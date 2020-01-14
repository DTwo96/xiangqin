<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="index.php?s=/Admin/Tuig/ulist/" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
            </div>

	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>编号</th><th>代理帐号</th><th>头像</th><th>微信</th><th>推荐人ID</th><th>上次登录时间</th><th width="300">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>	
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["user_login"]); ?></td>
				<td><img src="<?php echo ($vo["avatar"]); ?>" width="50" /></td>
				<td><?php echo ($vo["weixin"]); ?></td>
				<td><?php echo ($vo["parent_id"]); ?></td>
				<!-- <td><?php echo ($vo["tuiguang"]); ?></td> -->
				<td><?php echo (date("Y-m-d H:i:s",$vo["last_login_time"])); ?></td>
				<td>
					<a class="u-btn u-btn-primary" href="<?php echo U('tglist',array('uid'=>$vo['id']));?>">查看业绩</a>
					&nbsp;
					<a class="u-btn u-btn-primary u-btn-small" href="<?php echo U('Admin/Account/money');?>">查看提现</a>
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