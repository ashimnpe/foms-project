<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title', 'order_detail_id','quantity', 'total', 'grand_total'
    // ];

    protected $guarded = [];


    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }


}
