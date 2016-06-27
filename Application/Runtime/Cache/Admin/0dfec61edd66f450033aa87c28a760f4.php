<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>后台管理系统</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/gltm/Public/login/bootstrap.css" />
<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}

.form-signin {
	max-width: 300px;
	padding: 19px 29px 29px;
	margin: 0 auto 20px;
	background-color: #fff;
	border: 1px solid #e5e5e5;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
}

.form-signin .form-signin-heading, .form-signin .checkbox {
	margin-bottom: 10px;
}

.form-signin input[type="text"], .form-signin input[type="password"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 15px;
	padding: 7px 9px;
    width: 92%;
}
</style>
</head>
<body>
	<div class="container">
		<form class="form-signin" method="post" id="fm" action="<?php echo U('Login/login');?>">
			<h2 class="form-signin-heading">登录后台系统</h2>
			<input type="text" id="admin_name" name="user_name" class="input-block-level" placeholder="账号">
            <input type="password" id="admin_pass" name="phone_mm" class="input-block-level" placeholder="密码">
			<p style="text-align: right; margin-right: 25px;">
                <input type="submit" style="margin-left: 0px" id="login" name="login" class="btn btn-large btn-primary" type="submit" value="登录">
			</p>
		</form>
	</div>
</body>
</html>