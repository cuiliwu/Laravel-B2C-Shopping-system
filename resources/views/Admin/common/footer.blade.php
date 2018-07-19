
<div class="footer">
    <div class="pull-right">
        <strong>Copyright</strong> Cui's Group Company &copy; 2014-2015
    </div>
</div>
<script>
    // 自动选中菜单，自动填充面包屑
    $(function() {
        // 选中左侧菜单栏 begin
        var current = window.location.href;

        var A_Label = $('[href="'+current+'"]').get(0);
        var Li_parent = $(A_Label).parents('li');
        var Ul_parent = $(A_Label).parents('ul');
        $.each(Li_parent,function (k,v) {
            $(v).toggleClass('active');
        });
        $.each(Ul_parent,function (k,v) {
            $(v).toggleClass('in');
        });
        // 选中左侧菜单栏 end

        // 获取第一个已选中的菜单(已包含所有选中菜单)
        var allActive  = $('#side-menu .active').get(0);
        // 得到一级菜单名称
        var firstMenu  = $($(allActive).find(".nav-label").get(0)).html();
        // 判断是否有二级菜单 并 得到二级菜单
        var secondMenu = $($(allActive).find('.second-label').get(0)).html();
        // 判断是否有三级菜单 并 得到三级菜单
        var thirdMenu  = $($(allActive).find('.third-label').get(0)).html();

        // 面包屑赋值
        var nav = $('.breadcrumb');
        $(nav.find(".nav-label").get(0)).text(firstMenu);
        $(nav.find(".second-label").get(0)).text(secondMenu);
        $(nav.find(".second-label").get(0)).text(thirdMenu);

    });
</script>