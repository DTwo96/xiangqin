<?php if (!defined('THINK_PATH')) exit();?><h3>表单列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th width="50">编号</th><th>名称</th><th>表名</th><th width="160">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
      	<td><?php echo ($vo["fieldset_id"]); ?></td>
        <td><?php echo ($vo["name"]); ?></td>
        <td><?php echo ($vo["table"]); ?></td>
        <td>
        <a class="u-btn u-btn-primary u-btn-small" href="<?php echo U('AdminFormField/index',array('fieldset_id'=>$vo['fieldset_id']));?>">管理</a>
        <a class="u-btn u-btn-primary u-btn-small" href="<?php echo U('edit',array('fieldset_id'=>$vo['fieldset_id']));?>">修改</a>
        <a class="u-btn u-btn-danger u-btn-small del" href="javascript:;" url="<?php echo U('del');?>" data="<?php echo ($vo["fieldset_id"]); ?>">删除</a>
        </td>
      </tr><?php endforeach; endif; ?></tbody></table></div>
            </div> </div>
<script>
Do.ready('base',function() {
	$('#table').duxTable({});
});
</script>