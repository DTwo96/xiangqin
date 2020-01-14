<?php if (!defined('THINK_PATH')) exit();?><h3>缓存管理</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>说明</th><th>路径</th><th>大小</th><th width="100">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
        	<td><?php echo ($vo["name"]); ?></td>
            <td><?php echo ($vo["dir"]); ?></td>
            <td><?php echo ($vo["size"]); ?></td>
            <td>
            <a class="u-btn u-btn-danger u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">清空</a></td>
        </tr><?php endforeach; endif; ?></tbody></table></div>
            </div> </div>
<script>
Do.ready('base',function() {
	$('#table').duxTable({
		deleteUrl: "<?php echo U();?>"
	});
});
</script>