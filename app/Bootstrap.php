<?php
/**
 * @name Bootstrap
 * @author root
 * @desc   所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see    http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */

use Yaf\Bootstrap_Abstract as YafBootstrap;
use Yaf\Config\Ini;
use Yaf\Dispatcher as YafDispatcher;
use Yaf\Exception\TypeError;
use Yaf\Registry as YafRegistry;
use Yaf\Loader as YafLoader;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Bootstrap extends YafBootstrap
{
    public function _initConfig()
    {
        $config = [];
        $path   = ROOT_PATH . '/conf';
        foreach (glob(rtrim($path, '/') . '/*.ini') as $file) {
            try {
                $ini           = (new Ini($file))->get(ini_get('yaf.environ'));
                $name          = basename(str_replace('.ini', '', $file));
                $config[$name] = $ini->toArray();
            } catch (TypeError $e) {
                Logger::error($e->getMessage(), [
                    'File' => $e->getFile(),
                    'Line' => $e->getLine()
                ]);
            }
        }
        YafRegistry::set('config', $config);
    }

    public function _initPlugin(YafDispatcher $dispatcher)
    {
        //注册一个插件
        //$objSamplePlugin = new SamplePlugin();
        //$dispatcher->registerPlugin($objSamplePlugin);
    }

    public function _initRoute(YafDispatcher $dispatcher)
    {
        //在这里注册自己的路由协议,默认使用简单路由
    }

    public function _initView(YafDispatcher $dispatcher)
    {
        //在这里注册自己的view控制器，例如smarty,firekylin
        YafDispatcher::getInstance()->disableView();
    }

    public function _initLoader(YafDispatcher $dispatcher)
    {
        $loader = YafLoader::getInstance();
        $loader->import(ROOT_PATH . '/vendor/autoload.php');
    }

    public function _initOrmConnection(YafDispatcher $dispatcher)
    {
        $capsule   = new Capsule;
        $arrConfig = config('db')['default'];

        $capsule->addConnection([
            'driver'    => $arrConfig['driver'],
            'host'      => $arrConfig['write']['host'],
            'database'  => $arrConfig['database'],
            'username'  => $arrConfig['write']['username'],
            'password'  => $arrConfig['write']['password'],
            'charset'   => $arrConfig['charset'],
            'collation' => $arrConfig['collation'],
            'prefix'    => $arrConfig['prefix'],
        ]);
        $capsule->addConnection([
            'driver'    => $arrConfig['driver'],
            'host'      => $arrConfig['read']['host'],
            'database'  => $arrConfig['database'],
            'username'  => $arrConfig['read']['username'],
            'password'  => $arrConfig['read']['password'],
            'charset'   => $arrConfig['charset'],
            'collation' => $arrConfig['collation'],
            'prefix'    => $arrConfig['prefix'],
        ]);

        // Set the event dispatcher used by Eloquent models... (optional)
        $capsule->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }

    public function _initWhoops() {
        if (is_dev()) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }
    }

}




