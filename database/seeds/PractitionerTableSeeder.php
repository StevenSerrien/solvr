<?php

use Illuminate\Database\Seeder;

class PractitionerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('practitioners')->insert(array(
        'firstname' => 'Sofie',
        'lastname' => 'Declau',
        'rizivnumber' => '6-04500-04-801',
        'email' => 'sofie_declau@hotmail.com',
        'password' => Hash::make('logo'),
        'isAdmin' => 1,
        'isConfirmed' => 1,
        'confirmation_code' => null,
        'practice_id' => 1
      ));

      DB::table('practitioners')->insert(array(
        'firstname' => 'Silke',
        'lastname' => 'Auwers',
        'rizivnumber' => '6-04708-04-801',
        'email' => 'silke_auwers@hotmail.com',
        'password' => Hash::make('logo'),
        'isAdmin' => 0,
        'isConfirmed' => 0,
        'confirmation_code' => str_random(30),
        'practice_id' => 1,
      ));
    }
}
