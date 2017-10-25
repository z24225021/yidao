<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.window-container .window-head .toolbar {
    display: flex;
    height: 55px;
    padding: 0 .8em;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: stretch;
}
 .title{
 	color: #333;
    font-size: 16px;
    line-height: 55px;
    font-weight: 700;
 }
a, a:hover {
    text-decoration: none;
	color:#333;
}
li {list-style-type:none;}
.left{
	position:fixed;
	width:15%;
	background-color: #ddd;
	margin-right:15px;
	padding-right:15px;
	float:left;
	z-index:100px;
}
#main{
	width:75%;
	float:right;
	margin-bottom: 50px;	
}

.window{
	width:75%;
	margin:0 auto;
}
table{
	width: 70%;
	font-family: "Microsoft Yahei", 微软雅黑, Arial;
}
table th {
    height: auto;
    background-color: #666;
    color: #fff;
    text-align: left;
}
dd{
	color:#666;
	font-size: 1.5em;
}
   
 </style>
 <script language=javascript>
var lastScrollY=0;
function backtop()
{
var diffY=document.body.scrollTop;
var percent=.1*(diffY-lastScrollY);
if(percent>0)
{
 percent=Math.ceil(percent);
}
else
{
percent=Math.floor(percent);
}
document.all.left.style.pixelTop+=percent;
lastScrollY=lastScrollY+percent;
}
window.setInterval("backtop()",10);
</script>
 
<div class="window">
	<div class="window-head">
		<div class="toolbar">
			<a class="title" href="<?php echo U('Ydapi/Index/index');?>">一道约车完全开发手册</a>
			<div class="extra"></div>
		</div>
	</div>
	<div>
		<div style="height:2px;background-color: #136ec2;">
		</div>
	</div>
    <div class="container">
        <div id="left" class="left">
            <ul>
               <li><a href="#dz">地址</a></li>
               <li><a>登录模块</a></li>
               <ul>
               <li class=""><a href="#dl">登录</a></li>
               <li class=""><a href="#dx">短信验证码</a></li>
               <li class=""><a href="#zc">注册</a></li>
               <li class=""><a href="#yhrz">用户认证</a></li>
               <li class=""><a href="#sjrz">司机认证</a></li>
               <li class=""><a href="#hqrzzt">认证状态</a></li>
               <li class=""><a href="#sgrzzt">修改认证状态</a></li>
               <li class=""><a href="#wjmm">忘记密码</a></li>
               <li class=""><a href="#xgmm">修改密码</a></li>
               </ul>
               <li><a href="#yh">用户模块</a></li>
               <ul>
               <li class=""><a href="#yhxx">用户信息</a></li>
               <li class=""><a href="#hqyhdh">获取用户电话</a></li>
               <li class=""><a href="#gxyhxx">更新用户信息</a></li>
               <li class=""><a href="#gxtx">更新用户图像</a></li>
               <li class=""><a href="#kg">抢单开关</a></li>
               <li class=""><a href="#dw">上传位置</a></li>
               <li class=""><a href="#hqwz">获取位置</a></li>
               </ul>
               <li><a href="#dd">订单模块</a></li>
               <ul>
               <li class=""><a href="#fbdd">发布订单</a></li>
               <li class=""><a href="#xgdd">修改订单</a></li>
               <li class=""><a href="#scjg">计算价格</a></li>
               <li class=""><a href="#hqddxq">获取订单详情</a></li>
               <li class=""><a href="#hqddlb">获取订单列表</a></li>
               <li class=""><a href="#xgddsx">修改订单属性</a></li>
               <li class=""><a href="#ggddzt">更新订单状态</a></li>
               <li class=""><a href="#sjqd">司机抢单</a></li>
               <li class=""><a href="#cjzf">创建支付</a></li>
               </ul>
               <li><a href="#other">其他模块</a></li>
               <ul>
               <li class=""><a href="#sctp">上传图片</a></li>
               <li class=""><a href="#line">获取线路</a></li>
               <li class=""><a href="#ltot">线路对应车队</a></li>
               </ul>
            </ul>
        </div>
	    <div id="main">
	    	<div id="dz">
	    	 	<dd>请求地址：</dd>
	    		<table border="1" cellpadding="0" cellspacing="0" >
	            <tbody >
	            	<tr>
	                    <th width="30%">环境</th>
	                    <th width="60%">HTTP请求地址</th>
	                    <th>API接口名称</th>
	                </tr>
	                <tr>
	                    <td>正式环境</td>
	                    <td>http://yidaoba.cn/index.php/ydapi/index/</td>
	                    <td>method</td>
	                </tr>
	                <tr>
	                    <td>沙箱环境</td>
	                    <td>http://192.168.4.111/yidao/index.php/ydapi/index/</td>
	                    <td>method</td>
	                </tr>
	            </tbody>
	       	 	</table>
	    	</div><br>
			<div id="m1">
		        <dd id="dl">登录：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>login</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>phonenum</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户名</td>
		            </tr>
		            <tr>
		                <td>password</td>
		                <td>String</td>
		                <td>是</td>
		                <td>密码</td>
		            </tr>
		            <tr>
		                <td>usertype</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户类型（0：乘客，1：顺风车，2：专车司机，3：专线车司机，4：调度）</td>
		            </tr>
		            <tr>
		                <td>regid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>设备注册Id</td>
		            </tr>
		            </tbody>
		        </table>
		       	<d1>返回：</d1><br>
		       	<pre>
