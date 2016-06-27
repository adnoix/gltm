<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  	<title>Document</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/style.css" />
    <script type="text/javascript" src="/Public/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/js/ckform.js"></script>
    <script type="text/javascript" src="/Public/js/common.js"></script>
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
	<div class="form-inline definewidth m20"><button type="button" class="btn btn-success" id="addnew">新增用户</button></div>
	<table class="table table-bordered table-hover definewidth m10" >
		<thead>
		<tr>
			<th>用户名称</th> 
			<th>上一次登录时间</th> 
			<th>上一次登录ip</th> 
			<th>锁定状态</th> 
			<th>用户所属别组</th> 
			<th>操作</th> 
		</tr>
		</thead>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($v["admin_name"]); ?></td>
				<td><?php echo (date('Y-m-d H:i:s',$v["last_time"])); ?></td>
				<td><?php echo ($v["login_ip"]); ?></td>
				<td>
					<?php if($v["status"] == 2): ?>锁定
					<?php else: ?>
					未锁定<?php endif; ?>
				</td>
				<td>
					<?php if($v["admin_name"] == C("RBAC_SUPERADMIN")): ?>超级管理员
					<?php else: ?>
						<?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)<?php endif; ?>
				</td>
				<td>
				<?php if($v["admin_name"] == C("RBAC_SUPERADMIN")): ?><span style="color:red; font-weight:bold;">暂无权限操作</span>
				<?php else: ?>
					<?php if($v["status"] == 1): ?><a href="<?php echo U('Rbac/status',array('id'=>$v['id'],'status'=>$v['status']));?>">[锁定]</a>
					<?php else: ?>
						<a href="<?php echo U('Rbac/status',array('id'=>$v['id'],'status'=>$v['status']));?>">[启用]</a><?php endif; ?>
					<a href="<?php echo U('Rbac/adminEdit',array('id'=>$v['id'],'status'=>$v['status']));?>">[修改]</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
  	<script>
    $(function () {
        
		$('#addnew').click(function(){

				window.location.href="<?php echo U('Rbac/adminAdd');?>";
		 });


    });
	</script>
 </body>
</html>