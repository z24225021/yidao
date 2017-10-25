<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>河南一道科技有限公司</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="" />
<meta name="keywords" content="" />



<link rel="stylesheet" href="/yidao/Public/static/css/animate.css">
<link rel="stylesheet" href="/yidao/Public/static/css/icomoon.css">
<link rel="stylesheet" href="/yidao/Public/static/css/flexslider.css">
<link rel="stylesheet" href="/yidao/Public/static/css/style.css">

<link href="/yidao/Public/bootstrapall/css/docs.css" rel="stylesheet">
<link href="/yidao/Public/bootstrapall/css/onethink.css" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/yidao/Public/Admin/lib/bootstrap/css/datetimepicker.css">
    <link rel="stylesheet" href="/yidao/Public/Admin/lib/font-awesome/css/font-awesome.css">


	<script type="text/javascript" src="/yidao/Public/bootstrapall/js/jquery-3.1.0.min.js"></script> 
	<script src="/yidao/Public/Admin/lib/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/yidao/Public/Admin/lib/bootstrap/js/bootstrap-datetimepicker.zh-CN.js"></script>
	<script type="text/javascript" src="/yidao/Public/bootstrapall/js/bootstrap.js"></script>
	<script src="/yidao/Public/Admin/lib/bootstrap/js/bootstrap.js"></script>
<style type="text/css">
h1, h2, h3, h4, h5, h6{
  font-family: "Raleway","微软雅黑", Arial, sans-serif,"黑体";
}

.lia{
	padding-left: 16px !important;
    padding-right: 16px !important;
    padding-top: 7px !important;
    padding-bottom: 7px !important;
    border: 2px solid #27e1ce;
    color: #27E1CE;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    border-radius: 30px;
	transition: 0.2s;
}

</style>
<script type="text/javascript">

