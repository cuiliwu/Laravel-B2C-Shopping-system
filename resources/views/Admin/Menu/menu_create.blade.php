@extends('Admin.common.layout')
@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <div class="ibox-title">
                <h5>添加菜单 <small></small></h5>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" id="Form" action="{{asset('/Kawhi/menu')}}" method="post">
                    {!!  csrf_field() !!}
                    <div class="form-group">
                        @inject('menuPresenter','App\Presenters\MenuPresenter')
                        <label class="col-sm-3 control-label">父级菜单：</label>
                        <div class="col-sm-4">
                            <select name="parent_id" title="" class="form-control">
                                <option value="0">顶级菜单</option>
                                @foreach($menuPresenter->levelTree() as $item)
                                    <option value="{{$item['menu_id']}}">
                                        {!!  $item['html'] !!}{{ trans($item['title']) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单名称：</label>
                        <div class="col-sm-4">
                            <input id="title" title="" name="title" value="" class="form-control" type="text" placeholder="菜单名称">
                            @include('Admin.common.tip',['field' => 'title'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单路径：</label>
                        <div class="col-sm-4">
                            <input id="uri" title="" name="uri" value="" class="form-control" type="text" placeholder="例：/Kawhi/user">
                            @include('Admin.common.tip',['field' => 'uri'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">排序：</label>
                        <div class="col-sm-4">
                            <input id="order" title="" name="order" value="" class="form-control" type="text" placeholder="例：1">
                            @include('Admin.common.tip',['field' => 'order'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">显示：</label>
                        <div class="col-sm-4">
                            <div class="radio i-checks">
                                <label><input @if(old('hide',0) == 0) checked @endif type="radio" name="hide" value="0"/></label>否
                                <label><input @if(old('hide',0) == 1) checked @endif type="radio" name="hide" value="1"/></label>是
                            </div>
                            @include('Admin.common.tip',['field' => 'hide'])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">图标：</label>
                        <div class="col-sm-4">
                            <input id="icon" title="" name="icon" value="" class="form-control" type="text" placeholder="例子：fa fa-users">
                            @include('Admin.common.tip',['field' => 'icon'])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <a href="{{asset('/Kawhi/menu')}}" class="btn btn-default pull-left">返回</a>
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
