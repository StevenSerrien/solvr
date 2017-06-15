<?php

use Illuminate\Database\Seeder;

class ColorSchemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $colors = [
           ['hex' => '#dbe7fe', 'rgb' => '219, 231, 254'],
           ['hex' => '#fff0db', 'rgb' => '255, 240, 219'],
           ['hex' => '#ffe0e6', 'rgb' => '255, 224, 240'],
       ];


      DB::table('colorschemes')->insert($colors);
    }
}
