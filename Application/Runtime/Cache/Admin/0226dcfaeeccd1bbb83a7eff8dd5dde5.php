<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/wawj/Public/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/wawj/Public/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/wawj/Public/Css/astyle.css" />
    <script type="text/javascript" src="/wawj/Public/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/wawj/Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/wawj/Public/Js/ckform.js"></script>
    <script type="text/javascript" src="/wawj/Public/Js/common.js"></script>

    <link href="/wawj/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/wawj/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src='/wawj/Public/Js/jquery-1.7.2.min.js'></script>
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
<form id="J_Form" action="<?php echo U('Rbac/adminAdd');?>" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10" >
        <tr>
            <td width="10%" class="tableleft">用户账号</td>
            <td>
                <input type='text' name='admin_name' data-rules="{required:true}" />
            </td>
        </tr>
        <tr>
            <td class="tableleft">密码</td>
            <td>
                <input type='password' id='p1' name='password1' data-rules="{minlength:6}"  />
            </td>
        </tr>
        <tr>
            <td class="tableleft">确认密码</td>
            <td>
                <input type='password' name='password' data-rules="{equalTo:'#p1'}" />
            </td>
        </tr>
        <tr>
            <td class="tableleft">所属角色</td>
            <td>
                <select name="role_id">
                    <option value="">请选择角色</option>
                    <?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
                </select>
                <!-- <span class="add-role">添加一个角色</span> -->
            </td>
        </tr>
        <tr id="last">
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript" src="/wawj/Public/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/wawj/Public/assets/js/bui-min.js"></script>
<script type="text/javascript" src="/wawj/Public/assets/js/config-min.js"></script>
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
            window.location.href="<?php echo U('Rbac/adminList');?>";
        });

    });
</script>
</body>
</html>