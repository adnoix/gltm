<?php
namespace Home\Controller;
use Think\Controller;
use Think;

class OauthController extends CommonController
{
    /**
     * 认证方法 --using
     * @param varchar login 手机号或用户名
     * @param varchar password 密码
     * @return array 状态+提示
     */
    public function authorize()
    {
        if(!empty($_REQUEST['login']) && !empty($_REQUEST['password'])){
            $username = addslashes($_REQUEST['login']);
            $password = addslashes($_REQUEST['password']);
            $map = "(user_phone = '{$username}' or user_name='{$username}' or user_email='{$username}')";
            //根据帐号获取用户信息
            $user = M('User')->where($map)->field('user_id,user_password,user_salt')->find();
            //判断用户名密码是否正确
            if($user && md5(md5($password).$user['user_salt']) == $user['user_password']){
                //记录token
                if( $login = M('login')->where("login_uid=".$user['user_id'])->find() ){
                    $data['login_oauth_token']         = $login['login_oauth_token'];
                    $data['login_oauth_token_secret']  = $login['login_oauth_token_secret'];
                    $data['login_uid']                 = $user['user_id'];
                }else{
                    $data['login_oauth_token']         = getOAuthToken($user['user_id']);
                    $data['login_oauth_token_secret']  = getOAuthTokenSecret();
                    $data['login_uid']                 = $user['user_id'];
                    M('login')->add($data);
                }
                $this->apiReturn('success','登录成功',$data);
               }else{
               $this->apiReturn('error','用户名或密码错误');
            }
        }else{
            $this->apiReturn('error','用户名或密码不能为空');
        }
    }
    /**
     * 注销帐号，刷新token --using
     * @param varchar login 手机号或用户名
     * @return array 状态+提示
     */
    public function logout(){

        $login = $_REQUEST['login'];
        $login = addslashes($login);

        $where ="(user_phone = '{$login}' or user_name='{$login}' or user_email='{$login}')";

        //判断密码是否正确
        $user =M('User')->where($where)->field('user_id')->find();
        if($user){
            $data['login_oauth_token']         = getOAuthToken($user['user_id']);
            $data['login_oauth_token_secret']  = getOAuthTokenSecret();
            $data['login_uid']                 = $user['user_id'];
            M('login')->where("login_uid=".$user['user_id'])->save($data);
            $this->apiReturn('success','退出成功');
        }else{
            $this->apiReturn('error','退出失败');
        }
    }
    /********** 注册 **********/
    /**
     * 发送注册验证码 --using
     * @param varchar phone 手机号
     * @return array 状态值+提示信息
     */
    public function send_register_code()
    {
        $phone = floatval($_REQUEST['phone']);
        if(!$this->isValidPhone($phone)){
            $this->apiReturn('error','请填写正确的手机号');
        }
        /* # 检查是否可以已经被注册 */
        if (!D('User')->isChangePhone($phone)) {
            $this->apiReturn('error','该手机已经存在，无法再次注册');
            /* # 检查是否发送失败 */
        }
        $data['target'] = $phone;
        $home_user_yzm = '';
        for($i=0;$i<4;$i++) {
            $home_user_yzm .= rand(1,9);
        }
        $data['content'] = "【全域旅游】,你获取的验证码为" .$home_user_yzm. ",请注意查收！";
        $data['method'] = 'sendsmsnormal';
        $data['cpid'] = 'xunzhi';
        $data['cppsw'] = 'xunzhi';
        $res = sendMsg($data);
        if(empty($res)){
            $map['sms_phone']=$phone;
            $map['sms_code']=$home_user_yzm;
            $map['sms_message']='注册验证码';
            $map['sms_time']=time();
            M('sms')->add($map);
            $this->apiReturn('success','发送成功');
        }else{
            $this->apiReturn('error','发送失败');
        }
    }
    /**
     * 判断手机注册验证码是否正确
     * * @param varchar phone 手机号
    //  * @param varchar regCode 验证码
     * @return array
     * @author 盆盆
     **/
    public function check_register_code()
    {
        $phone = floatval($_REQUEST['phone']);
        $code  = intval($_REQUEST['regCode']);
        $sms   = D('Sms');

        /* # 判断验证码是否正确 */
        if ($sms->CheckCaptcha($phone, $code)) {
            $this->apiReturn('success','验证成功');
        }else{
            $this->apiReturn('error','验证失败');
        }
    }
    /**
     * 注册帐号 --using
     * @param varchar phone 手机号
     * @param varchar regCode 验证码
     * @param varchar ip 注册ip
     * @param varchar longitude 经度longitude
     * @param varchar latitude 纬度latitude
     * @param varchar password 密码
     * @return array 状态值+提示信息
     */
    public function register(){
        $phone = I('post.phone');
        $regCode = I('post.regCode');
        $password =I('post.password');
        $latitude=I('post.latitude');
        $longitude=I('post.longitude');
        $ip =I('post.ip');
        $sms   = D('Sms');
        if(!$this->isValidPhone($phone)){
            $this->apiReturn('error','请填写正确的手机号');
        }
        if (!$sms->CheckCaptcha($phone, $regCode)) {
            $this->apiReturn('error','验证码错误');
        }
        unset($sms);
        //开始注册
        $login_salt = rand(11111, 99999);
        $map['user_salt'] = $login_salt;
        $map['user_phone'] = $phone;
        $map['user_password']=md5(md5($password).$login_salt);
        $map['user_latitude'] = $latitude;
        $map['user_longitude'] = $longitude;
        $map['user_ip'] = $ip;
        $map['user_ctime']=time();
        $uid = M('User')->add($map);
        if($uid){
            $data['login_oauth_token']         = getOAuthToken($uid);
            $data['login_oauth_token_secret']  = getOAuthTokenSecret();
            $data['login_uid']                 = $uid;
            M('login')->add($data);
            $this->apiReturn('success','注册成功',$data);
        }else{
            $this->apiReturn('error','注册失败');
        }
    }
    /********找回密码*********/

