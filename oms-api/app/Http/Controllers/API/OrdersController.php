<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
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

            foreach ($request->products as $prod) {
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

    public function getAllOrders()
    {
        $orders = Order::with(['order_details' => function ($query) {
            $query->orderBy('created_at')->with('product')->get();
        }])
        ->withTrashed()
        ->get();

        return parent::resp(true, $orders, 200);
    }

    public function makePayment(Request $request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
            $order->update([
                'payment_status' => 'Paid'
            ]);
            return parent::resp(true, 'Payment made successfully', 201);
        } catch (\Throwable $th) {
            return parent::resp(false, $th->getMessage(), 400);
        }
    }

    public function completeOrder(Request $request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
            $order->update([
                'order_status' => 'Completed',
            ]);
            return parent::resp(true, 'Order completed', 201);
        } catch (\Throwable $th) {
            return parent::resp(false, $th->getMessage(), 400);
        }
    }

    public function cancelOrder(Request $request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
            $order->update([
                'order_status' => 'canceled',
                // 'order_quantity' => null
            ]);
            $order->delete();
            // return $order;
            // $order_details->update([
            //     'order_quantity' => 0
            // ]);

            return parent::resp(true, 'Order canceled', 201);
        } catch (\Throwable $th) {
            return parent::resp(false, $th->getMessage(), 400);
        }
    }

    public function getCount()
    {
        $user = User::count();
        $order = Order::withTrashed()->get('order_status as status');

        $count = [
            'user' => $user,
            'total' => $order->count(),
            'pending' => $order->where('status', 'processing')->count(),
            'completed' => $order->where('status', 'Completed')->count(),
            'canceled' => $order->where('status', 'canceled')->count()
        ];
        return parent::resp(true, $count);
    }
}
