<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>欢迎您登录一道科技</title>
        <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/static/css/login.css" media="all">
       	<link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/static/css/blue_color.css" media="all">
    </head>
    <body id="login-page">
        <div id="main-content">

            <!-- 主体 -->
            <div class="login-body">
                <div class="login-main pr">
                    <form action="/yidao/index.php/Admin/Login/login.cc" method="post" class="login-form">
                        <h3 class="welcome">一道科技管理平台</h3>
                        <div id="itemBox" class="item-box">
                            <div class="item">
                                <i class="icon-login-user"></i>
                                <input type="text" name="username" placeholder="请填写用户名" autocomplete="off" />
                            </div>
                            <span class="placeholder_copy placeholder_un">请填写用户名</span>
                            <div class="item b0">
                                <i class="icon-login-pwd"></i>
                                <input type="password" name="password" placeholder="请填写密码" autocomplete="off" />
                            </div>
                            <span class="placeholder_copy placeholder_pwd">请填写密码</span>
                            <div class="item verifycode">
                                <i class="icon-login-verifycode"></i>
                                <input type="text" name="verify" placeholder="请填写验证码" autocomplete="off">
                                <a class="reloadverify" title="换一张" href="javascript:void(0)">换一张？</a>
                            </div>
                            <span class="placeholder_copy placeholder_check">请填写验证码</span>
                            <div>
                                <img class="verifyimg reloadverify" alt="点击切换" src="<?php echo U('Admin/Tool/verify');?>">
                            </div>
                        </div>
                        <div class="login_btn_panel">
                            <button class="login-btn" type="submit">
                                <span class="in"><i class="icon-loading"></i>登 录 中 ...</span>
                                <span class="on">登 录</span>
                            </button>
                            <div class="check-tips"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="/yidao/Public/static/js/jquery-2.0.3.min.js"></script>
    <!--<![endif]-->
    <script type="text/javascript">
    	/* 登陆表单获取焦点变色 */
    	$(".login-form").on("focus", "input", function(){
            $(this).closest('.item').addClass('focus');
        }).on("blur","input",function(){
            $(this).closest('.item').removeClass('focus');
        });

    	//表单提交
    	$(document)
	    	.ajaxStart(function(){
	    		$("button:submit").addClass("log-in").attr("disabled", true);
	    	})
	    	.ajaxStop(function(){
	    		$("button:submit").removeClass("log-in").attr("disabled", false);
	    	});

  		$("form").submit(function(){
    	 	var self = $(this);
  			if($.trim($('input[name="username"]').val())==""){
  				self.find(".check-tips").text("请输入用户名！！");
  				return false;
  			} else if($.trim($('input[name="password"]').val())==""){
  				self.find(".check-tips").text("请输入密码！！");
  				return false;
  			} else if($.trim($('input[name="verify"]').val())==""){
  				self.find(".check-tips").text("请输入验证码！！");
  				return false;
  			}
    		$.post(self.attr("action"), self.serialize(), success, "json");
    		return false;

    		function success(data){
    			self.find(".check-tips").text(data.msg);
    			if(data.code){
    				window.location.href = "/yidao/index.php/"+data.url; 
    			} else {
    				//刷新验证码
    				$(".reloadverify").click();
    			}
    		} 
    	});

  		
  		
  		$(function(){
			//初始化选中用户名输入框
			$("#itemBox").find("input[name=username]").focus();
			//刷新验证码
			var verifyimg = $(".verifyimg").attr("src");
            $(".reloadverify").click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });
		});
    </script>
</body>
</html>