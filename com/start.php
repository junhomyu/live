<?php
/**
 * Created by PhpStorm.
 * User: leoyu
 * Date: 18/8/14
 * Time: 下午10:47
 */
//框架启动文件

namespace com;

class start
{
    public static $classMap = array();

    public $assign;

    static public function run()
    {
        //p('ok');
        $route = new \com\lib\route();
        $controller = $route->controller;
        $action = $route->action;
        $cfile = APP.'/Controller/'.$controller.'.php';
        $ctrClass = '\\app\\Controller\\'.$controller;
        if(is_file($cfile)){
           include $cfile;
           $class = new $ctrClass();
           $class->$action();
        }else{
            throw new \Exception('控制器不存在',$cfile);
        }
    }

    static public function load($class)
    {
        //自动加载类库
        if(isset(self::$classMap[$class])){
            return true;
        }else{
            $class = BASEDIR.'/'.str_replace('\\','/',$class).'.php';
            if(is_file($class)){
                include $class;
                self::$classMap[$class] = $class;
            }else{
                return false;
            }
        }

        //require BASEDIR.'/'.str_replace('\\','/',$class).'.php';
    }


    public function assign($name,$value)
    {
        $this->assign[$name] = $value;
    }

    public function display($file)
    {
        $file = APP.'/View/'.$file;

        if(is_file($file)){
            extract($this->assign);
            include $file;
        }
    }
}