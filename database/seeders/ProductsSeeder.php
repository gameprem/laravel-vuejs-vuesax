<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for($i = 0 ;$i < 50; $i++){
            Products::create([
                'name' => $faker->sentence,
                'publish_date' => $faker->date,
            ]);
        }
    }
}
