<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

    Public function _initialize()
    {
        $session = session(C('USER_AUTH_KEY'));
        if(!isset($session))
        {
            $this->redirect( '/Login/login');
        }

        $notAuth = in_array(MODULE_NAME, explode(',',C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')))||C('RBAC_SUPERADMIN')==$_SESSION['username'];



        if(C('USER_AUTH_ON')&& !$notAuth){
            $Rbac = new \Org\Util\Rbac;
            $Rbac ->AccessDecision(GROUP_NAME) || $this->error('没有权限');
        }

    }

}