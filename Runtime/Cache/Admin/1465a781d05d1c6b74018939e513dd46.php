<?php if (!defined('THINK_PATH')) exit();?><h3>系统消息列表</h3>

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
                    <input name="keyword" type="hidden" value="<?php echo ($pageMaps["keyword"]); ?>"/>	
		<select name="msg_type" id="msg_type"  class="form-element "><option value="0" <?php if(0 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >==类型==</option><option value="1" <?php if(1 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >送礼</option><option value="2" <?php if(2 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >邀请</option><option value="3" <?php if(3 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >礼物返利</option><option value="4" <?php if(4 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >粉丝买VIP</option><option value="5" <?php if(5 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >邀请好友</option><option value="6" <?php if(6 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >粉丝充值</option><option value="7" <?php if(7 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >私密照支出</option><option value="8" <?php if(8 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >私密照收入</option><option value="9" <?php if(9 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >上传照片</option><option value="10" <?php if(10 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >后台添加</option><option value="101" <?php if(101 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >提现</option><option value="201" <?php if(201 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> ><?php echo ($config["jifen_name"]); ?>/<?php echo ($config["jifen_name_nv"]); ?></option><option value="301" <?php if(301 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> ><?php echo ($config["money_name"]); ?></option><option value="3301" <?php if(3301 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >签到</option><option value="401" <?php if(401 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >充值</option><option value="501" <?php if(501 == $pageMaps['msg_type']){ ?> selected="selected"  <?php } ?> >亲密度</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>选择</th><th>编号</th><th width="250">用户id</th><th width="500">消息内容</th><th>消息类型</th><th>阅读状态</th><th>时间</th><th width="120">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
				<td><input type="checkbox" name="id[]" value="<?php echo ($vo["msg_id"]); ?>" /></td>
				<td><?php echo ($vo["msg_id"]); ?></td>
				<td><?php echo ($vo["uid"]); ?></td>
				<td><?php echo ($vo["msg_content"]); ?></td>
				<td>
				<?php echo ($msgtype[$vo['msg_type']]); ?>
					
				</td>
				<td>
					<?php if($vo['msg_status'] == 0): ?><span style="color: red;"> 未阅读 </span>
					<?php elseif($vo['msg_status'] == 1): ?>已阅读<?php endif; ?>
				</td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
				<td>
					<a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["msg_id"]); ?>">删除</a>
				</td>
			</tr><?php endforeach; endif; ?></tbody></table></div>
	<div class="m-table-bar">
            <div class="bar-action">
            <a class="u-btn u-btn-primary" href="javascript:;" id="selectAll">选择</a>
             <select name="selectAction" id="selectAction" class="form-element"><option value="1">删除</option></select>  
            <a class="u-btn u-btn-success" href="javascript:;" id="selectSubmit">执行</a>
            </div>
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
		//表格处理
		$('#table').duxTable({
			actionUrl : "<?php echo U('batchAction');?>",//批量操作
			deleteUrl: "<?php echo U('del');?>",
			actionParameter : function(){
				return {'class_id' : $('#selectAction').next('#class_id').val()};
			}
		});
	});
</script>