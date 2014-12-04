<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 17:02
 * Email: hi@hisune.com
 */
namespace Demo\Controller\Admin;

use \Tiny as tiny;

/**
 * themeBuilder之tabs举例
 * 通过http://127.0.0.1/admin/tab查看效果
 */
class Tab extends tiny\Controller
{
    // 属性名为action名称，通过http://127.0.0.1/admin/tab/tabs访问
    protected $actionTabs = array(
        'type' => 'theme',
        'name' => 'Tabs',
    );

    public function initialize()
    {
        $this->view->layout = 'admin';
    }

    public function index()
    {
        $this->view->display('admin/tab/index');
    }

}