<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'category_id', 'price', 'image'
    ];

    protected $appends = ['category_title'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryTitleAttribute()
    {
        return Category::findOrFail($this->category_id)->title;
    }

}
