<?php if (!defined('THINK_PATH')) exit();?>
<link rel="stylesheet" href="/yidao/Public/bootstrapall/css/bootstrap.css">
<script type="text/javascript" src="/yidao/Public/bootstrapall/js/jquery-3.1.0.min.js"></script> 
<script type="text/javascript" src="/yidao/Public/bootstrapall/js/bootstrap.js"></script>


<div>
<!--
/****************************************
本文件是【微信支付V2.0】JSAPI支付实例
需要用授权接口进入页面
****************************************/
-->

	<article class="charge">
		<h1>微信支付-H5-demo</h1>
		<section class="content">
				<h2>商品：测试商品。</h2>		
		  <ul class="select cf">
					<li><img src="weixin.jpg" style="width:150px;height:150px"></li>
				</ul>
				<p class="copy-right">亲，此商品不提供退款和发货服务哦</p>
				<div class="price">微信价：<strong>￥0.01元</strong></div>
				<div class="operation"><a class="btn-green" id="getBrandWCPayRequest" href="#">立即购买</a></div>
				<p class="copy-right">微信支付demo 由腾讯微信提供</p>
		</section>
	</article>


</div>
<script src="//wx.gtimg.com/wxpay_h5/fingerprint2.min.1.4.1.js"></script>
 <script type="text/javascript" src="../../css/zepto.min.js"></script>
    <script type="text/javascript">
                var fp=new Fingerprint2();
                fp.get(function(result)
{
$.getJSON("h5.json.php?code="+result, function(d){
    if(d.errmsg == ''){
        $('#getBrandWCPayRequest').attr("href",d.url);//+'&redirect_url=http%3a%2f%2fwxpay.    wxutil.com%2fmch%2fpay%2fh5jumppage.php
     }else{
      alert(d.errmsg);
                                
}
            
});                                                            
}
                  );
                </script>