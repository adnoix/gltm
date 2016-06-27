<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>邮箱验证-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body class="ui_background_gray">

<div class="wrap">
    <div class="bk20"></div>
    <div class="ui_padding30">
        <div class="ui_color ui_text_c">请输入手机号或邮箱验证身份完成关注</div>
        <div class="bk40"></div>
        <div class="ui_sfyz_c2 clearfix">
            <div class="ui_color3">邮箱</div>
            <input type="text" class="ui_ipttxt2 ui_border" placeholder="请输入验证邮箱">
            <div class="bk20"></div>
            <div class="ui_color3">验证码</div>
            <input type="text" class="ui_ipttxt2 ui_border" placeholder="请输入邮箱验证码" style="width:60%;">
            <a href="#" class="ui_color3 ui_ml10">获取验证码</a>
        </div>
        
        <div class="bk40"></div>
        <div class="bk40"></div>
        <a href="yxyztj.html"><input type="submit" value="下一步" class="ui_iptbtn ui_color2"></a>
        <div class="bk30"></div>
        <a href="sjyz.html"><input type="button" value="通过手机号进行身份验证" class="ui_iptbtn2"></a>
    </div>
</div>

<a href="javascript:void(0);" onclick="msgbox('手机号与EHR系统登记不符\n请使用企业邮箱验证');">弹框</a>

<div class="reveal-modal-bg"></div>
<!--tip-->
<a id="Alert_b" data-reveal-id="Alert_tip"></a>
<div id="Alert_tip" class="reveal-modal">
    <div class="reveal-msgbox">
        <div class="ui_alertb">
            <div class="tip ui_max_f1">提示内容</div>
            <div class="btnb">
                <div class="bk20"></div>
                <center><a class="ui_btn ui_color4 ui_max_f1 close-reveal-modal">确定</a></center>
                <div class="bk20"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
function msgbox(str) {
    $("#Alert_tip .tip").html(str);
    $("#Alert_b").trigger('click');
    // 关闭弹框
    //$(".close-reveal-modal").trigger('click');
}
    
</script>
<!--提示框-->
<script type="text/javascript" src="js/jquery.reveal.js"></script>
</body>
</html>