<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//burger seeder
        \App\Models\Item::create([
            'name' => 'Hotdog',
            'price' => 22.00,
            'category' => 'Burgers'
        ]);
        \App\Models\Item::create([
            'name' => 'Cheese Burger',
            'price' => 22.00,
            'category' => 'Burgers'
        ]);
        \App\Models\Item::create([
            'name' => 'Fries',
            'price' => 22.00,
            'category' => 'Burgers'
        ]);

//bev seeder
        \App\Models\Item::create([
            'name' => 'Coke',
            'price' => 10.00,
            'category' => 'Beverages'
        ]);
        \App\Models\Item::create([
            'name' => 'Sprite',
            'price' => 10.00,
            'category' => 'Beverages'
        ]);
        \App\Models\Item::create([
            'name' => 'Tea',
            'price' => 25.00,
            'category' => 'Beverages'
        ]);
//combo seeder
        \App\Models\Item::create([
            'name' => 'Chicken Combo Meal',
            'price' => 45.00,
            'category' => 'Combo Meal'
        ]);
        \App\Models\Item::create([
            'name' => 'Pork Combo',
            'price' => 55.00,
            'category' => 'Combo Meal'
        ]);
        \App\Models\Item::create([
            'name' => 'Fish Combo',
            'price' => 40.00,
            'category' => 'Combo Meal'
        ]);
    }
}
