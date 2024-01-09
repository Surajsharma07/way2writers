<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogcategory extends Model
{
    use HasFactory;
    public $table = 'blogcategories';
    /**
     * Summary of fillable
     * @var array
     */
    public $fillable = [

        'name',
        'slug',
        'status',
       'description',
      'image',
      'meta_title',
    'meta_description',
    'meta_keywords',
    'navbar_status',
    'created_by',
    'featured',
    ];
    public function getBlogcat()
    {
        return $this->hasMany(Blogcategory::class, 'id','id');
    }
    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'category_id');
    }
    
}
