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
																<!--0待审核 1通过 -->
  		<select name="flag" id="flag"  class="form-element "><option value="0" <?php if(0 == $pageMaps['flag']){ ?> selected="selected"  <?php } ?> >==状态==</option><option value="-1" <?php if(-1 == $pageMaps['flag']){ ?> selected="selected"  <?php } ?> >待审核</option><option value="1" <?php if(1 == $pageMaps['flag']){ ?> selected="selected"  <?php } ?> >通过</option><option value="2" <?php if(2 == $pageMaps['flag']){ ?> selected="selected"  <?php } ?> >未通过</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>选择</th><th>编号</th><th>照片ID</th><th>评论照片</th><th>评论人</th><th>评论内容</th><th>审核状态</th><th>该评论的点赞数</th><th>评论时间</th><th width="200">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
				<td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /></td>			
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["photoid"]); ?></td>
				<td><img src="<?php echo ($image[$vo['photoid']]); ?>" style="width: 120px;height: 80px;" /></td>
				<td><?php echo ($result[$vo['uid']]); ?>  (<?php echo ($vo['uid']); ?>)</td>
				<td><?php echo ($vo["content"]); ?></td>				
				<td>
					<?php if($vo['flag'] == 1 ): ?><span style="color: darkcyan;"> 已通过 </span>
					<?php elseif($vo['flag'] == 0 ): ?><span style=" color: crimson ;"> 待审核 </span>
					<?php elseif($vo['flag'] == 2 ): ?><span style=" color: red ;"> 未通过 </span><?php endif; ?>
				</td>
				<td><?php echo ($vo["zan"]); ?></td>							
				<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
				<td>
					<?php if($vo['flag'] == 0 ): ?><span>
							<a class="u-btn u-btn-primary u-btn-small" dataType="1" uid="<?php echo ($vo['uid']); ?>" data="<?php echo ($vo['id']); ?>"> 通过   </a>
							<a class="u-btn u-btn-primary u-btn-small" dataType="2" uid="<?php echo ($vo['uid']); ?>" data="<?php echo ($vo['id']); ?>"> 不通过   </a>
						</span><?php endif; ?>
					<a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">删除</a>
				</td>
			</tr><?php endforeach; endif; ?></tbody></table></div>
	<div class="m-table-bar">
            <div class="bar-action">
            <a class="u-btn u-btn-primary" href="javascript:;" id="selectAll">选择</a>
             <select name="selectAction" id="selectAction" class="form-element"><option value="3">删除</option><option value="2">不通过</option><option value="1">通过</option></select>  
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
			actionUrl: "<?php echo U('Admin/CommentManage/batchAction');?>", //批量操作
			deleteUrl: "<?php echo U('Admin/CommentManage/del');?>", //单条删除
			actionParameter: function() {
				return {
					'class_id': $('#selectAction').next('#class_id').val()
				};
			}
		});
	});





	$(".u-btn-primary").click(function(){
		var obj = $(this);
		var id = obj.attr('data');
		var type = obj.attr('dataType');
		var uid = obj.attr('uid');
		var index = obj.parent().index();	
		index = index - 4;
		
		$.ajax({
			type: "post",
			url: "<?php echo U('Admin/CommentManage/single');?>",
			data: {id:id,type:type,uid:uid},
			dataType:'json',
			success: function(msg) {
				if(msg.status == 1){
					if(type == 1){
						obj.parents('tr').find('td').eq(index).html('<span style=" color: darkcyan ;"> 已通过 </span>');					
					}
					if(type == 2){
						obj.parents('tr').find('td').eq(index).html('<span style=" color: red ;"> 未通过 </span>');
					}
					obj.parent('span').remove();
				}				
			}
		});
	});
</script>