<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 15:55
 * Email: hi@hisune.com
 */
namespace Demo\Controller;

use Demo\Model as model;
use \Tiny as tiny;

class Index extends tiny\Controller
{
    /**
     * hello world
     * 访问网站根目录http://127.0.0.1/，或者http://127.0.0.1/2 试试看
     */
    public function index($num = 1)
    {
        for ($i = 0; $i < $num; $i++) {
            echo 'hello world<br />';
        }
    }

    // 使用模板及查询举例
    public function template()
    {
        $demoModel = new model\Demo;
        $list = $demoModel->find();

        $this->view->assign('list', $list);
        $this->view->display('template');
    }

    // 插入数据举例
    public function create()
    {
        $demoModel = new model\Demo;
        // 方式1
        $demoModel->char = 'create1';
        $demoModel->int = rand(1, 500);
        $demoModel->time = date('Y-m-d H:i:s');
        $demoModel->save();
        // 方式2
//        $save = array(
//            'char' => 'create2',
//            'int' => rand(1, 500),
//            'time' => date('Y-m-d H:i:s'),
//        );
//        $demoModel->save($save);
    }

    // 更新数据举例
    public function update()
    {
        $demoModel = new model\Demo;
        // 方式1
        $demoModel->id = 1;
        $demoModel->char = 'update1';
        $demoModel->int = rand(1, 500);
        $demoModel->time = date('Y-m-d H:i:s');
        $demoModel->update();
        // 方式2
//        $update = array(
//            'id' => 1,
//            'char' => 'update2',
//            'int' => rand(1, 500),
//            'time' => date('Y-m-d H:i:s'),
//        );
//        $demoModel->update($update);
    }

    // 删除数据举例
    public function delete()
    {
        $demoModel = new model\Demo;
        $one = $demoModel->findOne();
        // 方式1
        $demoModel->delete($one->id);
        // 方式2
//        $demoModel->where('id = ?', array($one->id))->delete();
    }

    // 访问http://127.0.0.1/param 或 http://127.0.0.1/param/2 试试
    public function test($param = '')
    {
        var_dump($param);
    }
}