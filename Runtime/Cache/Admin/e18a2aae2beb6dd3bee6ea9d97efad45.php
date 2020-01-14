<?php if (!defined('THINK_PATH')) exit();?><h3>相册审核</h3>

<admin:panel>
	<div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="<?php echo U();?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
             
            <div class="tool-filter f-cb">
                <form action="<?php echo U();?>" method="post">
                    <input type="hidden" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
											<!-- 1 私密照     0 公开照 -->						
		<select name="phototype" id="phototype"  class="form-element "><option value="0" <?php if(0 == $pageMaps['phototype']){ ?> selected="selected"  <?php } ?> >==照片类型==</option><option value="1" <?php if(1 == $pageMaps['phototype']){ ?> selected="selected"  <?php } ?> >公开照</option><option value="-1" <?php if(-1 == $pageMaps['phototype']){ ?> selected="selected"  <?php } ?> >私密照</option></select>		
											<!-- 1推荐     2 未推荐 -->
		<select name="elite" id="elite"  class="form-element "><option value="0" <?php if(0 == $pageMaps['elite']){ ?> selected="selected"  <?php } ?> >==推荐状态==</option><option value="1" <?php if(1 == $pageMaps['elite']){ ?> selected="selected"  <?php } ?> >推荐</option><option value="2" <?php if(2 == $pageMaps['elite']){ ?> selected="selected"  <?php } ?> >未推荐</option></select>
											<!-- 0待审核   1通过 2未通过 -->
		<select name="flag" id="flag"  class="form-element "><option value="0" <?php if(0 == $pageMaps['flag']){ ?> selected="selected"  <?php } ?> >==审核状态==</option><option value="-1" <?php if(-1 == $pageMaps['flag']){ ?> selected="selected"  <?php } ?> >待审核</option><option value="1" <?php if(1 == $pageMaps['flag']){ ?> selected="selected"  <?php } ?> >通过</option><option value="2" <?php if(2 == $pageMaps['flag']){ ?> selected="selected"  <?php } ?> >未通过</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
		<div class="m-table-mobile"><table id="table" class="m-table "><thead><tr><th width="30">选择</th><th width="30">编号</th><th>标题</th><th>用户ID</th><th>用户</th><th>图片</th><th>点赞数</th><th>评论数</th><th>上传时间</th><th>是否为头像</th><th>是否推荐</th><th>状态</th><th width="200">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
					<td><input type="checkbox" name="id[]" value="<?php echo ($vo["photoid"]); ?>" /></td>
					<td><?php echo ($vo["photoid"]); ?></td>
					<td><?php echo ($vo["title"]); ?></td>
					<td><?php echo ($vo["uid"]); ?></td>
					<td><?php echo ($vo["user_nicename"]); ?></td>					
					<td><img src="<?php echo ($vo["uploadfiles"]); ?>" width="150px" /></td>
					<td><?php echo ($vo["hits"]); ?></td>
					<td><?php echo ($vo["istop"]); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$vo["timeline"])); ?></td>
					<td>
						<?php if(($vo["isavatr"]) == "1"): ?>是
						<?php else: ?>否<?php endif; ?>
					</td>
					<td>
						<?php if(($vo["elite"]) == "1"): ?><span style="color:#2D822D;">已推荐</span>
						<?php else: ?> <span style="color:red;">未推荐 </span><?php endif; ?>
					</td>
					<td>
						<?php if($vo['flag'] == 1): ?><span style="color:#2D822D;">通过</span>
						<?php elseif($vo['flag'] == 2): ?><span style="color:red;">未通过</span>
						<?php elseif($vo['flag'] == 0): ?><span style="color:red;">待审核</span><?php endif; ?>
					</td>

					<td>
               
					<?php if(($vo["flag"]) == "0"): ?><a class="u-btn u-btn-primary  u-btn-small doaction" dataType="1" dataid="<?php echo ($vo["photoid"]); ?>" status="1" >通过</a>
					    <a class="u-btn u-btn-primary  u-btn-small doaction" dataType="1" dataid="<?php echo ($vo["photoid"]); ?>" status="2" >不通过</a><?php endif; ?>
                     <?php if($vo['flag'] == 1): ?><a class="u-btn u-btn-primary  u-btn-small doaction" dataType="2" dataid="<?php echo ($vo["photoid"]); ?>" <?php if(($vo["elite"]) == "1"): ?>status="4"<?php else: ?>status="3"<?php endif; ?> href="javascript:;"><?php if(($vo["elite"]) == "1"): ?>撤销推荐<?php else: ?>推荐<?php endif; ?></a><?php endif; ?>
						<a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["photoid"]); ?>">删除</a>
					</td>

				</tr><?php endforeach; endif; ?></tbody></table></div>
		<div class="m-table-bar">
            <div class="bar-action">
            <a class="u-btn u-btn-primary" href="javascript:;" id="selectAll">选择</a>
             <select name="selectAction" id="selectAction" class="form-element"><option value="1">通过</option><option value="2">不通过</option><option value="3">推荐</option><option value="4">撤销推荐</option><option value="5">删除</option></select>  
            <a class="u-btn u-btn-success" href="javascript:;" id="selectSubmit">执行</a>
            </div>
            <div class="bar-pages">
              <div class="m-page">
                <?php echo ($page); ?>
              </div>
            </div>
            <div class="f-cb"></div>
        </div>

</admin:panel>

<script>
	Do.ready('base', function() {
		//移动操作
		$('#selectAction').change(function() {
			var type = $(this).val();
		});
		//表格处理
		$('#table').duxTable({
			actionUrl: "<?php echo U('batchPhotoAction');?>",
			deleteUrl: "<?php echo U('delPhoto');?>",
			actionParameter: function() {
				return {
					'class_id': $('#selectAction').next('#class_id').val()
				};
			}
		});
	});
	$(function() {
		$('.doaction').click(function() {
			var type = $(this).attr('dataType');
			var status = $(this).attr('status');
			var id = $(this).attr('dataid');
			var url = 'index.php?s=/Admin/User/operatePhoto/id/' + id + '/type/' + status + '.html';
			var text = {
				1: '未通过',
				2: '通过',
				3: '撤销推荐',
				4: '推荐'
			};
			var changs = {
				1: 2,
				2: 1,
				3: 4,
				4: 3
			};
			var index = parseInt($(this).parent().index());
			index = type == 1 ? index - 1 : index - 2;
			var html = {
				1: '<span style="color:#2D822D;">通过</span>',
				2: ' <span style="color:red;">未通过</span>',
				3: ' <span style="color:#2D822D;">已推荐</span>',
				4: ' <span style="color:red;">未推荐</span>'
			};
			var obj = $(this).parents('tr').find('td').eq(index);
			var o = $(this);
			$.get(url, '', function(data) {
				if (data.status == 1) {
					obj.html(html[status]);
					if(status==1){
						o.next().remove();
						o.html(text[4]);
						o.attr('status', 3);
						o.attr('dataType', 2);
					}else if(status==2){
						o.prev().remove();
						o.remove();
					}else{
						o.html(text[status]);
						o.attr('status', changs[status]);
					}

				} else {
					alert(data.info);
				}
			}, 'json')
		})
	})
</script>