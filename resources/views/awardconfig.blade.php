@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
       @include('sidebar')
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('积分配置') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">邀请人</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="upper" placeholder="邀请人奖励积分数量" value="{{ $data->upper_num }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">被邀请人</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="lower" placeholder="被邀请人奖励积分数量" value="{{ $data->lower_num }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-primary" id="award_submit">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#award_submit').click(function () {
            var upper = $('#upper').val();
            var lower = $('#lower').val();
            $.ajax({
                url:"{{ route('awardconfig') }}",
                type:"post",
                data:{upper:upper,lower:lower,_token:"{{csrf_token()}}"},
                dataType: 'json',
                success:function (res) {
                    alert(res.msg);
                }
                })

        });


    </script>
</div>

@endsection
