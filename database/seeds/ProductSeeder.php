<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class,10)->create()->each(function ($product){
            factory(\App\Category::class,3)->create();
            $product->categories()->attach(rand(1,3));
        });
    }
}
