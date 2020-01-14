<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <?php if($type == 1): ?><div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="index.php?s=/Admin/JinqianLog/index/type/1" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
             
            <div class="tool-filter f-cb">
                <form action="index.php?s=/Admin/JinqianLog/index/type/1" method="post">
                    <!--1送礼 2邀请 3礼物返利,4购买VIP返利,6充值返利 7私密照支出  8私密照返利  10后台添加  101提现 401充值--> 
			<input name="keyword" type="hidden" value="<?php echo ($pageMaps["keyword"]); ?>"/>
			<select name="flag" id="flag"  class="form-element "><option value="0" <?php if(0 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >==类型==</option><option value="5" <?php if(5 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >注册</option><option value="1" <?php if(1 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >送礼</option><option value="2" <?php if(2 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >邀请</option><option value="3" <?php if(3 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >礼物返利</option><option value="4" <?php if(4 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >购买VIP返利</option><option value="6" <?php if(6 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >充值返利 </option><option value="7" <?php if(7 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >私密照支出 </option><option value="8" <?php if(8 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >私密照返利</option><option value="10" <?php if(10 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >后台添加</option><option value="11" <?php if(11 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >新手任务</option><option value="101" <?php if(101 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >提现</option><option value="401" <?php if(401 == $pageMaps['falg']){ ?> selected="selected"  <?php } ?> >充值</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	<?php else: ?> 
		<div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="index.php?s=/Admin/JinqianLog/index/type/<?php echo ($type); ?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
            </div><?php endif; ?>
	

	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>编号</th><th>用户id</th><th>用户昵称</th><th>金额</th><th>变动详细</th><th>变动时间</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>	
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo['uid']); ?></td>
				<td><?php echo ($niceName[$vo['uid']]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
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