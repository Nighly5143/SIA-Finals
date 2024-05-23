<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Food;
use App\Model\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CustomerSeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
