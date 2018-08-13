<?php
/**
 * Created by PhpStorm.
 * User: leoyu
 * Date: 18/7/19
 * Time: 下午4:14
 */
include "../index.php";

class Ws{
    CONST HOST = '0.0.0.0';
    CONST POST = '9501';
    CONST CHART_PORT = "9503";

    public $ws = null;

    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST,self::CHART_PORT);

        $this->ws->listen(self::HOST,self::CHART_PORT,SWOOLE_SOCK_TCP);

        $this->ws->set([
            'worker_num' => 2,
            'task_worker_num' => 2,
        ]);
        $this->ws->on("open",[$this,'onOpen']);
        $this->ws->on("message",[$this,'onMessage']);
        $this->ws->on("task",[$this,'onTask']);
        $this->ws->on("finish",[$this,'onFinish']);
        $this->ws->on("close",[$this,'onClose']);

        $this->ws->start();
    }

    /**
     * 监听ws连接
     */
    public function onOpen($ws, $request)
    {
        //连接的fd 放到redis的有序集合里 [1,2,3]
        //print_r($request->fd);
        app\com\redis\Predis::getInstance()->sadd('live_key',$request->fd);

    }

    /**
     * 监听ws消息事件
     */
    public function onMessage($ws, $frame)
    {
        echo "receve-message:{$frame->data}\n";
        $fdArr = app\com\redis\Predis::getInstance()->sMembers('live_key');
        foreach ($fdArr as $v){
            $ws->push($v,"receve-message:{$frame->data}\n");
        }
        //$ws->push($frame->fd,"server-push:hello");
    }

    /**
     * 监听ws关闭
     */
    public function onClose($ws, $fd)
    {
        //浏览器关闭后再去删除redis里的fd
        app\com\redis\Predis::getInstance()->srem('live_key',fd);
        echo "clientid:{$fd}\n";

    }


    /**
     * task
     */
    public function onTask($ws,$taskId,$workerId,$data)
    {
        print_r($data);
        //耗时场景
        sleep(10);
        return "on task finish";
    }

    /**
     * finish
     */
    public function onFinish($ws,$taskId,$data)
    {
        echo "taskId:{$taskId}\n";
        echo "finish-data-success:{$data}\n";
    }

}

$obj = new Ws();