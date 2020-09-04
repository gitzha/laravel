<?php

use Illuminate\Database\Seeder;

class AwardStreamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = \Illuminate\Support\Facades\DB::table('users')->where('pid','>','0')->get();
        foreach ($data as $k=>$v){
            $insert = [
                'uid'=>$v->pid,
                'change_num'=>10,
                'source_type'=>1,
                'source_uid'=>$v->id,
                'created_at'=>date('Y-m-d H:i:s'),
            ];
            $insert1 = [
                'uid'=>$v->id,
                'change_num'=>5,
                'source_type'=>2,
                'source_uid'=>$v->pid,
                'created_at'=>date('Y-m-d H:i:s'),
            ];
            \Illuminate\Support\Facades\DB::table('award_streams')->insert([$insert,$insert1]);

        }
    }
}