成功
{
    "code": 200,
    "msg": "登陆成功",
    "info": {
        "id": "yh18888888888",
        "username": "18888888888",
        "password": "e10adc3949ba59abbe56e057f20f883e",
        "pass": "123456",
        "update_time": "2017-07-08 09:35:24",
        "create_time": "2017-07-08 09:35:24",
        "email": null,
        "isopen": 0,
        "type": "0"
    }
}
失败：
{
  "code": 0,
  "msg": "用户名或密码不正确"
}
				</pre>
		        <dd id="dx">短信验证码：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>yanzheng</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>phonenum</td>
		                <td>String</td>
		                <td>是</td>
		                <td>手机号</td>
		            </tr>
		            </tbody>
		        </table>
		       	<br>
		        <dd id="zc">注册：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>register</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>phonenum</td>
		                <td>String</td>
		                <td>是</td>
		                <td>手机号</td>
		            </tr>
		            <tr>
		                <td>password</td>
		                <td>String</td>
		                <td>是</td>
		                <td>密码</td>
		            </tr>
		            <tr>
		                <td>smsverify</td>
		                <td>String</td>
		                <td>是</td>
		                <td>短信验证码</td>
		            </tr>
		            <tr>
		                <td>usertype</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户类型（0：乘客，1：顺风车，2：专车司机，3：专线车司机，4：调度）</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
  成功：
{
    "code": 200,
    "msg": "注册成功",
    "info": {
        "uid": "yh1803735122",
        "phonenum": "1803735122"
    }
}
失败：
{
    "code": 0,
    "msg": "手机号已被注册"
}
验证码错误：
{
    "code": 0,
    "msg": "短信验证码不正确"
}
		        </pre>
		        <dd id="yhrz">用户认证：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>usercert</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户id</td>
		            </tr>
		            <tr>
		                <td>name</td>
		                <td>String</td>
		                <td>是</td>
		                <td>姓名</td>
		            </tr>
		            <tr>
		                <td>cardid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>身份证号</td>
		            </tr>
		            <tr>
		                <td>cardfontpic</td>
		                <td>String</td>
		                <td>是</td>
		                <td>身份证正面</td>
		            </tr>
		            <tr>
		                <td>cardbackpic</td>
		                <td>String</td>
		                <td>是</td>
		                <td>身份证反面</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
  成功：
{
    "code": 200,
    "msg": "提交成功",
}
失败：
{
    "code": 0,
    "msg": "提交失败"
}
</pre>
		        <dd id="sjrz">司机认证：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>drivercert</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>did</td>
		                <td>String</td>
		                <td>是</td>
		                <td>司机Id</td>
		            </tr>
		            <tr>
		                <td>name</td>
		                <td>String</td>
		                <td>是</td>
		                <td>姓名</td>
		            </tr>
		            
		            <tr>
		                <td>cardid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>身份证号</td>
		            </tr>
		            <tr>
		                <td>cardfontpic</td>
		                <td>String</td>
		                <td>是</td>
		                <td>身份证正面</td>
		            </tr>
		            <tr>
		                <td>cardbackpic</td>
		                <td>String</td>
		                <td>是</td>
		                <td>身份证反面</td>
		            </tr>
		            <tr>
		                <td>drivercard</td>
		                <td>String</td>
		                <td>是</td>
		                <td>驾驶证正反面</td>
		            </tr>
		            <tr>
		                <td>driverlicense</td>
		                <td>String</td>
		                <td>是</td>
		                <td>行驶证正反面</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
  成功：
{
    "code": 200,
    "msg": "提交成功",
}
失败：
{
    "code": 0,
    "msg": "提交失败"
}
</pre>
		        <dd id="hqrzzt">认证状态：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>getcertstate</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户id</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
  成功：
{
    "code": 200,
    "msg": "获取成功",
    "info": {
        "iscert": "2"
    }
}
失败：
{
    "code": 0,
    "msg": "获取失败"
}
</pre>
		        <dd id="sgrzzt">修改认证状态：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>certstate</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户ID</td>
		            </tr>
		            <tr>
		                <td>iscert</td>
		                <td>String</td>
		                <td>是</td>
		                <td>状态码（0:未认证，1:司机认证中，2:司机认证成功，3:用户认证成功,4:用户认证中）</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
  成功：
{
    "code": 200,
    "msg": "修改成功",
}
失败：
{
    "code": 0,
    "msg": "修改失败"
}
</pre>
		        <dd id="wjmm">忘记密码：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>forgetpwd</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>usertype</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户类型</td>
		            </tr>
		            <tr>
		                <td>phonenum</td>
		                <td>String</td>
		                <td>是</td>
		                <td>手机号</td>
		            </tr>
		            <tr>
		                <td>password</td>
		                <td>String</td>
		                <td>是</td>
		                <td>密码</td>
		            </tr>
		            <tr>
		                <td>smsverify</td>
		                <td>String</td>
		                <td>是</td>
		                <td>短信验证码</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
  成功：
{
    "code": 200,
    "msg": "密码修改成功",
    "info": {
        "uid": "yh1803735122",
        "phonenum": "1803735122"
    }
}
失败：
{
    "code": 0,
    "msg": "手机号未注册"
}
验证码错误：
{
    "code": 0,
    "msg": "短信验证码不正确"
}
		        </pre>
		        <dd id="xgmm">修改密码：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>changepwd</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户Id</td>
		            </tr>
		            <tr>
		                <td>password</td>
		                <td>String</td>
		                <td>是</td>
		                <td>旧密码</td>
		            </tr>
		            <tr>
		                <td>newpass</td>
		                <td>String</td>
		                <td>是</td>
		                <td>新密码</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
  成功：
{
    "code": 200,
    "msg": "密码修改成功",
    "info": {
        "uid": "yh1803735122",
        "phonenum": "1803735122"
    }
}
失败：
{
    "code": 0,
    "msg": "密码修改失败"
}
		        </pre>
			</div>
			<div id="yh">
				<dd id="yhxx">用户信息：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>userinfo</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户id</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "",
    "info": {
        "id": "yh18888888888",
        "name": "wang",
        "pic": null,
        "addr": null,
        "age": null,
        "phonenum": "18888888888",
        "cardbackpic": null,
        "cardfontpic": null,
        "cardid": "123456",
        "sex": null,
        "uid": "yh18888888888",
        "drivercard": "hello",
        "driverlicense": "hello"
    }
}

