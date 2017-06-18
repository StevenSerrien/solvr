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
           ['name' => 'Hoofdrekenen', 'category_id' => 1],
           ['name' => 'Metend Rekenen', 'category_id' => 1],
           ['name' => 'Getallenkennis', 'category_id' => 1],

           ['name' => 'Verlengingsregel', 'category_id' => 2],
           ['name' => 'Verenkelen en verdubbelen', 'category_id' => 2],
           ['name' => 'Vervoegingen', 'category_id' => 2],

           ['name' => 'Taalbeschouwing', 'category_id' => 3],
           ['name' => 'Voorzetsels', 'category_id' => 3],
           ['name' => 'Voornaamwoorden', 'category_id' => 3],
       ];


      DB::table('subcategories')->insert($subcategories);
    }
}
