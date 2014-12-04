<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 16:34
 * Email: hi@hisune.com
 */
foreach ($list as $v) {
    echo '<li>';
    echo $v->char . '[ ' . $v->time . ' ]';
    echo '</li>';
}