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
		<script type="text/javascript" src="js/common.js"></script>
		
		
	</head>
	<style type="text/css">
           .fx_header {
              position: fixed;
              top: 0px;
                }
     </style>

<body>

		<div class="hd_main" style="background: #fff;">
		<div style="height:40px;display:none ;" class="appdiv fx_header_new"></div>
  <!--#include file="app_share.html"-->
			<div class="fujinderen_header">
				提现
				<a href="javascript:history.go(-1);" class="fl" id="ddd"><img src="images/zuojian.png" style="width:11px;">返回</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<p class="tixianyuer">余额: <span><?php echo ((isset($info["money"]) && ($info["money"] !== ""))?($info["money"]):"0"); ?></span><img src="images/jinqian.png" alt=""> </p>
			<p class="tixianyuer2">最低提现金额<span><?php echo ($config["tx_qt_money"]); ?></span>元(1元=<?php echo ($config["moneyBL"]); echo ($config["money_name"]); ?>)</p>
			<div class="tixianqundao cb">
				
				<?php if($config['open_tx_wx'] == 1): ?><a  data="1"><img src="images/wxzf.png" alt=""><img src="images/hot1.png"></a><?php endif; ?>
				<?php if($config['open_tx_zfb'] == 1): ?><a data="2"><img src="images/zfb.png" alt=""><img src="images/hot1.png"></a><?php endif; ?>
				<?php if($config['open_tx_hf'] == 1): ?><a data="3"><img src="images/sjzf.png" alt=""><img src="images/hot1.png"></a><?php endif; ?>
                
			</div>
           
			<!-- 切换 -->
			<div>
				<?php if($config['open_tx_wx'] == 1): ?><div class="tixianqundao_nav" style="display:none">
					<p class="tishi1">系统会自动发红包到您的微信，请注意查收</p>
					<input type="text" id="dog1" name="money" class="input_tixian" placeholder="可提现金额<?php echo ($info["tmoney"]); ?>元">
					<input type="button"   class="input_button_new mtb10" onclick="tixian(1)" value="申请提现">
				</div><?php endif; ?>
				<?php if($config['open_tx_zfb'] == 1): ?><div class="tixianqundao_nav" style="display:none">
					<p class="tishi1">请正确填写支付宝账号，避免提现出现问题</p>
					<input type="text"  class="input_tixian" name="zfb_account" value="<?php echo ($zfbInfo["zfb_account"]); ?>" placeholder="请输入支付宝账号">
					<input type="text"  class="input_tixian mt10" name="zfb_lxr" value="<?php echo ($zfbInfo["zfb_lxr"]); ?>" placeholder="请输入收款人姓名">
					<input type="text"   class="input_tixian mt10" name="zfb_money" placeholder="可提现金额<?php echo ($info["tmoney"]); ?>元">
					<input type="button" class="input_button_new mtb10" onclick="tixian(2)" value="申请提现">
				</div><?php endif; ?>
				<?php if($config['open_tx_hf'] == 1): ?><div class="tixianqundao_nav" style="display:none">
					<p class="tishi1">请正确填写手机号码，避免话费充值出现问题</p>
					<input type="text" class="input_tixian" name="mob" value="<?php echo ($MobInfo); ?>" placeholder="请输入需要充值的手机号码">
					<div class="huaifei">
						<ul class="cb">
							<li class="hot" data="30"><span>30</span>元</li>
							<li data="50"><span>50</span>元</li>
							<li data="100"><span>100</span>元</li>
							<li data="200"><span>200</span>元</li>
							<li data="300"><span>300</span>元</li>
							<li data="500"><span>500</span>元</li>
						</ul>
					</div>
					<input type="button" class="input_button_new mtb10" onclick="tixian(3)" value="充值话费">
				</div><?php endif; ?>
			</div>
			<!-- 切换 -->
			<br><br><br><br><br>

			<!--#include file="footer.html"-->
		</div>
		<script type="text/javascript">
			$(".tixianqundao a").click(function() {
				var index = $(this).index();
				$(".tixianqundao a").removeClass("hot").eq(index).addClass("hot");
				$(".tixianqundao_nav").hide().eq(index).show();
				$('input[name="type"]').val($(this).attr('data'));
			})
			$(".huaifei ul li").click(function() {
				var index = $(this).index();
				$(".huaifei ul li").removeClass("hot").eq(index).addClass("hot");
			})
			
		    $(function(){
		    	$(".tixianqundao a").eq(0).addClass("hot");
		    	
		    	$('.tixianqundao_nav').eq(0).css('display','block');
		    	
		    })	
		
			
		</script>
		
		<script type="text/javascript">
		
		
			function tixian(type){
				
				var cantx = Number('<?php echo ((isset($info["money"]) && ($info["money"] !== ""))?($info["money"]): "0"); ?>'); //用户能提现的金额(钱包里的钱) 
				var menkan = Number('<?php echo ($config["tx_qt_money"]); ?>'); //提现的最低门槛
				var o_money = $('.tixianyuer span');
				var b_money = Number('<?php echo ($config["moneyBL"]); ?>');
				
				
				var data = {type:type};
				if(type==0){
					alertmsg('请选择提现方式！');
					return false;
				}
				
				switch(type){
				  case 1:
				  var money = parseInt($('input[name="money"]').val()); //用户想提现的金额
				   break;
				   case 2:
				   var money = parseInt($('input[name="zfb_money"]').val()); //用户想提现的金额
				   var zfb_account = $('input[name="zfb_account"]').val();
				   var zfb_lxr = $('input[name="zfb_lxr"]').val();
				   if(zfb_account==""||zfb_account==null){
					   alertmsg('请输入支付宝账号');
					   return false;
				   }
                   if(zfb_lxr==""||zfb_lxr==null){
                    	 alertmsg('请输入收款人');
  					   return false;
				   }
                   data.zfb_account = zfb_account;
                   data.zfb_lxr = zfb_lxr;
				   break;
				   case 3:
				   var money = parseInt($('.huaifei ul li.hot').attr('data'));
				   var mob = $('input[name="mob"]').val();
				   if(mob==""||mob==null){
                  	 alertmsg('请输入手机号码');
					   return false;
				   }
				   if(!isDigit(mob)) {
			    	  	alertmsg('请输入正确手机号');
			    	  	return false;
			       	} 
				   data.mob = mob;
				   break;
				}
				data.money = money;

				 if(money >= menkan){  // 能提现的金额大于想提现的金额					
					if(money > cantx){
							alertmsg("您的余额不足");
							return false;
						}
						setDisabled($(".input_button_new"),'提交中');
	
							$.ajax({
								type:"post",
								url:"<?php echo U('Home/User/tixian');?>",
								data:data,
								dataType:"json",
								success:function(data){
									unDisabled($('.input_button_new'),'申请提现');
									if(data.status==1){
									var ye = cantx -(money*b_money);
									o_money.text(ye);
									}
									alertmsg(data.info);
									//window.location.href="<?php echo U('Home/User/tixian');?>";
								}
							});	
							
					}else{
						alertmsg("提现金额必须大于起提金额"+ menkan +"元");
						return false;											
					}	
			
			}
		</script>
	</body>
</html>