失败：
{
    "code": 0,
    "msg": "获取失败"
}		        
		        </pre>
				<dd id="hqyhdh">获取用户电话：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>uphone</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>carteam</td>
		                <td>String</td>
		                <td>是</td>
		                <td>车队id</td>
		            </tr>
		            <tr>
		                <td>utype</td>
		                <td>String</td>
		                <td>否</td>
		                <td>用户类型（默认：4-调度）</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "获取成功",
    "info": [
        {
            "id": "dd13027530606",
            "phone": "13027530606"
        },
        {
            "id": "dd18637136723",
            "phone": "18637136723"
        }
    ]
}

失败：
{
    "code": 0,
    "msg": "获取失败"
}		        
		        </pre>
				<dd id="gxyhxx">更新用户信息：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>changeuser</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户id</td>
		            </tr>
		            <tr>
		                <td>name</td>
		                <td>String</td>
		                <td>否</td>
		                <td>用户姓名</td>
		            </tr>
		            <tr>
		                <td>addr</td>
		                <td>String</td>
		                <td>否</td>
		                <td>用户住址</td>
		            </tr>
		            <tr>
		                <td>age</td>
		                <td>String</td>
		                <td>否</td>
		                <td>年龄</td>
		            </tr>
		            <tr>
		                <td>sex</td>
		                <td>String</td>
		                <td>否</td>
		                <td>性别（0：女，1：男）</td>
		            </tr>
		            <tr>
		                <td>cardid</td>
		                <td>String</td>
		                <td>否</td>
		                <td>身份证号</td>
		            </tr>
		            <tr>
		                <td>pic</td>
		                <td>String</td>
		                <td>否</td>
		                <td>图像</td>
		            </tr>
		            <tr>
		                <td>cardfontpic</td>
		                <td>String</td>
		                <td>否</td>
		                <td>身份证正面</td>
		            </tr>
		            <tr>
		                <td>cardbackpic</td>
		                <td>String</td>
		                <td>否</td>
		                <td>身份证反面</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "修改成功"
}
失败：
{
    "code": 0,
    "msg": "修改失败"
}
		        </pre>
				<dd id="gxyhxx">更新用户图像：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>changeuserpic</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户id</td>
		            </tr>
		            <tr>
		                <td>file</td>
		                <td>file</td>
		                <td>是</td>
		                <td>用户图像</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "修改成功"
}
失败：
{
    "code": 0,
    "msg": "修改失败"
}
		        </pre>
				<dd id="kg">抢单开关：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>open</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>did</td>
		                <td>String</td>
		                <td>是</td>
		                <td>司机id</td>
		            </tr>
		            <tr>
		                <td>isopen</td>
		                <td>String</td>
		                <td>是</td>
		                <td>开关开启0：关闭1：开启</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "更新成功"
}
失败：
{
    "code": 0,
    "msg": "更新失败"
}
		        </pre>
				<dd id="dw">上传位置：</dd>//定位
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>uloc</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户ID</td>
		            </tr>
		            <tr>
		                <td>nowloc</td>
		                <td>String</td>
		                <td>是</td>
		                <td>位置坐标</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "更新成功"
}
失败：
{
    "code": 0,
    "msg": "更新失败"
}
		        </pre>
				<dd id="hqwz">获取位置：</dd><!-- //定位 -->
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>gloc</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>did</td>
		                <td>String</td>
		                <td>否</td>
		                <td>司机位置</td>
		            </tr>
		            <tr>
		                <td>carteam</td>
		                <td>String</td>
		                <td>否</td>
		                <td>车队id</td>
		            </tr>
		            <tr>
		                <td>isopen</td>
		                <td>String</td>
		                <td>否</td>
		                <td>是否发车（0：未发车，1：发车）</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "获取成功",
    "info": [
        {
            "uid": "sj18188888888",
            "name": "18188888888",
            "loc": "123456"
        },
        {
            "uid": "sj18288888888",
            "name": "18288888888",
            "loc": null
        },
        {
            "uid": "sj18682923463",
            "name": "18682923463",
            "loc": "34.676735,112.414697"
        }
    ]
}
失败：
{
    "code": 0,
    "msg": "获取失败"
}
		        </pre>
			</div>
			<div id="dd">
				<dd id="fbdd">发布订单：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>carorder</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>用户id</td>
		            </tr>
		            <tr>
		                <td>startxy</td>
		                <td>String</td>
		                <td>是</td>
		                <td>出发点坐标</td>
		            </tr>
		            <tr>
		                <td>startaddr</td>
		                <td>String</td>
		                <td>是</td>
		                <td>出发点具体位置</td>
		            </tr>
		            <tr>
		                <td>endxy</td>
		                <td>String</td>
		                <td>是</td>
		                <td>终点坐标</td>
		            </tr>
		            <tr>
		                <td>endaddr</td>
		                <td>String</td>
		                <td>是</td>
		                <td>终点具体位置</td>
		            </tr>
		            <tr>
		                <td>line</td>
		                <td>int</td>
		                <td>否</td>
		                <td>路线（专线车/快递）</td>
		            </tr>
		            <tr>
		                <td>carteam</td>
		                <td>int</td>
		                <td>否</td>
		                <td>车队Id</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>int</td>
		                <td>是</td>
		                <td>预约类型（0:顺风车/1:专车/2:专线车/3:城际快递）</td>
		            </tr>
		            <tr>
		                <td>contact_name</td>
		                <td>string</td>
		                <td>否</td>
		                <td>联系人</td>
		            </tr>
		            <tr>
		                <td>phonenum</td>
		                <td>string</td>
		                <td>是</td>
		                <td>联系电话</td>
		            </tr>
		            <tr>
		                <td>pnum</td>
		                <td>int</td>
		                <td>否</td>
		                <td>人数</td>
		            </tr>
		            <tr>
		                <td>pay</td>
		                <td>int</td>
		                <td>否</td>
		                <td>金额</td>
		            </tr>
		            <tr>
		                <td>state</td>
		                <td>string</td>
		                <td>否</td>
		                <td>订单状态</td>
		            </tr>
		            <tr>
		                <td>book_time</td>
		                <td>timestamp</td>
		                <td>否</td>
		                <td>预订时间</td>
		            </tr>
		            <tr>
		                <td>rname</td>
		                <td>string</td>
		                <td>否</td>
		                <td>接收者姓名</td>
		            </tr>
		            <tr>
		                <td>rphone</td>
		                <td>string</td>
		                <td>否</td>
		                <td>接收者电话</td>
		            </tr>
		            <tr>
		                <td>gname</td>
		                <td>string</td>
		                <td>否</td>
		                <td>物品名称</td>
		            </tr>
		             <tr>
		                <td>gtype</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品类型</td>
		            </tr>
		             <tr>
		                <td>gweight</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品重量</td>
		            </tr>
		             <tr>
		                <td>glong</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品长度</td>
		            </tr>
		             <tr>
		                <td>gwidth</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品宽度</td>
		            </tr>
		             <tr>
		                <td>gheight</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品高度</td>
		            </tr>
		            <tr>
		                <td>remark</td>
		                <td>String</td>
		                <td>否</td>
		                <td>备注</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "下单成功",
    "info": {
        "oid": "yc1506762303",
    }
}
失败：
{
    "code": 0,
    "msg": "预约失败"
}		        
		        </pre>
				<dd id="xgdd">修改订单：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>editorder</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>id</td>
		                <td>String</td>
		                <td>是</td>
		                <td>订单id</td>
		            </tr>
		            <tr>
		                <td>startxy</td>
		                <td>String</td>
		                <td>是</td>
		                <td>出发点坐标</td>
		            </tr>
		            <tr>
		                <td>startaddr</td>
		                <td>String</td>
		                <td>是</td>
		                <td>出发点具体位置</td>
		            </tr>
		            <tr>
		                <td>endxy</td>
		                <td>String</td>
		                <td>是</td>
		                <td>终点坐标</td>
		            </tr>
		            <tr>
		                <td>endaddr</td>
		                <td>String</td>
		                <td>是</td>
		                <td>终点具体位置</td>
		            </tr>
		            <tr>
		                <td>contact_name</td>
		                <td>String</td>
		                <td>否</td>
		                <td>联系人名字</td>
		            </tr>
		            <tr>
		                <td>phonenum</td>
		                <td>String</td>
		                <td>是</td>
		                <td>联系电话</td>
		            </tr>
		            <tr>
		                <td>pnum</td>
		                <td>String</td>
		                <td>否</td>
		                <td>人数</td>
		            </tr>
		            <tr>
		                <td>pay</td>
		                <td>int</td>
		                <td>否</td>
		                <td>金额</td>
		            </tr>
		            <tr>
		                <td>book_time</td>
		                <td>String</td>
		                <td>否</td>
		                <td>预定时间</td>
		            </tr>
		            <tr>
		                <td>rname</td>
		                <td>string</td>
		                <td>否</td>
		                <td>接收者姓名</td>
		            </tr>
		            <tr>
		                <td>rphone</td>
		                <td>string</td>
		                <td>否</td>
		                <td>接收者电话</td>
		            </tr>
		            <tr>
		                <td>gname</td>
		                <td>string</td>
		                <td>否</td>
		                <td>物品名称</td>
		            </tr>
		             <tr>
		                <td>gtype</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品类型</td>
		            </tr>
		             <tr>
		                <td>gweight</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品重量</td>
		            </tr>
		             <tr>
		                <td>glong</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品长度</td>
		            </tr>
		             <tr>
		                <td>gwidth</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品宽度</td>
		            </tr>
		             <tr>
		                <td>gheight</td>
		                <td>int</td>
		                <td>否</td>
		                <td>物品高度</td>
		            </tr>
		            <tr>
		                <td>remark</td>
		                <td>String</td>
		                <td>否</td>
		                <td>备注</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "修改成功",
}
失败：
{
    "code": 0,
    "msg": "修改失败"
}		        
		        </pre>
				<dd id="scjg">计算价格：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>price</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>otype</td>
		                <td>String</td>
		                <td>是</td>
		                <td>类型</td>
		            </tr>
		            <tr>
		                <td>startxy</td>
		                <td>String</td>
		                <td>是</td>
		                <td>出发点坐标</td>
		            </tr>
		            <tr>
		                <td>endxy</td>
		                <td>String</td>
		                <td>是</td>
		                <td>终点坐标</td>
		            </tr>
		            <tr>
		             	<td>line</td>
		                <td>String</td>
		                <td>否</td>
		                <td>线路</td>
		            </tr>
		            <tr>
		                <td>pnum</td>
		                <td>String</td>
		                <td>否</td>
		                <td>人数</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": ""
    "info": {
        "price": 200,
    }
}
失败：
{
    "code": 0,
    "msg": ""
}		        
		        </pre>
				<dd id="hqddxq">获取订单详情：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>findorder</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>id</td>
		                <td>String</td>
		                <td>是</td>
		                <td>订单id</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "",
    "info": {
        "oid": "yc1506801927",
        "startxy": "34.593848,112.458569",
        "startaddr": "洛阳市 洛阳龙门站",
        "endxy": "34.759108,113.77855",
        "endaddr": "郑州市 郑州东站",
        "lineid": "5",
        "otype": "2",
        "contact_name": null,
        "phonenum": "18637136723",
        "pnum": "3",
        "info_from": null,
        "did": "zxc18637136723",
        "book_time": "1506801928",
        "create_time": "2017-10-03 09:52:55",
        "state": "2",
        "orderdelete": "1",
        "pay": "210.00",
        "grade": null,
        "suggest": null,
        "remark": null,
        "uid": "yh18637136723",
        "rname": null,
        "rphone": null,
        "gname": null,
        "gtype": null,
        "gweight": null,
        "glong": null,
        "gwidth": null,
        "gheight": null,
        "carteam": "1",
        "route": null,
        "gettime": null,
        "arrivetime": null,
        "uname": "yidao",
        "linename": "洛阳市-郑州市"
    }
}
失败：
{
    "code": 0,
    "msg": "获取失败"
}	        
		        </pre>
				<dd id="hqddlb">获取订单列表：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>orderlist</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>uid</td>
		                <td>String</td>
		                <td>否</td>
		                <td>用户id</td>
		            </tr>
		            <tr>
		                <td>state</td>
		                <td>String</td>
		                <td>否</td>
		                <td>订单状态(0：未接单，1：司机抢单，2：接到乘客，3：乘客送达，4：完成支付，5：完成评价,-1:乘客取消订单，-2：调度取消订单，001:已接单，未指派，102：已指派，准备接人，101：默认（0，1，001），011：未处理（0，001），999：接送中，已完成，取消)</td>
		            </tr>
		            <tr>
		                <td>ordertype</td>
		                <td>String</td>
		                <td>否</td>
		                <td>订单类型</td>
		            </tr>
		            <tr>
		                <td>carteam</td>
		                <td>String</td>
		                <td>否</td>
		                <td>车队id</td>
		            </tr>
		            <tr>
		                <td>line</td>
		                <td>String</td>
		                <td>否</td>
		                <td>线路ID</td>
		            </tr>
		            <tr>
		                <td>tday</td>
		                <td>String</td>
		                <td>否</td>
		                <td>时间（1：当天，2：次日，3：第三天，4：三天后，其他值：全部订单）</td>
		            </tr>
		            
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "",
    "info": [
        {
            "id": "fc1499652098",
            "startxy": "dd",
            "startaddr": "升龙广场a区",
            "endxy": "aa",
            "endaddr": "郑州东站",
            "line": null,
            "type": null,
            "contact_name": null,
            "phonenum": "18888888888",
            "pnum": null,
            "info_from": null,
            "did": null,
            "book_time": "2017-07-10 10:01:38",
            "create_time": "2017-07-10 10:01:38",
            "state": null,
            "orderdelete": null,
            "pay": null,
            "remark": null,
            "uid": "yd18888888888"
        },
        {
            "id": "fc1499654852",
            "startxy": "dd",
            "startaddr": "升龙广场a区",
            "endxy": "aa",
            "endaddr": "郑州东站",
            "line": null,
            "type": null,
            "contact_name": null,
            "phonenum": "18888888888",
            "pnum": null,
            "info_from": null,
            "did": null,
            "book_time": "2017-07-10 10:47:32",
            "create_time": "2017-07-10 10:47:32",
            "state": null,
            "orderdelete": null,
            "pay": null,
            "remark": null,
            "uid": "yd18888888888"
        }
    ]
}
失败：
{
    "code": 0,
    "msg": "获取失败"
}	        
		        </pre>
				<dd id="xgddsx">修改订单属性：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>changeattr</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>id</td>
		                <td>String</td>
		                <td>是</td>
		                <td>订单id</td>
		            </tr>
		            <tr>
		                <td>key</td>
		                <td>String</td>
		                <td>是</td>
		                <td>订单属性contact_name,phonenum,pnum,info_from,did,book_time,create_time,state,orderdelete,pay,grade,suggest,<br>remark,rname,rphone,gname,gtype,gweight,glong,gwidth,gheight
						</td>
		            </tr>
		            <tr>
		                <td>value</td>
		                <td>String</td>
		                <td>否</td>
		                <td>属性值key:value同时存在</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "修改成功"
}
失败：
{
    "code": 0,
    "msg": "修改失败"
}	        
		        </pre>
				<dd id="ggddzt">更改订单状态：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>upstate</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>oid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>订单id</td>
		            </tr>
		            <tr>
		                <td>state</td>
		                <td>String</td>
		                <td>是</td>
						<td>订单状态(0：未接单，1：司机抢单，2：接到乘客，3：乘客送达，4：完成支付，5：完成评价,-1:乘客取消订单，-2：调度取消订单，001:已接单，未指派，102：已指派，准备接人，101：默认（0，1，001），011：未处理（0，001）,999：接送中，已完成，取消)</td>
						</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "更新成功"
    "info": {
        "price": 200,
    }
}
失败：
{
    "code": 0,
    "msg": "更新失败"
}	        
		        </pre>
				<dd id="sjqd">司机抢单接口：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>robdeal</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>oid</td>
		                <td>String</td>
		                <td>是</td>
		                <td>订单id</td>
		            </tr>
		            <tr>
		                <td>did</td>
		                <td>String</td>
		                <td>是</td>
		                <td>司机Id
						</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：
{
    "code": 200,
    "msg": "抢单成功"
}
失败：
{
    "code": 0,
    "msg": "抢单失败"
}	        
		        </pre>
				<dd id="cjzf">创建支付订单：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>createpaydeal</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>oid</td>
		                <td>string</td>
		                <td>是</td>
		                <td>订单id</td>
		            </tr>
		            <tr>
		                <td>ptype</td>
		                <td>string</td>
		                <td>是</td>
		                <td>支付类型（1:微信，2:支付宝）</td>
		            </tr>
		            </tbody>
		        </table>
		        <pre>
