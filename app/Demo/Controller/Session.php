<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/17
 * Time: 17:35
 */
namespace Demo\Controller;

use Demo\Helper as helper;
use Tiny\Request;

class Session extends \Tiny\Controller
{
    public function login()
    {
        if(Request::isPost()){
            // validation example code
            helper\Session::doLogin($this->request, $this->validation);
        }else{
            // your code
        }
    }
}