<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Image,Storage;
use App\Models\OrderProduct;
use App\Models\User,Order;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory,SoftDeletes;

    public $fillable = [
        'sale_count',
        'rating',
    ];
   
    public function getThumbAttribute()
    {
        if ($this->image != ""){
            $path = str_replace('images','thmbnail',$this->image);
            return \Storage::url($path);
        }
        return "";
    }
    public function getImageUrlAttribute()
    {
        if ($this->image != "")
            return \Storage::url($this->image);

        return $this->image;
    }
   
    public function getUser()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function scopeMightAlsoLike($query) {
        return $query->inRandomOrder()->where('is_active', 1)->where('category_id', '!=', 2)->take(3);
        
    }
    

    public function getProductMetaAttribute(){
         return (object) $this->hasOne(ProductMeta::class, 'product_id','id')->pluck('value','key')->toArray();
    }


    public function productPrice(){
        $free= 0; $from = 0; $to = 0; $price = 0; $offer_price = 0;
        if($this->is_free == '1'){
            $free = 1;
            $price = $this->price;
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

    public function getProductDetailsAttribute($val)
    {
        return unserialize($val);
    }


    public function getProductReview(){
        return $this->hasMany(Rating::class, 'product_id','id')->whereNull('parent_id');
    }
    public function getProductComment(){
        return $this->hasMany(Comments::class, 'product_id','id')->whereNull('parent_id');
    }
/*
    public function getdownlaodfilelink($variants){
        $data = (object) $this->hasOne(ProductMeta::class, 'product_id','id')->pluck('value','key')->toArray();
        $newFileArr=[];
        $fileArr = unserialize(@$data->multi_file);


        if(!empty($variants)){
            $variants = unserialize($variants);
            foreach ($variants as $key => $v2) {
                foreach ($fileArr as $key => $v3) {
                   
                    if($v3['file_price'] == @$v2['price_id'] || $v3['file_price'] == "ALL"){
                        $v3['product_id'] = base64url_encode($this->id);
                        unset($v3['file_external_url']);
                        unset($v3['file_url']);
                        $newFileArr[] = $v3;
                    }
                }
            }
        }else{
            foreach ($fileArr as $key => $v3) {
                $v3['product_id'] =  base64url_encode($this->id);
                unset($v3['file_external_url']);
                unset($v3['file_url']);
                $newFileArr[] = $v3;
            }
        }
        return $newFileArr;
    }*/
    // Assuming you have a user_id field in the Order model
    public function getdownlaodfilelink($orderId) {
        $newFileArr = [];
    
        // Fetch OrderProduct data for the given order ID
        $orderProducts = OrderProduct::where('order_id', $orderId)->get();
    
        foreach ($orderProducts as $orderProduct) {
            // Fetch files from OrderProduct model, adjust the key names based on your actual database structure
            $fileArr = [
                'file_name' => 'resume', // Replace with the actual field name for file name
                'file_price' => $orderProduct->price, // Replace with the actual field name for file price
                'product_id' => base64url_encode($orderProduct->product_id),
                'file_path' => $orderProduct->file_upload_path, // Replace with the actual field name for file path
            ];
    
            $newFileArr[] = $fileArr;
    
            // If cover letter is included, add cover letter file to $newFileArr
            if ($orderProduct->include_cover_letter && $orderProduct->cover_letter_path) {
                $coverLetterFile = [
                    'file_name' => 'Cover Letter',
                    'file_price' => $orderProduct->cover_letter_price, // Replace with the actual field name for cover letter price
                    'product_id' => base64url_encode($orderProduct->product_id),
                    'file_path' => $orderProduct->cover_letter_path,
                ];  
    
                $newFileArr[] = $coverLetterFile;
            }
        }
    
        return $newFileArr;
    }
            

    public function getUserProductReview(){
        return $this->hasOne(Rating::class, 'product_id','id')->where('user_id',auth()->id());
    }


    public function ratingUpdate($id)
    {
        return  Rating::where('product_id',4)->avg('rating');
    }

    //check user saves the product into the wishlist
    public function check_in_wishlist(){
        return $this->hasOne(Wishlist::class, 'product_id','id')->where('user_id',auth()->id())->exists(); 

    }
}
