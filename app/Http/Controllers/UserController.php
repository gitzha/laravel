<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use mysql_xdevapi\Table;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 用户关系
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user(){
        $userlist = User::with('allChildren')->get();
        return view('user',compact('userlist'));
    }

    /**
     * 用户信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userinfo(){
        $userinfo = DB::table('users')->get();
        foreach ($userinfo as $k=>$v){
            $count = DB::table('users')->where('pid',$v->id)->count('id');
            $userinfo[$k]->invite_num=$count;
        }
        return view('userinfo',compact('userinfo'));
    }



}
