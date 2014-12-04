<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 17:39
 * Email: hi@hisune.com
 */
?>
<div id="tab">

</div>
<script>
    $.get('<?php echo \Tiny\Url::get('admin/tab/tabs'); ?>', function(ret){
        $('#tab').html(ret);
    });
</script>