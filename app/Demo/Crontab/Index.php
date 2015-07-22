<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/24
 * Time: 11:07
 *
 * cli crontab example
 */
namespace Demo\Crontab;

class Index extends \Tiny\Cli
{

    public function index($param = 'test')
    {
        echo 'xxoo param ' . $param;
    }

}