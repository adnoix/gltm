<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  <title>Document</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/astyle.css" />
    <script type="text/javascript" src="/Public/js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/js/ckform.js"></script>
    <script type="text/javascript" src="/Public/js/common.js"></script>

    <link href="/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src='/Public/js/jquery-1.7.2.min.js'></script>
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
        .add-role{
        display:inline-block;
        width:100px;
        height:26px;
        line-height:26px;
        text-align:center;
        border:1px solid blue;
        border-radius:4px;
        margin-left:20px;
        cursor:pointer;
      }
    </style>
    <script type="text/javascript">
      $(function()
        {
        
          $('.add-role').click(function()
            {
              var obj = $(this).parents('tr').clone();
              obj.find('.add-role').remove();
              $('#last').before(obj);
          
            });
        })
    </script>
	</head>
	<body>
	<form id="J_Form" action="<?php echo U('Rbac/nodeAdd');?>" method="post" class="definewidth m20">
		 <table class="table table-bordered table-hover definewidth m10" >
			<tr>
		 		<td class="tableleft"><?php echo ($type); ?>名称</td>
		 		<td>
		 			<input type="text" name='name' data-rules="{required:true}"/>
		 		</td>
		 	</tr>
			<tr>
		 		<td class="tableleft" ><?php echo ($type); ?>描述</td>
		 		<td>
		 			<input type="text" name='title' data-rules="{required:true}"/>
		 		</td>
		 	</tr>
		 	<tr>
		 		<td class="tableleft" >是否开启</td> 
		 		<td>
		 			<input type="radio" name='status' value="1" checked="checked" />&nbsp;开启&nbsp;
		 			<input type="radio" name='status' value="0" />&nbsp;关闭
		 		</td>
		 	</tr>
		 	<tr>
		 		<td class="tableleft" >排序</td>
		 		<td><input type="text" name='sort' value="1" data-rules="{required:true}"/></td>
		 	</tr>
     		<tr id="last">
	          <td class="tableleft"></td>
	          <td>
	          	  <input type="hidden" name="pid" value='<?php echo ($pid); ?>'/>
		 		  <input type="hidden" name="level" value='<?php echo ($level); ?>'/>
	              <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
	          </td>
	        </tr>
		 </table>
	</form>
	<script type="text/javascript" src="/Public/assets/js/jquery.js"></script>
	  <script type="text/javascript" src="/Public/assets/js/bui-min.js"></script>
	  <script type="text/javascript" src="/Public/assets/js/config-min.js"></script>
	  <script type="text/javascript">
	  BUI.use('bui/form',function (Form) {
	    new Form.Form({
	      srcNode : '#J_Form'
	    }).render();
	  });
	</script>
	</body>
	</html>
	<script>
	    $(function () {
	        $('#backid').click(function(){
	                window.location.href="<?php echo U('Rbac/nodeList');?>";
	         });

	    });
	</script>
	</body>
</html>