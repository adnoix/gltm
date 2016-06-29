<?php
use Think\Controller;

function getOAuthToken($uid){
    return md5( $uid . uniqid() );
}

function getOAuthTokenSecret(){
    return md5( time() . uniqid() );
}
//发送短信
function sendMsg($params) {
    $cpid = $params['cpid'];
    $cppsw = $params['cppsw'];
    $method = $params['method'];
    $content = $params['content'];
    $target = $params['target'];

    require("HTTP_SDK.php");
    $engine = HTTP_SDK::getInstance($cpid,$cppsw);
    header("Content-type:text/html;charset=utf-8");
    switch ($method) {
        case 'sendsmsnormal':
            return $engine->pushMt($target,'1111111111', $content,  0);//1,手机号、2，内容、3，流水号、4，通道号（默认为0，预留扩展用）
            break;
        case 'getamount':
            return $engine->getAmount(0);
            break;
        default:
            # code...
            break;
    }
}