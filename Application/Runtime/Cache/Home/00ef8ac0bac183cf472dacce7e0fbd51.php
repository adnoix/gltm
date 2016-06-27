<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>抽奖-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/jquery.js"></script>
<script type="text/javascript">
    function cj(){
        var div = $("#div").val();
        //alert(div);
        $.ajax({
            //url:"http://localhost/hui/trunk/index.php?s=/Home/Choujiang/cjjb",
            url:"/wawj/index.php/Home/Choujiang/cjjb",
            async:"ture",
            success:function (e){
                $("div").html(); 
            }
        });
    }
</script>
<script type="text/javascript" src="/wawj/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="/wawj/Public/js/awardRotate.js"></script>
<script type="text/javascript">
var cjkyjb = 100; //可用抽奖金币
var cjxgjb = 20; //抽奖消费金币
    
var turnplate={
    restaraunts:[],				//大转盘奖品名称
    colors:[],					//大转盘奖品区块对应背景颜色
    outsideRadius:192,			//大转盘外圆的半径
    textRadius:155,				//大转盘奖品位置距离圆心的距离
    insideRadius:68,			//大转盘内圆的半径
    startAngle:0,				//开始角度

    bRotate:false				//false:停止;ture:旋转
};

$(document).ready(function(){
	//动态添加大转盘的奖品与奖品区域背景颜色
	turnplate.restaraunts = ["谢谢参与", "10个金币", "15个金币", "1个钻石", "谢谢参与", "1个金币", "5个金币", "10个金币"];
	turnplate.colors = ["#f5aa26", "#f7e098", "#f5aa26", "#f7e098","#f5aa26", "#f7e098", "#f5aa26", "#f7e098"];
	var rotateTimeOut = function (){
		$('#wheelcanvas').rotate({
			angle:0,
			animateTo:2160,
			duration:8000,
			callback:function (){
				alert('网络超时，请检查您的网络设置！');
			}
		});
	};

	//旋转转盘 item:奖品位置; txt：提示语;
	var rotateFn = function (item, txt){
		var angles = item * (360 / turnplate.restaraunts.length) - (360 / (turnplate.restaraunts.length*2));
		if(angles<270){
			angles = 270 - angles; 
		}else{
			angles = 360 - angles + 270;
		}
		$('#wheelcanvas').stopRotate();
		$('#wheelcanvas').rotate({
			angle:0,
			animateTo:angles+1800,
			duration:8000,
			callback:function (){
                switch(txt) {
                    case "谢谢参与":
                        $("#Alert_cjwz_tip .tip").html("没有中奖谢谢参与");
                        cjwz_msgbox();
                        break;
                    case "1个金币":
                        cjkyjb = cjkyjb + 1;   //可有金币增加
                        $("#Alert_cjcz_tip .tip").html("恭喜您抽中"+txt);
                        cjcz_msgbox();
                        break;    
                    case "5个金币":
                        cjkyjb = cjkyjb + 5;   //可有金币增加
                        $("#Alert_cjcz_tip .tip").html("恭喜您抽中"+txt);
                        cjcz_msgbox();
                        break;    
                    case "10个金币":
                        cjkyjb = cjkyjb + 10;   //可有金币增加
                        $("#Alert_cjcz_tip .tip").html("恭喜您抽中"+txt);
                        cjcz_msgbox();
                        break;
                    case "15个金币":
                        cjkyjb = cjkyjb + 15;   //可有金币增加
                        $("#Alert_cjcz_tip .tip").html("恭喜您抽中"+txt);
                        cjcz_msgbox();
                        break;    
                    case "1个钻石":
                        $("#Alert_cjczzs_tip .tip").html("恭喜您抽中"+txt);
                        cjczzs_msgbox();
                        break;
                }
                
				turnplate.bRotate = !turnplate.bRotate;
			}
		});
	};

	$('.pointer').click(function (){
        if (cjkyjb >= cjxgjb) { 
        //判断抽奖金币
            cjkyjb = cjkyjb - cjxgjb;
        } else {    
        //弹出抽奖金币不足
            $("#Alert_cjwz_tip .tip").html("金币不足<br>请赚取金币再来参与");
            cjwz_msgbox();
            return false;
        }
        
		if(turnplate.bRotate)return;
		turnplate.bRotate = !turnplate.bRotate;
		//获取随机数(奖品个数范围内)
		var item = rnd(1,turnplate.restaraunts.length);
		//奖品数量等于10,指针落在对应奖品区域的中心角度[252, 216, 180, 144, 108, 72, 36, 360, 324, 288]
		rotateFn(item, turnplate.restaraunts[item-1]);
		/* switch (item) {
			case 1:
				rotateFn(252, turnplate.restaraunts[0]);
				break;
			case 2:
				rotateFn(216, turnplate.restaraunts[1]);
				break;
			case 3:
				rotateFn(180, turnplate.restaraunts[2]);
				break;
			case 4:
				rotateFn(144, turnplate.restaraunts[3]);
				break;
			case 5:
				rotateFn(108, turnplate.restaraunts[4]);
				break;
			case 6:
				rotateFn(72, turnplate.restaraunts[5]);
				break;
			case 7:
				rotateFn(36, turnplate.restaraunts[6]);
				break;
			case 8:
				rotateFn(360, turnplate.restaraunts[7]);
				break;
			case 9:
				rotateFn(324, turnplate.restaraunts[8]);
				break;
			case 10:
				rotateFn(288, turnplate.restaraunts[9]);
				break;
		} */
		console.log(item);
	});
});

