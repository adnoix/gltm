<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title> 详情页</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/gltm/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/gltm/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="/gltm/Public/assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
    <div class="detail-page">

            <div id="grid"></div>
            </div>
    </div>
</div>
<script type="text/javascript" src="/gltm/Public/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/gltm/Public/assets/js/bui-min.js"></script>

<script type="text/javascript" src="/gltm/Public/assets/js/config-min.js"></script>
<script type="text/javascript">
    BUI.use('common/page',function(){


    });


</script>

<script type="text/javascript">
    BUI.use('bui/grid',function (Grid) {
        var data = [<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>{id:"<?php echo ($vo["uid"]); ?>",name:"<?php echo ($vo["user_name"]); ?>",phone:"<?php echo ($vo["user_phone"]); ?>",email:"<?php echo ($vo["user_email"]); ?>",ctime:"<?php echo ($vo["user_ctime"]); ?>"}<?php endforeach; endif; else: echo "" ;endif; ?>
                    ],

                grid = new Grid.SimpleGrid({
                    render : '#grid', //显示Grid到此处
                    width : 950,      //设置宽度
                    columns : [
                        {title:'编号',dataIndex:'id',width:80},
                        {title:'姓名',dataIndex:'name',width:100},
                        {title:'手机号',dataIndex:'phone',width:100,renderer:Grid.Format.dateRenderer},
                        {title:'邮箱',dataIndex:'email',width:300},
                        {title:'注册时间',dataIndex:'ctime',width:300}
                    ]
                });
        grid.render();
        grid.showData(data);
    });
    //此处实现 js 代码
</script>

</body>
</html>