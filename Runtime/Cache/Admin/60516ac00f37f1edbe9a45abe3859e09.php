<?php if (!defined('THINK_PATH')) exit();?><h3>赠送列表</h3>

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
                    <select name="touser_isread" id="touser_isread"  class="form-element "><option value="0" <?php if(0 == $pageMaps['touser_isread']){ ?> selected="selected"  <?php } ?> >==类型==</option><option value="1" <?php if(1 == $pageMaps['touser_isread']){ ?> selected="selected"  <?php } ?> >阅读状态</option><option value="2" <?php if(2 == $pageMaps['touser_isread']){ ?> selected="selected"  <?php } ?> >其他</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>选择</th><th width="50">编号</th><th width="150">送礼人</th><th width="150">收礼人</th><th width="150">礼物ID</th><th width="150">礼物</th><th width="150">礼物价格</th><th width="150">礼物数量</th><th>赠送时间</th><th>收礼人是否查看</th><th width="120">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                            <td><input type="checkbox" name="id[]" value="<?php echo ($vo["giftlist_id"]); ?>" /></td>
				<td><?php echo ($vo["giftlist_id"]); ?></td>
				<td><?php echo ($niceName[$vo['fromuid']]); ?></td>
				<td><?php echo ($niceName[$vo['touid']]); ?></td>
                                <td><?php echo ($vo["gift_id"]); ?></td>
                                <td><img src="<?php echo ($vo["gift_image"]); ?>" style="width: 90px;height: 60px;border: none;" /></td>
                                <td><?php echo ($vo["gift_price"]); ?></td>
                                <td><?php echo ($vo["giftnum"]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
				<td>
					<?php if($vo['touser_isread'] == 1): ?><span style="color: red;"> 已查看 </span> 
					<?php elseif($vo['touser_isread'] == 0): ?><span style="color: darkgreen;"> 未查看 </span><?php endif; ?>
				</td>
				<td>
					<a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["giftlist_id"]); ?>">删除</a>
				</td>
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
	Do.ready('base',function() {
		//左下角的选择操作      
		$('#selectAction').change(function() {
			var type = $(this).val();
		});
		//表格处理
		$('#table').duxTable({
			actionUrl : "<?php echo U('batchAction');?>",//批量操作
			deleteUrl: "<?php echo U('del');?>",
			actionParameter : function(){
				return {'class_id' : $('#selectAction').next('#class_id').val()};
			}
		});
	});
</script>