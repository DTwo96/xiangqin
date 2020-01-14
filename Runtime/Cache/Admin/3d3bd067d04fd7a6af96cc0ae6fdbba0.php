<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="<?php echo U();?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
             
            <div class="tool-filter f-cb">
                <form action="<?php echo U();?>" method="post">
                    <input type="hidden" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
																<!--支付平台:  1.微信  2.支付宝-->
		<select name="payfrom" id="payfrom"  class="form-element "><option value="0" <?php if(0 == $pageMaps['payfrom']){ ?> selected="selected"  <?php } ?> >==充值平台==</option><option value="1" <?php if(1 == $pageMaps['payfrom']){ ?> selected="selected"  <?php } ?> >微信</option><option value="2" <?php if(2 == $pageMaps['payfrom']){ ?> selected="selected"  <?php } ?> >支付宝</option></select>
																<!--充值状态:  1.成功   2.审核   0.失败   4.超时-->
  		<select name="status" id="status"  class="form-element "><option value="0" <?php if(0 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >==充值状态==</option><option value="1" <?php if(1 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >成功</option><option value="2" <?php if(2 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >审核</option><option value="-1" <?php if(-1 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >失败</option><option value="4" <?php if(4 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >超时</option></select>	
  																<!--充值类型:  1.购买vip 2.充值-->
  		<select name="paytype" id="paytype"  class="form-element "><option value="0" <?php if(0 == $pageMaps['paytype']){ ?> selected="selected"  <?php } ?> >==充值类型==</option><option value="1" <?php if(1 == $pageMaps['paytype']){ ?> selected="selected"  <?php } ?> >购买vip</option><option value="2" <?php if(2 == $pageMaps['paytype']){ ?> selected="selected"  <?php } ?> >充值</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	
	
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>编号</th><th>用户id</th><th>用户昵称</th><th>所属代理</th><th>充值金额</th><th>充值平台</th><th>订单号</th><th>充值状态</th><th>充值类型</th><th>cid</th><th>充值时间</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>	
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo['uid']); ?></td>
				<td><?php echo ($niceName[$vo['uid']]); ?></td>
                <td><?php echo ($pniceName[$vo['parent_id']]); ?></td>
				<!--<td><?php if($vo['sex'] == 1): ?>男<?php elseif($vo['sex'] == 2): ?>女<?php endif; ?></td>-->
				<td><?php echo ($vo["fee"]); ?></td>
				<td>
					<!--支付平台:  1微信，2支付宝-->
					<?php if($vo['payfrom'] == 1): ?>微信<?php elseif($vo['payfrom'] == 2): ?>支付宝<?php endif; ?>
				</td>
				<td><?php echo ($vo["out_trade_no"]); ?></td>
				
				<td>
					<!--充值状态:  1成功2审核0失败4超时-->
					<?php if($vo['status'] == 1): ?>成功
					<?php elseif($vo['status'] == 2): ?>审核
					<?php elseif($vo['status'] == 0): ?>失败
					<?php elseif($vo['status'] == 4): ?>超时<?php endif; ?>
				</td>
				<td>
					<!--充值类型:  1，购买vip 2,充值'-->
					<?php if($vo['paytype'] == 1): ?>购买vip<?php elseif($vo['paytype'] == 2): ?>充值<?php endif; ?>
				</td>
				<td><?php echo ($vo["cid"]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
			</tr><?php endforeach; endif; ?></tbody></table></div>
	<div class="m-table-bar">
            <div class="bar-pages">
              <div class="m-page">
                <?php echo ($page); ?>
              </div>
            </div>
            <div class="f-cb"></div>
        </div>
            </div> </div>


<script>
	Do.ready('base',function() {
		//左下角的选择操作      
		$('#selectAction').change(function() {
			var type = $(this).val();
		});
		
		$('#table').duxTable({
//			actionUrl: "<?php echo U('Admin/Audit/batchAction');?>", //批量操作
			deleteUrl: "<?php echo U('');?>", //单条删除
			actionParameter: function() {
				return {
					'class_id': $('#selectAction').next('#class_id').val()
				};
			}
		});
	});
</script>