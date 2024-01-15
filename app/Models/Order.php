<?php

namespace App\Models;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tnx_id','payment_id','payer_id','billing_email', 'billing_name', 'billing_address', 'billing_city',
    'billing_province', 'billing_postalcode', 'billing_phone', 'billing_name_on_card',
    'billing_discount', 'billing_discount_code', 'billing_subtotal', 'billing_tax',
    'billing_total', 'error','payment_method','mode','payment_gateway','status','json_response','include_cover_letter', 'cover_letter_price','cover_letter_status', 'delivery_option_name','delivery_option_price',
];


public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
    public function getUser()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function getOrderProduct()
    {
        return $this->hasMany(OrderProduct::class,'order_id','id');
    }

    public function getStatusAttribute($val)
    {
        if($val == 1)
        return 'Order Received';
        elseif($val == 2)
        return 'Fail';
        elseif($val == 3)
        return 'proccessing';
        elseif($val == 4)
        return 'Complete';
        else
        return 'Payment pending';
    }

    public static $searchable = [
        'id' => 'Order Id',
        'tnx_id' => 'Transaction Id',
        'user_id' => 'User Id',
        'payment_gateway' => 'Payment Gateway',
        'status' => 'Status',
        'payment_id' => 'Payment Id',
        'payer_id' => 'Payer Id',
        'billing_total' => 'Billing Total',
        'created_at'=>'DATE',
    ];
    
}
