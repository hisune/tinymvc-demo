<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/19
 * Time: 15:39
 */
namespace Demo\Model;

use Tiny\Helper;

class Group extends \Tiny\ORM
{

    public static function attributes()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'purview' => '权限',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public static function groupEnum()
    {
        $groupModel = new Group();
        $group = $groupModel->find();
        return Helper::renderEnum($group, 'id', 'name');
    }

}