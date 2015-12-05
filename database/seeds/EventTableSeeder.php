<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->truncate();

        Event::create([
            'tablename' => 'users',
            'action' => 'create(创建)',
            'user_id' => 2
        ]);

        Event::create([
            'tablename' => 'users',
            'action' => 'store(保存)',
            'user_id' => 2
        ]);

        Event::create([
            'tablename' => 'users',
            'action' => 'destroy(删除)',
            'user_id' => 2
        ]);

    }
}
