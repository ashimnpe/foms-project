<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'order_id','product_id','quantity', 'total', 'grand_total'
    ];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function products()
    {
        return $this->hasOne(Product::class);
    }
}
