<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public $invitecode;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {

        $this->invitecode = $request->input('invite_code');
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $invite_uid = 0;
        if(!empty($data['invitecode'])){
            $invite_uid = jdecode($data['invitecode']);
        }

        //$invite_uid 获取邀请用户信息，数据不为空，//获取积分配置表，开启事务，邀请用户total_num + upper，当前用户+lower
        $invite_user = DB::table('users')->where('id',$invite_uid)->first();

        if(!empty($invite_user)){
            $award_config = DB::table('award_configs')->first();
            DB::beginTransaction();
            $invite_total_award = $invite_user->total_award + $award_config->upper_num;
            $invite_res = DB::table('users')->where('id',$invite_uid)->update(['total_award'=>$invite_total_award]);
            $total_award = $user->total_award + $award_config->lower_num;
            $user_res =  DB::table('users')->where('id',$user->id)->update(['total_award'=>$total_award]);
            //积分流水表
            $invite['uid'] = $invite_uid;
            $invite['change_num'] = $award_config->upper_num;
            $invite['source_type'] = 1;
            $invite['source_uid'] = $user->id;
            $invite['created_at'] = date('Y-m-d H:i:s');
            $user_stream['uid'] = $user->id;
            $user_stream['change_num'] = $award_config->lower_num;
            $user_stream['source_type'] = 2;
            $user_stream['source_uid'] = $invite_uid;
            $user_stream['created_at'] = date('Y-m-d H:i:s');
            $stream_res = DB::table('award_streams')->insert([$invite,$user_stream]);
            if($invite_res && $user_res && $stream_res){
                DB::commit();
            }else{
                DB::rollBack();
            }
        }

        $invite_code = createCode($user->id,6);
        DB::table('users')->where('id',$user->id)->update(['invite_code'=>"$invite_code",'pid'=>$invite_uid]);
        //积分流水表中记录本次积分变动信息，


       return  $user;
    }
}
