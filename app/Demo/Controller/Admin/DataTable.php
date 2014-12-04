<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 17:10
 * Email: hi@hisune.com
 */
namespace Demo\Controller\Admin;

use \Tiny as tiny;

/**
 * themeBuilder之dataTables举例
 * 通过http://127.0.0.1/admin/datatable查看效果
 */
class DataTable extends tiny\Controller
{
    // 属性名为action名称，通过http://127.0.0.1/admin/datatable/datatables访问
    protected $actionDataTables = array(
        'type' => 'theme',
        'name' => 'DataTables',
    );

    public function initialize()
    {
        $this->view->layout = 'admin';
    }

    public function index()
    {
        $this->view->display('admin/datatable/index');
    }

}