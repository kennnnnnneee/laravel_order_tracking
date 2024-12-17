<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    // Show all orders with filtering by status
    public function index(Request $request)
    {
        $status = $request->get('status'); // Optional filter for status
        $orders = Order::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders', 'status'));
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:to_pay,to_ship,to_deliver,delivered',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully!');
    }
}

