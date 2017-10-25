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
    <div class="btn btn-primary"><?php echo ($title); ?></div>
</div>
<div class="tab-pane active in" id="home">
      <form id="tab" action="/yidao/index.php/Admin/Index/ladd?pid=62" method="post">
        <div class="form-group">
        <label>出发城市</label>
          <input type="text" name="startcity" id="start"  class="form-control" value="<?php echo ($line['startcity']); ?>"  placeholder="请输入出发城市">
        	<p id="serror" class="bg-danger"></p>
        </div>
        <div class="form-group">
        <label>区域选择<input type="button" class="areachoose" id="startid" value="选择出发城市区域" ></label>
          <input type="text" name="startg" id="startg"  class="form-control" value="<?php echo ($line['startg']); ?>" readonly="readonly" >
        	<p id="serror" class="bg-danger"></p>
        </div>
        <div class="form-group">
        <label>终点城市</label>
          <input type="text" name="endcity" id="end" class="form-control" value="<?php echo ($line['endcity']); ?>"  placeholder="请输入终点城市">
        	<p id="eerror" class="bg-danger"></p>
        </div>
        <div class="form-group">
        <label>区域选择<input type="button" class="areachoose" id="endid" value="选择终点城市区域" ></label>
          <input type="text" name="endg" id="endg" class="form-control" value="<?php echo ($line['endg']); ?>"  readonly="readonly" >
        	<p id="eerror" class="bg-danger"></p>
        </div>
        <div class="form-group">
			<input type="hidden" name="uid" value="<?php echo S('admin')['id'];?>"> 
        	<input type="hidden" name="id" value="<?php echo ($line['id']); ?>">
        	<input type="hidden" name="uptime" value="<?php echo ($line['uptime']); ?>">
       <!--  <label>线路</label><br>
        	<div class="form-group">
	        	<div class="col-md-4">
		          	<input type="text" id="sname" class="form-control" value="<?php echo ($line['startcity']); ?>" readonly="readonly" >
	        	</div>
	        	<div class="col-md-1" style="text-align: center;">至</div>
	        	<div class="col-md-4">
		          	<input type="text" id="ename" class="form-control" value="<?php echo ($line['endcity']); ?>" readonly="readonly" > 
	        	</div>
        	</div><br> -->
        </div>
        <div class="form-group">
	    <label>基本价</label>
	        <input type="text" name="bprice" id="bprice" class="form-control" value="<?php echo ($line['bprice']); ?>"  placeholder="请输入基本价">
	        	<p id="eerror" class="bg-danger"></p>
	    </div>
	    <div class="form-group">
	    <label>超范围加价</label>
	        <input type="text" name="addp" id="addp" class="form-control" value="<?php echo ($line['addp']); ?>"  placeholder="请输入加价">
	        	<p id="eerror" class="bg-danger"></p>
        </div>
	    <div class="btn-toolbar list-toolbar">
	      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 保存</button>
	      <button type="reset" class="btn btn-danger"><i class="fa fa-reset"></i> 重置</button>
	    </div>
        </form>
</div>
<!-- 

地图

 -->
    <link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=2c4052cc5bbdc6f72929dda7cdc11531"></script>
    <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
    <script src="//webapi.amap.com/ui/1.0/main.js?v=1.0.10"></script>
<div id="container" style="margin-top: 60px;display:none"></div>
<div id="buttong" class="button-group" style="display:none;top:70px">
    <input id="draw" type="button" class="button" value="绘制"/>
    <input id="suredraw" type="button" class="button" value="确认"/>
    <input id="overdraw" type="button" class="button" value="清除"/>
    <input id="cancel" type="button" class="button" value="取消"/>
	<div class="button-group" id="result" style="top:70px">
	<div class="list-group" id="marklist"></div>
	</div>