成功：

}

    }
}
失败：
{
    "code": 0,
    "msg": "发起支付失败"
}	        
		        </pre>
			</div>
    		<div id="other">
		        <dd id="sctp">上传：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>upload</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>file</td>
		                <td>file</td>
		                <td>是</td>
		                <td>文件</td>
		            </tr>
		            <tr>
		                <td>uptype</td>
		                <td>string</td>
		                <td>是</td>
		                <td>上传类型（头像：pic,证件上传：card,新闻：news）</td>
		            </tr>
		            </tbody>
		        </table>
		       	<d1>返回：</d1><br>
		       	<pre>
成功：
{
    "code": 200,
    "msg": "上传成功！",
    "info": {
        "name": "3zwq.jpg",
        "type": "image/jpeg",
        "size": 1676584,
        "key": "file",
        "ext": "jpg",
        "md5": "5547dfdc3560c9c540e709f363d15aaa",
        "sha1": "0810e854baad27b13ee2d3dc3e3a5321eecb5ac0",
        "savename": "598a732e779f6.jpg",
        "savepath": "2017-08-09/"
    }
}
失败：
{
    "code": 0,
    "msg": "上传失败！",
    "other": ""
}

				</pre>
		        <dd id="line">线路获取：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>lines</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>carteam</td>
		                <td>string</td>
		                <td>否</td>
		                <td>车队ID</td>
		            </tr>
		            </tbody>
		        </table>
		       	<d1>返回：</d1><br>
		       	<pre>
