<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>红包_弹出-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body>

<div class="wrap">
    <div class="hbbgb ui_hbbg">
    </div>
</div>

<div class="reveal-modal-bg"></div>
<!--红包弹出-->
<a id="Alert_hb_b" data-reveal-id="Alert_hb_tip"></a>
<div id="Alert_hb_tip" class="reveal-modal">
    <div class="reveal-msgbox">
        <div class="ui_hb_msg ui_hb_box">
            <div class="close-reveal-modal ui_ico2 close_ico2 close_wz"></div>
            <div class="bk40"></div>
            <div class="head"><img src="/wawj/Public/img/head_logo.png" class="ui_block ui_circle"></div>
            <div class="bk15"></div>
            <div class="ui_color2">销售部</div>
            <div class="bk10"></div>
            <div class="ui_color2 ui_min_f1 ui_op5">给你发了一个红包</div>
            <div class="bk20"></div>
            <p class="ui_color2">年终奖大红包猜猜有多大！</p>
            <div class="bk40"></div>
            <div class="ui_chb_btn">
                <a href="javascript:void(0);" onclick="chb_msgbox2();"><img src="/wawj/Public/img/chb_btn.png" class="ui_block"></a>
            </div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
        </div>
    </div>
</div>

<!--拆开红包-->
<a id="Alert_ckhb_b" data-reveal-id="Alert_ckhb_tip"></a>
<div id="Alert_ckhb_tip" class="reveal-modal" style="top:30px;">
    <div class="reveal-msgbox">
        <div class="ui_hb_msg2 ui_hb_box2">
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk50"></div>
            <div class="ui_color2 ui_min_f1" style="line-height:1.2em;">获得100积分<br>已存入您的个人账户</div>
            <div class="bk20"></div>
            <div class="head"><img src="/wawj/Public/img/head_logo.png" class="ui_block ui_circle"></div>
            <div class="bk15"></div>
            <div class="ui_color2">销售部</div>
            <div class="bk20"></div>
            <div class="ui_color2">销售业绩更上一层楼！</div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
        </div>
    </div>
</div>

<!--拆开红包-已领完-->
<a id="Alert_ckhb_ylw_b" data-reveal-id="Alert_ckhb_ylw_tip"></a>
<div id="Alert_ckhb_ylw_tip" class="reveal-modal" style="top:50px;">
    <div class="reveal-msgbox">
        <div class="ui_hb_msg ui_hb_box3">
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="ui_color2 ui_min_f1" style="line-height:1.2em;">来晚一步<br>红包已被领完了</div>
            <div class="bk40"></div>
            <div class="head"><img src="/wawj/Public/img/head_logo.png" class="ui_block ui_circle"></div>
            <div class="bk15"></div>
            <div class="ui_color2">销售部</div>
            <div class="bk20"></div>
            <div class="ui_color2">销售业绩更上一层楼！</div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="ui_hb_btn">
                <a href="领取详情.html" class="ui_color2 ui_max_f1">查看红包领取详情</a>
            </div>
            <div class="bk20"></div>
            <div class="bk40"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/wawj/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    hbbgb_h = $(".hbbgb").height();
    window_h = $(window).height();
    if (hbbgb_h<window_h) {
        $(".hbbgb").css("height",window_h+"px");
    }
    
    //红包弹出
    function hb_msgbox() {
        $("#Alert_hb_b").trigger('click');
        // 关闭弹框
        //$(".close-reveal-modal").trigger('click');
    }
    
    //拆开红包
    function chb_msgbox(){
        $(".close-reveal-modal").trigger('click');
        $("#Alert_ckhb_b").trigger('click');
    }
    
    //拆开红包_已领完
    function chb_msgbox2(){
        $(".close-reveal-modal").trigger('click');
        $("#Alert_ckhb_ylw_b").trigger('click');
    }
    
    window.onload = function(){ 
        //弹出
        hb_msgbox();
    };
</script>
<!--提示框-->
<script type="text/javascript" src="/wawj/Public/js/jquery.reveal.js"></script>
</body>
</html>