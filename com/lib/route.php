<?php
/**
 * Created by PhpStorm.
 * User: leoyu
 * Date: 18/8/14
 * Time: 下午11:10
 */
namespace com\lib;


class route
{
    public $controller;

    public $action;

    public function __construct()
    {
        if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/'){
          $path = $_SERVER['REQUEST_URI'];
          $pathArr = explode('/',trim($path,'/'));
          if(isset($pathArr[0])){
              $this->controller = $pathArr[0];
          }
          if(isset($pathArr[1])){
              $this->action = $pathArr[1];
          }else{
              $this->action = config::get('ACTION','route');
          }

          //url多余部分转换成GET  id/2/name/ye/age/3
          $count = count($pathArr)+2;
          $i = 2;
          while($i<$count){
              if(isset($pathArr[$i+1])){
                  $_GET[$pathArr[$i]] = $pathArr[$i+1];
              }
              $i = $i+2;
          }
        }else{
            $this->controller = config::get('CONTROLLER','route');;
            $this->action = config::get('ACTION','route');;
        }
    }
}