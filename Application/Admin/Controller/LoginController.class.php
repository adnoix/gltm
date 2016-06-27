<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{

    /**
     * 登陆
     * author gao
     * date 2016-1-27
     */
    public function login()
    {
        if (empty($_POST)) { //判断是否点击了登陆按钮
            $this->display();
        } else {
            $adminObj = M("Admin");
            $adminWhere['admin_name'] = I('post.user_name');
            $adminWhere['admin_pwd'] =md5( I('post.phone_mm'));
            $adminWhere['status'] = 1; //用户状态
            $admin = $adminObj->where($adminWhere)->find();
            if (empty($admin)) {
                $this->error("登陆失败", U("Login/login"));
            } else {
                session(C('USER_AUTH_KEY'), $admin['id']);
                session("A_NAME", $admin['admin_name']); //生成session
                session("A_ID", $admin['id']);
                //修改最后登录时间和IP
                $adminSave = array(
                    "last_time" => time(), //最后登录时间
                    "login_ip" => get_client_ip(), //登录IP地址
                );
                $saveAdmin = $adminObj->where($adminWhere)->save($adminSave);

                if ($admin['admin_name'] == C('RBAC_SUPERADMIN')) {
                    session(C('ADMIN_AUTH_KEY'), true);
                }
                $Rbac = new \Org\Util\Rbac;
                $Rbac->saveAccessList();
                $this->success("登陆成功", U("Admin/Index/index"));
            }
        }
    }
}