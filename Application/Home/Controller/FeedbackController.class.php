<?php
namespace Home\Controller;
use Think\Controller;
use Think;

class FeedbackController extends CommonController
        {
         public $userid="";
         public function _initialize(){
                  $login_oauth_token=addslashes($_REQUEST['login_oauth_token']);
                  $login_oauth_token_secret=addslashes($_REQUEST['login_oauth_token_secret']);
                  $map=array();
                  $map['login_oauth_token']=$login_oauth_token;
                  $map['login_oauth_token_secret']=$login_oauth_token_secret;
                  $uid=M('login')->field('login_uid')->where($map)->getField('login_uid');
                  if($uid){
                            $this->userid=$uid;
                  }else{
                      $this->apiReturn('error','接口认证失败');
                  }
              }
    /**
         * 用户反馈 --
         * @param varchar login_oauth_token
         * @param varchar login_oauth_token_secret
         * @param varchar feedbackdetail
                            * feedback_ip
         * @param varchar feedbackcontact
         * @return array 状态+提示
         */
        public function submit(){
            $feedback_detail=addslashes($_REQUEST['feedbackdetail']);
            if(empty($feedback_detail)){
                $this->apiReturn('error','反馈内容不能为空！');
            }elseif(strlen($feedback_detail)>=100){
                $this->apiReturn('error','反馈内容不能超过100个字！');
            }
            $feedback_contact=addslashes($_REQUEST['feedbackcontact']);
            $feedback_ip=$_REQUEST['feedback_ip'];
            $map['feedback_uid']=$this->userid;
            $map['feedback_contact']=$feedback_contact;
            $map['feedback_ip']=$feedback_ip;
            $map['feedback_ctime']=time();
            $result=M('feedback')->add($map);
            if($result){
                $this->apiReturn('success','反馈成功');
            }else{
                $this->apiReturn('success','反馈失败');
            }
        }
}
