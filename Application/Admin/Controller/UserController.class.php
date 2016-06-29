<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {

        public function userList(){
            $list=M('user')->select();
           $this->assign("list",$list);
            $this->display();
        }


}