<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>活动报名-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body class="ui_background_gray3">

<div class="wrap">
    <div id="slideBox" class="slideBox">
        <div class="bd">
        	<ul>
        		<li><a href="#"><img src="/wawj/Public/img/hd_banner.jpg" class="ui_block"></a></li>
        		<li><a href="#"><img src="/wawj/Public/img/hd_banner.jpg" class="ui_block"></a></li>
        		<li><a href="#"><img src="/wawj/Public/img/hd_banner.jpg" class="ui_block"></a></li>
        		<li><a href="#"><img src="/wawj/Public/img/hd_banner.jpg" class="ui_block"></a></li>
        	</ul>
        </div>
        
        <div class="hd">
        	<ul></ul>
        </div>
    </div>
    <script type="text/javascript">
    TouchSlide({ 
        slideCell:"#slideBox",
        titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
        mainCell:".bd ul", 
        effect:"left", 
        interTime:3000,
        autoPage:true, //自动分页
        autoPlay:true   //自动运行
    });
    </script>
    
    <div class="ui_hdbm_c2 ui_background_white clearfix">
        <div class="clt ui_padding_lr20 ui_color12 ui_border_r ui_nowrap">伟业我爱我家春季拓展活动</div>
        <div class="crt ui_padding_lr20">
            <div class="cnb clearfix">
                <span class="ui_ico time_ico"></span>
                <span class="ui_color2 ui_min_f1">2016.4.6-2016.4.8</span>
            </div>
        </div>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_hdbm_c3 ui_background_white clearfix">
        <dl class="clearfix">
            <span class="ui_ico hd_ico"></span>
            <span class="ui_color6">户外拓展</span>
        </dl>
        
        <dl class="clearfix">
            <span class="ui_ico hd_ico2"></span>
            <span class="ui_color6">古北水镇</span>
        </dl>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_padding ui_background_white">
        <div class="ui_hdti">活动介绍</div>
        <div class="bk10"></div>
        <div class="desb ui_min_f1 ui_color6">
            <p>古北水镇山环水绕、移步换景。行走间，回味古老建筑的历史气息；转角、回眸、凝望，清冽的河水总是在不经间给你欣喜；携手乘上小舟，聆听摇橹声声，仿似诉说着长城故事，细品水镇另番韵味，时近、时远、忽隐，忽现……</p>
        </div>
        <div class="bk10"></div>
        <div class="bk30 ui_border_b7"></div>
        <div class="bk30"></div>
        <div class="ui_artc">
            <img src="/wawj/Public/img/hd_pic.jpg">
        </div>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_padding ui_background_white">
        <div class="ui_hdti">活动介绍</div>
        <div class="bk20"></div>
        <div class="desb ui_min_f1 ui_color6">
            <p>活动将于2012年4月27日24点开始——2012年5月31日24点结束（“活动期”）。（本活动规则中提及的所有时间和日期均为北京时间）</p>
            <p>2、若您符合上文第二条资格的条件而获得参加本次活动资格参加者进入“迪士尼妙趣童年”活动页面，活动分为2个部分：</p>
            <p>第一部分“来九宫格找童年回忆” </p>
            <p>制作“妙趣童年”九宫格，并分享至微博。</p>
            <p>第二部分“享迪士尼儿童节大礼” </p>
            <p>方法一：获取迪士尼幸运纪念奖：参加者点击8大迪士尼儿童节礼物的任意一个进入迪士尼礼物主题页面， 参与制作并转发“迪士尼许愿卡” （“作品”），即有机会通过幸运抽奖的方式获取迪士尼送出的共计2431个“迪士尼幸运纪念奖”。</p>
        </div>
        <div class="bk20"></div>
    </div>
    
    <div class="bk40"></div>
    <div class="bk40"></div>
    <div class="ui_padding_lr40">
        <a href="hdbm.html"><input type="submit" value="报名参加" class="ui_iptbtn ui_color2"></a>
    </div>
    <div class="bk40"></div>
</div>

<script type="text/javascript" src="/wawj/Public/js/jquery.min.js"></script>
<!--缩放内容图片-->
<script type="text/javascript">
var optionswidth;
var sUserAgent = navigator.userAgent.toLowerCase();
var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
var bIsMidp = sUserAgent.match(/midp/i) == "midp";
var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
var bIsAndroid = sUserAgent.match(/android/i) == "android";
var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
var bIsWP = sUserAgent.match(/windows phone/i) == "windows phone";

if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM || bIsWP) {
    window_w = $(window).width();
    optionswidth = (window_w - 20);
} else {
    optionswidth = 600;
}

$('.ui_artc img').load(function() {
    iresize(this,optionswidth);
});

function iresize(self,optionswidth) {
    var width = $(self).width();
    var height = $(self).height();
    if(width > optionswidth) {
        height = optionswidth * height / width;
        $(self).css('width', optionswidth);
        $(self).css('height', Math.round(height));
    }
}

$('.ui_artc img').each(function(i){
    iresize(this,optionswidth);
});
</script>
</body>
</html>