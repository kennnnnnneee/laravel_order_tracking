<?php  

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    // Main page with counts
    public function index()
    {
        $toPayCount = Order::where('status', 'to pay')->count();
        $toShipCount = Order::where('status', 'to ship')->count();
        $toDeliverCount = Order::where('status', 'to deliver')->count();
        $deliveredCount = Order::where('status', 'delivered')->count();

        return view('orders.index', compact(
            'toPayCount', 'toShipCount', 'toDeliverCount', 'deliveredCount'
        ));
    }

    // Page for "To Pay" status
    public function toPay()
    {
        $orders = Order::where('status', 'to pay')->get();
        return view('orders.status', ['orders' => $orders, 'title' => 'To Pay Orders']);
    }

    // Page for "To Ship" status
    public function toShip()
    {
        $orders = Order::where('status', 'to ship')->get();
        return view('orders.status', ['orders' => $orders, 'title' => 'To Ship Orders']);
    }

    // Page for "To Deliver" status
    public function toDeliver()
    {
        $orders = Order::where('status', 'to deliver')->get();
        return view('orders.status', ['orders' => $orders, 'title' => 'To Deliver Orders']);
    }

    // Page for "Delivered" status
    public function delivered()
    {
        $orders = Order::where('status', 'delivered')->get();

        // Add delivered count here
        $deliveredCount = Order::where('status', 'delivered')->count();

        return view('orders.status', [
            'orders' => $orders,
            'title' => 'Delivered Orders',
            'deliveredCount' => $deliveredCount
        ]);
    }

    // Mark an order as received and update delivered count
    public function receive($id)
    {
        // Find the order by ID
        $order = Order::findOrFail($id);

        // Update the status to 'received'
        $order->status = 'received';
        $order->save();

        // Recalculate the delivered count after the update
        $deliveredCount = Order::where('shipment_status', 'delivered')->count();

        // Redirect back with updated delivered count and success message
        return redirect()->back()->with([
            'success' => 'Order marked as received.',
            'deliveredCount' => $deliveredCount
        ]);
    }
}
