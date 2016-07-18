<?php
namespace Home\Controller;

use Think\Controller;
use Think;

class AboutController extends CommonController
{

    /**
     * 关于我们 --
     * @return array 状态+提示
     */
    public function aboutus()
    {
       $about=M('aboutus')->field('aboutus_detail')->find();
        if(empty($about)){
            $aa=(object)array();
            $this->apiReturn('error', '暂无数据',$aa);
        }else{
            $this->apiReturn('success', '查询成功',$about);
        }
    }
}
