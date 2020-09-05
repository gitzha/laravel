@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
    <div class="row ">
       @include('sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header btn-primary">{{ __('用户信息') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>用户id</th>
                            <th>用户名称</th>
                            <th>总邀请好友</th>
                            <th>积分总数</th>
                            <th>注册时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($userinfo as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->invite_num }}</td>
                                <td>{{ $user->total_award }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td><a href="{{route('awardstream',array('uid'=>$user->id))  }}" class="btn  btn-primary">积分记录</a></td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
{{--    <div class="row justify-content-center">--}}

{{--    </div>--}}

{{--</div>--}}

@endsection
