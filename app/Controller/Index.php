<?php
/**
 * Created by PhpStorm.
 * User: leoyu
 * Date: 18/8/14
 * Time: 上午12:03
 */
namespace app\Controller;

use com\lib\config;
use com\lib\model;
use com\start;

class Index extends start
{
    public function test(){
       /*$model = new model();
       $sql = "select * from admin";
       $result = $model->query($sql);
       p($result->fetchAll());*/
       $data = 'hello yuhj';

       $this->assign('data',$data);
       $this->display('index/index.html');

    }
}