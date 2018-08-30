<?php
/**
 * Created by PhpStorm.
 * User: leoyu
 * Date: 18/8/14
 * Time: 上午12:00
 */

//入口文件
define('BASEDIR',__DIR__);

define('COM',BASEDIR.'/com');

define('APP',BASEDIR.'/app');

define('DEBUG',true);

if(DEBUG){
    ini_set('display_errors','on');
}else{
    ini_set('display_errors','off');
}

include COM.'/common/function.php';

include COM.'/start.php';

spl_autoload_register('\com\start::load');

\com\start::run();

//include BASEDIR.'/com/Loader.php';

//spl_autoload_register('\\com\\Loader::autoload');


//\app\Home\Controller\Index::test();