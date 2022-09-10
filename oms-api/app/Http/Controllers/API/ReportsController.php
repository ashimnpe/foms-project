<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
   public function getDailyReport(){
    $orders = Order::with(['order_details' => function ($query) {
        $query->with('product')->get();
    }])->get();

    return parent::resp(true, $orders, 200);
    }
}
