<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'name' => 'Adobo',
                'description' => 'Made from chicken or pork',
                'price' => 45.00,
                'imageUrl' => 'adobo.jpg'
            ],
            [
                'name' => 'Afritada',
                'description' => 'Made from chicken or pork',
                'price' => 50.00,
                'imageUrl' => 'afritada.jpg'
            ],
            [
                'name' => 'Giniling',
                'description' => 'Made from chicken or pork',
                'price' => 40.00,
                'imageUrl' => 'giniling.jpg'
            ],
        ];

        foreach($data as $d){
            Food::create($d);
        }
    }
}
