<?php if (!defined('THINK_PATH')) exit();?>  <div class="g-col-2-1">
    <div class="m-panel">
  	<div class="panel-header">统计表</div>
      <div class="m-table-mobile">
	   <div style="width:98%; height: 100%; padding: 10px; overflow: auto;" id="tongjitext">
	   <table class="m-table">
	   <thead>
	   <tr align="center" style="background-color:skyblue">
	   <td>
	   </td>
	   <td>男性</td>
	   <td>女性</td>
	   <td>总数</td>

	   </tr>
	   </thead>
	   <tbody>
	   <tr align="center">
	   <td>普通会员</td>
	   <td><a href="<?php echo U('Admin/User/index',array('sex'=>1));?>"><?php echo ((isset($info["manUser"]) && ($info["manUser"] !== ""))?($info["manUser"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/User/index',array('sex'=>2));?>"><?php echo ((isset($info["girlUser"]) && ($info["girlUser"] !== ""))?($info["girlUser"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/User/index');?>"><?php echo ((isset($info["UserCount"]) && ($info["UserCount"] !== ""))?($info["UserCount"]):"0"); ?></a></td>

	   </tr>
	      <tr align="center">
	   <td>vip</td>
	   <td><a href="<?php echo U('Admin/User/index',array('sex'=>1,'vip'=>1));?>"><?php echo ((isset($info["manVip"]) && ($info["manVip"] !== ""))?($info["manVip"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/User/index',array('sex'=>2,'vip'=>1));?>"><?php echo ((isset($info["girlVip"]) && ($info["girlVip"] !== ""))?($info["girlVip"]):"0"); ?></a></td>	   
	   <td><a href="<?php echo U('Admin/User/index',array('vip'=>1));?>"><?php echo ((isset($info["VIPCount"]) && ($info["VIPCount"] !== ""))?($info["VIPCount"]):"0"); ?></a></td>
	   </tr>
	   
	      <tr align="center">
	   <td>当天新增(普通会员)</td>
	   <td><a href="<?php echo U('Admin/User/index',array('sex'=>1));?>"><?php echo ((isset($info["manUserDay"]) && ($info["manUserDay"] !== ""))?($info["manUserDay"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/User/index',array('sex'=>2));?>"><?php echo ((isset($info["girlUserDay"]) && ($info["girlUserDay"] !== ""))?($info["girlUserDay"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/User/index');?>"><?php echo ((isset($info["UserCountDay"]) && ($info["UserCountDay"] !== ""))?($info["UserCountDay"]):"0"); ?></a></td>

	   </tr>
	      <tr align="center">
	   <td>当天新增(vip)</td>
	   <td><a href="<?php echo U('Admin/User/index',array('sex'=>1,'vip'=>1));?>"><?php echo ((isset($info["manVipDay"]) && ($info["manVipDay"] !== ""))?($info["manVipDay"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/User/index',array('sex'=>2,'vip'=>1));?>"><?php echo ((isset($info["girlVipDay"]) && ($info["girlVipDay"] !== ""))?($info["girlVipDay"]):"0"); ?></a></td>	   
	   <td><a href="<?php echo U('Admin/User/index',array('vip'=>1));?>"><?php echo ((isset($info["VIPCountDay"]) && ($info["VIPCountDay"] !== ""))?($info["VIPCountDay"]):"0"); ?></a></td>
	   </tr>
	   
	   <tr align="center" style="background-color:skyblue"><td>
	   </td>
	   <td>待审核昵称</td>
	   <td>待审核头像</td>
	   <td>待审核相册</td>

	   </tr>
	   <tr align="center">
	   <td rowspan="2">待审核</td>
	   <td><a href="<?php echo U('Admin/Audit/AuditNickname',array('status'=>-1,'iscount'=>1));?>"><?php echo ((isset($info["nicknameFlag"]) && ($info["nicknameFlag"] !== ""))?($info["nicknameFlag"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/Audit/AuditAvatar',array('status'=>-1,'iscount'=>1));?>"><?php echo ((isset($info["avatarFlag"]) && ($info["avatarFlag"] !== ""))?($info["avatarFlag"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/User/userPhotoFlag',array('flag'=>-1,'iscount'=>1));?>"><?php echo ((isset($info["photoFlag"]) && ($info["photoFlag"] !== ""))?($info["photoFlag"]):"0"); ?></a></td>

	   </tr>
	    <tr align="center">
	   <td></td>
	   <td>待审核评论：<a href="<?php echo U('Admin/CommentManage/index',array('flag'=>-1,'iscount'=>1));?>"><?php echo ((isset($info["commentFlag"]) && ($info["commentFlag"] !== ""))?($info["commentFlag"]):"0"); ?></a></td>
	   <td>待审核内心独白：<a href="<?php echo U('Admin/Audit/AuditMonolog',array('status'=>-1,'iscount'=>1));?>"><?php echo ((isset($info["monoFlag"]) && ($info["monoFlag"] !== ""))?($info["monoFlag"]):"0"); ?></a></td>
	   <td></td>
	   <td></td>
	   <td></td>
	   </tr>
	   
	   <tr align="center" style="background-color:skyblue"><td>
	   </td>
	   <td>提现待审核</td>
	   <td>待提现总金额</td>
	   <td>已提现总金额</td>
	   </tr>
	   <tr align="center">
	   <td>提现</td>
	   <td><a href="<?php echo U('Admin/Moeny/index',array('status'=>2));?>"><?php echo ((isset($info["txFlag"]) && ($info["txFlag"] !== ""))?($info["txFlag"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/Moeny/index',array('status'=>2));?>"><?php echo ((isset($info["txFee"]) && ($info["txFee"] !== ""))?($info["txFee"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/Moeny/index',array('status'=>1));?>"><?php echo ((isset($info["txTotalFee"]) && ($info["txTotalFee"] !== ""))?($info["txTotalFee"]):"0"); ?></a></td>
	   </tr>
	  
	    <tr align="center" style="background-color:skyblue"><td>
	   </td>
	   <td>vip</td>
	   <td>充值</td>
	   <td>总收入</td>
	   </tr>
	   <tr align="center">
	   <td>收入</td>
	   <td><a href="<?php echo U('Admin/RechargeLog/index');?>"><?php echo ((isset($info["vipMoney"]) && ($info["vipMoney"] !== ""))?($info["vipMoney"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/RechargeLog/index');?>"><?php echo ((isset($info["chongMoney"]) && ($info["chongMoney"] !== ""))?($info["chongMoney"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/RechargeLog/index');?>"><?php echo ((isset($info["MoneyCount"]) && ($info["MoneyCount"] !== ""))?($info["MoneyCount"]):"0"); ?></a></td>
	   </tr>
	    <tr align="center">
	     <td>当天收入</td>
	   <td><a href="<?php echo U('Admin/RechargeLog/index');?>"><?php echo ((isset($info["vipMoneyDay"]) && ($info["vipMoneyDay"] !== ""))?($info["vipMoneyDay"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/RechargeLog/index');?>"><?php echo ((isset($info["chongMoneyDay"]) && ($info["chongMoneyDay"] !== ""))?($info["chongMoneyDay"]):"0"); ?></a></td>
	   <td><a href="<?php echo U('Admin/RechargeLog/index');?>"><?php echo ((isset($info["MoneyCountDay"]) && ($info["MoneyCountDay"] !== ""))?($info["MoneyCountDay"]):"0"); ?></a></td>
	   </tr>

	   </tbody>
	   </table>
	   </div>   
      </div>
    </div>
  </div>