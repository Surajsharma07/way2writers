<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User,Order,OrderProduct};
use Image,Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    public $fillable = [
        'product_type',
        'name',
        'slug',
        'image',
        'category_id',
        'sub_category_id',
        'user_id',
        'tags',
        'description',
        'quantity',
        'preview_link',
        'uploaded_by',
        'price',
        'is_enable_multi_price',
        'file_type',
        'file_name',
        'file_url',
        'file_open_pass',
        'coupon_id',
        'is_active',
        'is_fee',
        'is_preview',
        'is_featured',
        'meta_title',
        'meta_keywords',
        'meta_desc',
        'sale_count',
        'rating',
        'short_desc',
        'product_details'
    ];

    public function getImageAttribute($path)
    {
        if ($path != "")
            return \Storage::url($path);

        return $path;
    }

    public function save(array $options = [])
    {
        if (request()->hasFile("image") && request()->file("image")->isValid()) {
                $image = request()->file('image');
                $imageName = time().uniqid().'.'.$image->extension();
                $this->image = request()->file('image')->storeAs($this->folderPath(), $imageName);
                $img = Image::make($image->path());
                $img->resize(400, 250, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->stream();
                Storage::disk('local')->put($this->thumbfolderPath().'/'.$imageName, $img, 'public');

        }
        return parent::save();
    }

    public function folderPath()
    {
        return "product/images/" . strtolower(date("FY"));
    }
    public function thumbfolderPath()
    {
        return "product/thmbnail/" . strtolower(date("FY"));
    }
    public function previewfolderPath()
    {
        return "product/preview/" . strtolower(date("FY"));
    }
    public function filefolderPath()
    {
        return "product/files/" . strtolower(date("FY"));
    }
  
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, 'id','category_id');
    }
    public function getUser()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function getProductDetailsAttribute($val)
    {
        return unserialize($val);
    }


    public function scopeFilter($query)
    {
        if (request('product_type'))
            $query->where('product_type', '=', request('product_type'));
        if(request('category_id'))
            $query->where('category_id', '=', request('category_id'));
        if(request('sub_category_id'))
            $query->where('sub_category_id', '=', request('sub_category_id'));
        if (request('filter') == 'contains')
            $query->where(request('key'), 'like', '%' . request('s') . '%');
        if (request('filter') == 'equals')
            $query->where(request('key'), '=', request('s'));
        if (request('filter') == 'greaterEquals')
            $query->where(request('key'), '>=', request('s'));
        if (request('filter') == 'lesserEquals')
            $query->where(request('key'), '<=', request('s'));
        return;
    }


    public function getProductReview(){
        return $this->hasMany(Rating::class, 'product_id','id')->whereNull('parent_id');
    }
    public function getProductComment(){
        return $this->hasMany(Rating::class, 'product_id','id')->whereNull('parent_id');
    }

    public function getNetRevenue(){
        $orderId = OrderProduct::where('product_id',$this->id)->pluck('id');
        return Order::whereIn('id',$orderId)->sum('billing_total');
    }

    public function getProductMetaAttribute(){
        return (object) $this->hasOne(ProductMeta::class, 'product_id','id')->pluck('value','key')->toArray();
    }
    public function productPrice(){
        $free= 0; $from = 0; $to = 0; $price = 0; $offer_price = 0;
        if($this->is_free == '1'){
            $free = 1;
            $price =  $this->price;
        }else{
            if (($this->is_enable_multi_price == 1 && isset($this->productMeta->multi_price) &&!empty($this->productMeta->multi_price))){
                $priceArr = (object) unserialize(@$this->productMeta->multi_price);
                foreach ($priceArr as $key => $value){
                    if($key == 0){
                        if (!empty(@$value['offer_price']) && @$this->is_offer != 0){
                            $from = @$value['offer_price'];                                      
                        }
                        else{
                            $from =  @$value['price'];
                        }
                    }else{
                        if (!empty(@$value['offer_price']) && @$this->is_offer != 0){
                            $to = @$value['offer_price'];                                      
                        }
                        else{
                            $to =  @$value['price'];
                        }
                    }
                }
            }
            else{
                if (@$this->is_offer != '0')
                   $offer_price  = $this->offer_price;
                
                   $price =  $this->price;
       
            }
        }

        return  ['free' => $free, 'from' => $from, 'to'=> $to, 'price'=>$price,'offer_price'=>$offer_price];
    }
}
