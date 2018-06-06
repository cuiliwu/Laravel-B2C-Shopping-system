<script>
    // 自动填充 后台面包屑,
    $(function() {
        // 选中左侧菜单栏


        // 获取第一个已选中的菜单(已包含所有选中菜单)
        var allActive  = $('#side-menu .active').get(0);
        // 得到一级菜单名称
        var firstMenu  = $($(allActive).find(".nav-label").get(0)).html();
        // 判断是否有二级菜单 并 得到二级菜单
        var secondMenu = $($(allActive).find('.second-label').get(0)).html();
        // 判断是否有三级菜单 并 得到三级菜单
        var thirdMenu  = $($(allActive).find('.third-label').get(0)).html();


        console.log(firstMenu);
        console.log(secondMenu);
        console.log(thirdMenu);
    });
</script>