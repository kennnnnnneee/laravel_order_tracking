<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['to pay', 'to ship', 'to deliver', 'delivered'];

        foreach (range(1, 20) as $index) {
            Order::create([
                'product_name' => 'Product ' . $index,
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}

