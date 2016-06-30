<?php
namespace Home\Controller;
use Think\Controller;
use Think;

class CommonController extends Controller
{
    /**
     * @param string $status 消息状态
     * @param string $msg 提示内容
     * @param array $data 返回数组
     * api同一返回格式
     * author gao
     * date 2016-1-25
     */
    public function apiReturn($status = "success", $msg = '', $data = array())
    {
        $return['status'] = $status;
        $return['msg'] = $msg;
        $return['data'] = $data;
        header('Content-Type:application/json; charset=UTF-8');
        echo json_encode($return);
        exit;
    }

    /**
     * 通过CURL发送HTTP请求
     * @param string $url //请求URL
     * @param array $postFields //请求参数
     * @return mixed
     *
     * author gao
     * date 2016-1-26
     */
    private function curlPost($url, $postFields)
    {
        $postFields = http_build_query($postFields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * @param $content  短信内容
     * @param $mobile   发送的手机号
     * @return mixed
     * 短信通道，创蓝
     * author gao
     * date 2016-1-26
     */
    public function sendCode($content, $mobile)
    {
        $url = "http://222.73.117.156/msg/HttpBatchSendSM"; //使用创蓝短信通道
        $postArr = array(
            'account' => 'kekemei',
            'pswd' => 'Txb123456',
            'msg' => $content,
            'mobile' => $mobile,
            'needstatus' => true
        );
        return $this->curlPost($url, $postArr);
    }
    /**
     * 验证字符串是否是手机号 --using
     * @param varchar phone 手机号
     * @return boolean
     */
    public function isValidPhone($phone) {
        return preg_match("/^[1][3578]\d{9}$/", $phone) !== 0;
    }
}
