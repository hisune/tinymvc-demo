<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 17:05
 * Email: hi@hisune.com
 */
namespace Demo\Helper\Admin;

use \Tiny as tiny;

class Tab extends tiny\Helper
{

    public static function getTabsSetting()
    {
        return array(
            'tabs' => array(
                array('title' => 'Title test1', 'url' => 'index/index'),
                array('title' => 'Title test2', 'url' => 'index/test'),
            ),
            'js' => '',
            'id' => '',
        );
    }

}