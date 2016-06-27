<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  	<title>Document</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/style.css" />
    <script type="text/javascript" src="/Public/Js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/Css/page.css" />
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
 </head>
 <body>
	<div class="form-inline definewidth m20"><button type="button" class="btn btn-success" id="addnew">新增角色</button></div>
	<table class="table table-bordered table-hover definewidth m10" >
		<thead>
		<tr>
			<th>角色名称</th> 
			<th>角色描述</th>  
			<th>状态</th>  
			<th>操作</th> 
		</tr>
		</thead>
		<?php if(is_array($role)): foreach($role as $key=>$v): ?><tr>
				<td><?php echo ($v["name"]); ?></td>
				<td><?php echo ($v["remark"]); ?></td>
				<td>
					<?php if($v["status"]): ?>开启
					<?php else: ?>
						关闭<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo U('Rbac/access',array('rid'=>$v['id']));?>">[配置权限]</a>
					<?php if($v['status'] == 1): ?><a href="<?php echo U('Rbac/roleLock',array('rid'=>$v['id'],'status'=>$v['status']));?>">[锁定]</a>
					<?php else: ?>
						<a href="<?php echo U('Rbac/roleLock',array('rid'=>$v['id'],'status'=>$v['status']));?>">[启用]</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
	</table>
  	<script>
    $(function () {
		$('#addnew').click(function(){
				window.location.href="<?php echo U('Rbac/roleAdd');?>";
		 });


    });
	</script>
 </body>
</html>