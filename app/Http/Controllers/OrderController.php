<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET all orders
    public function index()
    {
        return Order::all();
    }

    // GET one order
    public function show($id)
    {
        return Order::findOrFail($id);
    }

    // CREATE order
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => $request->status ?? 'pending',
        ]);

        return response()->json($order, 201);
    }

    // UPDATE order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update($request->all());

        return response()->json($order);
    }

    // DELETE order
    public function destroy($id)
    {
        Order::destroy($id);

        return response()->json(['message' => 'Order deleted']);
    }
}
