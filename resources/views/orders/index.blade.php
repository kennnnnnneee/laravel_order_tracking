<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f9f9f9; margin: 0; }
        h1 { color: #ff5722; }
        .button-container { display: flex; justify-content: center; margin-top: 20px; gap: 20px; }
        .status-button {
            display: inline-block;
            text-decoration: none;
            color: #555;
            text-align: center;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 120px;
            position: relative;
        }
        .status-button i { font-size: 24px; color: #ff5722; }
        .status-button span { display: block; margin-top: 8px; }
        .badge {
            position: absolute;
            top: 5px;
            right: 10px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 5px 8px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Order Tracking</h1>

    <!-- Buttons for Status -->
    <div class="button-container">
        <!-- To Pay -->
        <a href="{{ route('orders.toPay') }}" class="status-button">
            <i class="fa-solid fa-wallet"></i>
            <span>To Pay</span>
            @if ($toPayCount > 0)
                <div class="badge">{{ $toPayCount }}</div>
            @endif
        </a>

        <!-- To Ship -->
        <a href="{{ route('orders.toShip') }}" class="status-button">
            <i class="fa-solid fa-box"></i>
            <span>To Ship</span>
            @if ($toShipCount > 0)
                <div class="badge">{{ $toShipCount }}</div>
            @endif
        </a>

        <!-- To Deliver -->
        <a href="{{ route('orders.toDeliver') }}" class="status-button">
            <i class="fa-solid fa-truck"></i>
            <span>To Deliver</span>
            @if ($toDeliverCount > 0)
                <div class="badge">{{ $toDeliverCount }}</div>
            @endif
        </a>

        <!-- Delivered -->
        <a href="{{ route('orders.delivered') }}" class="status-button">
            <i class="fa-solid fa-check-circle"></i>
            <span>Delivered</span>
            @if ($deliveredCount > 0)
                <div class="badge">{{ $deliveredCount }}</div>
            @endif
        </a>
    </div>
</body>
</html>
