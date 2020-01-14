<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>记录列表</h3>

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
                    <select name="gender" id="gender"  class="form-element "><option value="0" <?php if(0 == $pageMaps['gender']){ ?> selected="selected"  <?php } ?> >==性别==</option><option value="1" <?php if(1 == $pageMaps['gender']){ ?> selected="selected"  <?php } ?> >男</option><option value="2" <?php if(2 == $pageMaps['gender']){ ?> selected="selected"  <?php } ?> >女</option></select>
																 <!--3 收礼物变动 4被关注女 5邀请好友男 201购买VIP获得-->
  		<select name="type" id="type"  class="form-element "><option value="0" <?php if(0 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >==类型==</option><option value="3" <?php if(3 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >收礼物</option><option value="4" <?php if(4 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >被关注</option><option value="5" <?php if(5 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >邀请好友</option><option value="201" <?php if(201 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >购买VIP</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	
	
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>编号</th><th>用户id</th><th>用户昵称</th><th>性别</th><th><?php echo ($name); ?>值</th><th>变动详情</th><th>时间</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>					
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo['uid']); ?></td>
				<td><?php echo ($niceName[$vo['uid']]); ?></td>
				<td><?php if($vo['sex'] == 1): ?>男<?php elseif($vo['sex'] == 2): ?>女<?php endif; ?></td>
				<td><?php echo ($vo["jifen"]); ?></td>
				<td><?php echo ($vo["desc"]); ?></td>				
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
	});
</script>