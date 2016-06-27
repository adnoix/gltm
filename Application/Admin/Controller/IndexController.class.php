<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends CommonController {
    /**
     * 后台首页
     * author  gao
     * date 2016-1-27
     */
    public function index() {
        $this -> display();
    }

    /**
     * 退出登陆
     * author gao
     * date 2016-1-28
     */
    public function noLogin() {
        session("A_ID",null);
        session("A_NAME",null);
        redirect(U('Login/login'));
    }
}
