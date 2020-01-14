<?php if (!defined('THINK_PATH')) exit();?><h3>列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="<?php echo U();?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
             
            <div class="tool-filter f-cb">
                <form action="<?php echo U();?>" method="post">
                    <select name="type" id="type"  class="form-element "><option value="0" <?php if(0 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >==类型==</option><option value="1" <?php if(1 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >微信</option><option value="2" <?php if(2 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >支付宝</option><option value="3" <?php if(3 == $pageMaps['type']){ ?> selected="selected"  <?php } ?> >话费充值</option></select>
    <select name="status" id="status"  class="form-element "><option value="0" <?php if(0 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >=请选择=</option><option value="1" <?php if(1 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >成功</option><option value="2" <?php if(2 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >审核中</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
  <div class="m-table-mobile"><table id="table" class="m-table "><thead><tr><th width="30">选择</th><th>编号</th><th width="100">用户名</th><th>提现金额</th><th><?php echo ($config["jifen_name"]); ?>\<?php echo ($config["jifen_name_nv"]); ?></th><th><?php echo ($config["money_name"]); ?>余额</th><th>类型</th><th>支付宝账号</th><th>收款人</th><th>手机号</th><th>描述</th><th>状态</th><th>创建时间</th><th width="180">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
        <td>
        	<input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" />
        </td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["user_login"]); ?></td>
        <td style="color: red"><?php echo ($vo["fee"]); ?></td>
        <td><?php echo ($vo["jifen"]); ?></td>
        <td class="u<?php echo ($vo["uid"]); ?>"><?php echo ($vo["money"]); ?>（<a href="javascript:clearmoney(<?php echo ($vo["uid"]); ?>);">直接清零</a>）</td>
        <td><?php echo ($type[$vo['type']]); ?></td>
        <td><?php echo ($vo["zfb_account"]); ?></td>
        <td><?php echo ($vo["zfb_lxr"]); ?></td>
        <td><?php echo ($vo["mob"]); ?></td>
        
        <td><?php echo ($vo["body"]); ?></td>
        <td><?php echo ($status[$vo['status']]); ?></td>
		<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
        <td>
        <?php if($vo['status'] == 2): ?><a class="u-btn u-btn-primary  u-btn-small"   href="javascript:if(confirm('确定要通过吗？'))location.href='<?php echo U('tixian',array('id'=>$vo['id'],'status'=>1));?>';">通过</a>
        <a class="u-btn  u-btn-danger u-btn-small"   href="javascript:if(confirm('确定失败吗？'))location.href='<?php echo U('tixian',array('id'=>$vo['id'],'status'=>0));?>';">失败</a><?php endif; ?>
        <a class="u-btn u-btn-primary  u-btn-small" href="<?php echo U('moneyEdit',array('id'=>$vo['id']));?>">查看</a>
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
<script type="text/javascript" charset="utf-8">
	Do.ready('base',function() {
		//移动操作
		$('#selectAction').change(function() {
			var type = $(this).val();
			if(type == 3){
				$(this).after($('#class_id').clone());
			}else{
				$(this).nextAll('select').hide();
			}
		});
		//表格处理
		$('#table').duxTable({
			actionUrl : "<?php echo U('batchAction');?>",
			deleteUrl: "<?php echo U('del');?>",
			actionParameter : function(){
				return {'class_id' : $('#selectAction').next('#class_id').val()};
			}
		});
		
	});
	
 function clearmoney(uid){
	   if(confirm('确定要清零吗？'))
		$.post("/index.php/Admin/Account/clearmoney",{uid:uid},function(data){
			if(data.status==1){
				$(".u"+uid).html('0');
			}
		},'json')
		}
</script>