@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
<style>
    ul li{
        list-style: none;
        line-height: 30px;
    }
</style>
    <div class="row ">
       @include('sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header btn-primary">{{ __('用户关系表') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div>

                    <ul>
                        <li style="color: #1cc09f;font-size: 18px;font-weight: bold;margin-bottom: 20px">id  <span style="margin-left: 15px;" >姓名</span></li>
                        @foreach ($userlist as $user)
                            <li >{{ $user->id }}_{{ $user->name }}</li>
                            <ul>
                                @foreach ($user->allChildren as $childCategory)
                                    @include('child_category', ['child_category' => $childCategory])
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>



                </div>
            </div>
        </div>
    </div>
{{--    <div class="row justify-content-center">--}}

{{--    </div>--}}

{{--</div>--}}

@endsection
