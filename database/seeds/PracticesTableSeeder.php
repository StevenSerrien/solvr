<?php

use Illuminate\Database\Seeder;

class PracticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('practices')->insert(array(
        'name' => 'Logokids',
        'streetname' => 'Ringlaan',
        'housenumber' => '33',
        'locality' => 'Merksem',
        'postal_code' => '2170',
        'telephone' => '0364 515 85',
        'isConfirmed' => 1,
        'lat' => 51.254320,
        'lng' => 4.457167
      ));
    }
}
