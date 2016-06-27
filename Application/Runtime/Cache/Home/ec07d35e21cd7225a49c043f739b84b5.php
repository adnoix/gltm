<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>许愿详情-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body>

<div class="wrap">
    <div class="xybgb ui_xybg4">
        <div class="bk50"></div>
        <img src="img/xyxq_ti.png" class="ui_block">
        <div class="bk30"></div>
        <div class="ui_padding_lr30 ui_xyxq_c">
            <div class="ui_color2">我的愿望</div>
            <div class="bk15"></div>
            <textarea class="ui_color2 textarea" placeholder="请写下您的愿望，愿您梦想齐飞"></textarea>
            <div class="bk20"></div>
            <div class="xy_lable_b ui_min_f1">
                <input type="hidden" class="ipt_lable" value="1">
                <span class="on" data-id="1">
                    标签
                    <em class="ui_ico4 lable_check_ico"></em>
                </span>
                <span data-id="2">
                    标签
                    <em class="ui_ico4 lable_check_ico"></em>
                </span>
                <span data-id="3">
                    标签
                    <em class="ui_ico4 lable_check_ico"></em>
                </span>
                <span data-id="4">
                    标签
                    <em class="ui_ico4 lable_check_ico"></em>
                </span>
            </div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <a href="xuyuanqiang.html"><input type="submit" class="ui_color2 ui_max_f1 ui_iptbtn3" value="提交"></a>
        </div>
        
    </div>
</div>
<script type="text/javascript" src="/wawj/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    xybgb_h = $(".xybgb").height();
    window_h = $(window).height();
    if (xybgb_h<window_h) {
        $(".xybgb").css("height",window_h+"px");
    }
    
    //标签选择
    $(".xy_lable_b span").click(function(){
        $(this).find("em").show();
        $(this).siblings().find("em").hide();
        ipt_lable = $(this).attr("data-id");
        $(this).parent().children(".ipt_lable").val(ipt_lable);
    });
</script>
</body>
</html>