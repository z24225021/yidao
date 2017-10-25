<?php if (!defined('THINK_PATH')) exit();?> <!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>河南一道科技后台管理系统</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/lib/bootstrap/css/datetimepicker.css">
    <link rel="stylesheet" href="/yidao/Public/Admin/lib/font-awesome/css/font-awesome.css">

    <script src="/yidao/Public/Admin/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="/yidao/Public/Admin/lib/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/yidao/Public/Admin/lib/bootstrap/js/bootstrap-datetimepicker.zh-CN.js"></script>
  

	<link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/stylesheets/premium.css">
    <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/static/css/admin.css">
    
    <!-- 富文本框样式 -->
    <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/dist/css/wangEditor.min.css">
    <!-- 分页样式    -->
    <link href="/yidao/Public/static/css/pagination.css" rel="stylesheet" type="text/css">
    
    <style type="text/css">
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        	font-family: "黑体";
        }
    </style>
	
</head>
<body class="theme-blue">

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> 河南一道科技后台管理系统</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?php echo S('admin')['username'];?>
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="./">个人中心</a></li>
                <li><a tabindex="-1" href="./">登录信息</a></li>
               <!--  <li class="divider"></li> 
   				<li >Admin Panel</li>
                <li><a href="./">Users</a></li> 
                <li><a href="./">Security</a></li>
                -->
                <li class="divider"></li>
                <li><a tabindex="-1" href="<?php echo U('logout');?>">退出</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>

    <div class="sidebar-nav">
		<ul id="pmenu">
		<input type="hidden" id="menu_ul" value="<?php echo U('cMenu');?>">
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="javascript:;" onclick="getChildMenu(<?php echo ($vo["id"]); ?>)" class="nav-header" ><i class="fa fa-fw fa-dashboard"></i> <?php echo ($vo["name"]); ?></a></li>
				 <li><ul id="menu<?php echo ($vo["id"]); ?>" name="cmenu" class="menu<?php echo ($vo["id"]); ?>  nav nav-list collapse in">
				     </ul>
				 </li><?php endforeach; endif; else: echo "" ;endif; ?> 
        <li><a href="help"  class="nav-header" ><i class="fa fa-fw fa-dashboard"></i> 帮助</a></li>
        <li><a href="<?php echo U('test');?>"  class="nav-header" ><i class="fa fa-fw fa-dashboard"></i> 测试</a></li>
    	</ul>
    </div>
    <div class="content">
        <div class="header">
            <!-- <div class="stats">
	    <p class="stat"><span class="label label-info">5</span> Tickets</p>
	    <p class="stat"><span class="label label-success">27</span> Tasks</p>
	    <p class="stat"><span class="label label-danger">15</span> Overdue</p>
	</div> -->
	<div id="search_header" class="input-group search pull-right hidden-sm hidden-xs">
            <div class="input-group">
              <input type="text" id="search" class="form-control">
              <span class="input-group-btn">
                  <button class="btn btn-primary" id=searchbtn type="button"><i class="fa fa-search "></i></button>
              </span>
            </div>
    </div>
 <script type="text/javascript">

 function getChildMenu(pid){
 		$("ul[name='cmenu']").removeClass("in");
 		if($("#menu"+pid).has("li").length == 0){
 			var url = $('#menu_ul').val();
	 		$.ajax({
	              type:'get',
	              url:url,
	              data:{pid:pid},
	              dataType:'json',
	              success:function(data){
	            	  $("#menu"+pid).html("");
	            	  $.each(data.msg, function(i, item) {
	            			var APP = "/yidao/index.php";
	                    	$("#menu"+item.pid).append(
	                    		  "<li><a href='"+APP+"/Admin/Index/"+item.url+"?pid="+pid+"'><span class='fa fa-caret-right'></span> "+item.name+"</a></li>");
	                  });
	              },
	            }); 
 		}
 		$("#menu"+pid).addClass("in");
 }
 getChildMenu("<?php echo ($menupid); ?>");
 
$(function(){
	 function show(){
	    
	 }
	 setInterval(show,3000);// 注意函数名没有引号和括弧！ 
	 // 使用setInterval("show()",3000);会报“缺少对象” 
});
 
 </script>

 
<div class="btn-toolbar list-toolbar">
    <button class="btn btn-primary"> <?php echo ($title); ?></button>
