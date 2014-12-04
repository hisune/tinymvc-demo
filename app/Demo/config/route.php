<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 15:48
 * Email: hi@hisune.com
 */
return array(
    // 路由配置
    'routes' => array(
        'admin' => 'admin', // 方式1，子模块模式
        'page/{id}' => function($id){ // 方式2，直接处理数据
            echo md5($id);
        },
        '{num}' => function ($num, &$controller, &$method, &$pathInfo) { // 方式3：指定c,m,p
            $controller = 'Index';
            $method = 'index';
            $pathInfo = array($num);
        },
        'param/{param?}' => function ($param, &$controller, &$method, &$pathInfo) { // 例：最后一个参数可不传递, 用'?'
            $controller = 'Index';
            $method = 'test';
            $pathInfo = array($param);
        },
    ),
    // 路由匹配后的正则配置
    'pattern' => array(
        'num' => '[0-9]+',
        'param' => '[0-9]*',
    ),
);