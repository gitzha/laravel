<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use mysql_xdevapi\Table;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
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

    public function welcome(Request $request){
        //随机获取一个表中存在的邀请码，用于测试邀请
        $invite_code = DB::table('users')->select('invite_code')->first();

        return view('welcome',['invite_code'=>  $invite_code->invite_code]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $id = Auth::id();

        $invite_code = DB::table('users')->where('id',$id)->select('invite_code')->first();

        return view('home',['invite_code'=>  $invite_code->invite_code]);
    }









}
