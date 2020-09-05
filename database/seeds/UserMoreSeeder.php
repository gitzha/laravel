<?php

use Illuminate\Database\Seeder;

class UserMoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = \Illuminate\Support\Facades\DB::table('users')->limit(20)->get();
        if (!$data->isEmpty()){
            foreach ($data as $k=>$v){
                $insert = [
                    'name'=>\Illuminate\Support\Str::random(4),
                    'pid'=>$v->id,
                    'invite_code' =>"",
                    'total_award'=>"5",
                    'email' => \Illuminate\Support\Str::random(4)."@qq.com",
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => \Illuminate\Support\Str::random(10),
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s')
                ];

                $insert_id =   \Illuminate\Support\Facades\DB::table('users')->insertGetId($insert);
                \Illuminate\Support\Facades\DB::table('users')->where('id',$v->id)->update(['total_award'=>10]);
                $invite_code = createCode($insert_id,6);
                \Illuminate\Support\Facades\DB::table('users')->where('id',$insert_id)->update(['invite_code'=>$invite_code]);

            }
        }

    }
}
