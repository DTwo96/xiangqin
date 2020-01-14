<?php if (!defined('THINK_PATH')) exit();?>
<?php if(!$list): ?><li class="cb zanwu"></li>
<?php else: ?>			
	<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li class="cb">
		    <div class="fl"><p class="vip_chouzhiqulu"><?php echo ($vo["desc"]); ?></p><p class="vip_date"><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></p></div>
		    <div class="fr vip_money"><?php echo ($vo["money"]); ?></div>
		</li><?php endforeach; endif; endif; ?>	
<script type="text/javascript" src="js/common.js"></script>
<script>
	zhuanwu();
</script>