function rnd(n, m){
	var random = Math.floor(Math.random()*(m-n+1)+n);
	return random;
	
}


//页面所有元素加载完毕后执行drawRouletteWheel()方法对转盘进行渲染
window.onload=function(){
	drawRouletteWheel();
};

function drawRouletteWheel() {    
  var canvas = document.getElementById("wheelcanvas");    
  if (canvas.getContext) {
	  //根据奖品个数计算圆周角度
	  var arc = Math.PI / (turnplate.restaraunts.length/2);
	  var ctx = canvas.getContext("2d");
	  //在给定矩形内清空一个矩形
	  ctx.clearRect(0,0,422,422);
	  //strokeStyle 属性设置或返回用于笔触的颜色、渐变或模式  
	  ctx.strokeStyle = "#f39800";
	  //font 属性设置或返回画布上文本内容的当前字体属性
	  ctx.font = '22px Microsoft YaHei';      
	  for(var i = 0; i < turnplate.restaraunts.length; i++) {       
		  var angle = turnplate.startAngle + i * arc;
		  ctx.fillStyle = turnplate.colors[i];
		  ctx.beginPath();
		  //arc(x,y,r,起始角,结束角,绘制方向) 方法创建弧/曲线（用于创建圆或部分圆）    
		  ctx.arc(211, 211, turnplate.outsideRadius, angle, angle + arc, false);    
		  ctx.arc(211, 211, turnplate.insideRadius, angle + arc, angle, true);
		  ctx.stroke();  
		  ctx.fill();
		  //锁画布(为了保存之前的画布状态)
		  ctx.save();   
		  
		  //----绘制奖品开始----
		  ctx.fillStyle = "#E5302F";
		  var text = turnplate.restaraunts[i];
		  var line_height = 24;
		  //translate方法重新映射画布上的 (0,0) 位置
		  ctx.translate(211 + Math.cos(angle + arc / 2) * turnplate.textRadius, 211 + Math.sin(angle + arc / 2) * turnplate.textRadius);
		  
		  //rotate方法旋转当前的绘图
		  ctx.rotate(angle + arc / 2 + Math.PI / 2);
		  
		  /** 下面代码根据奖品类型、奖品名称长度渲染不同效果，如字体、颜色、图片效果。(具体根据实际情况改变) **/
		  if(text.indexOf("个")>0){
            //流量包
			  var texts = text.split("个");
			  for(var j = 0; j<texts.length; j++){
				  ctx.font = j == 0?'bold 24px Microsoft YaHei':'bold 22px Microsoft YaHei';
				  if(j == 0){
					  ctx.fillText(texts[j]+"个", -ctx.measureText(texts[j]+"个").width / 2, j * line_height);
				  }else{
					  ctx.fillText(texts[j], -ctx.measureText(texts[j]).width / 2, j * line_height);
				  }
			  }
		  }else if(text.indexOf("个") == -1 && text.length>6){
          //奖品名称长度超过一定范围 
			  text = text.substring(0,6)+"||"+text.substring(6);
			  var texts = text.split("||");
			  for(var j = 0; j<texts.length; j++){
				  ctx.fillText(texts[j], -ctx.measureText(texts[j]).width / 2, j * line_height);
			  }
		  }else{
			  //在画布上绘制填色的文本。文本的默认颜色是黑色
			  //measureText()方法返回包含一个对象，该对象包含以像素计的指定字体宽度
			  ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
		  }
		  
		  //添加对应图标
		  if(text.indexOf("金币")>0){
			  var img= document.getElementById("shan-img");
			  img.onload=function(){  
				  ctx.drawImage(img,-15,10);      
			  }; 
			  ctx.drawImage(img,-15,10);  
		  }else if(text.indexOf("谢谢参与")>=0){
			  /*var img= document.getElementById("sorry-img");
			  img.onload=function(){  
				  ctx.drawImage(img,-15,10);      
			  };  
			  ctx.drawImage(img,-15,10);*/  
		  }
		  //把当前画布返回（调整）到上一个save()状态之前 
		  ctx.restore();
		  //----绘制奖品结束----
	  }     
  } 
}
</script>
</head>

