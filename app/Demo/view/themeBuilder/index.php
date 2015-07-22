<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/24
 * Time: 18:01
 */
?>
<style>
    html{
        background: #f1f1f1;
        padding-top: 15px;
    }
    #db-field-result{
        color: #ff0000;
        font-weight: bold;
    }
</style>
<?=self::style('css/AdminLTE.min.css');?>
<div class="col-md-6" id="theme"></div>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <strong>Tiny MVC Theme Builder</strong>
        </div>
        <div class="box-body">
            <p>支持mysql, mongodb自动生成增删改查配置文件</p>
            <p>当前项目名： <strong><?=APPLICATION?></strong></p>
            <p>controller: </p>
            <pre><?=var_export(\Tiny\Config::$controller)?></pre>
            <p>生成的文件所在位置：</p>
            <pre>controller: <?=$dir?> <br />helper: <?=str_replace('\\' . \Tiny\Config::$controller[0], '\\Helper', $dir)?> <br />model: <?=str_replace('\\' . \Tiny\Config::$controller[0], '\\Molder', $dir)?>
            </pre>
            <p>DB table自动查询结果：</p>
            <div id="db-field-result"></div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <strong>Copyright &copy; 2014-2015 <a href="http://hisune.com" target="_blank">Hisune</a>.</strong> All rights reserved.
            powered by <a href="https://github.com/hisune/tinymvc" target="_blank">Tiny MVC</a>
        </div>
    </div>
</div>
<script>
    $.get('<?php echo \Tiny\Url::get('themeBuilder/build'); ?>', function(ret){
        $('#theme').html(ret);
    });
</script>