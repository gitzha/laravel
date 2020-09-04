<?php

use Illuminate\Database\Seeder;

class AwardConfig extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('award_configs')->insert([
            'lower_num' => 5,
            'upper_num' => 10,
        ]);
    }
}
