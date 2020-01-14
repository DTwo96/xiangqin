<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>私信列表</h3>

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
		<select name="isread" id="isread"  class="form-element "><option value="0" <?php if(0 == $pageMaps['isread']){ ?> selected="selected"  <?php } ?> >==阅读状态==</option><option value="1" <?php if(1 == $pageMaps['isread']){ ?> selected="selected"  <?php } ?> >已阅读</option><option value="-1" <?php if(-1 == $pageMaps['isread']){ ?> selected="selected"  <?php } ?> >未阅读</option></select>		
		<select name="ishello" id="ishello"  class="form-element "><option value="0" <?php if(0 == $pageMaps['ishello']){ ?> selected="selected"  <?php } ?> >==私信类型==</option><option value="1" <?php if(1 == $pageMaps['ishello']){ ?> selected="selected"  <?php } ?> >招呼消息</option><option value="-1" <?php if(-1 == $pageMaps['ishello']){ ?> selected="selected"  <?php } ?> >聊天消息</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
	
	
	
	
	<div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th>选择</th><th>编号</th><th>发送私信用户</th><th width="120">接收私信用户</th><th width="400">私信内容</th><th width="220">发送时间</th><th width="120">对方查看状态</th><th width="150">接入客服</th><th width="220">对方查看时间</th><th width="120">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="content"  data-fromuid='<?php echo ($vo["fromuid"]); ?>' data-touid='<?php echo ($vo["touid"]); ?>'>
				<td><input type="checkbox" name="id[]" value="<?php echo ($vo["msgid"]); ?>" /></td>
				<td><?php echo ($vo["msgid"]); ?></td>
				<td class="uid<?php echo ($vo["fromuid"]); ?>"><?php echo ($userNicename[$vo['fromuid']]); ?>(<?php echo ($userNicename['sex'][$vo['fromuid']]); ?>)<font color="red"><?php echo ($userNicename['ismj'][$vo['fromuid']]); ?></font></td>
				<td class="uid<?php echo ($vo["touid"]); ?>"><?php echo ($userNicename[$vo['touid']]); ?>(<?php echo ($userNicename['sex'][$vo['touid']]); ?>)<font color="red"><?php echo ($userNicename['ismj'][$vo['touid']]); ?></font></td>
				<td class="content1"><?php echo ($vo["content"]); ?>
				<div  class="showbox">
					<ul class="ulbox">
					
						
					
						
					</ul>
				</div>
				</td>			
				<td><?php echo (date("Y-m-d H:i:s",$vo["sendtime"])); ?></td>
				<td>
					<?php if($vo['isread'] == 1 ): ?><span style="color: red;" > 已阅读 </span>
					<?php elseif($vo['isread'] == 0 ): ?><span style=" color:  darkcyan;"> 未阅读 </span><?php endif; ?>
				</td>
				
				<td>
					<span style=" color:  darkcyan;"> <?php echo ($vo["kfname"]); ?></span>							
					
				</td>
				<td>
					<?php if($vo['redtime']): echo (date("Y-m-d H:i:s",$vo["redtime"])); ?>
					<?php else: endif; ?>
				</td>
				<td>
				<?php if($userNicename['ismj'][$vo['touid']]=='马甲' ||$userNicename['ismj'][$vo['fromuid']]=='马甲') { ?>
					<a class="u-btn u-btn-primary  u-btn-small" href="<?php echo U('Compose/wechat',array('msgid'=>$vo['msgid'],'adminid'=>$loginUserInfo['user_id'],'noread'=>$vo['noread']));?>" target="_blank" data="<?php echo ($vo["msgid"]); ?>">接入对话</a>
				<?php } ?>
					<a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["msgid"]); ?>">删除</a>
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
<style>
	.content1{ position: relative;}
	.showbox{ position: absolute;  bottom: -500px; z-index:100; height:500px; overflow:auto; left: -100%; border: 1px solid #ccc; background: #fff; padding: 10px; min-width: 1000px; display: none}
</style>
<script>
	Do.ready('base',function() {
		
		$('#selectAction').change(function() {
			var type = $(this).val();
		});
		//表格处理
		$('#table').duxTable({
			actionUrl : "<?php echo U('batchAction');?>",//批量操作
			deleteUrl : "<?php echo U('del');?>",//单条删除
			actionParameter : function(){
				return {'class_id' : $('#selectAction').next('#class_id').val()};
			}
		});
	});
	// mod by mangosteen 20160516
	$(".content").hover(function(){
		var fromuid = $(this).attr("data-fromuid");
		var touid = $(this).attr("data-touid");
		var o = $(this);
		$.post("/index.php/Admin/Compose/listsx",{fromuid:fromuid,touid:touid},function(data){
			o.find(".showbox ul").html('');			
			$.each(data,function(index,val){
					var funame = $(".uid"+val.fromuid).last().html();
					var tuname = $(".uid"+val.touid).last().html();
					var isread = val.isread==1?'<font color="#dedede">已阅</font>':'未读';
					var body = '<li><font color="darkcyan">'+funame+'->'+tuname+'</font> '+val.content+isread+'('+val.ktime+')</li>';
					o.find(".showbox ul").append(body);
			})			
		},'json')
		o.find(".showbox").show();

	},function(){
		var o = $(this);
		o.find(".showbox").hide();

	});
</script>