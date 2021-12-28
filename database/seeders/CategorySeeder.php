<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            'name' => 'Burgers',
        ]);
        \App\Models\Category::create([
            'name' => 'Beverages',
        ]);
        \App\Models\Category::create([
            'name' => 'Combo Meal',
        ]);

    }
}
