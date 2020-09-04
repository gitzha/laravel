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

    public function user(){
        $userlist = User::with('allChildren')->get();
        return view('user',compact('userlist'));
    }

    public function userinfo(){
        $userinfo = DB::table('users')->get();
        return view('userinfo',compact('userinfo'));
    }



}
