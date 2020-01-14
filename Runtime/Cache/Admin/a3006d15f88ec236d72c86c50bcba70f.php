<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="index.php?s=/Admin/Tuig/index/" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
             
            <div class="tool-filter f-cb">
                <form action="index.php?s=/Admin/Tuig/index/" method="post">
                    <input name="keyword" type="hidden" value="<?php echo ($pageMaps["keyword"]); ?>"/>
		<select name="status" id="status"  class="form-element "><option value="0" <?php if(0 == $status){ ?> selected="selected"  <?php } ?> >还未审核</option><option value="2" <?php if(2 == $status){ ?> selected="selected"  <?php } ?> >已拒绝</option><option value="1" <?php if(1 == $status){ ?> selected="selected"  <?php } ?> >已通过</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>

	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>编号</th><th>用户id</th><th>姓名</th><th>联系方式</th><th>状态</th><th>时间</th><th width="300">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>	
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["uid"]); ?></td>
				<td><?php echo ($vo["realname"]); ?></td>
				<td><?php echo ($vo["tel"]); ?></td>
				<td><?php if($vo["status"] == 1): ?>已通过<?php elseif($vo["status"] == 2): ?> 已拒绝<?php else: ?>还未审核<?php endif; ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
				<td>
					<a class="u-btn u-btn-primary  u-btn-small doAccept" data="<?php echo ($vo["id"]); ?>" datadone="0">通过</a>
					<a class="u-btn u-btn-danger  u-btn-small doReject" data="<?php echo ($vo["id"]); ?>" datadone="0">拒绝</a>
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


<script type="text/javascript">
	Do.ready('base',function() {
		//左下角的选择操作      
		$('#selectAction').change(function() {
			var type = $(this).val();
		});
	});

	//通过
	$('.doAccept').click(function(){
		var id = $(this).attr('data');
		var obj = $(this);
		$.ajax({
			type:"post",
			url:"<?php echo U('');?>",
			data:{acceptId:id},
			dataType:'json',
			success:function(msg){
				if(msg == 1){
					obj.html("已通过");
				}
			}
			
		});
	});

	//拒绝
	$('.doReject').click(function(){
		var id = $(this).attr('data');
		var obj = $(this);
		$.ajax({
			type:"post",
			url:"<?php echo U('');?>",
			data:{rejectId:id},
			dataType:'json',
			success:function(msg){
				if(msg == 1){
					obj.html("已拒绝");
				}
			}
			
		});
	});
</script>