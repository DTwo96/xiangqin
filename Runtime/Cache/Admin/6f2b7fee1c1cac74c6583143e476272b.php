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
                    <!--0待审核 1通过  2 未通过-->
		<input type="hidden" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
  		<select name="status" id="status"  class="form-element "><option value="0" <?php if(0 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >==状态==</option><option value="-1" <?php if(-1 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >待审核</option><option value="1" <?php if(1 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >通过</option><option value="2" <?php if(2 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >未通过</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>选择</th><th>编号</th><th>用户ID</th><th>用户名</th><th>审核内容</th><th>审核状态</th><th>添加时间</th><th width="200">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
				<td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /></td>			
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["uid"]); ?></td>
				<td><?php echo ($niceName[$vo['uid']]); ?></td>
				<td>
					<?php if($vo['type'] == 0): ?><img src="<?php echo ($vo["text"]); ?>" style="width: 120px;height: 80px;" />
					<?php else: ?> 
						<?php echo ($vo["text"]); endif; ?>
				</td>
				<td id="audit_a">
					<?php if($vo['status'] == 1 ): ?><span style="color: darkcyan;"> 已通过 </span>
					<?php elseif($vo['status'] == 0 ): ?><span style="color: lightcoral;"> 待审核 </span>	
					<?php elseif($vo['status'] == 2 ): ?><span style=" color: red ;"> 未通过 </span><?php endif; ?>
				</td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["created_time"])); ?></td>
				<td>
					<?php if($vo['status'] == 0 ): ?><span>
							<a class="u-btn u-btn-primary u-btn-small" datatype='1' data="<?php echo ($vo["id"]); ?>">通过 </a>
							<a class="u-btn u-btn-primary u-btn-small" datatype='2' data="<?php echo ($vo["id"]); ?>">不通过 </a>
						</span><?php endif; ?>
					<a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">删除</a>
				</td>
			</tr><?php endforeach; endif; ?></tbody></table></div>
	<div class="m-table-bar">
            <div class="bar-action">
            <a class="u-btn u-btn-primary" href="javascript:;" id="selectAll">选择</a>
             <select name="selectAction" id="selectAction" class="form-element"><option value="2">通过</option><option value="3">未通过</option><option value="1">删除</option></select>  
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
			actionUrl: "<?php echo U('Admin/Audit/batchAction');?>", //批量操作
			deleteUrl: "<?php echo U('Admin/Audit/del');?>", //单条删除
			actionParameter: function() {
				return {
					'class_id': $('#selectAction').next('#class_id').val()
				};
			}
		});
	});
	
	
	$(".u-btn-primary").click(function(){
		var obj = $(this);
		var index = parseInt(obj.parent().index()-3);
		var o = obj.parents('tr').find('td').eq(index);
		var  html ='<span style="color:#2D822D;">已通过</span>';
		var id = obj.attr('data');
		var type = obj.attr('datatype');
		
		
		$.ajax({
			type: "post",
			url: "<?php echo U('Admin/Audit/audit');?>",
			data: {id:id,type:type} ,
			dataType:"json",
			success: function(result) {
			    if(result == 1){
				    o.html('<span style="color:#2D822D;">已通过</span>');
					obj.parent('span').remove();  
			    }
			    if(result == 2){
			    	o.html('<span style="color:red;">未通过</span>');
					obj.parent('span').remove();
			    }
			}
		});	
	})
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function audit(id) {
		var o = $('.u-btn-primary');
		var index = parseInt(o.parent().index()-2);		
		var obj = o.parents('tr').find('td').eq(index);
		var  html ={1:'<span style="color:#2D822D;">通过</span>',2:' <span style="color:red;">未通过</span>'}; 
		
		$.ajax({
			type: "post",
			url: "<?php echo U('Admin/Audit/audit');?>",
			data: "id=" + id ,
			dataType:"json",
			success: function(result) {
			    if(result.status==1){
				    obj.html(html[1]);
					o.remove();  
			    }else{
				   alert(result.info);
			    }
			}
		});
	}
</script>