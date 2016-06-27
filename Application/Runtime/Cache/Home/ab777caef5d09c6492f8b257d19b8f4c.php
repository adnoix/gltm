<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>常规答题-伟业我爱我家</title>
<link href="/wawj/Public/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="/wawj/Public/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/wawj/Public/js/TouchSlide.1.1.js"></script>
</head>

<body>

<div class="wrap">
    <div class="dtbgb ui_dtbg">
        <div class="ui_cgdt_c ui_cgdt_c_pd" id="cgdt_c">
            <div class="bk40"></div>
            <div class="bk30"></div>
            <div class="tib ui_text_c ui_color15">常规答题</div>
            <div class="bk40"></div>
            <div class="bk40"></div>
            <div class="ui_padding_lr20">
                <div class="ui_dt_timeb ui_color2">
                    <span class="ui_ico time_ico"></span>
                    <span class="ui_ml10" id="Djs_id_1">
                    </span>
                </div>
            </div>
            <div class="bk20"></div>
            <div class="cnb clearfix">
                <dl class="clearfix" right-key="C">
                    <input type="hidden" class="dt_radio" value="">
                    <dd class="ui_color16">1、您对现在的工作环境满意么？</dd>
                    <ul>
                        <li data-id="A">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">满意</span>
                        </li>
                        <li data-id="B">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">不满意</span>
                        </li>
                        <li data-id="C">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">还可以</span>
                        </li>
                        <li data-id="D">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">其它</span>
                        </li>
                    </ul>
                </dl>
                
                <dl class="clearfix" right-key="A">
                    <input type="hidden" class="dt_radio" value="">
                    <dd class="ui_color16">2、您认为工作是否影响到您的健康状况？</dd>
                    <ul>
                        <li data-id="A">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">累趴了</span>
                        </li>
                        <li data-id="B">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">加班过劳死</span>
                        </li>
                        <li data-id="C">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">女汉子、精壮男</span>
                        </li>
                        <li data-id="D">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">偶尔腰酸背痛腿抽筋</span>
                        </li>
                    </ul>
                </dl>
                
                <dl class="clearfix" right-key="B">
                    <input type="hidden" class="dt_radio" value="">
                    <dd class="ui_color16">3、您每天花多少时间去公司？</dd>
                    <ul>
                        <li data-id="A">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">轻轻松松10分钟</span>
                        </li>
                        <li data-id="B">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">早睡早起好习惯、大约30分钟</span>
                        </li>
                        <li data-id="C">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">每天花费大约1小时</span>
                        </li>
                        <li data-id="D">
                            <span class="ui_ico radio_ico fl"></span>
                            <span class="ui_ml10 ui_color6 title">堵爆了、每天大约2小时在路上</span>
                        </li>
                    </ul>
                </dl>
            </div>
            <div class="bk40"></div>
            <div class="bk20"></div>
            <div class="ui_padding_lr20">
                <input type="submit" class="ui_max_f1 ui_color2 ui_dt_submit" onclick="DT_Submit();" value="提交">
            </div>
            <div class="bk40"></div>
            <div class="bk20"></div>
            <div class="bk40"></div>
            <div class="bk20"></div>
        </div>
    </div>
</div>

<div class="reveal-modal-bg"></div>
<!--答题超时-->
<a id="Alert_dtcs_b" data-reveal-id="Alert_dtcs_tip"></a>
<div id="Alert_dtcs_tip" class="reveal-modal">
    <div class="reveal-msgbox">
        <div class="ui_dt_alertb">
            <div class="ui_ico close_ico3 close_wz close-reveal-modal"></div>
            <div class="tip ui_max_f1">提示内容</div>
            <div class="btnb">
                <div class="bk20"></div>
                <center><a class="ui_dt_btn ui_max_f1 close-reveal-modal">确定</a></center>
                <div class="bk20"></div>
            </div>
        </div>
    </div>
</div>

<!--答题成功-->
<a id="Alert_dtcg_b" data-reveal-id="Alert_dtcg_tip"></a>
<div id="Alert_dtcg_tip" class="reveal-modal">
    <div class="reveal-msgbox">
        <div class="ui_dt_alertb">
            <div class="ui_ico close_ico3 close_wz close-reveal-modal"></div>
            <div class="tip ui_max_f1">提示内容</div>
            <div class="btnb">
                <div class="bk20"></div>
                <center><a class="ui_dt_btn ui_max_f1 close-reveal-modal">确定</a></center>
                <div class="bk20"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/wawj/Public/js/jquery.min.js"></script>
<script type="text/javascript">
var dtcs = false;
var dtyw = false;
    
