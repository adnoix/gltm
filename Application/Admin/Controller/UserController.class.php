<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {

        public function userList(){
            $list=M('user');
            $userCount=$list->count();
            $Page       = new \Think\Page($userCount,25);
            $show       = $Page->show();//
            $list = $list->limit($Page->firstRow.','.$Page->listRows)->select();
            // var_dump($list);
            $this->assign('page',$show);// 赋值分页输出
            $this->assign("list",$list);
            $this->display();
        }


}