@extends('layouts.app')

@section('content')
<div >
    <div class="row ">
        @include('sidebar')
{{--        <div class="row justify-content-center">--}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert" >
                                {{ session('status') }}
                            </div>
                        @endif
                        <p style="font-size: 20px">
                            {{ __('You are logged in!') }}

                        </p>
                           <p style="margin: 100px 0;font-weight: bold;font-size: 20px;color: #1ab394">
                               你的邀请码是：{{$invite_code}}<br/><br/>
                               邀请好友链接： <a  href="{{route('register',array('invite_code'=>$invite_code))}}">{{route('register',array('invite_code'=>$invite_code))}}</a>
                              <br/><br/>  复制后退出重新注册进行测试
                           </p>



                    </div>

                </div>
            </div>
{{--        </div>--}}
    </div>

</div>

@endsection