成功：
{
    "code": 200,
    "msg": "",
    "info": [
        {
            "id": "1",
            "name": "洛阳-郑州",
            "startcity": "洛阳",
            "endcity": "郑州",
            "uptime": "2017-08-11 15:29:32",
            "uid": "1"
        },
        {
            "id": "2",
            "name": "洛阳-郑州机场",
            "startcity": "洛阳",
            "endcity": "郑州机场",
            "uptime": "2017-08-11 15:32:14",
            "uid": "1"
        }
    ]
}
失败：
{
    "code": 0,
    "msg": "获取失败",
}
				</pre>
		        <dd id="ltot">线路对应车队：</dd>
				<table border="1" cellpadding="0" cellspacing="0">
		            <thead>
		            <tr>
		                <th width="20%">名称</th>
		                <th width="10%">类型</th>
		                <th width="10%">是否必须</th>
		                <th width="60%">描述</th>
		            </tr>
		            </thead>
		            <tbody>
		            <tr>
		                <td>method</td>
		                <td>String</td>
		                <td>是</td>
		                <td>linetoteam</td>
		            </tr>
		            <tr>
		                <td>type</td>
		                <td>post</td>
		                <td>是</td>
		                <td>发送请求方式</td>
		            </tr>
		            <tr>
		                <td>lineid</td>
		                <td>string</td>
		                <td>是</td>
		                <td>线路id</td>
		            </tr>
		            </tbody>
		        </table>
		       	<d1>返回：</d1><br>
		       	<pre>
成功：
{
    "code": 200,
    "msg": "",
    "info": [
        {
            "id": "1",
            "name": "一道",
            "lines": "1,2",
            "uid": "1"
        },
        {
            "id": "4",
            "name": "11",
            "lines": "1,2",
            "uid": "1"
        }
    ]
}
失败：
{
    "code": 0,
    "msg": "获取异常",
}
				</pre>
			</div>
		</div>
    </div>
</div>
<script>
	
</script>