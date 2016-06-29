<?php

namespace Home\Model;
use Think\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminModel
 *
 * @author penpen
 */
class SmsModel extends Model
{
   public function CheckCaptcha($phone, $code){
       $res=$this->where('sms_phone ='.$phone)->order("sms_id desc")->find();
       if($res){
           if($code==$res['sms_code']){
               return true;
           }else{
               return false;
           }
       }else{
           return false;
       }
   }
}
