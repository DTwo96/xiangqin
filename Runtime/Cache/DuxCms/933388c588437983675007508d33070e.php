<?php if (!defined('THINK_PATH')) exit();?><h3>栏目列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th width="50">编号</th><th>名称</th><th width="80">类型</th><th width="80">排序</th><th width="130">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
      	<td><?php echo ($vo["class_id"]); ?></td>
        <td><a href="<?php echo ($vo["curl"]); ?>" target="_blank"><?php echo ($vo["cname"]); ?></a></td>
        <td><?php echo ($vo["model_name"]); ?></td>
        <td><?php echo ($vo["sequence"]); ?></td>
        <td>
        <a class="u-btn u-btn-primary u-btn-small" href="<?php echo U($vo['app'].'/AdminCategory/edit',array('class_id'=>$vo['class_id']));?>">修改</a>
        <a class="u-btn u-btn-danger u-btn-small del" href="javascript:;" url="<?php echo U($vo['app'].'/AdminCategory/del');?>" data="<?php echo ($vo["class_id"]); ?>">删除</a>
        </td>
      </tr><?php endforeach; endif; ?></tbody></table></div>
            </div> </div>
<script>
Do.ready('base',function() {
	$('#table').duxTable({});
});
</script>