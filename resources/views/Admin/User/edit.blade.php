@extends('Admin.common.layout')
@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <div class="ibox-title">
                <h5>编辑管理员 <small></small></h5>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" id="Form" action="{{asset('/Kawhi/user')}}/{{old('user_id')}}" method="post">
                    {!!  csrf_field() !!}
                    @if(isset($type) && $type == 'PUT')
                        {{method_field("PUT")}}
                    @endif
                    <input title="" name="id" value="{{old('user_id')}}" class="form-control" type="hidden">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">用户名称：</label>
                        <div class="col-sm-8">
                            <input id="name" title="" name="name" value="{{old('name')}}" class="form-control" type="text">
                            @include('Admin.common.tip',['field' => 'name'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">email：</label>
                        <div class="col-sm-8">
                            <input id="route" title="" name="email" value="{{old('email')}}" class="form-control" type="text" placeholder="登录账号">
                            @include('Admin.common.tip',['field' => 'email'])
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
