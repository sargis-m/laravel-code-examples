<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function ship(Request $request, $orderId)
    {
        // Ship the order...

        $order = Order::find($orderId);

        // Broadcast the OrderShipped event
        broadcast(new OrderShipped($order));

        return response()->json(['message' => 'Order shipped successfully']);
    }
}
