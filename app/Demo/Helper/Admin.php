<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/18
 * Time: 15:20
 */
namespace Demo\Helper;
use Demo\Model\Group;
use \Tiny as tiny;
use \Demo\Model\Admin as adminModel;

class Admin extends tiny\Helper
{
    public static function listDataTablesSetting()
    {
        $group = Group::groupEnum();
        $title = tiny\Html::tag(
            'a',
            'Add a Admin',
            [
                'onclick' => 'loadContent("' . \Tiny\Url::get('admin/mod') . '")',
                'type' => 'button',
                'style' => 'float: right;',
                'class' => 'btn btn-info'
            ]
        );
        return array(
            'id' => '',
            'js' => '',
            'title' => $title,
            'default' => array(
                'sort' => 'created_at desc'
            ),
            'column' => array(
                array(
                    'title' => adminModel::attributes()['id'],
                    'name' => 'id',
                    'sort' => true,
                ),
                array(
                    'title' => adminModel::attributes()['group_id'],
                    'name' => 'group_id',
                    'filter' => array('type' => 'select', 'filter' => false, 'option' => $group),
                    'call' => 'enum',
                    'enum' => $group,
                    'sort' => true,
                ),
                array(
                    'title' => adminModel::attributes()['name'],
                    'name' => 'name',
                    'filter' => array(
                        'type' => 'input',
                        'like' => true,
                    ),
                ),
                array(
                    'title' => adminModel::attributes()['true_name'],
                    'name' => 'true_name',
                    'filter' => array(
                        'type' => 'input',
                        'like' => true,
                    ),
                ),
                array(
                    'title' => adminModel::attributes()['department'],
                    'name' => 'department',
                    'filter' => array(
                        'type' => 'input',
                        'like' => true,
                    ),
                ),
                array(
                    'title' => adminModel::attributes()['tel'],
                    'name' => 'tel',
                ),
                array(
                    'title' => adminModel::attributes()['created_at'],
                    'name' => 'created_at',
                ),
                array(
                    'title' => '操作',
                    'call' => 'renderOperate'
                )
            ),
            'model' => 'admin',
        );
    }

    // 辅助输出函数，$row为当前结果行
    public static function listDataTablesShowRenderOperate($row)
    {
        return tiny\Html::tag(
            'button',
            '',
            [
                'onclick' => 'loadContent("' . tiny\Url::get('admin/mod', ['id' => $row->id]) . '")',
                'class' => 'glyphicon glyphicon-edit pointer'
            ]
        ) .
        tiny\Html::tag(
            'button',
            '',
            [
                'onclick' => 'deleteItem("' . tiny\Url::get('admin/delete', ['id' => $row->id]) . '", "' . $row->true_name . '")',
                'class' => 'glyphicon glyphicon-remove pointer',
                'style' => 'margin-left: 3px;'
            ]
        );
    }

    public static function modModSetting()
    {
        return [
            'id' => '',
            'js' => '',
            'mod' => [
                ['title' => adminModel::attributes()['id'], 'name' => 'id', 'type' => 'hidden', 'display' => false],
                ['title' => adminModel::attributes()['group_id'], 'name' => 'group_id', 'type' => 'select', 'option' => $group = Group::groupEnum()],
                ['title' => adminModel::attributes()['name'], 'name' => 'name', 'type' => 'input', 'required' => true],
                ['title' => adminModel::attributes()['true_name'], 'name' => 'true_name', 'type' => 'input', 'required' => true],
                ['title' => adminModel::attributes()['department'], 'name' => 'department', 'type' => 'input', 'required' => true],
                ['title' => adminModel::attributes()['tel'], 'name' => 'tel', 'type' => 'input'],
                ['title' => adminModel::attributes()['password'], 'name' => 'password', 'value' => '', 'type' => 'password', 'require' => true],
            ],
        ];
    }

    public static function modModPostBefore(&$post)
    {
        if(isset($post['password']) && $post['password']){
            if(strlen($post['password']) < 6){
                tiny\Error::echoJson(-3, 'password must have 6 character at least');
            }
            $post['password'] = tiny\Auth::getPassword($post['password'], false);
        }else{
            if(isset($post['id'])){
                $adminModel = new \Demo\Model\Admin;
                $admin = $adminModel->findOne($post['id']);
                $post['password'] = $admin->password;
            }
        }
    }

    public static function passwordModSetting()
    {
        return [
            'id' => '',
            'js' => '',
            'mod' => [
                ['title' => '原始密码', 'name' => 'oldPassword', 'type' => 'password', 'required' => true],
                ['title' => '新密码', 'name' => 'password', 'type' => 'password', 'required' => true],
                ['title' => '确认密码', 'name' => 'confirmPassword', 'type' => 'password', 'required' => true],
            ],
        ];
    }

}