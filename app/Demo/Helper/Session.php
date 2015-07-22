<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/18
 * Time: 10:41
 */
namespace Demo\Helper;

use Demo\Model\Admin;
use Tiny\Auth;
use Tiny\Verify;

class Session extends \Tiny\Helper
{

    public static function doLogin($request, $validation)
    {
        $validation->data = $request->post();

        // 验证举例
        $validation->field('name')->required('user name required');
        $validation->field('password')->required('user password required');
        $validation->field('verify')->required('verify required')->equal('verify code error', Verify::getVerify());
        $validation->validateWithBack();

        // your code
    }
}