<body>

<div class="wrap">
    <div class="ui_cjjl_c2">
        <img src="/wawj/Public/img/cj_pic.png" class="ui_block">
        <div class="cnb">
            <img src="/wawj/Public/img/1.png" id="shan-img" style="display:none;" />
            <img src="/wawj/Public/img/2.png" id="sorry-img" style="display:none;" />
            <div class="banner">
                <div class="turnplate">
                    <canvas class="item" id="wheelcanvas" width="422px" height="422px"></canvas>
                    <img class="pointer" src="/wawj/Public/img/turnplate-pointer.png" onclick="cj()"/>
                </div>
            </div>
            <div class="bk20"></div>
            <div class="ui_padding_lr20">
                    <div class="tib ui_color2 ui_min_f1 ui_text_c" id="div">您有<?php echo $array[0]['home_money_gold'];?>金币，每次抽奖需消耗<?php echo $xhb[0]['home_ldsz_consume'];?>金币</div>
                    
            </div>
            
            <div class="bk40"></div>
            <div class="bk40"></div>
        </div>
        
        <div class="bk40"></div>
        <div class="ui_padding_lr30">
            <div class="cnb2 ui_padding">
                <div class="ui_ico9 cj_ico wz_c1"></div>
                <div class="ui_ico9 cj_ico2 wz_c2"></div>
                <div class="btnb ui_color2 ui_max_f1">中奖记录</div>
                <div class="bk40"></div>
                <div class="bk20"></div>
                <div class="ui_cjlist" id="marqueebox1" style="height:200px; overflow:hidden" >
                    <?php if(is_array($arr)): foreach($arr as $key=>$vo): ?><dl class="clearfix">
                            <span class="fl"><?php echo ($vo["home_user_name"]); ?></span>
                            <span class="fr ui_color17"><?php echo ($vo["home_ld_winning"]); ?></span>
                        </dl><?php endforeach; endif; ?>
                </div>
                <div class="bk40"></div>
            </div>
        </div>
        <div class="bk40"></div>
        <div class="bk40"></div>
        <div class="bk20"></div>
    </div>
    
    <div class="bk20"></div>
    <div class="ui_cjjl_c3 ui_padding">
        <div class="tib ui_text_c ui_color2">抽奖规则</div>
        <div class="bk20"></div>
        <div class="cnb ui_min_f1 ui_color2">
        <p>1、每次抽奖消耗<?php echo $xhb[0]['home_ldsz_consume'];?>金币</p>
        <p>2、活动期间，每位用户不限抽奖次数。</p>
        <p>3、活动时间：
            <?php  $date_time_array = getdate($date[0]['home_ld_startactivity']); $month = $date_time_array["mon"]; $day = $date_time_array["mday"]; $year = $date_time_array["year"]; $date_time_array = getdate($date[0]['home_ld_endactivity']); $month2 = $date_time_array["mon"]; $day2 = $date_time_array["mday"]; $year2 = $date_time_array["year"]; echo "$year-$month-$day\n~$year2-$month2-$day2\n";?></p>
                <p>4、中奖用户抽中积分或金币、可以在我的账户中查看记录</p>
        </div>
        <div class="bk40"></div>
        <center>
            <a href="/wawj/index.php/Home/Choujiang/cjjl" class="ui_cj_btn ui_color17">历史记录</a>
        </center>
        <div class="bk40"></div>
    </div>
