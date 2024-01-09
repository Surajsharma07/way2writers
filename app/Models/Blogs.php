<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    
    public $fillable = [
    'name',
    'slug',
    'category_id',
    'description',
    'image',
    'meta_title',
    'meta_description',
    'meta_keyword',
    'status',
    'created_by',
    'featured',
    ];
    public function getBlogs()
    {
        return $this->hasMany(Blogs::class, 'id','id');
    }
    public function getCategory()
    {
        return $this->hasOne(Blogs::class, 'id','id');
    }
    public function save(array $options = [])
    {
        if (request()->hasFile("image") && request()->file("image")->isValid()) {
            $this->image = request()->file("image")->store($this->folderPath());
        }
        return parent::save();
    }
    public function category()
    {
        return $this->belongsTo(Blogcategory::class, 'category_id');
    }
    public function folderPath()
    {
        return "blogs/" . strtolower(date("FY"));
    }
}

