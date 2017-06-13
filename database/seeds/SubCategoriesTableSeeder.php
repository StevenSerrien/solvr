<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $subcategories = [
           ['name' => 'Sommen', 'category_id' => 1],
           ['name' => 'Breuken', 'category_id' => 1],
           ['name' => 'Vermenigvuldigen', 'category_id' => 1],

           ['name' => 'Verlengingsregel', 'category_id' => 2],

           ['name' => 'Taalbeschouwing', 'category_id' => 3],
       ];


      DB::table('subcategories')->insert($subcategories);
    }
}
