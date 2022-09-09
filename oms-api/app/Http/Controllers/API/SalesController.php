<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class SalesController extends Controller
{
   public function getDailySales(){
    $orders = Order::with(['order_details' => function ($query) {
        $query->with('product')->get();
    }])->get();

    }
}
