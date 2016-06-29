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
class UserModel extends Model
{
    public function isChangePhone($phone, $userID = null)
    {
        $uid = $this->where('`user_phone` = ' . $phone)->field('`user_id`')->find();
        if ($uid == $userID or !$uid) {
            return true;
        }
        return false;
    }
    
}
