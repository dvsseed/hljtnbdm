<?php

use Illuminate\Database\Seeder;
use App\BSM;

class BSMTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bsm')->truncate();

        BSM::create([
        'bm_name' => '艾科灵睿',
        'bm_model' => '艾科灵睿',
        'bm_order' => 1
        ]);

        BSM::create([
        'bm_name' => '鱼跃',
        'bm_model' => '鱼跃',
        'bm_order' => 2
        ]);

        BSM::create([
        'bm_name' => '滕爱',
        'bm_model' => '滕爱',
        'bm_order' => 3
        ]);

        BSM::create([
        'bm_name' => '康迅360',
        'bm_model' => '康迅360',
        'bm_order' => 4 
        ]);

        BSM::create([
        'bm_name' => '泰尔茂',
        'bm_model' => '泰尔茂',
        'bm_order' => 5 
        ]);

        BSM::create([
        'bm_name' => '艾科益优',
        'bm_model' => '艾科益优',
        'bm_order' => 6 
        ]);

        BSM::create([
        'bm_name' => 'POP',
        'bm_model' => 'POP',
        'bm_order' => 7 
        ]);

    }
}
