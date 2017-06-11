<?php

use Illuminate\Database\Seeder;

class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('specialities')->insert(array(
        'name' => 'ASS',
      ));
      DB::table('specialities')->insert(array(
        'name' => 'Autisme',
      ));
      DB::table('specialities')->insert(array(
        'name' => 'Leerstoornissen',
      ));
      DB::table('specialities')->insert(array(
        'name' => 'Dyscalculie',
      ));
    }
}
