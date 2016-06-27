<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>商城-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body class="ui_background_gray2">

<div class="wrap">
    <div id="slideBox" class="slideBox">
        <div class="bd">
        	<ul>
        		<li><a href="#"><img src="/wawj/Public/img/banner.png" class="ui_block"></a></li>
        		<li><a href="#"><img src="/wawj/Public/img/banner.png" class="ui_block"></a></li>
        		<li><a href="#"><img src="/wawj/Public/img/banner.png" class="ui_block"></a></li>
        		<li><a href="#"><img src="/wawj/Public/img/banner.png" class="ui_block"></a></li>
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
    
    <div class="ui_syr1c ui_background_white ui_padding clearfix">
        <dl>
            <span class="ui_ico jf_ico fl"></span>
            <span class="ui_color6 ui_ml10">积分<font class="ui_color4">300</font></span>
        </dl>
        
        <dl>
            <span class="ui_ico jb_ico fl"></span>
            <span class="ui_color6 ui_ml10">金币<font class="ui_color4">50</font></span>
        </dl>
        
        <dl>
            <span class="ui_ico zs_ico fl"></span>
            <span class="ui_color6 ui_ml10">钻石<font class="ui_color4">50</font></span>
        </dl>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_syr2c ui_background_white clearfix">
        <dl class="clearfix">
            <a href="#">
            <div class="lcn">
                <p class="ui_color8">电子产品</p>
                <p class="ui_color7 ui_nowrap ui_min_f2">最新数码兑不停</p>
            </div>
            <div class="pic">
                <img src="/wawj/Public/img/sy_pic.png" class="ui_block">
            </div>
            </a>
        </dl>
        
        <dl class="clearfix">
            <a href="#">
            <div class="lcn">
                <p class="ui_color9">服饰美装</p>
                <p class="ui_color7 ui_nowrap ui_min_f2">朋友聚会时尚搭</p>
            </div>
            <div class="pic">
                <img src="/wawj/Public/img/sy_pic2.png" class="ui_block">
            </div>
            </a>
        </dl>
        
        <dl class="clearfix">
            <a href="#">
            <div class="lcn">
                <p class="ui_color10">生活用品</p>
                <p class="ui_color7 ui_nowrap ui_min_f2">每日上新惊喜不断</p>
            </div>
            <div class="pic">
                <img src="/wawj/Public/img/sy_pic3.png" class="ui_block">
            </div>
            </a>
        </dl>
        
        <dl class="clearfix">
            <a href="#">
            <div class="lcn">
                <p class="ui_color11">家居家纺</p>
                <p class="ui_color7 ui_nowrap ui_min_f2">品质简约生活</p>
            </div>
            <div class="pic">
                <img src="/wawj/Public/img/sy_pic4.png" class="ui_block">
            </div>
            </a>
        </dl>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_syr3c ui_background_white clearfix">
        <div class="tib ui_color6">热门产品</div>
        <div class="bk10"></div>
        <div class="grid clearfix">
            <div class="grid-item">
                <div class="box">
                    <p class="ui_nowrap">海尔吸尘吸</p>
                    <p class="ui_color6 ui_min_f1 ui_nowrap">大吸力 无耗材</p>
                    <div class="pic"><a href="#"><img src="/wawj/Public/img/sy_pic5.png" class="ui_block"></a></div>
                </div>
            </div>
            
            <div class="grid-item">
                <div class="box">
                    <p class="ui_nowrap">罗技畅销鼠标</p>
                    <p class="ui_color6 ui_min_f1 ui_nowrap">手感舒适响应快</p>
                    <div class="pic"><a href="#"><img src="/wawj/Public/img/sy_pic6.png" class="ui_block"></a></div>
                </div>
            </div>
            
            <div class="grid-item">
                <div class="box">
                    <p class="ui_nowrap">韦乐雅斯体重秤</p>
                    <p class="ui_color6 ui_min_f1 ui_nowrap">钢化玻璃防水</p>
                    <div class="pic"><a href="#"><img src="/wawj/Public/img/sy_pic7.png" class="ui_block"></a></div>
                </div>
            </div>
        </div>
        <div class="bk20"></div>
    </div>
    
    <div class="ui_footh"></div>
    <div class="ui_nav ui_background_white ui_border_t ui_max_f1 clearfix">
        <ul>
            <li class="on"><a href="shop.html">首页</a></li>
            <li><a href="cart.html">购物车</a></li>
            <li><a href="wode.html">我的</a></li>
        </ul>
    </div>
</div>
</body>
</html>