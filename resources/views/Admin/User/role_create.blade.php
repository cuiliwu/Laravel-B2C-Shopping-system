@extends('Admin.common.layout')
@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <div class="ibox-title">
                <h5>添加角色 <small></small></h5>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" id="Form" action="{{asset('/Kawhi/role')}}" method="post">
                    {!!  csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">角色名称：</label>
                        <div class="col-sm-8">
                            <input id="name" title="" name="name" value="" class="form-control" type="text">
                            @include('Admin.common.tip',['field' => 'name'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">角色label：</label>
                        <div class="col-sm-8">
                            <input id="label" title="" name="label" value="" class="form-control" type="text" placeholder="角色label">
                            @include('Admin.common.tip',['field' => 'label'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">描述：</label>
                        <div class="col-sm-8">
                            <input id="description" title="" name="description" value="" class="form-control" type="text" placeholder="描述">
                            @include('Admin.common.tip',['field' => 'description'])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <a href="{{asset('/Kawhi/role')}}" class="btn btn-default pull-left">返回</a>
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
