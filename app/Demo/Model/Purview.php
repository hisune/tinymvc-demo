<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/19
 * Time: 16:46
 */
namespace Demo\Model;

use Tiny\Auth;
use Tiny\Helper;

class Purview extends \Tiny\ORM
{

    public static function attributes()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'data' => '权限内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    // todo 缓存
    public static function getPurview()
    {
        $purviewModel = new Purview();
        return Helper::renderEnum($purviewModel->find(), 'id', 'name');
    }

    /**
     * 更新 group 与 详细 purview的对应关系
     */
    public static function updateGroupPurview()
    {
        $groupModel = new Group();
        $groupList = $groupModel->field(['purview', 'id'])->find();
        foreach($groupList as $group){
            $list = [];
            if($group->purview){
                $purviewModel = new Purview();
                $group->purview = json_decode($group->purview, true);
                $group->purview = implode('","', $group->purview);
                $purview = $purviewModel->field('data')->where('id in ("' . $group->purview . '")')->find();
                if($purview){
                    foreach($purview as $v){
                        $v = json_decode($v->data, true);
                        foreach($v as $string){
                            $list[] = $string;
                        }
                    }
                }
            }
            Auth::setPurviewCache($group->id, $list);
        }
    }

}