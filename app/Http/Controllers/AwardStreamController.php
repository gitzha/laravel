<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use mysql_xdevapi\Table;
use Illuminate\Support\Facades\Validator;

class AwardStreamController extends Controller
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
     * 用户积分流水
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function awardstream(Request $request){
        $request->validate([
            'uid' => 'required|numeric',
        ]);
        $uid = $request->input('uid');
        $awardstream = DB::table('award_streams')->leftjoin('users','award_streams.source_uid','=','users.id')->where('award_streams.uid',$uid)->select('users.name', 'award_streams.*')->get();
        return view('awardstream',compact('awardstream'));
    }


}
