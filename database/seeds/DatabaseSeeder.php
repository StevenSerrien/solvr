<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('PracticesTableSeeder');
        $this->call('PractitionerTableSeeder');
        $this->call('SpecialitiesTableSeeder');
        $this->call('ColorsTableSeeder');
        $this->call('AgesTableSeeder');

        $this->call('CategoriesTableSeeder');
        $this->call('SubCategoriesTableSeeder');

    }
}
