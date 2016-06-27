<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/astyle.css" />
    <script type="text/javascript" src="/Public/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Js/common.js"></script>

    <link href="/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
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
<form id="J_Form" action="<?php echo U('Rbac/roleAdd');?>" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10" >
        <tr>
            <td width="10%" class="tableleft">角色名称</td>
            <td>
                <input type='text' name='name' data-rules="{required:true}" />
            </td>
        </tr>
        <tr>
            <td class="tableleft">角色描述</td>
            <td>
                <input type='text' name='remark' data-rules="{required:true}" />
            </td>
        </tr>

        <tr>
            <td class="tableleft">是否开启</td>
            <td>
                <input type="radio" name='status' value="1" checked="cheched" />&nbsp;开启&nbsp;
                <input type="radio" name='status' value="0" />&nbsp;关闭
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
<script type="text/javascript" src="/Public/assets/js/jquery-1.8.1.min.js"></script>
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
            window.location.href="<?php echo U('Rbac/roleList');?>";
        });

    });
</script>
</body>
</html>