</div>
<script type="text/javascript">
	document.getElementById("search_header").style.display='none';
    //初始化地图对象，加载地图
    var areaname;
    var centercity;
    var map = new AMap.Map("container", {
        resizeEnable: true,
        zoom: 13
    });
   
    var path =[];
    var i = 1;
    var markers=[];
    var j = 1;
    var paths=[];
	map.on('click',function(e){
		//自定义标记
		AMapUI.loadUI(['overlay/SimpleMarker'], function(SimpleMarker) {
	      var marker = new SimpleMarker({
	              iconLabel: i++,
	              map: map,
	              position: e.lnglat
	        });
		    markers.push(marker);
	    });
		var markerid='marker'+j+'-'+i;
		var areaid = 'area-'+j
	    if(i==1){
	    	/* $('#result').append('<div class="list-group" id="'+areaid+'"></div>'); */
        	$('#marklist').append('<a href="javascript:;" onclick="deleteMarkers(\''+areaid+'\')" class="list-group-item active glyphicon glyphicon-remove" style="padding:4px 10px;width:90px">area'+j+'</a>'); 
        	$('#marklist').append('<button type="button" id="'+markerid+'" class="list-group-item" style="padding:4px 10px;width:90px">'+markerid+'</button>');
        }else{
        	$('#marklist').append('<button type="button" id="'+markerid+'" class="list-group-item" style="padding:4px 10px;width:90px">'+markerid+'</button>');
        }
	    path.push(e.lnglat);
	});
	var polygons=[];
 	AMap.event.addDomListener(document.getElementById('draw'), 'click', function() {
	   var  polygon = new AMap.Polygon({
	        map: map,
	        path: path,
	        strokeColor: '#'+Math.floor(Math.random()*0xffffff).toString(16),
            strokeOpacity: 1,
            strokeWeight: 3,
            fillColor: "#f5deb3",
            fillOpacity: 0.35
	    });
	    polygons.push(polygon);
	    map.setFitView();
	    path.push(path[0]);
	    var pathstr=path.join("-");
 		paths.push("("+pathstr.replace(new RegExp(',','gm'),' ').replace(new RegExp('-','gm'),',')+")");
 		path=[];
 		i=1;
 		alert("绘制区域"+j+"成功！")
 		j++;
	    
/*         
		alert('点是否在多边形内：' + polygon.contains(myMarker.getPosition())); 
*/
    }); 
	
 	AMap.event.addDomListener(document.getElementById('overdraw'), 'click', function() {
 		map.remove(markers);
 		map.remove(polygons);
 		$("#marklist").empty();
 		i=1;
 		j=1;
    }); 
 	AMap.event.addDomListener(document.getElementById('cancel'), 'click', function() {
	    map.remove(markers);
 		map.remove(polygons);
 		$("#marklist").empty();
		markers=[];
		paths = [];
 		path=[];
 		i=1;
 		j=1;
 		$('#container').hide();
	    $('#buttong').hide();
    }); 
 	
 	AMap.event.addDomListener(document.getElementById('suredraw'), 'click', function() {
 		$('#container').hide();
	    $('#buttong').hide(); 
 		var pathresult = paths.join(',');
 		var num=(pathresult.split(' ')).length-1;
 		if(0== num){
 			pathresult="POINT"+pathresult;
 		}else if(2== num){
 			pathresult="LINESTRING"+pathresult;
 		}else{
 			pathresult="POLYGON("+pathresult+")";
 		} 
 		map.remove(markers);
 		map.remove(polygons);
 		$("#marklist").empty();
		$('#'+areaname).val(pathresult);
		markers=[];
		paths = [];
 		path=[];
 		i=1;
 		j=1;
    }); 

 	

$(function(){
    $("input:button").click(function() {
       var nclass =  $(this).attr("class");
       var nid= $(this).attr('id');
       if($.trim(nclass)==$.trim('areachoose')){
	       $('#container').show();
	       $('#buttong').show();
	       switch(nid)
	       {
	       case 'startid':
		       areaname="startg";
		       if($('#start').val()!=""){
		    	   centercity=$('#start').val();
		    	   map.setCity(centercity);
		       }else{
		    	   map.setCity("洛阳市");
		       }
	         break;
	       case 'endid':
		       areaname="endg";
		       if($('#end').val()!=""){
		    	   centercity=$('#end').val();
		    	   map.setCity(centercity);
		       }else{
		    	   map.setCity("洛阳市");
		       }
	         break;
	       } 
       }
    });
});
/* function deleteMarkers(mid){
	var nid = mid.substring(mid.indexOf('-')+1);
	nid = nid - 1;
	for(mk in markers[nid]){
		alert(1);
		mk.setMap(null);
	}
 	$("#"+mid).remove();
} */
$(document).ready(function(){
	  $("#start").focus(function(){
		  $("#serror").text("");
	  });
	  $("#end").focus(function(){
		  $("#eerror").text("");
	  });
	  $("#start").blur(function(){
			if($("#start").val()==""){
				$("#serror").text("请输入出发城市");
			}else{
				$("#sname").val($("#start").val());
			}
	  });
	  $("#end").blur(function(){
			if($("#end").val()==""){
				$("#eerror").text("请输入终点城市");
			}else{
				$("#ename").val($("#end").val());
			}
	  });
	});
</script>
      
      
      
      
      
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