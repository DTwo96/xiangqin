<?php if (!defined('THINK_PATH')) exit();?><h3>自动任务列表</h3>

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
                    <!--  1 马甲招呼     2 未读私信提醒        -->
		<input type="hidden" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
  		<select name="type" id="type"  class="form-element "><option value="0" <?php if(0 == 0){ ?> selected="selected"  <?php } ?> >==状态==</option><option value="1" <?php if(1 == 0){ ?> selected="selected"  <?php } ?> >马甲招呼</option><option value="2" <?php if(2 == 0){ ?> selected="selected"  <?php } ?> >未读私信提醒</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>选择</th><th>编号</th><th>昵称</th><th>内容</th><th>类型</th><th>对方昵称</th><th>评论</th><th>时间</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
				<td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /></td>			
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($niceName[$vo['uid']]); ?>（<?php echo ($vo["uid"]); ?>）</td>
				<td><?php echo ($vo["text"]); ?></td>
				<td>
					<?php if($vo['type'] == 1 ): ?>马甲招呼
					<?php elseif($vo['type'] == 2 ): ?>未读私信提醒<?php endif; ?>
				</td>
				<td><?php echo ($niceName[$vo['touid']]); ?>（<?php echo ($vo["touid"]); ?>）</td>
				<td><?php echo ($vo["remark"]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
				<td><a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">删除</a></td>
			</tr><?php endforeach; endif; ?></tbody></table></div>
	<div class="m-table-bar">
            <div class="bar-action">
            <a class="u-btn u-btn-primary" href="javascript:;" id="selectAll">选择</a>
             <select name="selectAction" id="selectAction" class="form-element"><option value="1">删除</option></select>  
            <a class="u-btn u-btn-success" href="javascript:;" id="selectSubmit">执行</a>
            </div>
            <div class="bar-pages">
              <div class="m-page">
                <?php echo ($page); ?>
              </div>
            </div>
            <div class="f-cb"></div>
        </div>
            </div> </div>
<script>
	Do.ready('base', function() {
		$('#selectAction').change(function() {
			var type = $(this).val();
		});
		//表格处理
		$('#table').duxTable({
			actionUrl: "<?php echo U('Admin/Autotask/batchAction');?>", //批量操作
			deleteUrl: "<?php echo U('Admin/Autotask/del');?>", //单条删除
			actionParameter: function() {
				return {
					'class_id': $('#selectAction').next('#class_id').val()
				};
			}
		});
	});
</script>