    /**
     * 发送短信验证码
     *
     * @return array
     * @author Medz Seven <lovevipdsw@vip.qq.com>
     **/
    public function sendCodeByPhone()
    {
        $phone  = floatval($_REQUEST['phone']);
        if(!$this->isValidPhone($phone)){
            $this->apiReturn('error','请填写正确的手机号');
        }
        $login = M('User')->where("user_phone =".$phone)->field('`user_phone`')->find();
        if (!$login) {
            $this->apiReturn('error','该用户没有绑定手机号码，或者用户不存在！');
        }
        $data['target'] = $phone;
        $home_user_yzm = '';
        for($i=0;$i<4;$i++) {
            $home_user_yzm .= rand(1,9);
        }
        $data['content'] = "【全域旅游】,你获取的验证码为" .$home_user_yzm. ",请注意查收！";
        $data['method'] = 'sendsmsnormal';
        $data['cpid'] = 'xunzhi';
        $data['cppsw'] = 'xunzhi';
        $res = sendMsg($data);
        if(empty($res)){
            $map['sms_phone']=$phone;
            $map['sms_code']=$home_user_yzm;
            $map['sms_message']='找回验证码';
            $map['sms_time']=time();
            M('sms')->add($map);
            $this->apiReturn('success','发送成功');
        }else{
            $this->apiReturn('error','发送失败');
        }
    }
    /**
     * 保存用户密码
     *
     * @return array
     * @author penpen
     **/
    public function saveUserPasswordByPhone()
    {
        $phone = I('post.phone');
        $regCode = I('post.regCode');
        $password =I('post.password');
        $repassword =I('post.repassword');
        $sms   = D('Sms');
        if(!$this->isValidPhone($phone)){
            $this->apiReturn('error','请填写正确的手机号');
        }
        if (!$sms->CheckCaptcha($phone, $regCode)) {
            $this->apiReturn('error','验证码错误');
        }
        unset($sms);
        if($password!=$repassword){
            $this->apiReturn('error','两次输入的密码不一致');
        }
        $login = M('User')->where("user_phone =".$phone)->field('`user_phone`')->find();
        if (!$login) {
            $this->apiReturn('error','该用户没有绑定手机号码，或者用户不存在！');
        }
        $data = array();
        $data['user_salt'] = rand(10000, 99999);
        $data['user_password']   = md5(md5($password).$data['login_salt']);
        $res=M('User')->where('`user_phone` ='.$phone)->save($data);
        if($res){
            $this->apiReturn('success','修改成功');
        }else{
            $this->apiReturn('error','修改失败');
        }
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
