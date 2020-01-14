<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	.yijian{
		width: 80px;
		border: none;
		padding:0px 10px ;
		color: white;
		background-color: deepskyblue;
		line-height: 25px;" 
		cursor: pointer;
	}
</style>

<h3>关注列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="<?php echo U();?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
            </div>
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th width="200">编号</th><th>用户ID</th><th width="250">关注人</th><th width="250">被关注的人</th><th>关注时间</th><th>被关注的人是否查看</th><th width="150">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($niceName[$vo['fromuid']]); ?>  (<?php echo ($vo['fromuid']); ?>)</td>
				<td><?php echo ($niceName[$vo['touid']]); ?>   (<?php echo ($vo['touid']); ?>)</td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
				<td>
					<?php if($vo['touser_isread'] == 1): ?><span style="color: red;"> 已查看 </span> 
					<?php elseif($vo['msg_type'] == 0): ?><span style="color: darkgreen;"> 未查看 </span><?php endif; ?>
				</td>
				<td>
					<a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">删除</a>
					<?php if($abc[$vo['fromuid']][$vo['touid']]['hehe'] == 1): ?><input type="button" class="yijian" onclick="yijian(<?php echo ($vo['fromuid']); ?>,<?php echo ($vo['touid']); ?>)" value="一键关注" /><?php endif; ?>
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
	
	function yijian(fromuid,touid){
		
		$.ajax({
			type:"post",
			url:"<?php echo U('Home/Ajax/guanzhu');?>",
			data:{fromuid:touid,touid:fromuid},
			success:function(){
				window.location.href = "<?php echo U('index');?>";
			}
		});
	}
</script>