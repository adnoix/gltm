<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
 <head>
  <title>全域旅游后台管理</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="/gltm/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="/gltm/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="/gltm/Public/assets/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
          <span class="lp-title-port">全域旅游</span><span class="dl-title-text">后台管理</span>
        </a>
      </div>
    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($_SESSION['A_NAME']); ?></span><a href="<?php echo U('Admin/Index/noLogin');?>" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <ul id="J_Nav"  class="nav-list ks-clear">
        <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">旅游管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-order">附件管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-inventory">系统管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-supplier">用户管理</div></li>
      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="/gltm/Public/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="/gltm/Public/assets/js/bui.js"></script>
  <script type="text/javascript" src="/gltm/Public/assets/js/config.js"></script>

  <script>
    BUI.use('common/main',function(){
      var config = [{
          id:'spot',
          homePage : 'spot  List',
          menu:[{
              text:'景点管理',
              items:[
                  {id:'spotadd',text:'添加景点',href:"#"},
                  {id:'spotList',text:'景点列表',href:"#"},
              ]
            },{
              text:'线路管理',
              items:[
                  {id:'lineList',text:'线路列表',href:'#'},
              ]
            }]
          },{
            id:'attach',
            menu:[{
                text:'图片管理',
                items:[
                  {id:'imgList',text:'图片列表',href:'#'},
                ]
            }]
          },{
            id:'search',
            menu:[{
                    text : '地区管理',
                    items : [
                        {id:'Findlist',text:'地区管理',href:"/gltm/Area/AreaList"},
                    ]
                }]
          },{
            id:'User',
            homePage : 'userList',
            menu:[{
                text:'用户管理',
                items:[
                  {id:'userList',text:'用户列表',href:'/gltm/User/userList'},
                ]
              }]
          }];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>