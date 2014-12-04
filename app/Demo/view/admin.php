<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 17:12
 * Email: hi@hisune.com
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php echo self::script('http://lib.sinaapp.com/js/jquery/2.0.3/jquery-2.0.3.min.js', true);?>
    <?php echo self::script('http://lib.sinaapp.com/js/bootstrap/latest/js/bootstrap.min.js', true);?>
    <?php echo self::script('http://www.dangrossman.info/wp-content/themes/2012/moment.js', true);?>
    <?php echo self::script('http://www.dangrossman.info/wp-content/themes/2012/daterangepicker.js', true);?>
    <?php echo self::script('http://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js', true);?>

    <?php echo self::style('http://lib.sinaapp.com/js/bootstrap/latest/css/bootstrap.min.css', true);?>
    <?php echo self::style('http://www.dangrossman.info/wp-content/themes/2012/daterangepicker-bs3.css', true);?>
    <?php echo self::style('http://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css', true);?>
</head>
<body>
<?php echo \Tiny\View::getContent();?>
</body>
</html>