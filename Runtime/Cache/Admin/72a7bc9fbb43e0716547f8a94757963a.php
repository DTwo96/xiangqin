<?php if (!defined('THINK_PATH')) exit();?><h3>亲密度列表</h3>

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
                    <!--1相互关注2送礼3聊天-->
  		<select name="type" id="type"  class="form-element "><option value="0" <?php if(0 == type){ ?> selected="selected"  <?php } ?> >==状态==</option><option value="1" <?php if(1 == type){ ?> selected="selected"  <?php } ?> >相互关注</option><option value="2" <?php if(2 == type){ ?> selected="selected"  <?php } ?> >送礼</option><option value="3" <?php if(3 == type){ ?> selected="selected"  <?php } ?> >聊天</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th width="200">编号</th><th width="250">发起变化人</th><th width="250">亲密度值</th><th>亲密度变化的好友</th><th>变化描述</th><th>关注时间</th><th width="120">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($userNicename[$vo['fromuid']]); ?></td>
				<td><?php echo ($vo["fee"]); ?></td>
				<td><?php echo ($userNicename[$vo['uid']]); ?></td>
				<td><?php echo ($vo["desc"]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
				<td>
					<a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">删除</a>
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
		//表格处理
		$('#table').duxTable({
			deleteUrl: "<?php echo U('del');?>",
		});
	});
</script>