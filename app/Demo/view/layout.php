<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 16:31
 * Email: hi@hisune.com
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?=self::script('jquery/jquery-1.11.3.min.js');?>
    <?=self::script('bootstrap/js/bootstrap.min.js');?>
    <?=self::script('plugins/bootbox/bootbox.min.js');?>
    <?=self::script('plugins/datarangepicker/moment.min.js');?>
    <?=self::script('plugins/datarangepicker/daterangepicker.js');?>
    <?=self::script('plugins/multiselect/js/bootstrap-multiselect.js');?>

    <?=self::style('bootstrap/css/bootstrap.min.css');?>
    <?=self::style('plugins/datarangepicker/daterangepicker-bs3.css');?>
    <?=self::style('plugins/multiselect/css/bootstrap-multiselect.css');?>
    <title>Admin Panel</title>
</head>
<body>
    <?php echo \Tiny\View::getContent();?>
</body>
</html>