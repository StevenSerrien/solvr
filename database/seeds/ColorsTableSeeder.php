<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $colors = [
           ['name' => 'Aarbei Rood', 'code' => '#e3777'],
           ['name' => 'Zonnebloem Geel', 'code' => '#fce289'],
           ['name' => 'Blauwe Oceaan', 'code' => '#3b6ecc'],
           ['name' => 'Orange Wortel', 'code' => '#e67e22'],
           ['name' => 'Zachte Smaragd', 'code' => '#2ecc71'],
       ];


      DB::table('colors')->insert($colors);
    }
}