//答题倒计时
function count_down(obj,o){
    var www_qsyz_net=/^[\d]{4}-[\d]{1,2}-[\d]{1,2}( [\d]{1,2}:[\d]{1,2}(:[\d]{1,2})?)?$/ig,str='',conn,s;
    if(!o.match(www_qsyz_net)){
        alert('参数格式为2012-01-01[ 01:01[:01]].\r其中[]内的内容可省略');
        return false;
    }
    var sec = (new Date(o.replace(/-/ig,'/')).getTime() - new Date().getTime())/1000;
    if(sec > 0 && dtcs == false && dtyw == false){
        conn='剩余时间';
        day = Math.floor(sec/24/3600);
        if (Math.floor((sec/3600)%24)<10) {
            hh = '0'+Math.floor((sec/3600)%24);
        } else {
            hh = Math.floor((sec/3600)%24);
        }
        if (Math.floor((sec/60)%60)<10) {
            mm = '0'+Math.floor((sec/60)%60);
        } else {
            mm = Math.floor((sec/60)%60);
        }
        if (Math.floor(sec%60)<10) {
            ss = '0'+Math.floor(sec%60);
        } else {
            ss = Math.floor(sec%60);
        }
        time = hh + ':' + mm + ':' + ss;
        str += '<span class="time">' + time + '</span>';
        document.getElementById(obj).innerHTML = conn +' ' + str + '';
        setTimeout(function(){ count_down(obj,o) },1000);
    }else{
        conn='剩余时间 00:00:00';
        sec*=-1;
        if (dtyw == true) {
        } else {
            dtcs = true;
            $("#Alert_dtcs_tip .tip").html("<b>很遗憾</b><br>超时答题 未获得金币");
        }
        document.getElementById(obj).innerHTML = conn;
        
        dtcs_msgbox();  //答题超时弹框
    }
}
    
//时间格式化
Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

var d = new Date();
var t = d.getTime();
t += 60*60*1000;    //定义一小时过期
d = new Date(t).Format("yyyy-MM-dd hh:mm:ss");
js_datetime = d;
count_down('Djs_id_1',js_datetime);
</script>


<script type="text/javascript">
    dtbgb_h = $(".dtbgb").height();
    window_h = $(window).height();
    if (dtbgb_h<window_h) {
        $(".dtbgb").css("height",window_h+"px");
    }
    
    //答题超时
    function dtcs_msgbox() {
        
        $("#Alert_dtcs_b").trigger('click');
        // 关闭弹框
        //$(".close-reveal-modal").trigger('click');
    }
    
    //答题成功
    function dtcg_msgbox() {
        $("#Alert_dtcg_b").trigger('click');
        // 关闭弹框
        //$(".close-reveal-modal").trigger('click');
    }
    
    //答题选择
    $("#cgdt_c .cnb dl ul li").click(function(){
        dataid = $(this).attr("data-id");
        $(this).parent().parent().children(".dt_radio").val(dataid);
        $(this).addClass("on");
        $(this).siblings().removeClass("on");
    });
    
    //答题提交
    function DT_Submit() {
        if (dtcs || dtyw) {
            dtcs_msgbox();
        } else {
            qbzq = true;   //全部正确
            tm_num = $("#cgdt_c dl").length;
            for (i=0;i<tm_num;i++) {
                dq_dt_radio = $("#cgdt_c dl").eq(i).children(".dt_radio").val();
                dq_zqda = $("#cgdt_c dl").eq(i).attr("right-key");
                if (dq_dt_radio != dq_zqda) {
                    qbzq = false;
                }
                
                tm_xx_num = $("#cgdt_c dl").eq(i).find("li").length;
                for(j=0;j<tm_xx_num;j++) {
                    dq_xx_da = $("#cgdt_c dl").eq(i).find("li").eq(j).attr("data-id");
                    if (dq_xx_da == dq_zqda) {
                       $("#cgdt_c dl").eq(i).find("li").eq(j).children(".title").addClass("ui_color15"); 
                    }
                }
            }
            
            if (qbzq) { //全部正确
                $("#Alert_dtcg_tip .tip").html("<b>恭喜您获得10金币</b><br>感谢您的参与");
                dtcg_msgbox();
            } else {
                //设置结束答题
                dtyw = true;
                document.getElementById("Djs_id_1").innerHTML = "剩余时间 00:00:00";
                $("#Alert_dtcs_tip .tip").html("<b>很遗憾</b><br>答题有误 未获得金币");
            }
            
        }
    }
    
</script>
<!--提示框-->
<script type="text/javascript" src="/wawj/Public/js/jquery.reveal.js"></script>
</body>
</html>