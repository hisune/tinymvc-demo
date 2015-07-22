<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/18
 * Time: 14:01
 */
namespace Demo\Model;

class Menu extends \Tiny\ORM
{

    public static function attributes()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'parent' => '父菜单',
            'route' => '路由',
            'icon' => '图标',
            'order' => '排序',
            'blank' => '是否新窗口打开',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

}
