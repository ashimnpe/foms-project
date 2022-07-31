<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function placeOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $order = Order::create([
                'net_total' => $request->netTotal,
                'grand_total' => $request->netTotal
            ]);

            foreach($request->products as $prod) {
                $product = (object) $prod;
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                    'total' => $product->total,
                ]);
            }

            DB::commit();
            return parent::resp(true, [
                'message' => 'Order placed successfully!',
                'orderId' => $order->id
            ], 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return parent::resp(false, $th->getMessage(), 422);
        }
    }

}
