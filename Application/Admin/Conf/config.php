<?php
/**
 * 后台配置文件
 * author Pei
 * date 2016-05-04
 */
return array(
    'RBAC_SUPERADMIN'=>'admin',    //超级管理员名称
    "ADMIN_AUTH_KEY" => 'superadmin',          //超级管理员识别号(必配)
    'USER_AUTH_ON' =>true,             //是否开启验证
    'USER_AUTH_TYPE' =>2,              //验证类型 1登陆验证   2时时验证
    'USER_AUTH_KEY' => 'uid',      //用户认证识别号
    'NOT_AUTH_MODULE' => 'Index',  //无需认证的控制器
    'NOT_AUTH_ACTION' =>'',         //无需认证的动作方法
    'RBAC_ROLE_TABLE' => 'gltm_role',  //角色表名称
    'RBAC_USER_TABLE' => 'gltm_role_user',    //角色与用户的中间表名称
    'RBAC_ACCESS_TABLE' => 'gltm_access',     //权限表名称
    'RBAC_NODE_TABLE' => 'gltm_node',         //节点表名称
);