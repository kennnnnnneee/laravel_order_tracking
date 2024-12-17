<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        h1 { text-align: center; color: #333; margin-top: 20px; }
        .container { width: 90%; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        th { background: #ff5722; color: white; }
        .success { color: green; }
        .error { color: red; }
        .action-buttons { display: flex; justify-content: center; gap: 10px; }
        button, form { display: inline-block; }
        .delete-btn { background: red; color: white; border: none; padding: 5px 10px; cursor: pointer; }
        .update-btn { background: #ff9800; color: white; border: none; padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Admin Order Management</h1>
    <div class="container">
        <!-- Success Message -->
        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <!-- Filter Dropdown -->
        <form method="GET" style="margin-bottom: 20px;">
            <label for="status">Filter by Status: </label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="to_pay" {{ $status == 'to_pay' ? 'selected' : '' }}>To Pay</option>
                <option value="to_ship" {{ $status == 'to_ship' ? 'selected' : '' }}>To Ship</option>
                <option value="to_deliver" {{ $status == 'to_deliver' ? 'selected' : '' }}>To Deliver</option>
                <option value="delivered" {{ $status == 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
        </form>

        <!-- Orders Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td class="action-buttons">
                            <!-- Update Status Form -->
                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                                @csrf
                                <select name="status" required>
                                    <option value="to_pay" {{ $order->status == 'to_pay' ? 'selected' : '' }}>To Pay</option>
                                    <option value="to_ship" {{ $order->status == 'to_ship' ? 'selected' : '' }}>To Ship</option>
                                    <option value="to_deliver" {{ $order->status == 'to_deliver' ? 'selected' : '' }}>To Deliver</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                                <button type="submit" class="update-btn">Update</button>
                            </form>
                            <!-- Delete Order -->
                            <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div style="margin-top: 20px; text-align: center;">
            {{ $orders->links() }}
        </div>
    </div>
</body>
</html>
