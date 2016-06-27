<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Class RbacController
 * @package Admin\Controller
 * 权限管理控制器    应用thinkPHP  RBAC 权限管理模式
 * author Pei
 * date 2016-05-04
 */
class RbacController extends CommonController
{
    /**
     * 用户管理
     * author Pei
     * date 2016-05-04
     */
    public function adminList()
    {
        $adminObj = M("Admin");
        $adminField = array(
            "home_admin.id",             //管理员id
            "home_admin.admin_name",   //管理员名字
            "home_admin.last_time",    //管理员最后登陆时间
            "home_admin.login_ip",     //管理员最后一次登陆的ip
            "home_admin.status",       //管理员状态
            "role.name",              //角色名字
            "role.remark"             //角色备注
        );
        $adminList = $adminObj -> join("left join home_role_user role_user on role_user.user_id = home_admin.id")
            -> join("left join home_role role on role.id = role_user.role_id")
            -> field($adminField) -> order("home_admin.last_time desc")
            -> select();


        $this->assign("list", $adminList);
        $this->display();
    }

    /**
     * 添加用户
     * author Pei
     * date 2016-05-04
     */
    public function adminAdd() {
        if(empty($_POST)){ //判断是否点击了提交按钮
            //没有点击提交按钮，查询所有角色
            $roleObj = M("Role");
            $roleWhere['status'] = 1;  //角色状态，1为启用，0为禁用
            $roleList = $roleObj -> where($roleWhere) -> select();

            $this -> assign("role",$roleList);
            $this -> display();
        }else{

            $adminObj = M("Admin");
            $adminWhere['admin_name'] = $_POST['admin_name'];
            $adminFind = $adminObj -> where($adminWhere) -> find();
            if(!empty($adminFind)){
                $this -> error("该管理员已经存在");
            }else{
                $adminAdd = array(
                    "admin_name"   => $_POST['admin_name'],    //管理员名字
                    "admin_pwd"    => md5($_POST['password']),  //登陆密码
                    "last_time"    => time(),                    //最后一次登陆时间
                    "login_ip"     => get_client_ip(),           //登陆ip
                    "status"       => 1,                          //用户状态，1启用，2禁用
                );
                $addAdmin = $adminObj -> add($adminAdd);  //向管理员表添加数据
                if($addAdmin){   //判断是否添加成功
                    //向用户和角色关联表添加数据
                    $roleUserObj = M("Role_user");
                    $roleUserAdd = array(
                        "role_id"   => $_POST['role_id'],   //角色id
                        "user_id"   => $addAdmin,            //用户id
                    );
                    $addRoleUser = $roleUserObj -> add($roleUserAdd);
                    if($addRoleUser){
                        $this -> success("添加成功",U("Rbac/adminList"));
                    }else{
                        $this -> error("用户添加成功，与角色关联失败",U("Rbac/adminList"));
                    }
                }else{
                    $this -> error("添加失败");
                }
            }
        }
    }

    /**
     * 修改用户状态
     * author Pei
     * date 2016-05-04
     */
    public function status() {
        $adminObj = M("Admin");
        $adminWhere['id'] = I("id");

        $lock = I('status');
        if ($lock == 2) {   //用户状态，1是启用，2是禁用
            $editAdmin = $adminObj -> where($adminWhere) -> setField('status',1);
        }else {
            $editAdmin = $adminObj -> where($adminWhere) -> setField('status',2);
        }

        if($editAdmin) {
            $this -> success("修改成功",U("Rbac/adminList"));
        }else{
            $this -> error("修改失败");
        }
    }

    /**
     * 修改管理员信息
     * author Pei
     * date 2016-05-04
     */
    public function adminEdit() {
        $adminObj = M("Admin");
        if(empty($_POST)) {  //判断是否点击了提交按钮
            $adminWhere['home_admin.id'] = $_GET['id'];
            $adminField = array(
                "home_admin.id",             //管理员id
                "home_admin.admin_name",    //管理员名字
                "role_user.role_id",      //用户的角色的名字
            );

            $adminFind = $adminObj -> join("left join home_role_user role_user on role_user.user_id = home_admin.id")
                -> where($adminWhere) -> field($adminField) -> find();

            //查询所有的角色
            $roleObj = M("Role");
            $roleList = $roleObj -> select();

            $this -> assign("admin",$adminFind);
            $this -> assign("role",$roleList);
            $this -> display();

        }else{
            $adminWhere['admin_name'] = $_POST['username'];
            $adminWhere['id'] = array("neq",$_POST['user_id']);
            $adminFind = $adminObj -> where($adminWhere) -> find();
            if(empty($adminFind)){
                unset($adminWhere);
                $adminWhere['id'] = $_POST["user_id"];
                $adminEdit = array(
                    "admin_name" => $_POST['username'],        //管理员名字
                    "admin_pwd"  => md5($_POST['password']),   //管理员登陆密码
                );
                $editAdmin = $adminObj -> where($adminWhere) -> save($adminEdit);

                //修改管理员与角色关联表
                $roleUserObj = M("Role_user");
                $roleUserWhere['user_id'] = $_POST['user_id'];
                $roleUserEdit['role_id'] = $_POST['role_id'];
                $editRoleUser = $roleUserObj -> where($roleUserWhere) -> save($roleUserEdit);

                if($editAdmin !== false && $editRoleUser !== false){
                    $this -> success("修改成功",U("Rbac/adminList"));
                }else{
                    $this -> error("修改失败",10000);
                }
            }else {
                $this -> error("该用户名已经存在");
            }

        }
    }

