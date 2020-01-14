<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>列表</h3>

        <div class="m-panel ">
            <div class="panel-body">
            <div class="m-table-tool f-cb">
            <div class="tool-search f-cb">
                    <form action="index.php?s=/Admin/User/index/sort/<?php echo ($sort); ?>" method="post">
                        <input type="text" class="form-element" name="keyword" value="<?php echo ($pageMaps["keyword"]); ?>" />
                        <button class="u-btn u-btn-primary" type="submit">搜索</button>
                    </form></div>
             
            <div class="tool-filter f-cb">
                <form action="index.php?s=/Admin/User/index/sort/<?php echo ($sort); ?>" method="post">
                    <?php if($sort): ?><select name="level" id="level"  class="form-element "><option value="0" <?php if(0 == $pageMaps['level']){ ?> selected="selected"  <?php } ?> >==马甲类别==</option><option value="1" <?php if(1 == $pageMaps['level']){ ?> selected="selected"  <?php } ?> >普通马甲</option><option value="2" <?php if(2 == $pageMaps['level']){ ?> selected="selected"  <?php } ?> >高级马甲</option></select><?php endif; ?>	
  	<?php if(!$sort): ?><select name="vip" id="vip"  class="form-element "><option value="0" <?php if(0 == $pageMaps['vip']){ ?> selected="selected"  <?php } ?> >==会员等级==</option><option value="1" <?php if(1 == $pageMaps['vip']){ ?> selected="selected"  <?php } ?> >vip</option><option value="2" <?php if(2 == $pageMaps['vip']){ ?> selected="selected"  <?php } ?> >普通会员</option></select><?php endif; ?>	
  	
  	<!--  省份筛选     -->
    <select name="provinceid" id="provinceid" class="form-element " >
      <option value="0">==省份==</option>
      <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo["areaid"]); ?>"><?php echo ($vo["areaname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
    
    <!--  城市筛选     -->
    <select name="cityid" id="cityid" class="form-element " >
      <option value="0">==城市==</option>
      <?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo['areaid'] == $info['cityid']): ?>selected<?php endif; ?>  value="<?php echo ($vo["areaid"]); ?>"><?php echo ($vo["areaname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
    
    <select name="sex" id="sex"  class="form-element "><option value="0" <?php if(0 == $pageMaps['sex']){ ?> selected="selected"  <?php } ?> >==性别==</option><option value="1" <?php if(1 == $pageMaps['sex']){ ?> selected="selected"  <?php } ?> >男</option><option value="2" <?php if(2 == $pageMaps['sex']){ ?> selected="selected"  <?php } ?> >女</option></select>
  	<select name="status" id="status"  class="form-element "><option value="0" <?php if(0 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >==状态==</option><option value="1" <?php if(1 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >正常</option><option value="2" <?php if(2 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >未验证</option><option value="3" <?php if(3 == $pageMaps['status']){ ?> selected="selected"  <?php } ?> >禁止</option></select>
                    <button class="u-btn u-btn-primary" type="submit">筛选</button>
                </form>
            </div></div>
  <div class="m-table-mobile"><table id="table" class="m-table "><thead><tr><th width="30">选择</th><th width="30">编号</th><th>子用户查看</th><th>性别</th><th>昵称</th><th>头像</th><th><?php echo ($config["jifen_name"]); ?>/<?php echo ($config["jifen_name_nv"]); ?></th><th><?php echo ($config["money_name"]); ?></th><th>地区</th><th>微信OPENID</th><th>是否已关注</th><th>手机</th><th>最后登陆</th><th>注册时间</th><th>马甲</th><th>VIP</th><th width="60">状态</th><th width="300">操作</th></tr></thead><tbody><?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
        <td>
        	<input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" />
        </td>
        <td><?php echo ($vo["id"]); ?></td>
       <!-- <td><a href="javascript:;" ><?php echo ($vo["user_login"]); ?></a></td>-->
        <td><a href="<?php echo U('',array('pid'=>$vo['id']));?>" >子用户查看(<?php echo ($vo["fscount"]); ?>)</a></td>
		<td><a href="javascript:;" > 
		<?php if($vo['sex'] == 1): ?>男
		<?php elseif($vo['sex'] == 2): ?>
		女
		<?php elseif($vo['sex'] == 3): ?>
		其他<?php endif; ?>
		</a></td>
        <td><a href="javascript:;" ><?php echo ($vo["user_nicename"]); ?></a></td>
        <td>
        <?php if($vo['avatar']): ?><img src="<?php echo ($vo["avatar"]); ?>" width="40">
		<?php else: endif; ?>
          <!--<?php if($vo['status']): ?><span class="u-badge u-badge-success">发布</span>
            <?php else: ?>
            <span class="u-badge u-badge-danger">草稿</span><?php endif; ?>-->
        </td>
		<td><?php echo ($vo["jifen"]); ?></td>
		<td><?php echo ($vo["money"]); ?></td>
		<td><?php echo ((isset($vo["province_name"]) && ($vo["province_name"] !== ""))?($vo["province_name"]):"未知"); echo ($vo["city_name"]); ?></td>
		
		<td><?php echo ($vo["weixin"]); ?></td>
		<td>
		<?php if($vo['subscribe']): ?>是
		<?php else: ?>
			否<?php endif; ?>
		</td>
		<td><?php echo ($vo["user_login"]); ?></td>
		 <td><?php echo (date("Y-m-d H:i:s",$vo["last_login_time"])); ?></td>
		  <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
		      <td>
		<?php if($vo['ismj'] == 1): ?><span style="color:#6636c9;">普通马甲</span><?php elseif($vo['ismj'] == 2): ?><span style="color:red;">高级马甲</span><?php else: ?>普通会员<?php endif; ?>
        </td>
		 <td>
		<?php if($vo['vip'] == 1): ?><span style="color:red;">VIP(剩<?php echo ($vo["vipData"]); ?>天)</span><?php else: endif; ?>
        </td>
        <td>
		
          <?php if($vo['user_status'] == 1): ?><span class="u-badge u-badge-success">正常</span>
            <?php elseif($vo['user_status'] == 2): ?>
			  <span class="u-badge u-badge-danger">未验证</span>
			<?php else: ?>
            <span class="u-badge u-badge-danger">禁止登陆</span><?php endif; ?>
        </td>
     
        
        <td>
        <a class="u-btn u-btn-primary  u-btn-small" href="<?php echo U('edit',array('id'=>$vo['id']));?>">管理</a>
       
        <a class="u-btn u-btn  u-btn-small tj" href="javascript:;" data="<?php echo ($vo["id"]); ?>"><?php if(($vo["type"]) == "1"): ?>撤销推荐<?php else: ?>推荐<?php endif; ?></a>
        <a class="u-btn u-btn  u-btn-small add" href="javascript:;" dataType="1"  data="<?php echo ($vo["id"]); ?>">+财富值</a>
        <a class="u-btn u-btn  u-btn-small add" href="javascript:;" dataType="2"  data="<?php echo ($vo["id"]); ?>">+余额</a>
		 <a class="u-btn u-btn-danger  u-btn-small del" href="javascript:;" data="<?php echo ($vo["id"]); ?>">删除</a>
		</td>
      </tr><?php endforeach; endif; ?></tbody></table></div>
  <div class="m-table-bar">
            <div class="bar-action">
            <a class="u-btn u-btn-primary" href="javascript:;" id="selectAll">选择</a>
             <select name="selectAction" id="selectAction" class="form-element"><option value="1">删除</option><option value="2">推荐</option></select>  
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
	
	//加财富值or加余额
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
	//推荐
	$(function(){
		$('.tj').click(function(){
			var id = $(this).attr('data');
			var obj = $(this);
			
			$.ajax({
				type:"post",
				url:"<?php echo U('Admin/User/tuijian');?>",
				data:{id:id},
				dataType:'json',
				success:function(msg){
					if(msg == 1){
						obj.html("推荐");
					}
					
					if(msg == 2){
						obj.html('撤销推荐');
					}
				}
				
			});
		});
	})
	
	//筛选地区
	$(function(){
		$('#provinceid').change(function(){
			var url = "<?php echo U('Home/Ajax/ajax_get_city');?>";
	    var provinceid =  $(this).val();
	    if(!provinceid) return false;
			$.post(url,{provinceid:provinceid},function(json){
				html = '<option value="0">==城市==</option>';
				if(json){					
					$.each(json, function(idx, item) {
						html += '<option value="'+item.areaid+'">'+ item.areaname + '</option>';
					});	               
					$("#cityid").html(html);
				}	
			},'json');
		})	
	})
</script>