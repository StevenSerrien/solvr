<?php

use Illuminate\Database\Seeder;

class AgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $agesRanges = [
           ['ageStart' => 4, 'ageEnd' => 6],
           ['ageStart' => 7, 'ageEnd' => 9],
           ['ageStart' => 10, 'ageEnd' => 11],
       ];


      DB::table('ages')->insert($agesRanges);
    }
}
