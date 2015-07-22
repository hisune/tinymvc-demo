<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 15:47
 * Email: hi@hisune.com
 */
return array(
    'debug' => false, // 是否开启debug
    'flag' => 'hisune', // session前缀
    'show_error' => true, // 是否显示错误
    'timezone' => 'PRC', // 默认时区
    'token' => false, // 是否给表单自动加token
    'env' => 'development', // production or development
    'key' => 'your_key',
    'database' => array(
        'dns' => 'mysql:host=localhost;port=3306;dbname=demo;charset=utf8',
        'username' => 'root',
        'password' => '',
        'prefix' => '',
        'separate' => false, // 主从分离
        'rand_read' => false, // 随机读取
        'log_queries' => true, // 是否记录当前请求的所有sql
    ),
    'mongodb' => array(
        'host' => '127.0.0.1',
        'port' => 27017,
        'db' => 'demo'
    )
);