    /**
     * 节点列表
     * author Pei
     * date 2016-05-04
     */
    public function nodeList()
    {
        $nodeObj = M("Node");
        $nodeField = array('id', 'name', 'title', 'pid');
        $nodeList = $nodeObj->field($nodeField)->order('sort')->select();
        $nodeApp = node_merge($nodeList);

        $this->assign("node", $nodeApp);
        $this->display();
    }

    /**
     * 添加节点
     * author  Pei
     * date 2016-05-04
     */
    public function nodeAdd()
    {
        if (empty($_POST)) {
            $pid = I('pid', 0, 'intval');
            $level = I('level', 1, 'intval');

            $this->assign("pid", $pid);
            $this->assign("level", $level);
            switch ($level) {
                case 1:
                    $type = '应用';
                    break;
                case 2:
                    $type = '控制器';
                    break;
                case 3:
                    $type = '动作方法';
                    break;
            }
            $this->assign("type", $type);
            $this->display();
        } else {
            $nodeObj = M("Node");
            $nodeAdd = array(
                "name"    => $_POST['name'],   //节点名字
                "title"   => $_POST['title'],  //节点描述
                "status"  => $_POST['status'], //状态
                "sort"    => $_POST['sort'],    //排序
                "pid"     => $_POST['pid'],     //父级id
                "level"   => $_POST['level']    //等级
            );

            $addNode = $nodeObj -> add($nodeAdd);  //添加数据
            if($addNode){
                $this -> success("添加成功",U("Rbac/nodeList"));
            }else{
                $this -> error("添加失败");
            }
        }
    }

    /**
     * 删除节点
     * author Pei
     * date 2016-05-04
     */
    public function nodeDel() {
        $nodeDel = delList('node','id','pid',I("pid"));
        if($nodeDel){
            $this->success('节点删除成功',U('Rbac/nodeList'));
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * 角色管理
     * author Pei
     * date 2016-05-04
     */
    public function roleList(){
        $roleObj = M("Role");
        $roleList = $roleObj -> select();
//        p($roleList);
        $this -> assign("role",$roleList);
        $this -> display();
    }

    /**
     * 添加角色
     * author Pei
     * date 2016-05-04
     */
    public function roleAdd() {
        if(empty($_POST)){   //判断是否点击了提交按钮
            $this -> display();
        }else{
            $roleObj = M("Role");
            $roleAdd = array(
                "name"     => $_POST['name'],    //角色名
                "remark"   => $_POST['remark'], //角色描述
                "status"   => $_POST['status'], //状态
            );

            $addRole = $roleObj -> add($roleAdd);  //添加数据
            if($addRole){
                $this -> success("添加成功",U('Rbac/roleList'));
            }else{
                $this -> error("添加失败");
            }

        }
    }

    /**
     * 配置角色权限
     * author Pei
     * date 2016-05-04
     */
    public function access() {

        $accessObj = M("Access");  //角色和节点关联表

        if(empty($_POST)){  //判断是否点击了修改按钮
            $nodeObj = M("Node");  //节点表
            $nodeList = $nodeObj  -> order("sort asc") -> select();  //查询所有的节点数据

            $accessWhere['role_id'] = $_GET['rid'];
            $accessList = $accessObj -> where($accessWhere) -> getField("node_id",true);  //查询本角色已经拥有的节点权限

            $node = node_merge($nodeList,$accessList);

            $this -> assign("node",$node);
            $this -> assign("rid",$_GET['rid']);
            $this -> display();
        }else{
            $accessWhere['role_id'] = $rid = $_POST['rid'];
            $delAccess = $accessObj -> where($accessWhere) -> delete();  //先将此角色的所有权限全部删除

            foreach($_POST['access'] as $key => $value) {   //循环组成添加的数组
                $tmp = explode('_',$value);
                $data[] = array(
                    'role_id' => $rid,    //角色id
                    'node_id' => $tmp[0], //节点id
                    'level' => $tmp[1]     //节点等级
                );
            }

            $addAccess = $accessObj -> addAll($data);

            if($addAccess){
                $this -> success("修改成功",U('Rbac/roleList'));
            }else{
                $this -> error("修改失败");
            }
        }
    }

    /**
     * 锁定、启动角色状态
     * author Pei
     * date 2016-05-04
     */
    public function roleLock() {
        $roleObj = M("Role");
        $roleWhere['id'] = I('rid');

        $status = I('status');

        if ($status==1) {
            $roleEdit = $roleObj -> where($roleWhere) -> setField("status",0);
        }else {
           $roleEdit = $roleObj -> where($roleWhere) -> setField("status",1);
        }
        if($roleEdit){
            $this -> success("设置成功",U("Rbac/roleList"));
        }else{
            $this -> error("设置失败");
        }
    }
}
