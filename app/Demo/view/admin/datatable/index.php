<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 17:14
 * Email: hi@hisune.com
 */
?>
<div id="list">

</div>
<script>
    $.get('<?php echo \Tiny\Url::get('admin/datatable/dataTables'); ?>', function(ret){
        $('#list').html(ret);
    });
</script>