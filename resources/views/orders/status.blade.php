<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f9f9f9; }
        h1 { text-align: center; color: #ff5722; }
        .order-container {
            margin: 20px auto;
            max-width: 600px;
            background: white;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .order-container p { margin: 5px 0; }
        hr { border: 0; border-top: 1px solid #eee; }
        .receive-button {
            background: #ff5722;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .receive-button:hover {
            background: #e64a19;
        }
        .back-button {
            background: #ddd;
            color: #555;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background: #bbb;
        }
        .success-message {
            text-align: center;
            color: #4CAF50;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>

    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="back-button">Back</a>  <!-- Using Laravel's 'url()->previous()' to return to the previous page -->

    <!-- Display success message if available -->
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <!-- Order List -->
    <div class="order-container">
        @forelse ($orders as $order)
            <p><strong>Product:</strong> {{ $order->product_name }}</p>
            <p><strong>Status:</strong> 
                <span style="color: {{ $order->status == 'delivered' ? '#4CAF50' : '#000' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>

            <!-- Display Receive Button only for delivered orders -->
            @if ($order->status == 'delivered')
                <form action="{{ route('orders.receive', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="receive-button">Receive</button>
                </form>
            @endif
            <hr>
        @empty
            <p style="text-align: center; color: #777;">No delivered orders at the moment.</p>
        @endforelse
    </div>
</body>
</html>
