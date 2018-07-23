@extends('Admin.common.layout')
@section('content')
    <div class="ibox">

        <div class="ibox-title">
            <small class="pull-right text-muted">Current Time :  {{date('M d Y - H:i',time())}}</small>
        </div>

        <div class="ibox-content">
            属性管理列表。
        </div>
    </div>
@endsection
