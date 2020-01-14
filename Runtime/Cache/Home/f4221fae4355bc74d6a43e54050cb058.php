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
<style type="text/css">
       .fx_header {
              position: fixed;
              top: 0px;
                }
  </style>

<body>
 
  <div class="hd_main">
   <div style="height:40px;display:none ;" class="appdiv fx_header_new"></div>
  <!--#include file="app_share.html"-->
    <header class="hd_header">
    <div class="shouiyi">我的收益余额</div>
    <div class="jifen"><span><?php echo ((isset($money) && ($money !== ""))?($money):"0"); ?></span><?php echo ($config["money_name"]); ?></div>
    <div class="nav_hd nav_hd_to  bott_bor">
        <div class="fl"><?php echo ((isset($info["photofmoney"]) && ($info["photofmoney"] !== ""))?($info["photofmoney"]):"0"); ?><br>照片累计收益</div>
        <div class="fr"><?php echo ((isset($info["yqmoney"]) && ($info["yqmoney"] !== ""))?($info["yqmoney"]):"0"); ?><br>邀请累计收益</div>
        <p class="cb"></p>
    </div>
    <div class="nav_hd">
	   <?php if($uinfo["sex"] == 2): ?><div class="fl"><?php echo ((isset($info["ltfmoney"]) && ($info["ltfmoney"] !== ""))?($info["ltfmoney"]):"0"); ?><br>聊天累计收益</div>
			<?php else: ?>
        <div class="fl"><?php echo ((isset($info["ltmoney"]) && ($info["ltmoney"] !== ""))?($info["ltmoney"]):"0"); ?><br>聊天累计支出</div><?php endif; ?>
        <div class="fr"><?php echo ((isset($info["giftmoney"]) && ($info["giftmoney"] !== ""))?($info["giftmoney"]):"0"); ?><br>收礼累计收益</div>
        <p class="cb"></p>
    </div>
 </header>
 <div class="zijinbiandong">
      	<ul>
      		<li><a href="<?php echo U('MyMoneyLog',array('type'=>1));?>" class="cb"><span class="fl"><img src="images/shourumingxi.png"  alt="">收入明细</span> <span class="fr"><img src="images/youjianhei.png"></span></a></li>
      		<li><a href="<?php echo U('MyCostLog',array('type'=>1));?>" class="cb"><span class="fl"><img src="images/zhichumingxi.png"  alt="">支出明细</span> <span class="fr"><img src="images/youjianhei.png"></span></a></li>
      		<li><a href="<?php echo U('MyCreditLog');?>" class="cb"><span class="fl"><img src="images/vipchouzjhijilu.png" alt="">VIP充值记录</span> <span class="fr"><img src="images/youjianhei.png"></span></a></li>
      	</ul>
      </div>
      
	     <!--#include file="footer.html"-->  
  </div>


</body>

</html>