Hisune Tiny MVC Framework Demo App
=========
* (https://github.com/hisune/tinymvc)
* Author: Hisune(http://hisune.com)
* 示例网站：http://hisune.com

安装方法
=========
* 执行`composer create-project hisune/tinymvc-demo 2.2`
* composer帮助：(https://getcomposer.org)  
> linux：  
> `curl -sS https://getcomposer.org/installer | php`  
> `mv composer.phar /usr/local/bin/composer`  
> windows:  
> https://getcomposer.org/Composer-Setup.exe

目录结构介绍
========
* 注意某些目录的首字母大写
```sh
.
├── app                         // Hisune Tiny Frame的应用程序，里每个目录代表一个应用程序
│   └── App1                    // App1 code，目录下的推荐目录配置如下：
│       ├── bootstrap           // bootstrap文件，及自定义函数库
│       ├── config              // 配置文件
│       ├── Controller          // Controller继承\Tiny\Controller
│       │   ├── Admin           // 模块举例
│       │   │   └── Index.php   // 子模块Controller
│       │   └── Index.php       // 无模块Controller
│       ├── Model               // Model继承\Tiny\Model
│       ├── Helper              // Helper继承\Tiny\Helper
│       ├── var                 // 日志及缓存目录
│       └── view                // 视图文件
├── app1                        // 举例app
│   ├── asset                   // 前端资源目录
│   └── index.php               // app1应用的入口文件
├── vendor                      // composer包，当前只有Hisune Tiny Frame包
└── cli                         // cli接口，执行方法php cli appName fileName
```
* 只允许app1目录暴露，多应用只需加app2， app3等。

About
========
**Created by Hisune [lyx](http://hisune.com)**
