<?php
/**
 * Created by PhpStorm.
 * User: yuhj
 * Date: 7/10/18
 * Time: 4:49 PM
 */
namespace com\db;


require "../vendor/autoload.php";


class Medoo
{

    /**
     * @var
     */
    protected $db;


    /**
     * @var array
     */
    protected $options = [
        'database_type' => 'mysql',
        'database_name' => 'live',
        'server'   => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset'  => 'utf8'
    ];


    /**
     * @param $options
     * @return Medoo
     */
    public function init($options)
    {
        if(!empty($options)) $this->options = array_merge($this->options,$options);
        $this->db = new medoo($options);
    }


    /**
     * @param $options
     * @return mixed
     */
    public static function getInstance($options)
    {
        static $_instance = [];
        $name = md5(serialize($options));
        if(!isset($_instance[$name])){
            $_instance[$name] = self::init($options);
        }
        return $_instance[$name];
    }

    /**
     * @param $table
     * @param array $data
     * @return mixed
     */
    public function add($table, $data=[])
    {
        if(count($data)>0){
            return $this->db->insert($table, $data);
        }
        return false;
    }
}