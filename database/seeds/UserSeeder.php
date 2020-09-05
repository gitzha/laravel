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
        factory(App\User::class, 30)->create();
        $data = \Illuminate\Support\Facades\DB::table('users')->get();
        if(!$data->isEmpty()){
            foreach ($data as $k=>$v){
                $invite_code = createCode($v->id,6);
                \Illuminate\Support\Facades\DB::table('users')->where('id',$v->id)->update(['invite_code'=>$invite_code]);
            }
        }

    }

}
