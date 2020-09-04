<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = \Illuminate\Support\Facades\DB::table('users')->limit(20)->get();
        if(empty($data)){
            factory(App\User::class, 20)->create()->each(function ($user) {
                $user->save(factory(App\User::class)->make());
            });
        }


        if (!empty($data)){
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
                ];

              $res =   \Illuminate\Support\Facades\DB::table('users')->insert($insert);
              \Illuminate\Support\Facades\DB::table('users')->where('id',$v->id)->update(['total_award'=>10]);
            }
        }
        $data = \Illuminate\Support\Facades\DB::table('users')->get();
        if(!empty($data)){
            foreach ($data as $k=>$v){
                $invite_code = createCode($v->id,6);
                \Illuminate\Support\Facades\DB::table('users')->where('id',$v->id)->update(['invite_code'=>$invite_code]);
            }
        }

    }

}
