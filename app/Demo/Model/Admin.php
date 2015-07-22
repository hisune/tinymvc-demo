<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/17
 * Time: 18:49
 */
namespace Demo\Model;

class Admin extends \Tiny\ORM
{

    public static function attributes()
    {
        return [
            'id' => 'ID',
            'group_id' => '用户组',
            'name' => '登录名',
            'true_name' => '真实姓名',
            'department' => '部门',
            'tel' => '电话',
            'password' => '密码',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

}