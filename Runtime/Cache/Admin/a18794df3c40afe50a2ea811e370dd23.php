<?php if (!defined('THINK_PATH')) exit();?><h3><?php if(($type) == "1"): ?>购买vip<?php else: ?>充值<?php endif; ?>设置 </h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
              <a  href="<?php echo U('saveCredit',array('type'=>$_GET['type']));?>" class="u-btn u-btn-primary  u-btn-small">添加设置</a>
            </div>
  <?php if(!$type): ?><div class="m-table-mobile"><table id="table" class="m-table "><thead><tr><th width="30">选择</th><th width="30">编号</th><th>充值钱数</th><th>赠送钱数</th><th width="250">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
        <td>
        	<input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" />
        </td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["money"]); ?></td>
        <td><?php echo ($vo["zmoney"]); ?></td>       
        <td>
        <a class="u-btn u-btn-primary  u-btn-small" href="<?php echo U('saveCredit',array('id'=>$vo['id'],'type'=>$type));?>">修改</a>      
		 <a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">删除</a>
		</td>
      </tr><?php endforeach; endif; ?></tbody></table></div>
  <?php else: ?>
   <div class="m-table-mobile"><table id="table" class="m-table "><thead><tr><th width="30">选择</th><th width="30">编号</th><th>vip天数</th><th>原价</th><th>现价</th><th width="250">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
        <td>
        	<input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" />
        </td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["day"]); ?></td>
        <td><?php echo ($vo["original"]); ?></td>
         <td><?php echo ($vo["price"]); ?></td>       
        <td>
        <a class="u-btn u-btn-primary  u-btn-small" href="<?php echo U('saveCredit',array('id'=>$vo['id'],'type'=>$type));?>">修改</a>      
		 <a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">删除</a>
		</td>
      </tr><?php endforeach; endif; ?></tbody></table></div><?php endif; ?>
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
			deleteUrl: "<?php echo U('delCredit',array('type'=>$_GET['type']));?>",
			actionParameter : function(){
				return {'class_id' : $('#selectAction').next('#class_id').val()};
			}
		});
	});
	
	$(function(){
		$('.add').click(function(){
			var mtype = $(this).attr('dataType');
			var uid = $(this).attr('data');
			var type = 10;
			var desc = '后台添加';
			var moeny=prompt("请输入金额！");
		    if(moeny){
		    	$.post("<?php echo U('Admin/User/sendaccount');?>",{mtype:mtype,type:type,moeny:moeny,desc:desc,uid:uid},function(data){
		    		if(data=='操作成功！'){
		    			alert(data);
		    			history.go(0);
		    		}
	    	
	    		})
		    }
			
		})
	})
	
	
	
</script>