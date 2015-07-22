<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/18
 * Time: 11:18
 */
?>
<?=self::style('css/AdminLTE.min.css');?>
<?=self::style('css/skins/_all-skins.min.css');?>
<?=self::style('fontawesome/css/font-awesome.min.css');?>

<body class="skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>DP</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?=self::img('img/ym.png', false, ['class' => 'user-image'])?>
                            <span class="hidden-xs"><?=$user['true_name']?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <?=self::img('img/ym.png', false, ['class' => 'img-circle'])?>
                                <p>
                                    <?=$user['true_name']?> - <?=$user['department']?>
                                    <small>Member since <?=$user['created_at']?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" onclick="loadContent('<?=\Tiny\Url::get('admin/password')?>')" class="btn btn-default btn-flat">修改密码</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?=\Tiny\Url::get('session/login')?>" class="btn btn-default btn-flat">退出登录</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" id="sidebar-menu">
<!--                <li class="header">MAIN NAVIGATION</li>-->
                <?php
                function getUrl($v)
                {
                    if(strpos($v['route'], 'http') === 0){
                        $url = 'href="' . $v['route'] . '"';
                        if($v['blank'])
                            $url .= ' target="_blank"';
                    }else
                        $url = $v['route'] ? 'data-url="' . \Tiny\Url::get($v['route']) . '"' : '';
                    $url .= ' data-name="' . $v['name'] . '"';
                    return $url;
                }
                function getChild($first)
                {
                    if(isset($first['child'])){
                        echo '<ul class="treeview-menu">';
                        foreach($first['child'] as $second){
                            $url = getUrl($second);
                            echo '<li><a style="cursor: pointer;" ' . $url . '><i class="fa fa-circle-o"></i> ' . $second['name'];
                            if(isset($second['child'])){
                                echo '<i class="fa fa-angle-left pull-right"></i>';
                                getChild($second);
                            }
                            echo '</a></li>';
                        }
                        echo '</ul>';
                    }
                }
                foreach($menu as $first):
                    $url = getUrl($first);
                ?>
                    <li class="<?=isset($first['child']) ? 'treeview' : ''?>">
                        <a style="cursor: pointer;" <?=$url?>>
                            <i class="fa fa-<?=$first['icon'] ?: 'th'?>"></i> <span><?=$first['name']?></span>
                            <?=isset($first['child']) ? '<i class="fa fa-angle-left pull-right"></i>' : ''?>
                        </a>
                        <?=getChild($first);?>
                    </li>
                <?php
                endforeach;
                ?>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 id="content-header">
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active" id="breadcrumb-name">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="main-content">
            <div class="box box">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="box-title">Hello World</h3>
                </div>
                <div class="box-body">
                    Welcome to admin panel, <?=$user['true_name']?> - <?=$user['department']?>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://hisune.com" target="_blank">Hisune</a>.</strong> All rights reserved.
        powered by <a href="https://github.com/hisune/tinymvc" target="_blank">Tiny MVC</a>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->
<!-- AdminLTE App -->
<?=self::script('js/app.min.js');?>

<!-- AdminLTE for demo purposes -->
<?=self::script('js/demo.js');?>

<script>
    // 菜单
    $('#sidebar-menu').find('a').each(function(){
        var url = $(this).data('url');
        if(url){
            $(this).click(function(){
                $('#breadcrumb-name').html($(this).data('name'));
                $('#content-header').html($(this).data('name'));
                loadContent(url);
            });
        }
    });
    var loadContent = function(url)
    {
        $.ajax({
            url: url,
            beforeSend: function(){
                $('#main-content').html('<?=tiny\Html::loading()?>');
            },
            success: function(response){
                $('#main-content').html(response);
            }
        });
    };
    // 删除记录
    var deleteItem = function(url, tips, run)
    {
        if(typeof tips == 'undefined')
            tips = '这条信息';
        if(typeof run == 'undefined')
            run = 'dataTablesSubmit()';

        tips = '确定删除' + tips + '吗？';
        bootbox.confirm(tips, function (result) {
            if (result) {
                $.get(url, function (ret) {
                    var detail=eval("("+ret+")");

                    if(detail.msg != '')
                        bootbox.alert(detail.msg);
                    if (detail.ret == 1)
                        eval(run);
                });
            }
        });
    };

    var alertUrl = function(url, tips)
    {
        if(typeof tips == 'undefined'){
            runAlert(url);
        }else{
            bootbox.confirm(tips, function (result) {
                if (result) {
                    runAlert(url);
                }
            });
        }
    };

    var runAlert = function(url)
    {
        $.get(url, function (ret) {
            var detail=eval("("+ret+")");
            bootbox.alert(detail.msg);
        });
    };

    var tabUrl = function(id, index, url, load, ones) {
        if(typeof id != 'string'){
            id = 'myTab';
        }
        var _t = $('#' + id + ' > li:eq(' + index + ')');
        _t.attr('url', url);
        if(typeof ones != 'undefined' && ones == false)
            _t.attr('original', url);
        if (typeof load != 'undefined' && load) {
            _t.children().click();
        }
    };
</script>
</body>