</div>
<div style="height:600px">
<table class="table" >
  <thead>
    <tr>
      <th>序号</th>
      <th>标题</th>
      <th>内容简介</th>
      <th>作者</th>
      <th>前台显示</th>
      <th>时间</th>
      <th style="width: 3.5em;">操作</th>
    </tr>
  </thead>
  <tbody>
  
  <?php if(is_array($news)): $k = 0; $__LIST__ = array_slice($news,0,10,true);if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
      <td><?php echo ($k); ?></td>
      <td><?php echo ($vo['title']); ?></td>
      <td><?php echo ($vo['subtitle']); ?></td>
      <td><?php echo ($vo['author']); ?></td>
      <td> <?php if(($vo['state'] == 0)): ?>显示<?php endif; ?> 
		  <?php if(($vo['state'] == 1)): ?>不显示<?php endif; ?> </td>
      <td><?php echo ($vo['creat_time']); ?></td>
      <td>
          <a href="<?php echo U('nedit',array('nid'=>$vo['id']));?>"><i class="fa fa-pencil"></i></a>
          <a href="<?php echo U('ndelete',array('nid'=>$vo['id']));?>" onclick="return del()" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
      </td>
    </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
  </tbody>
</table>
</div>
<div class="view_center">
	<div class="pagination" ><?php echo ($page); ?></div>
</div>



        </div>
    </div>
<footer>
	<hr>
	<p class="pull-right">
		Collect from <a href="#" title="一道科技"
			target="_blank">河南一道科技有限公司</a>
	</p>
	<p>
		© 2017 <a href="#" target="_blank">wei1co</a>
	</p>
</footer>

<script src="/yidao/Public/Admin/lib/bootstrap/js/bootstrap.js"></script>
<script src="/yidao/Public/yidao/js/mydate.js"></script>


<!--  富文本js   -->
	<script type="text/javascript" src="/yidao/Public/Admin/dist/js/lib/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/yidao/Public/Admin/dist/js/wangEditor.js"></script>
    <script type="text/javascript" src="/yidao/Public/Admin/dist/js/wUpload.js"></script>
    
    <script type="text/javascript">
         // 阻止输出log
        // wangEditor.config.printLog = false;

        var editor = new wangEditor('editor-trigger');

        // 上传图片
        editor.config.uploadImgUrl = '<?php echo U("upload");?>';
        editor.config.uploadParams = {
            // token1: 'abcde',
             token2: '12345'
        };
        editor.config.uploadHeaders = {
            'Accept' : 'text/x-json'
        }
        // editor.config.uploadImgFileName = 'myFileName';

        // 隐藏网络图片
        // editor.config.hideLinkImg = true;

        // 表情显示项
        editor.config.emotionsShow = 'value';
        editor.config.emotions = {
            'default': {
                title: '默认',
                data: '/yidao/Public/Admin/dist/emotions.data'
            }
        };

        // 插入代码时的默认语言
        // editor.config.codeDefaultLang = 'html'

        // 只粘贴纯文本
        // editor.config.pasteText = true;

        // 跨域上传
        // editor.config.uploadImgUrl = 'http://localhost:8012/upload';

        // 第三方上传
        // editor.config.customUpload = true;

        // 普通菜单配置
        // editor.config.menus = [
        //     'img',
        //     'insertcode',
        //     'eraser',
        //     'fullscreen'
        // ];
        // 只排除某几个菜单（兼容IE低版本，不支持ES5的浏览器），支持ES5的浏览器可直接用 [].map 方法
        // editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
        //     if (item === 'insertcode') {
        //         return null;
        //     }
        //     if (item === 'fullscreen') {
        //         return null;
        //     }
        //     return item;
        // });

        // onchange 事件
        editor.onchange = function () {
            console.log(this.$txt.html());
        };

        // 取消过滤js
        // editor.config.jsFilter = false;

        // 取消粘贴过来
        // editor.config.pasteFilter = false;

        // 设置 z-index
        // editor.config.zindex = 20000;

        // 语言
        // editor.config.lang = wangEditor.langs['en'];

        // 自定义菜单UI
        // editor.UI.menus.bold = {
        //     normal: '<button style="font-size:20px; margin-top:5px;">B</button>',
        //     selected: '.selected'
        // };
        // editor.UI.menus.italic = {
        //     normal: '<button style="font-size:20px; margin-top:5px;">I</button>',
        //     selected: '<button style="font-size:20px; margin-top:5px;"><i>I</i></button>'
        // };
        
        editor.create(); 
    </script>
</body>
</html>