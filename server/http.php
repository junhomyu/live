<?php
/**
 * Created by PhpStorm.
 * User: leoyu
 * Date: 18/7/19
 * Time: 下午2:37
 */
$http = new swoole_http_server("0.0.0.0",9502);

$http->set([
    'document_root' => '/users/leoyu/2018work/live/public/static',
    'enable_static_handler' => true
]);


$http->on('request',function($request,$response){
    /*$content = [
        'date' => date("Ymd H:i:s"),
        'get:' => $request->get,
        'post:' => $request->post,
        'header:' => $request->header,
    ];
    swoole_async_writefile(__DIR__."/access.log",json_encode($content).PHP_EOL,function($filename){
        //TODO

    },FILE_APPEND);*/
    //$response->cookie('yu','123123',time()+1800);
    $_POST = [];
    if(isset($request->post)) {
        foreach($request->post as $k => $v) {
            $_POST[$k] = $v;
        }
    }
    $response->end(json_encode($response));
    //$response->end('hello http'.json_encode($request->get));
});

$http->start();