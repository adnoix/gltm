<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<script type="text/javascript" src="/Public/js/jquery.js"></script>
		<link rel="stylesheet" href="/Public/css/public.css" />
	    <link rel="stylesheet" href="/Public/css/node.css" />
	
	</head>
	<body>
		 
		 <div id="wrap"> 
		 	<a href="<?php echo U('Rbac/nodeAdd');?>"  class="add-app">添加应用</a>
           
            <?php if(is_array($node)): foreach($node as $key=>$app): ?><div class="app">
            		<p>
            			<strong><?php echo ($app["title"]); ?></strong>
            			[<a href="<?php echo U('/Rbac/nodeAdd',array('pid'=>$app['id'], 'level'=> 2));?>">添加控制器</a>]
            			[<a href="<?php echo U('Admin/Rbac/nodeDel',array('pid'=>$app['id']));?>">删除</a>]
            		</p>

            		<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
            				<dt>
            					<strong><?php echo ($action["title"]); ?></strong>
            					[<a href="<?php echo U('/Rbac/nodeAdd',array('pid'=>$action['id'], 'level'=> 3));?>">添加方法</a>]
            				</dt>
            			</dl>
            			<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd>
            					<span><?php echo ($method["title"]); ?></span>
            				</dd><?php endforeach; endif; endforeach; endif; ?>
            	</div><?php endforeach; endif; ?>
		 </div>
	</body>
</html>