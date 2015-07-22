<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/24
 * Time: 17:50
 */
namespace Demo\Helper;
use \Tiny as tiny;

class ThemeBuilder extends tiny\Helper
{

    public static function buildModSetting()
    {
        return [
            'id' => '',
            'js' => 'function check(){
                var type = $(".mod-type").val();
                var config = $(".mod-config").val();
                var table = $(".mod-table").val();
                if(type != "" && config != "" && table != ""){
                    $.ajax({
                        url: "'. tiny\Url::get('themeBuilder/check') .'",
                        data: {type: type, config: config, table: table},
                        dataType: "json",
                        success: function(response){
                            if(response.ret == 1){
                                $(".mod-field").val(response.msg);
                            }else{
                                $(".mod-field").val("");
                                $("#db-field-result").html(response.msg);
                            }
                        }
                    });
                }
                if(type == "mysql"){
                    $(".mod-field").attr("readonly", true);
                }else{
                    $(".mod-field").removeAttr("readonly");
                }
            }',
            'mod' => [
                ['title' => '数据库类型', 'name' => 'type', 'attribute' => ['onchange' => 'check()'], 'type' => 'select', 'option' => self::getDbType()],
                ['title' => '数据库配置字段', 'name' => 'config', 'attribute' => ['onchange' => 'check()'], 'type' => 'input', 'default' => 'database', 'required' => true],
                ['title' => '表名', 'name' => 'table', 'type' => 'input', 'attribute' => ['onchange' => 'check()'], 'required' => true],
                ['title' => '增删改查', 'name' => 'method', 'type' => 'checkbox', 'default' => '["sel", "mod", "del"]', 'option' => self::getMethod()],
                ['title' => '字段名', 'name' => 'field', 'type' => 'textarea', 'attribute' => ['readonly' => 'true'], 'required' => true],
            ],
        ];
    }

    public static function getDbType()
    {
        return [
            'mysql' => 'mysql',
            'mongodb' => 'mongodb',
        ];
    }

    public static function getMethod()
    {
        return [
            'sel' => '查',
            'mod' => '增/改',
            'del' => '删',
        ];
    }

    public static function generateController($post)
    {
        $namespace = ucfirst(\Tiny\Config::$application) . '\\' . \Tiny\Config::$controller[0];
        $class = ucfirst($post['table']);
        $table = lcfirst($post['table']);
        if(in_array('sel', $post['method'])){
            $sel = <<<PHP
    protected \$actionList = [
        'type' => 'theme',
        'name' => 'DataTables',
    ];


PHP;
        }else
            $sel = '';
        if(in_array('mod', $post['method'])){
            $mod = <<<PHP
    protected \$actionMod = [ // 还有一个model参数，指定哪个模型
        'type' => 'theme',
        'name' => 'mod',
        'option' => ['action' => '$table/mod']
    ];


PHP;
        }else
            $mod = '';
        if(in_array('del', $post['method'])){
            $del = <<<PHP
    protected \$actionDelete = [ // 还有一个model参数，指定哪个模型
        'type' => 'action',
        'name' => 'delete',
    ];

PHP;
        }else
            $del = '';

        return <<<PHP
<?php
/**
 * Hisune Tiny MVC Auto Generate Tool
 * Controller Generate
 */
namespace $namespace;

class $class extends \Tiny\Controller
{
$sel$mod$del
    public function initialize()
    {
        \Tiny\Auth::checkAdmin(\$this);
    }

}
PHP;

    }

    public static function generateHelper($post)
    {
        $namespace = ucfirst(\Tiny\Config::$application) . '\\Helper';
        $class = ucfirst($post['table']);
        $table = lcfirst($post['table']);
        $modelNamespace = '\\' . ucfirst(\Tiny\Config::$application) . '\\Model\\' . ucfirst($class);
        $modelNamespaceAlias = $table . 'Model';
        if($post['type'] == 'mysql'){
            $id = 'id';
        }else{
            $id = '_id';
        }
        $field = explode(',', $post['field']);

        $modSetting = '';
        if(in_array('mod', $post['method'])){ // mod
            $modString = '';
            foreach($field as $v){
                if(in_array($v, ['created_at', 'updated_at']))
                    continue;
                if($v == $id){
                    $modString .= "
                ['title' => $modelNamespaceAlias::attributes()['$v'], 'name' => '$v', 'type' => 'hidden', 'display' => false,],";
                }else
                    $modString .= "
                ['title' => $modelNamespaceAlias::attributes()['$v'], 'name' => '$v', 'type' => 'input',],";
            }
            $modSetting = "    public static function modModSetting()
    {
        return [
            'id' => '',
            'js' => '',
            'mod' => [$modString
            ],
        ];
    }";
        } // mod end

        if(in_array('sel', $post['method'])){ // sel
            if(in_array('mod', $post['method'])){ // mod
                $addTitle = "
         \$title = tiny\\Html::tag(
            'a',
            'Add a $class',
            [
                'onclick' => 'loadContent(\"' . \\Tiny\\Url::get('{$table}/mod') . '\")',
                'type' => 'button',
                'style' => 'float: right;',
                'class' => 'btn btn-info'
            ]
        );";
                $addTitleSet = "            'title' => \$title,";
            }else{ // mod end
                $addTitle = '';
                $addTitleSet = '';
            }
            // field
            $column = '';
            foreach($field as $v){
                if($post['type'] == 'mongodb' && $v == '_id'){
                    $column .= "
                [
                    'title' => $modelNamespaceAlias::attributes()['$v'],
                    'name' => '$v',
                    'call' => 'string',
                    'filter' => array('type' => 'input', 'like' => false),
                    'sort' => true,
                ],
                ";
                }else
                    $column .= "
                [
                    'title' => $modelNamespaceAlias::attributes()['$v'],
                    'name' => '$v',
                    'filter' => array('type' => 'input', 'like' => false),
                    'sort' => true,
                ],
                ";
            }

            if(in_array('mod', $post['method'])){// mod
                $mod = "
        tiny\\Html::tag(
            'button',
            '',
            [
                'onclick' => 'loadContent(\"' . tiny\\Url::get('$table/mod', ['$id' => (string)\$row->$id]) . '\")',
                'class' => 'glyphicon glyphicon-edit pointer'
            ]
        )";
            }else {// mod end
                $mod = "''";
            }
            if(in_array('del', $post['method'])){// del
                $del = "
        tiny\\Html::tag(
            'button',
            '',
            [
                'onclick' => 'deleteItem(\"' . tiny\\Url::get('$table/delete', ['$id' => (string)\$row->$id]) . '\")',
                'class' => 'glyphicon glyphicon-remove pointer',
                'style' => 'margin-left: 3px;'
            ]
        )";
            }else {// del end
                $del = "''";
            }
            if($mod || $del){
                $operateColumn = "
                    [
                        'title' => '操作',
                        'call' => 'renderOperate'
                    ],
                ";
                $operateFunction = "    // 辅助输出函数，\$row为当前结果行
    public static function listDataTablesShowRenderOperate(\$row)
    {
        return $mod . $del;
    }";
            }else{
                $operateColumn = '';
                $operateFunction = '';
            }
            $sel = <<<PHP
    public static function listDataTablesSetting()
    {
$addTitle
        return [
            'id' => '',
            'js' => '',
$addTitleSet
            'column' => [
                $column$operateColumn
            ],
            'model' => '$table',
        ];
    }
$operateFunction
PHP;
        }else // sel end
            $sel = '';


        return <<<PHP
<?php
/**
 * Hisune Tiny MVC Auto Generate Tool
 * Helper Generate
 */
namespace $namespace;
use \Tiny as tiny;
use $modelNamespace as $modelNamespaceAlias;

class $class extends tiny\Helper
{

$sel

$modSetting
}
PHP;

    }

    public static function generateModel($post)
    {
        $namespace = ucfirst(\Tiny\Config::$application) . '\\Model';
        $class = ucfirst($post['table']);
        if($post['type'] == 'mysql'){
            $model = '\Tiny\ORM';
        }else{
            $model = '\Tiny\Mongo';
        }
        $field = explode(',', $post['field']);
        $attributes = '';
        foreach($field as $v){
            $attributes .= "            '{$v}' => '{$v}',\n";
        }
        $attributes = rtrim($attributes, "\n");
        return <<<PHP
<?php
/**
 * Hisune Tiny MVC Auto Generate Tool
 * Model Generate
 */
namespace $namespace;

class $class extends $model
{

    protected \$name = '{$post['config']}';

    public static function attributes()
    {
        return [
$attributes
        ];
    }

}
PHP;

    }

}