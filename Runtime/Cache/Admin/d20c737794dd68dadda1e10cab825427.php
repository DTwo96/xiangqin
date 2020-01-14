<?php if (!defined('THINK_PATH')) exit();?><h3>备份列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>备份文件</th><th width="130">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
      <td><?php echo ($vo["name"]); ?></td>
      <td><a class="u-btn u-btn-primary u-btn-small action" url="<?php echo U('import');?>" href="javascript:;" data="<?php echo ($vo["time"]); ?>">还原</a> <a class="u-btn u-btn-danger u-btn-small del" href="javascript:;" data="<?php echo ($vo["time"]); ?>">删除</a></td>
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
	$('#table').duxTable({
		deleteUrl: "<?php echo U('del');?>"
	});
});
</script>