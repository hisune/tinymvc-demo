<?php
/**
 * Created by Hisune.
 * User: hi@hisune.com
 * Date: 2015/6/24
 * Time: 17:46
 */
namespace Demo\Controller;

use Tiny\Config;
use Tiny\Error;
use Tiny\Helper;
use Tiny\Request;

class ThemeBuilder extends \Tiny\Controller
{
    protected $actionBuild = [ // 还有一个model参数，指定哪个模型, helper 里面有**ModBefore
        'type' => 'theme',
        'name' => 'mod',
        'option' => ['action' => 'themeBuilder/run']
    ];

    public function initialize()
    {
        if(Config::config()->env != 'development'){
            Error::printError('Can\'t open Theme Builder! env config forbidden.');
        }
    }

    public function index()
    {
        $this->view->assign('dir', __DIR__);
        $this->view->display('themeBuilder/index');
    }

    public function check()
    {
        $type = Request::get('type');
        $config = Request::get('config');
        $table = Request::get('table');
        switch($type){
            case 'mysql':
                $field = $this->_getMysqlTable($config, $table);
                break;
            case 'mongodb':
                $field = $this->_getMongodbCollection($config, $table);
                break;
            default:
                Error::echoJson(-1, 'db type error');
        }

        if(is_array($field)){
            Error::echoJson(1, implode(',', $field));
        }else
            Error::echoJson(-1, $field);
    }

    private function _getMysqlTable($config, $table)
    {
        if(!isset(Config::config()->{$config}['dns']) || !isset(Config::config()->{$config}['username']) || !isset(Config::config()->{$config}['password']))
            return 'db config error';
        try {
            $db = new \PDO(Config::config()->{$config}['dns'], Config::config()->{$config}['username'], Config::config()->{$config}['password']);
            $res = $db->query('DESCRIBE ' . $table);
            if($res){
                $field = [];
                foreach($res as $row){
                    $field[] = $row['Field'];
                }
                return $field;
            }else
                return 'describe ' . $table . ' failed!';
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    private function _getMongodbCollection($config, $collection)
    {
        if(!isset(Config::config()->{$config}['db']) || !isset(Config::config()->{$config}['host']) || !isset(Config::config()->{$config}['port']))
            return 'db config error';
        try{
            $dbName = Config::config()->{$config}['db'];
            $db = new \MongoClient('mongodb://' . Config::config()->{$config}['host'] . ':' . Config::config()->{$config}['port']);
            $db = $db->{$dbName};
            $one = $db->$collection->findOne();
            if($one){
                $field = [];
                foreach($one as $k => $v){
                    $field[] = $k;
                }
                return $field;
            }else{
                return 'no record for ' . $collection;
            }
        }catch (\Exception $e){
            return 'connection mongodb failed';
        }
    }

    public function run()
    {
        $post = Request::post();
        $post['table'] = Helper::parseName($post['table'], 1);
        $controller = \Demo\Helper\ThemeBuilder::generateController($post);
        $helper = \Demo\Helper\ThemeBuilder::generateHelper($post);
        $model = \Demo\Helper\ThemeBuilder::generateModel($post);

        $controllerFile = __DIR__ . DIRECTORY_SEPARATOR . ucfirst($post['table']) . '.php';
        $helperFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Helper' . DIRECTORY_SEPARATOR . ucfirst($post['table']) . '.php';
        $modelFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . ucfirst($post['table']) . '.php';

        if(file_exists($controllerFile)){
            Error::echoJson(-1, 'controller file ' . $controllerFile . ' exits already!');
        }
        if(file_exists($helperFile)){
            Error::echoJson(-1, 'helper file ' . $helperFile . ' exits already!');
        }
        if(file_exists($modelFile)){
            Error::echoJson(-1, 'model file ' . $modelFile . ' exits already!');
        }

        file_put_contents($controllerFile , $controller);
        file_put_contents($helperFile , $helper);
        file_put_contents($modelFile, $model);
        Error::echoJson(-1, 'Success!');
    }

}