<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>我的-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body class="ui_background_gray2">

<div class="wrap">
    <div class="ui_gwc_c1 clearfix">
        <dl class="ui_background_white">
            <div class="tb ui_border_t ui_border_b ui_padding_lr20 clearfix">
                <span class="ui_color6">伟业我爱我爱积分商城发货商品</span>
            </div>
            
            <div class="cb ui_padding clearfix">
                <div class="pic"><img src="/wawj/Public/img/sy_pic5.png" class="ui_block"></div>
                <div class="rcn clearfix">
                    <div class="rc_l">
                        <div class="ti ui_color6">罗技畅销游戏电竞鼠标系列人体工学设计无线连接</div>
                        <div class="bk20"></div>
                        <div class="ui_jiajian_c clearfix">
                            <span class="ui_ico2 jian_ico ui_border fl jian_num"></span>
                            <input type="text" class="ui_ipttxt3 ui_color6 fl num" value="1" data-rel="10">
                            <span class="ui_ico2 jia_ico ui_border fl jia_num"></span>
                        </div>
                    </div>
                    
                    <div class="rc_r">
                        <div class="ui_max_f2 ui_color12">¥126</div>
                        <div class="ui_line_through ui_color6">¥320</div>
                        <div class="bk20"></div>
                        <a href="#" class="ui_color6">删除</a>
                    </div>
                </div>
            </div>
            
            <div class="tb ui_border_t ui_border_b ui_padding_lr20 clearfix">
                <span class="ui_color6 fl">共1件商品合计</span>
                <span class="ui_color4 fr">¥126金币</span>
            </div>
        </dl>
        
        <dl class="ui_background_white">
            <div class="tb ui_border_t ui_border_b ui_padding_lr20 clearfix">
                <span class="ui_color6">伟业我爱我爱积分商城发货商品</span>
            </div>
            
            <div class="cb ui_padding clearfix">
                <div class="pic"><img src="/wawj/Public/img/sy_pic5.png" class="ui_block"></div>
                <div class="rcn clearfix">
                    <div class="rc_l">
                        <div class="ti ui_color6">罗技畅销游戏电竞鼠标系列人体工学设计无线连接</div>
                        <div class="bk20"></div>
                        <div class="ui_jiajian_c clearfix">
                            <span class="ui_ico2 jian_ico ui_border fl jian_num"></span>
                            <input type="text" class="ui_ipttxt3 ui_color6 fl num" value="1" data-rel="10">
                            <span class="ui_ico2 jia_ico ui_border fl jia_num"></span>
                        </div>
                    </div>
                    
                    <div class="rc_r">
                        <div class="ui_max_f2 ui_color12">¥126</div>
                        <div class="ui_line_through ui_color6">¥320</div>
                        <div class="bk20"></div>
                        <a href="#" class="ui_color6">删除</a>
                    </div>
                </div>
            </div>
            
            <div class="tb ui_border_t ui_border_b ui_padding_lr20 clearfix">
                <span class="ui_color6 fl">共1件商品合计</span>
                <span class="ui_color4 fr">¥126金币</span>
            </div>
        </dl>
    </div>
    <div class="bk20"></div>
    
    <div class="ui_padding ui_background_white ui_text_c">
        <span class="ui_color6">总金额&ensp;<font class="ui_bold">¥126金币</font></span>
        <div class="bk20"></div>
        <center><input type="submit" value="结算" class="ui_iptbtn ui_color2" style="width:80%;"></center>
    </div>
    <div class="bk20"></div>
    
    <div class="ui_footh"></div>
    <div class="ui_nav ui_background_white ui_border_t ui_max_f1 clearfix">
        <ul>
            <li><a href="shop.html">首页</a></li>
            <li class="on"><a href="cart.html">购物车</a></li>
            <li><a href="wode.html">我的</a></li>
        </ul>
    </div>
</div>

<script type="text/javascript" src="/wawj/Public/js/jquery.min.js"></script>
<script type="text/javascript">
$(".ui_jiajian_c .jia_num").click(function(){
    num_val = parseInt($(this).parent().children(".num").val());
	max_num = parseInt($(this).parent().children(".num").attr("data-rel"));
    if (num_val < max_num) {
		num_val = num_val + 1;
	} else {
        alert("已到最大库存！");
    }
	$(this).parent().children(".num").val(num_val);
});
    
$(".ui_jiajian_c .jian_num").click(function(){
    num_val = parseInt($(this).parent().children(".num").val());
	max_num = parseInt($(this).parent().children(".num").attr("data-rel"));
    if (num_val<=0) {
		num_val = 0;
	} else {
		num_val = num_val - 1;
	}
	$(this).parent().children(".num").val(num_val);
});
</script>
</body>
</html>