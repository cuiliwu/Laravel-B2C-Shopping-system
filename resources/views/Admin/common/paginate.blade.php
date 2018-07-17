<div class="col-sm-12">
    <div class="dataTables_paginate paging_simple_numbers" id="editable_paginate" style="text-align: right">
        <ul class="pagination">
            @if(isset($page['links']['first_page']))
                <li class="paginate_button " aria-controls="editable" tabindex="0" id="editable_home">
                    <a href="{{$page['links']['first_page']}}">首页</a>
                </li>
            @endif

            @if(isset($page['links']['prev_page']))
                <li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">
                    <a href="{{$page['links']['prev_page']}}">上一页</a>
                </li>
            @endif
            @foreach($page['links']['list_page'] as $item)
                <li class="paginate_button {{$item['current_page'] ? 'active' : ''}}" aria-controls="editable" tabindex="0">
                    <a href="{{$item['path']}}">{{$item['num']}}</a>
                </li>
            @endforeach
            @if(isset($page['links']['next_page']))
                <li class="paginate_button next" aria-controls="editable" tabindex="0" id="editable_next">
                    <a href="{{$page['links']['next_page']}}">下一页</a>
                </li>
            @endif

            @if(isset($page['links']['last_page']))
                <li class="paginate_button " aria-controls="editable" tabindex="0" id="editable_last">
                    <a href="{{$page['links']['last_page']}}">末页</a>
                </li>
            @endif
            <li>&nbsp;&nbsp;共{{$page['total_pages']}}页，到第&nbsp;&nbsp;<input title="" type="number" style="width: 40px;" max="{{$page['total_pages']}}"  min="1" data-max="{{$page['total_pages']}}" class="g-input jump-page" data-url-template="{{$page['links']['url_template']}}" />&nbsp;页&nbsp;<input type="button" onclick="" value="确定" class="btn btn-sm btn-primary jump-page-submit" /></li>
        </ul>
    </div>
</div>