$(function () {
    $(".faq-tabbable").find("li").each(function () {
        var a = $(this).find("a:first")[0];
        if ($(a).attr("href") === location.pathname) {
            $(this).addClass("active");
        } else {
            $(this).removeClass("active");
        }
    });
})
</script>
</head>
<body >
		<header id="fh5co-header" role="banner">
			<div class="container">
				<div class="header-inner">
					<h1>
						一道科技
					</h1>
					<nav role="navigation">
						 <ul>
								<li <?php if($titleli == 'index' ): ?>class='active'<?php endif; ?>>
								<a href="<?php echo U('Index/index');?>">首页</a></li>
								<li <?php if($titleli == 'about' ): ?>class='active'<?php endif; ?>>
								<a href="<?php echo U('Index/about');?>">公司简介</a></li>
								<li <?php if($titleli == 'news' ): ?>class='active'<?php endif; ?>>
								<a href="<?php echo U('Index/news');?>">公司动态</a></li>
								<li <?php if($titleli == 'contact' ): ?>class='active'<?php endif; ?>>
								<a href="<?php echo U('Index/contact');?>">联系我们</a></li>
							<!--	<li><a class="lia" style="color:#27E1CE;" href="<?php echo U('Index/login');?>">会员登录</a></li>
							<?php if(S('user') == null): else: ?> 
								<li><a href="<?php echo U('Home/ycar');?>">我要约车</a></li>
								<li><a href="<?php echo U('Home/test');?>">测试</a></li>
	                            <li ><a href="<?php echo U('Home/selfCenter');?>" >我的订单</a></li>
								<div class="dropdown pull-right">  
									<li ><a href="#" class="lia" style="color:#27E1CE;" data-toggle="dropdown" ><?php echo S('user')['username'];?> <b class="caret"></b></a>
										<ul class="dropdown-menu " style="min-width:120px" >
	                                		<li ><a href="<?php echo U('Home/selfCenter');?>" >个人中心</a></li>
	                                		<li ><a href="<?php echo U('Home/logout');?>" >注销登录</a></li>
	                            		</ul>
									</li>
								</div><?php endif; ?>-->
						</ul> 
					</nav>
				</div>
			</div>
		</header>
 	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
		   	<li style="background-image: url(/yidao/Public/static/images/01.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<h2>一道约车  相约一道出行</h2>
		   					<br/>
		   					<p><a class="btn btn-primary btn-lg">一起</a></p>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url(/yidao/Public/static/images/02.jpg);">
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<h2>一道陪你走过灿烂的旅途</h2>
		   					<br/>
		   					<p><a href="#" class="btn btn-primary btn-lg">陪伴</a></p>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url(/yidao/Public/static/images/03.jpg);">
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<h2>一道享受不一样的人生</h2>
		   					<br/>
		   					<p><a href="#" class="btn btn-primary btn-lg">畅享</a></p>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>
	
	
	<div id="fh5co-pricing-section" class="fh5co-light-grey-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>一道走起</h2>
					<p> </p>
				</div>
			</div>
			<div class="row">
				<div class="pricing">

					<div class="col-md-3 animate-box">
						<div class="price-box">
							<div class="price"><sup class="currency">绿色行</sup><small></small></div>
							<p>环保节能、减缓交通压力、促进人与人之间信任，文明交通、推动绿色出行、人人关注环境保护，顺风车一道走起。 </p>
							<a href="#" class="btn btn-select-plan btn-sm">顺风车</a>
						</div>
					</div>

					<div class="col-md-3 animate-box">
							<div class="price-box popular">
							<div class="price"><sup class="currency">任选车</sup><small></small></div>
							<p>快速响应您的用车需求，高效完成您的出行规划；各个车型随你选，安全舒适，公司接待，居家出行，让轻松和惬意一道伴随。 </p>
							<a href="#" class="btn btn-select-plan btn-sm">专车</a>
						</div>
					</div>

					<div class="col-md-3 animate-box">
						<div class="price-box">
							<div class="price"><sup class="currency">任选线</sup><small></small></div>
							<p>从一地直达某一地，一个城市直达另一城市，全程接送，不用担心来回倒车的烦恼，不用担心路线不熟，一道一站式服务。 </p>
							<a href="#" class="btn btn-select-plan btn-sm">专线车</a>
						</div>
					</div>
					<div class="col-md-3 animate-box">
						<div class="price-box popular">
							<div class="price"><sup class="currency">当天达</sup><small></small></div>
							<p>每天准时发车、准点到达，城与城之间定时，定价，定车次，像火车一样行驶并准点到达，让货物直达指定地点</p>
							<a href="#" class="btn btn-select-plan btn-sm">城际快递</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	<div id="fh5co-services-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>平台优势</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class=""></i>
						<div class="desc">
							<h3>安全可靠</h3>
							<p>实名认证车主驾照、行驶证、车辆牌照及保险信息等；平台实时监控拼车环节；严格监控车主行为，拒绝黑车。</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class=""></i>
						<div class="desc">
							<h3>经济实惠</h3>
							<p>根据运行成本，分摊制定拼车费用标准，费用远低于打车价格，节省费用开支。分摊成本、共享优惠。</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class=""></i>
						<div class="desc">
							<h3>轻松出行</h3>
							<p>预约即享专座，不会出现拥挤现象，从出发点到目的地，全程接送，享受快乐并从中交朋结友。</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 
    <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >企业网站模板</a></div>
	
	<div id="fh5co-work-section" class="fh5co-light-grey-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>Latest Projects</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 animate-box">
					<a href="#" class="item-grid text-center">
						<div class="image" style="background-image: url(images/image_1.jpg)"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">Geographical App</h3>
								<h5 class="category">Web Application</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 animate-box">
					<a href="#" class="item-grid text-center">
						<div class="image" style="background-image: url(images/image_2.jpg)"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">Geographical App</h3>
								<h5 class="category">User Interface</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 animate-box">
					<a href="#" class="item-grid text-center">
						<div class="image" style="background-image: url(images/image_3.jpg)"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">Geographical App</h3>
								<h5 class="category">Branded</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 animate-box">
					<a href="#" class="item-grid text-center">
						<div class="image" style="background-image: url(images/image_4.jpg)"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">Geographical App</h3>
								<h5 class="category">Web</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 animate-box">
					<a href="#" class="item-grid text-center">
						<div class="image" style="background-image: url(images/image_5.jpg)"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">Geographical App</h3>
								<h5 class="category">Illustration</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 animate-box">
					<a href="#" class="item-grid text-center">
						<div class="image" style="background-image: url(images/image_6.jpg)"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">Geographical App</h3>
								<h5 class="category">Web Application</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-12 text-center animate-box">
					<p><a href="#" class="btn btn-primary with-arrow">View More Projects <i class="icon-arrow-right"></i></a></p>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-testimony-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>Clients Feedback</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-offset-0 to-animate">
					<div class="wrap-testimony animate-box">
						<div class="owl-carousel-fullwidth">
							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="/yidao/Public/static/images/person1.jpg" alt="user">
									</figure>
									<blockquote>
										<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."</p>
									</blockquote>
									<span>Athan Smith, via <a href="#" class="twitter">Twitter</a></span>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="/yidao/Public/static/images/person2.jpg" alt="user">
									</figure>
									<blockquote>
										<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."</p>
									</blockquote>
									<span>Nathalie Kosley, via <a href="#" class="twitter">Twitter</a></span>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="/yidao/Public/static/images/person3.jpg" alt="user">
									</figure>
									<blockquote>
										<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."</p>
									</blockquote>
									<span>Yanna Kuzuki, via <a href="#" class="twitter">Twitter</a></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="fh5co-blog-section" class="fh5co-light-grey-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>Recent from Blog</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 animate-box">
					<a href="#" class="item-grid">
						<div class="image" style="background-image: url(images/image_1.jpg)"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">We Create Mobile App</h3>
								<h5 class="date"><span>June 23, 2016</span> | <span>4 Comments</span></h5>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6 col-sm-6 animate-box">
					<a href="#" class="item-grid">
						<div class="image" style="background-image: url(images/image_2.jpg)"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">Geographical App</h3>
								<h5 class="date"><span>June 22, 2016</span> | <span>10 Comments</span></h5>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-12 text-center animate-box">
					<p><a href="#" class="btn btn-primary with-arrow">View More Post <i class="icon-arrow-right"></i></a></p>
				</div>
			</div>
		</div>
	</div>
	<div id="fh5co-pricing-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>Pricing</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
				</div>
			</div>
			<div class="row">
				<div class="pricing">
					<div class="col-md-3 animate-box">
						<div class="price-box">
							<h2 class="pricing-plan">Starter</h2>
							<div class="price"><sup class="currency">$</sup>9<small>/month</small></div>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
							<a href="#" class="btn btn-select-plan btn-sm">Select Plan</a>
						</div>
					</div>

					<div class="col-md-3 animate-box">
						<div class="price-box">
							<h2 class="pricing-plan">Basic</h2>
							<div class="price"><sup class="currency">$</sup>27<small>/month</small></div>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
							<a href="#" class="btn btn-select-plan btn-sm">Select Plan</a>
						</div>
					</div>

					<div class="col-md-3 animate-box">
						<div class="price-box popular">
							<h2 class="pricing-plan pricing-plan-offer">Pro <span>Best Offer</span></h2>
							<div class="price"><sup class="currency">$</sup>74<small>/month</small></div>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
							<a href="#" class="btn btn-select-plan btn-sm">Select Plan</a>
						</div>
					</div>

					<div class="col-md-3 animate-box">
						<div class="price-box">
							<h2 class="pricing-plan">Unlimited</h2>
							<div class="price"><sup class="currency">$</sup>140<small>/month</small></div>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
							<a href="#" class="btn btn-select-plan btn-sm">Select Plan</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
	-->

	<div class="fh5co-cta" style="background-image: url(images/slide_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="col-md-12 text-center animate-box">
				<h1 style="color:white;">一道约车    相约一道出行</h1>
			</div>
		</div>
	</div>



	
	<script src="/yidao/Public/Admin/lib/bootstrap/js/bootstrap.js"></script>
	<script src="/yidao/Public/yidao/js/mydate.js"></script>
	<footer id="fh5co-footer" class="">
	
		<div class="container">
			<div class="col-md-6  col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
				<h3>关于我们</h3>
				<ul class="float">
					<li><a href="#">公司地址：洛阳市西工区升龙广场A座11-3-1601</a></li>
					<li><a href="#">联系电话：400-159-0699</a></li>
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
				</ul>
				<ul class="float">
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
				</ul>

			</div>
			<div class="col-md-6  col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
				<h3>产品服务</h3>
				<ul class="float">
					<li><a href="#">软件应用开发服务</a></li>
					<li><a href="#">网络约车服务</a></li>
					
				</ul>
				<ul class="float">
					<li><a href="#">汽车租赁服务</a></li>
					<li><a href="#">拼车服务</a></li>
				<!-- 	<li><a href="#">Free HTML5 &amp; CSS3 Template</a></li>
					<li><a href="#">HandCrafted Templates</a></li> -->
				</ul>

			</div>

			
			<div class="col-md-12 fh5co-copyright text-center">
				<p style="color: white;">&copy; 2016 河南一道科技公司. All Rights Reserved. <span>Designed with  河南一道科技研发部</span></p>	
			</div>
		</div>
	</footer>
</body>
</html>