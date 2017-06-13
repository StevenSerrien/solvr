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
           ['ageStart' => 1, 'ageEnd' => 4],
           ['ageStart' => 5, 'ageEnd' => 7],
           ['ageStart' => 7, 'ageEnd' => 11],
       ];


      DB::table('ages')->insert($agesRanges);
    }
}
