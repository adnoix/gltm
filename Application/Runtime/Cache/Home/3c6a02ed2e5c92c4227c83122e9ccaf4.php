<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>活动申请_公开-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body class="ui_background_gray2">

<div class="wrap">
    <div class="ui_hdsq_c2">
        <dl class="clearfix ui_border_b9">
            <div class="dl_l ui_color6">
                申请人
            </div>
            <div class="dl_r">
                <input type="text" class="ui_hdsq_txt" placeholder="请输入活动申请人">
            </div>
        </dl>
        
        <dl class="clearfix ui_border_b9">
            <div class="dl_l ui_color6">
                部门
            </div>
            <div class="dl_r">
                <input type="text" class="ui_hdsq_txt" placeholder="申请人所在部门">
            </div>
        </dl>
        
        <dl class="clearfix">
            <div class="dl_l ui_color6">
                手机号码
            </div>
            <div class="dl_r">
                <input type="text" class="ui_hdsq_txt" placeholder="请输入申请人联系方式">
            </div>
        </dl>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_hdsq_c2">
        <dl class="clearfix ui_border_b9">
            <div class="dl_l ui_color6">
                开始时间
            </div>
            <div class="dl_r clearfix">
                <select class="ui_hdsq_txt ui_hdsq_select">
                    <option>请选择活动时间</option>
                </select>
            </div>
        </dl>
        
        <dl class="clearfix">
            <div class="dl_l ui_color6">
                结束时间
            </div>
            <div class="dl_r clearfix">
                <select class="ui_hdsq_txt ui_hdsq_select">
                    <option>请选择活动时间</option>
                </select>
            </div>
        </dl>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_hdsq_c2">
        <dl class="clearfix ui_border_b9">
            <div class="dl_l ui_color6">
                活动类型
            </div>
            <div class="dl_r clearfix">
                <select class="ui_hdsq_txt ui_hdsq_select">
                    <option>请输入活动地点</option>
                </select>
            </div>
        </dl>
        
        <dl class="clearfix">
            <div class="dl_l ui_color6">
                活动地点
            </div>
            <div class="dl_r clearfix">
                <input type="text" class="ui_hdsq_txt" placeholder="请输入活动地点">
            </div>
        </dl>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_hdsq_c2">
        <dl class="clearfix">
            <div class="dl_l ui_color6">
                活动介绍
            </div>
            <div class="dl_r clearfix">
                <textarea class="ui_hdsq_txt ui_hdsq_textarea" placeholder="请输入活动内容介绍"></textarea>
            </div>
        </dl>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_hdsq_c2">
        <dl class="clearfix">
            <div class="dl_l ui_color6">
                活动规则
            </div>
            <div class="dl_r clearfix">
                <textarea class="ui_hdsq_txt ui_hdsq_textarea" placeholder="请输入活动规则"></textarea>
            </div>
        </dl>
    </div>
    
    <div class="bk40"></div>
    <div class="ui_hdsq_c3">
        <dl class="clearfix">
            <input class="hdxy_check" type="hidden" value="0">
            <span class="ui_ico2 check2_ico"></span>
            <span class="ui_color6"><a href="hongdongxieyi.html">我已阅读并同意《活动协议条款》</a></span>
        </dl>
    </div>
    
    <div class="bk40"></div>
    <div class="bk20"></div>
    <div class="ui_padding_lr40">
        <input type="submit" value="提交" class="ui_iptbtn ui_color2">
    </div>
    <div class="bk40"></div>
</div>

<a href="javascript:void(0);" onclick="msgbox('<b>提交成功</b><br>内容申请通过后我们会联系您感谢您的参与！！');">弹框</a>

<div class="reveal-modal-bg"></div>
<!--tip-->
<a id="Alert_hd_b" data-reveal-id="Alert_hd_tip"></a>
<div id="Alert_hd_tip" class="reveal-modal">
    <div class="reveal-msgbox">
        <div class="ui_alertb ui_alertb2">
            <div class="tip ui_max_f1">提示内容</div>
            <div class="btnb">
                <div class="bk20"></div>
                <center><a class="ui_btn ui_color4 ui_max_f1 close-reveal-modal">确定</a></center>
                <div class="bk20"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/wawj/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    //活动协议
    $(".ui_hdsq_c3 dl").click(function(){
        if($(this).hasClass("on")) {
            $(this).children(".hdxy_check").val(0);
            $(this).removeClass("on");
        } else {
            $(this).children(".hdxy_check").val(1);
            $(this).addClass("on");
        }
    });
</script>

<script type="text/javascript">
function msgbox(str) {
    $("#Alert_hd_tip .tip").html(str);
    $("#Alert_hd_b").trigger('click');
    // 关闭弹框
    //$(".close-reveal-modal").trigger('click');
}
    
</script>
<!--提示框-->
<script type="text/javascript" src="/wawj/Public/js/jquery.reveal.js"></script>
</body>
</html>