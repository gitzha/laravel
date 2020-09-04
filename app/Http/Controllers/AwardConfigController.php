<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use mysql_xdevapi\Table;
use Illuminate\Support\Facades\Validator;

class AwardConfigController extends Controller
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

    public function awardconfig(Request $request){
        $data = DB::table('award_configs')->first();
        if($_POST){

            $request->validate([
                'upper' => 'required|numeric',
                'lower' => 'required|numeric',
            ]);

            $param['upper_num'] = trim($request->input('upper'));
            $param['lower_num'] = trim($request->input('lower'));

            if($data->upper_num == $param['upper_num'] && $data->lower_num = $param['lower_num']){//防止重复更改数据库
                return response(['code'=>1,'msg'=>"修改后的内容和修改前一样，如需修改，请更改内容!"]);;
            }
            $param['updated_at'] = date('Y-m-d H:i:s',time());

            $res = DB::table('award_configs')->update($param);
            if($res){
                return response(['code'=>1,'msg'=>"修改成功!"]);
            }else{
                return response(['code'=>0,'msg'=>"修改失败!"]);
            }
        }
        return view('awardconfig',['data'=>$data]);
    }



}
