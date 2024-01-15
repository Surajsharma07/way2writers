<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    public $table = 'contactus';

    public $fillable = [
        'id',
        'name',
        'email',
        'message',
        'type',
        'filepath', // Consistent with the controller
        'is_replay'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'message' => 'string',
        'filepath'=>'string',
        'type' => 'string',
        'is_replay' => 'integer'
    ];

    public static array $rules = [
        // Your validation rules can go here if needed
    ];
    public function folderPath()
    {
        return "contactus/" . strtolower(date("FY"));
    }
}
