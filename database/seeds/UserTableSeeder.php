<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
        'id' => 128,
        'name' => '王媛媛',
        'password' => Hash::make('128')
        ]);

        User::create([
        'id' => 100,
        'name' => '邱美玲',
        'password' => Hash::make('100')
        ]);

        User::create([
        'id' => 8000,
        'name' => '管理员',
        'password' => Hash::make('root'),
        'is_admin' => 1
        ]);

    }
}
