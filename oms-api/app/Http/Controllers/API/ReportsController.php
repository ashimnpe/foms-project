<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
   public function getDailyReport(){
    $dateType = request()->date_type;
    $month = request()->month;
    

    $baseQuery = OrderDetail::groupBy('product_id')->orderBy('id','asc')
        ->selectRaw('*, sum(quantity) as total_qty, sum(total) as total_amount')
        ->with('product');

    if ($dateType == 'Yesterday') {
        $baseQuery->whereDate('created_at', Carbon::yesterday());
    } else if ($dateType == 'Today') {
        $baseQuery->whereDate('created_at', Carbon::today());
    } else if ($dateType == 'Month' && isset($month)) {
        $baseQuery->whereMonth('created_at', date('m', strtotime($month)));
    }   

    $orderDetails = $baseQuery->get();

    

    return parent::resp(true, $orderDetails, 200);
    }
}
