<?php if (!defined('THINK_PATH')) exit();?><h3>虚拟礼物列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>编号</th><th width="250">名称</th><th width="180">图片</th><th>价格(<?php echo ($config["money_name"]); ?>)</th><th>返利点（女）</th><th><?php echo ($config["jifen_name"]); ?>/<?php echo ($config["jifen_name_nv"]); ?></th><th>亲密度</th><th>上架状态</th><th>创建时间</th><th width="120">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
      	<td><?php echo ($vo["gift_id"]); ?></td>
        <td><?php echo ($vo["gift_name"]); ?></td>
        <td><img src="<?php echo ($vo["images"]); ?>" style="width: 90px;height: 60px;border: none;" /></td>
        <td><?php echo ($vo["price"]); ?></td>
        <td><?php echo ($vo["rebate"]); ?></td>
        <td><?php echo ($vo["jifen"]); ?></td>
        <td><?php echo ($vo["qmd"]); ?></td>
        <td><?php if($vo['status'] == 0): ?><span style="color: red;">已下架</span> <?php else: ?> <span style="color: darkgreen">上架中</span><?php endif; ?></td>
        <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
        <td>
	        <a class="u-btn u-btn-primary u-btn-small"     href="<?php echo U('edit',array('gift_id'=>$vo['gift_id']));?>">修改</a>
	        <a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["gift_id"]); ?>" >删除</a>        	
        </td>
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
	$('#table').duxTable({
		deleteUrl: "<?php echo U('del');?>",
	});
});
</script>