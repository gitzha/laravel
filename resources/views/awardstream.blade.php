@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
    <div class="row ">
       @include('sidebar')
{{--        <div class="row justify-content-center">--}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header btn-primary">{{ __('用户积分记录') }}</div>

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
                                <th>积分变化</th>
                                <th>积分变化类型</th>
                                <th>来源uid</th>
                                <th>来源用户名</th>
                                <th>创建时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($awardstream as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>+{{ $data->change_num }}</td>
                                    @if ( $data->source_type  === 1)
                                        <td>邀请好友返利</td>
                                    @elseif ($data->source_type === 2)
                                        <td>被邀请注册</td>
                                    @else

                                    @endif
                                    <td>{{ $data->source_uid }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->created_at }}</td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
{{--    </div>--}}


{{--</div>--}}

@endsection
