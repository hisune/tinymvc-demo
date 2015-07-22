<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/18
 * Time: 14:01
 */
namespace Demo\Helper;

use Demo\Model as model;
use Tiny\Auth;
use Tiny\Helper;

class Index extends Helper
{

    // todo 缓存
    public static function getMenuTree($preview = true)
    {
        $menuModel = new model\Menu();
        $menu = $menuModel->order('`order` desc')->find();
        if($preview){
            foreach($menu as $k => $v){ // 判断权限
                // if you want to check admin's purview
//                if($v->route && strpos($v->route, 'http') === false){
//                    $route = explode('/', $v->route);
//                    if(!Auth::hasPurview($route[0], $route[1])){
//                        unset($menu[$k]);
//                    }
//                }
            }
        }
        $tree = Helper::getTree($menu);
        if($preview){
            self::_renderTree($tree);
        }
        return $tree;
    }

    // 菜单的整理
    private static function _renderTree(&$tree)
    {
        if(is_array($tree)){
            foreach($tree as $k => $v){
                if((!isset($v['child']) || !$v['child']) && !$v['route'])
                    unset($tree[$k]);
                elseif(isset($v['child']) && $v['child'])
                    self::_renderTree($v['child']);
            }
        }
    }

    public static function getMenuHumanTree($purview = true)
    {
        return [0 => '顶级菜单'] + Helper::getHumanTree(self::getMenuTree($purview));
    }

    public static function getTrueFalse()
    {
        return [
            0 => '否',
            1 => '是',
        ];
    }

}