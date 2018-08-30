<?php
/**
 * Created by PhpStorm.
 * User: leoyu
 * Date: 18/8/15
 * Time: 上午12:12
 */
namespace com\lib;

class model extends \PDO
{
    public function __construct()
    {
        $database = config::all('database');
        try{
            parent::__construct($database['DSN'],$database['USERNAME'],$database['PASSWORD']);
        }catch (\PDOException $e){
            echo $e->getMessage();
        }
    }
}