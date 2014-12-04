<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 15:47
 * Email: hi@hisune.com
 */
return array(
    'debug' => true, // 是否开启debug
    'flag' => 'demo', // session前缀
    'show_error' => true, // 是否显示错误
    'timezone' => 'PRC', // 默认时区
    'token' => false, // 是否给表单自动加token
    'database' => array(
        'dns' => "mysql:host=127.0.0.1;port=3306;dbname=tiny;charset=utf8",
        'username' => 'root',
        'password' => '',
        'prefix' => '',
        'separate' => false, // 主从分离
        'rand_read' => false, // 随机读取
        'log_queries' => true, // 是否记录当前请求的所有sql
    ),
);