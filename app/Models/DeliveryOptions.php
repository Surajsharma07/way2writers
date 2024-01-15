<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOptions extends Model
{
    use HasFactory;
    public $fillable = [
        'id',
        'name',
        'amount',
        'is_active',
    ];

    public function getdeliveryoption()
    {
        return $this->hasMany(DeliveryOptions::class, 'id');
    }
}
