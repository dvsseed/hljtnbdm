<?php

use Illuminate\Database\Seeder;
use App\Feature;
use App\Hasfeature;

class FeatureTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        DB::table('features')->truncate();

        /*
                Feature::create([
                    'href' => '/dm/home',
                    'btnclass' => 'btn-success',
                    'innerhtml' => '个人信息'
                ]);
        */

        Feature::create([
            'href' => '/patient',
            'btnclass' => 'btn-primary',
            'innerhtml' => '患者资料'
        ]);

        Feature::create([
            'href' => '/case',
            'btnclass' => 'btn-info',
            'innerhtml' => '方案管理'
        ]);

        DB::table('hasfeatures')->truncate();

        Hasfeature::create([
            'user_id' => 2,
            'feature_id' => 1
        ]);

        Hasfeature::create([
            'user_id' => 2,
            'feature_id' => 2
        ]);

        Hasfeature::create([
            'user_id' => 3,
            'feature_id' => 1
        ]);

        Hasfeature::create([
            'user_id' => 3,
            'feature_id' => 2
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
