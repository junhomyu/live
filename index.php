<?php
/**
 * Created by PhpStorm.
 * User: leoyu
 * Date: 18/8/14
 * Time: 上午12:00
 */

//入口文件
define('BASEDIR',__DIR__);

include BASEDIR.'/com/Loader.php';

spl_autoload_register('\\com\\Loader::autoload');


\app\Home\Controller\Index::test();