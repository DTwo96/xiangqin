<?php if (!defined('THINK_PATH')) exit();?><h3>用户列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="<?php echo U();?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($keyword); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
             
            <div class="tool-filter f-cb">
                <form action="<?php echo U();?>" method="post">
                    <select name="group_id" class="form-element">
    <option value="0">=用户组=</option>
    <?php if(is_array($groupList)): foreach($groupList as $key=>$vo): ?><option value="<?php echo ($vo["group_id"]); ?>" 
      <?php if($groupId == $vo['group_id']): ?>selected="selected"<?php endif; ?>
      ><?php echo ($vo["name"]); ?>
      </option><?php endforeach; endif; ?>
  </select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>

<div class="m-table-mobile"><table id="table" class="m-table "><thead><tr><th width="80">编号</th><th>用户名</th><th>用户组</th><th>状态</th><th width="130">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
      <td><?php echo ($vo["user_id"]); ?></td>
      <td><?php echo ($vo["username"]); ?></td>
      <td><?php echo ($vo["group_name"]); ?></td>
      <td><?php if($vo['status']): ?><span class="u-badge u-badge-success">正常</span>
          <?php else: ?>
          <span class="u-badge u-badge-danger">禁用</span><?php endif; ?></td>
      <td><a class="u-btn u-btn-primary u-btn-small" href="<?php echo U('edit',array('user_id'=>$vo['user_id']));?>">修改</a> <a class="u-btn u-btn-danger u-btn-small del" href="javascript:;" data="<?php echo ($vo["user_id"]); ?>">删除</a></td>
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