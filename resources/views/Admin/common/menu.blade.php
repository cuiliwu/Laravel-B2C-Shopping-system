<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{asset('img/profile_small.jpg')}}" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">David Williams</strong>
                            </span>
                            <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="/Kawhi"><i class="fa fa-th-large"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{asset('/Kawhi/user')}}"><span class="second-label">后台用户管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{asset('/Kawhi/user')}}" class="third-label">用户列表1</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{asset('/Kawhi/user/permission')}}">前台用户管理<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{asset('/Kawhi/user')}}">用户列表2</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/Kawhi"><i class="fa fa-desktop"></i> <span class="nav-label">商品管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{asset('/Kawhi/product/cate')}}">分类管理</a></li>
                    <li><a href="{{asset('/Kawhi/product/spec')}}">规格管理</a></li>
                    <li><a href="{{asset('/Kawhi/product/attribute')}}">属性管理</a></li>
                    <li><a href="{{asset('/Kawhi/product/product')}}">商品管理</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>