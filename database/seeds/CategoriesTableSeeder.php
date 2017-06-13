<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $categories = [
           ['name' => 'Rekenen'],
           ['name' => 'Spelling'],
           ['name' => 'Taal'],
       ];


      DB::table('categories')->insert($categories);
    }
}
