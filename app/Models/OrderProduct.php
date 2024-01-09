<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Frontend\{Product};
class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'order_id','price','quantity','variants','include_cover_letter', 'cover_letter_price','cover_letter_path', 'delivery_option_name', 'delivery_option_price','cover_letter_status','file_upload_path','resumeStatus',
];


    // public function  getvariantsAttribute(){
    //     return unserialize($this->variants);
    // }
    public function order()
{
    return $this->belongsTo(Order::class);
}
public function product() {
        return $this->belongsTo(Product::class, 'product_id');
     }
    

    public function getProduct()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }
    public function folderPath()
    {
        return "main_product_files/" . strtolower(date("FY"));
    }
    public function getdownlaodfilelink($variants)
{
    $newFileArr = [];

    // Assuming $this refers to the OrderProduct model
    $orderProductId = $this->id;

    // Retrieve file links from the OrderProduct model
    $fileArr = $this->files; // Make sure to define the relationship in your OrderProduct model

    if (!empty($variants)) {
        $variants = unserialize($variants);
        foreach ($variants as $variant) {
            foreach ($fileArr as $file) {
                if ($file['file_price'] == $variant['price_id'] || $file['file_price'] == "ALL") {
                    $file['product_id'] = base64url_encode($orderProductId);
                    unset($file['file_external_url']);
                    unset($file['file_url']);
                    $newFileArr[] = $file;
                }
            }
        }
    } else {
        foreach ($fileArr as $file) {
            $file['product_id'] = base64url_encode($orderProductId);
            unset($file['file_external_url']);
            unset($file['file_url']);
            $newFileArr[] = $file;
        }
    }

    return $newFileArr;
}

}