</div>

<div class="reveal-modal-bg"></div>
<!--抽奖未中、没有可抽奖金币-->
<a id="Alert_cjwz_b" data-reveal-id="Alert_cjwz_tip"></a>
<div id="Alert_cjwz_tip" class="reveal-modal" style="top:40px;">
    <div class="reveal-msgbox">
        <div class="ui_cj_alertb">
            <div class="cnb cnb_wz_bg tip ui_text_c ui_max_f1 ui_color2">
                提示内容
            </div>
            <div class="btn_b ui_padding clearfix">
                <ul>
                    <li><a class="close-reveal-modal" href="/wawj/index.php/Home/Choujiang/index">确定</a></li>
                    <li><a class="close-reveal-modal" href="javascript:void(0);">再玩一次</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--抽奖中奖非钻石-->
<a id="Alert_cjcz_b" data-reveal-id="Alert_cjcz_tip"></a>
<div id="Alert_cjcz_tip" class="reveal-modal" style="top:40px;">
    <div class="reveal-msgbox">
        <div class="ui_cj_alertb">
            <div class="cnb cnb_zj_bg tip ui_text_c ui_max_f1 ui_color2">
                提示内容
            </div>
            <div class="btn_b ui_padding clearfix">
                <ul>
                    <li><a class="close-reveal-modal" href="javascript:void(0);">确定</a></li>
                    <li><a class="close-reveal-modal" href="javascript:void(0);">再玩一次</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--抽奖中奖钻石-->
<a id="Alert_cjczzs_b" data-reveal-id="Alert_cjczzs_tip"></a>
<div id="Alert_cjczzs_tip" class="reveal-modal" style="top:40px;">
    <div class="reveal-msgbox">
        <div class="ui_cj_alertb">
            <div class="cnb cnb_zjzs_bg tip ui_text_c ui_max_f1 ui_color2">
                提示内容
            </div>
            <div class="btn_b ui_padding clearfix">
                <ul>
                    <li><a class="close-reveal-modal" href="javascript:void(0);">确定</a></li>
                    <li><a class="close-reveal-modal" href="javascript:void(0);">再玩一次</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //抽奖未中、没有可抽奖金币
    function cjwz_msgbox() {
        
        $("#Alert_cjwz_b").trigger('click');
        // 关闭弹框
        //$(".close-reveal-modal").trigger('click');
    }
    
    //抽奖中奖非钻石
    function cjcz_msgbox() {
        $("#Alert_cjcz_b").trigger('click');
        // 关闭弹框
        //$(".close-reveal-modal").trigger('click');
    }
    
    //抽奖中奖钻石
    function cjczzs_msgbox() {
        $("#Alert_cjczzs_b").trigger('click');
        // 关闭弹框
        //$(".close-reveal-modal").trigger('click');
    }
</script>
<!--提示框-->
<script type="text/javascript" src="/wawj/Public/js/jquery.reveal.js"></script>

<script type="text/javascript">
    //中奖记录滚动
    function startmarquee(lh,speed,delay,index){
        var t;
        var p=false;
        var o=document.getElementById("marqueebox"+index);
        o.innerHTML+=o.innerHTML;
        o.onmouseover=function(){p=true}
        o.onmouseout=function(){p=false}
        o.scrollTop = 0;
        function start(){
            t=setInterval(scrolling,speed);
            if(!p){ o.scrollTop += 1;}
        }
        function scrolling(){
        if(o.scrollTop%lh!=0){
            o.scrollTop += 1;
            if(o.scrollTop>=o.scrollHeight/2) o.scrollTop = 0;
            }else{
                clearInterval(t);
                setTimeout(start,delay);
            }
        }
        setTimeout(start,delay);
    }
    startmarquee(25,40,0,1);
</script>

</body>
</html>