<nav class="navbar-default navbar-static-side" role="navigation" style="width: 220px;float: left;height: inherit;background-color: #2f4050;">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        @if(session('is_super')==1)
                        <img alt="image" class="img-circle" height="80" src="{{asset('img/a9.jpg')}}" />
                        @else
                        <img alt="image" class="img-circle" height="80" src="{{asset('img/a7.jpg')}}" />
                        @endif
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="{{asset('Kawhi/')}}">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{session('name')}}</strong>
                            </span>
                            <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Contacts</a></li>
                        <li><a href="#">{{session('email')}}</a></li>
                        <li class="divider"></li>
                        <li><a href="{{asset('/Kawhi/logout')}}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="#"><span class="second-label">后台用户管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level collapse">
                            <li>
                                <a href="{{asset('/Kawhi/user')}}" class="third-label">用户列表</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="second-label">前台用户管理<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#" class="third-label">用户列表2</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">商品管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{asset('/Kawhi/product/cate')}}"  class="second-label" >分类管理</a>
                    </li>
                    <li>
                        <a href="{{asset('/Kawhi/product/spec')}}" class="second-label">规格管理</a>
                    </li>
                    <li>
                        <a href="{{asset('/Kawhi/product/attribute')}}" class="second-label">属性管理</a>
                    </li>
                    <li>
                        <a href="{{asset('/Kawhi/product/product')}}" class="second-label">商品管理</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>