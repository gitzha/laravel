@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
       @include('sidebar')
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('用户关系表') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div>

                            <ul>
                                @foreach ($userlist as $user)
                                    <li>{{ $user->name }}</li>
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

</div>

@endsection
