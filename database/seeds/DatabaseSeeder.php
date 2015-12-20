<?php

use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        $this->call('UserTableSeeder');
        $this->call('FeatureTableSeeder');
        // $this->call('EventTableSeeder');
        $this->call('BSMTableSeeder');
        $this->call('DeleteTableSeeder');
        /* faker */
//        $this->call('FakerTableSeeder');
    }
}
