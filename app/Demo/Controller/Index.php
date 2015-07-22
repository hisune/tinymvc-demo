<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/17
 * Time: 17:36
 */
namespace Demo\Controller;

use Tiny\Cookie;
use Tiny\Html;

class Index extends \Tiny\Controller
{
    public static $authWhite = [
        'admin' => ['verify'],
        'purview' => ['index', 'verify'],
    ];

    public function initialize()
    {
//        \Tiny\Auth::checkAdmin($this);
    }

    public function index()
    {
        $menu = \Demo\Helper\Index::getMenuTree();

        $this->view->assign('menu', $menu);
        $this->view->assign('user', Cookie::get('user'));
        $this->view->display('index/index');
    }

    public function verify()
    {
        $verify = new \Tiny\Verify;
        $verify->font = __DIR__ . '/../../../' . \Tiny\Config::$application . '/asset/fonts/ariblk.ttf';
        $verify->outputVerify();
    }
}