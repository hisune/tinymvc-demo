<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/18
 * Time: 15:10
 */
namespace Demo\Controller;

class Admin extends \Tiny\Controller
{

    protected $actionList = [
        'type' => 'theme',
        'name' => 'DataTables',
    ];

    protected $actionMod = [ // 还有一个model参数，指定哪个模型, helper 里面有**ModBefore
        'type' => 'theme',
        'name' => 'mod',
        'option' => ['action' => 'admin/mod']
    ];

    protected $actionPassword = [
        'type' => 'theme',
        'name' => 'mod',
        'option' => ['action' => 'admin/password']
    ];

    protected $actionDelete = [ // 还有一个model参数，指定哪个模型
        'type' => 'action',
        'name' => 'delete',
    ];

    public function initialize()
    {
        // if check admin
//        \Tiny\Auth::checkAdmin($this);
    }

}