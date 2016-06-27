<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>开始许愿-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body>

<div class="wrap">
    <div class="xybgb ui_xybg">
        <div class="ui_xybtn"><a href="xuyuanqiang.html" class="ui_color12">许愿墙</a></div>
        <div class="ui_xyft_btnb ui_padding">
            <center><a href="xuyuanxiangqing.html" class="btn1 ui_bold ui_max_f1 ui_color2">开始许愿</a></center>
            <div class="bk30"></div>
            <div class="bk30"></div>
            <a href="wodeyuanwang.html" class="btn2 ui_color2 fl">我的愿望</a>
            <a href="tadeyuanwang.html" class="btn2 ui_color2 fr">Ta的愿望</a>
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
</script>
</body>
</html>