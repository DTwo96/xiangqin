<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($formInfo["name"]); ?>列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <?php if($formInfo['name'] == '提现申请'): ?><div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="<?php echo ($url); ?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($keyword); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
             
            <div class="tool-filter f-cb">
                <form action="<?php echo ($url); ?>" method="post">
                    <select name="status" id="status"  class="form-element "><option value="0" <?php if(0 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >==状态==</option><option value="1" <?php if(1 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >通过</option><option value="2" <?php if(2 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >未审</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div><?php endif; ?>
	<table id="table" class="m-table ">
	
    	<thead>
    	<th width="30">选择</th>
        <th width="50">编号</th>
        <?php if(is_array($tableTh)): foreach($tableTh as $key=>$vo): ?><th><?php echo ($vo); ?></th><?php endforeach; endif; ?>
        <th width="120">操作</th>
        </thead>
        <tbody>
    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
      <td><input type="checkbox" name="id[]" value="<?php echo ($vo["data_id"]); ?>" /></td>
      	<td><?php echo ($vo["data_id"]); ?></td>
        <?php if(is_array($fieldList)): foreach($fieldList as $key=>$val): if($val['show']): ?><td><?php echo D('DuxCms/FieldData')->showListField($vo[$val['field']],$val['type'],$val['config']); ?></td><?php endif; endforeach; endif; ?>
        <td>
        <a class="u-btn u-btn-primary u-btn-small" href="<?php echo U('edit',array('data_id'=>$vo['data_id'],'fieldset_id'=>$formInfo['fieldset_id']));?>">修改</a>
        <a class="u-btn u-btn-danger u-btn-small del" href="javascript:;" url="<?php echo U('del',array('fieldset_id'=>$formInfo['fieldset_id']));?>" data="<?php echo ($vo["data_id"]); ?>">删除</a>
        </td>
      </tr><?php endforeach; endif; ?>
    </tbody>
    </table>
    <?php if($val['show']): endif; ?>
   <?php if($formInfo['name'] == '提现申请'): ?><div class="m-table-bar">
            <div class="bar-action">
            <a class="u-btn u-btn-primary" href="javascript:;" id="selectAll">选择</a>
             <select name="selectAction" id="selectAction" class="form-element"><option value="1">通过</option><option value="2">未通过</option></select>  
            <a class="u-btn u-btn-success" href="javascript:;" id="selectSubmit">执行</a>
            </div>
            <div class="bar-pages">
              <div class="m-page">
                <?php echo ($page); ?>
              </div>
            </div>
            <div class="f-cb"></div>
        </div>
   </else>
   <div class="m-table-bar">
            <div class="bar-pages">
              <div class="m-page">
                <?php echo ($page); ?>
              </div>
            </div>
            <div class="f-cb"></div>
        </div><?php endif; ?>
            </div> </div>
<script>
Do.ready('base',function() {

	//表格处理
	$('#table').duxTable({
		actionUrl : "<?php echo U('edit',array('fieldset_id'=>$formInfo['fieldset_id']));?>",
//		deleteUrl: "<?php echo U('del');?>",
		actionParameter : function(){
			return {'class_id' : $('#selectAction').next('#class_id').val()};
		}
	});
});
</script>