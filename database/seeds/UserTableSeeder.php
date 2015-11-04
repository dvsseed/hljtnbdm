<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        DB::table('users')->truncate();

        User::create([
            'account' => '8000',
            'name' => '管理员',
            'password' => Hash::make('root'),
            'position' => '管理员',
            'is_admin' => 1
        ]);

        User::create([
            'account' => '0000',
            'name' => '测试员',
            'position' => '卫教师',
            'password' => Hash::make('0000')
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
