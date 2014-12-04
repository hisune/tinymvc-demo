<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 17:18
 * Email: hi@hisune.com
 */
namespace Demo\Helper\Admin;

use \Tiny as tiny;

class DataTable extends tiny\Helper
{

    public static function getDataTablesSetting()
    {
        return array(
            'id' => '',
            'js' => '',
            'export' => true,
            'default' => array(
                'filter' => 'd.id > 0', // 默认过滤参数
                'group' => '',
                'having' => '',
            ),
            'title' => '测试标题，title',
//            'page' => false, // false为不分页，或指定页数，可以是10,25,50,100
//            'before' => 'xx', // 表格前附加html
//            'after' => 'oo', // 表格后附加html
            'column' => array(
                array(
                    'title' => 'hidden测试',
                    'name' => 'd.id',
                    'alias' => 'hidden',
                    'sort' => true,
                    'filter' => array(
                        'type' => 'hidden',
                        'call' => 'callHidden', // 当前helper中定义call函数$post, &whereStr, &$whereBind
                    ),
                    'display' => false, // 隐藏字段后，call函数将无效
                ),
                array(
                    'title' => 'range测试',
                    'name' => 'd.int',
                    'filter' => array(
                        'type' => 'range',
                        'width' => '50',
                    )
                ),
                array(
                    'title' => 'input测试',
                    'name' => 'd.char',
                    'sort' => true,
                    'alias' => 'input',
                    'filter' => array(
                        'type' => 'input',
                        'like' => true,
                    ),
                    'call' => 'renderInput',
                ),
                array(
                    'title' => 'date-range',
                    'name' => 'd.time',
                    'filter' => array(
                        'type' => 'date_range',
                        'width' => '100',
                    ),
                ),
                array(
                    'title' => 'date-time',
                    'name' => 'd.created_at',
                    'filter' => array(
                        'type' => 'date',
                    ),
                ),
                array(
                    'title' => '测试',
                    'name' => 'j.select',
                    'sort' => 'asc',
                    'filter' => array('type' => 'select', 'filter' => false, 'option' => array(1 => 'test1', 2 => 'test2')),
                    'call' => 'enum',
                    'enum' => array(1 => 'test1', 2 => 'test2'),
                ),
                array(
                    'title' => '操作',
                    'tips' => 'tips测试',
                    'call' => 'renderTest', // 不带name的call只有一个参数，即当前结果行
                ),
            ),
            'model' => 'demo',
            'join' => array(
                'main' => 'd',
                'on' => array(
                    array('type' => 'left' , 'join' => '__JOIN__ j on d.id = j.demo_id'),
                ),
            ),
        );
    }

    // 前置post函数
    public static function dataTablesPostBefore(&$post)
    {

    }

    // 后置post函数
    public static function dataTablesPostAfter(&$msg)
    {

    }

    // 辅助过滤函数
    public static function dataTablesFilterCallHidden($post, &$whereStr, &$whereBind)
    {

    }

    // 辅助输出函数，$row为当前结果行
    public static function dataTablesShowRenderInput($row)
    {
        return $row->input;
    }

    // 辅助输出函数，$row为当前结果行
    public static function dataTablesShowRenderTest($row)
    {
        return '<button class="btn btn-xs btn-primary" data-id="' . $row->hidden . '" onclick="alert($(this).data(\'id\'))">Click!</button>';
    }

}