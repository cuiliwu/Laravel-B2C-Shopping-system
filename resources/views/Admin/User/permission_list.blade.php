@extends('Admin.common.layout')
@section('content')
    <style>
        .ibox-content table td{vertical-align:middle!important;}
    </style>
    <div class="ibox">
        {{--<div class="ibox-title">--}}
        {{--<small class="pull-right text-muted">Current Time :  {{date('M d Y - H:i',time())}}</small>--}}
        {{--</div>--}}

        <div class="ibox-content">
            <div class="row">
                <form action="" method="get">
                    {{csrf_field()}}
                    <div class="col-sm-12">
                        <a class="btn btn-sm btn-primary fl mr10" href="{{url('/Kawhi/permission/create')}}">新增</a>
                        <button type="submit" class="btn btn-sm btn-primary pull-right">查询</button>
                        <div class="input-group fr mr10">
                        </div>

                    </div>
                </form>
            </div>
            <div class="row">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>权限名称</td>
                        <td>权限label</td>
                        <td>权限描述</td>
                        <td>创建时间</td>
                        <td class="text-center">操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$value)
                        <tr>
                            <td>{{$value['id']}}</td>
                            <td>{{$value['name']}}</td>
                            <td>{{$value['label']}}</td>
                            <td>{{$value['description']}}</td>
                            <td>{{$value['created_at']}}</td>
                            <td class="text-center">
                                <a class="btn btn-success" href="{{asset('/Kawhi/permission')}}/{{$value['id']}}/edit">编辑</a>
                                <button class="btn btn-danger" data-url="{{asset('/Kawhi/permission')}}/{{$value['id']}}" data-toggle="modal" data-target="#delete-modal">
                                    删除
                                </button>
                                <button type="button" class="btn btn-primary ">禁用</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                @include('Admin.common.paginate')
            </div>
        </div>
    </div>
@endsection

@section("after.js")
    @include('Admin.components.modal.delete',['title'=>'操作提示','content'=>'你确定要删除这个权限吗?'])
@endsection