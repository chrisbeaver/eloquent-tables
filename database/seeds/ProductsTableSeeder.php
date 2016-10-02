<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 3000)->create()->each(function($u) {
        	factory(App\Product::class)->make();
    	});
    }
}
