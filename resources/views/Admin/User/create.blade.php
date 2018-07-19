@extends('Admin.common.layout')
@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <div class="ibox-title">
                <h5>添加管理员 <small></small></h5>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" id="Form" action="{{asset('/Kawhi/user')}}" method="post">
                    {!!  csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">用户名称：</label>
                        <div class="col-sm-8">
                            <input id="name" title="" name="name" value="" class="form-control" type="text">
                            @include('Admin.common.tip',['field' => 'name'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">email：</label>
                        <div class="col-sm-8">
                            <input id="route" title="" name="email" value="" class="form-control" type="text" placeholder="登录账号">
                            @include('Admin.common.tip',['field' => 'email'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">密码：</label>
                        <div class="col-sm-8">
                            <input id="icon" title="" name="password" value="" class="form-control" type="password" placeholder="登录密码">
                            @include('Admin.common.tip',['field' => 'password'])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                        <a href="{{asset('/Kawhi/user')}}" class="btn btn-default pull-left">返回</a>
                        <button type="submit" class="btn btn-primary pull-right" id="btn_submit">
                            确定
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
