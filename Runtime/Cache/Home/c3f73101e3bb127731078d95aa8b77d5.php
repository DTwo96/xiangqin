<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta content="black" name="apple-mobile-web-app-status-bar-style">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
		<title><?php echo ($media["title"]); ?></title>
		<link rel="stylesheet" type="text/css" href="css/css.css">
		<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	</head>



	<body>
		<div class="zhuce">
		<!--#include file="app_share.html"-->
			<div class="zhuce_a">
				<p><img src="images/yingdao_logo.png" alt=""><?php echo C("site_title");?></p>
				<p><?php echo C("site_subtitle");?></p>
			</div>

			<div class="zhuce_b">
				<div class="baikuang"><input type="text" id="mob" placeholder="请输入手机号" maxlength="11"></div>
				<div class="baikuang"><input type="password" id="pass" placeholder="请输入6到16位密码"></div>
				<div class="wangji cb"> <a href="<?php echo U('index');?>" class="fl">立即注册</a><a href="<?php echo U('Home/Public/getpwd');?>" class="fr">忘记密码？</a></div>
				<a href="javascript:;" id="ljlogin">立即登录</a>
				<div class="weixinlogin">
					<?php if($iswx): ?><span></span><span></span> 社交账号登录
		            <p class="weixinlogin_A">
						<a href="<?php echo U('dowxlogin');?>"><img src="images/weilogin_03.png" alt=""></a>
					</p><?php endif; ?>      		
					
					
				</div>
			</div>

		</div>
		<script type="text/javascript">
	var pimuheight = $(window).height();
    $(".zhuce").css('height',pimuheight);
</script>
		<script type="text/javascript">
			$(function() {
				$("#ljlogin").click(function() {
					var pass = $("#pass").val();
					$.post("<?php echo U('Ajax/login');?>",{
						mob: $("#mob").val(),
						pass: pass
					}, function(data) {
						if (data.status == 1) {
							window.location.href = '<?php echo U("Index/index");?>';
						} else {
							alert(data.info);
						}
					}, 'json');
				});
			})
		</script>

	</body>

</html>