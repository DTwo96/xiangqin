<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>用户</h3>

        <form action="<?php echo U();?>" method="post" id="form" class="m-form ">
        <fieldset>
          <div class="g-main-body">
		
    <?php if(is_array($header)): $i = 0; $__LIST__ = $header;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="u-btn  <?php if($vo['action'] == $action): ?>u-btn-primary<?php else: ?>u-btn<?php endif; ?>" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["action_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
   

		<div class=" m-form-horizontal">
			<admin:panel>
				
        <div class="formitm">
            <label class="lab">头像</label>
            <div class="ipt">
                <img src="<?php echo ((isset($info["avatar"]) && ($info["avatar"] !== ""))?($info["avatar"]):'/Public/img/mrtx.jpg'); ?>" id="superman" width="100px">
					<input id="fileupload" type="file" style="display:none;">
					<input type="hidden" name="avatar" value="" />
					<input type="button" value="上传头像" id="upload" onclick="fileuploadshow()" />
                <p class="help-block">用户头像</p>
            </div>
        </div>

				
        <div class="formitm">
            <label class="lab">用户名/登录名</label>
            <div class="ipt">
                <?php if($info['user_login']): echo ($info['user_login']); ?>
						<input name="user_login" type="hidden"  class="form-element u-width-large  " id="user_login" value="<?php echo ($info["user_login"]); ?>" maxlength="20"   >
						<?php else: ?>
						<input name="user_login" type="text"  class="form-element u-width-large  " id="user_login" value="<?php echo ($info["user_login"]); ?>" maxlength="20"  datatype="*" ><?php endif; ?>
                <p class="help-block">用户登录帐号</p>
            </div>
        </div>
				
        <div class="formitm">
            <label class="lab">密码</label>
            <div class="ipt">
                <input name="user_pass" type="password"  class="form-element u-width-large  " id="user_pass" value="" maxlength="250"   >
                <p class="help-block">用户密码</p>
            </div>
        </div>
				
        <div class="formitm">
            <label class="lab">重复密码</label>
            <div class="ipt">
                <input name="user_pass2" type="password"  class="form-element u-width-large  " id="user_pass2" value="" maxlength="250"   >
                <p class="help-block">重复密码</p>
            </div>
        </div>
				
        <div class="formitm">
            <label class="lab">昵称</label>
            <div class="ipt">
                <input name="user_nicename" type="text"  class="form-element u-width-large  " id="user_nicename" value="<?php echo ($info["user_nicename"]); ?>" maxlength="20"   >
                <p class="help-block">昵称</p>
            </div>
        </div>
				
        <div class="formitm">
            <label class="lab">性别</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="sex" id="sex0" value="0"   <?php if(!isset($info['sex'])){ $info['sex']= "1"; } if(0 == $info['sex']){ ?> checked="checked" <?php } ?> > <span>未知</span>
                    </label> <label>
                      <input type="radio" name="sex" id="sex1" value="1"   <?php if(!isset($info['sex'])){ $info['sex']= "1"; } if(1 == $info['sex']){ ?> checked="checked" <?php } ?> > <span>男</span>
                    </label> <label>
                      <input type="radio" name="sex" id="sex2" value="2"   <?php if(!isset($info['sex'])){ $info['sex']= "1"; } if(2 == $info['sex']){ ?> checked="checked" <?php } ?> > <span>女</span>
                    </label> 
                <p class="help-block">性别</p>
            </div>
        </div>
				
        <div class="formitm">
            <label class="lab">推荐人</label>
            <div class="ipt">
                <input name="parent_id" type="text"  class="form-element u-width-large  " id="parent_id" value="<?php echo ($info["parent_id"]); ?>" maxlength="250"   >
                <p class="help-block">推荐人ID</p>
            </div>
        </div>
				
        <div class="formitm">
            <label class="lab">关注公众号状态</label>
            <div class="ipt">
                <?php if(($info["subscribe"]) == "1"): ?>已关注，关注时间:<?php echo (date("Y-m-d H:i:s",$info["subscribe_time"])); ?>
						<?php else: ?>未关注<?php endif; ?>
                <p class="help-block">是否关注公众号</p>
            </div>
        </div>

				
        <div class="formitm">
            <label class="lab">积分余额统计</label>
            <div class="ipt">
                <?php echo C('jifen_name')?>：<?php echo ($info["jifen"]); ?><br>
					<?php echo C('money_name')?>：<?php echo ($info["money"]); ?>
                <p class="help-block">积分余额统计</p>
            </div>
        </div>
				
        <div class="formitm">
            <label class="lab">所在地区</label>
            <div class="ipt">
                <select name="provinceid" id="provinceid">
          <option value="0">请选择</option>
         <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo['areaid'] == $info['provinceid']): ?>selected<?php endif; ?>  value="<?php echo ($vo["areaid"]); ?>"><?php echo ($vo["areaname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>

					<select name="cityid" id="cityid">
         <option value="0">请选择</option>
         <?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo['areaid'] == $info['cityid']): ?>selected<?php endif; ?>  value="<?php echo ($vo["areaid"]); ?>"><?php echo ($vo["areaname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
                <p class="help-block">所在地区</p>
            </div>
        </div>

				
        <div class="formitm">
            <label class="lab">用户状态</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="user_status" id="user_status0" value="1"   <?php if(!isset($info['user_status'])){ $info['user_status']= "1"; } if(1 == $info['user_status']){ ?> checked="checked" <?php } ?> > <span>正常</span>
                    </label> <label>
                      <input type="radio" name="user_status" id="user_status1" value="0"   <?php if(!isset($info['user_status'])){ $info['user_status']= "1"; } if(0 == $info['user_status']){ ?> checked="checked" <?php } ?> > <span>禁用</span>
                    </label> <label>
                      <input type="radio" name="user_status" id="user_status2" value="2"   <?php if(!isset($info['user_status'])){ $info['user_status']= "1"; } if(2 == $info['user_status']){ ?> checked="checked" <?php } ?> > <span>未验证</span>
                    </label> 
                <p class="help-block">禁用后该用户将无法登录</p>
            </div>
        </div>

				
        <div class="formitm form-submit">
        <div class="ipt">
            <div class="tip" id="tips"></div>
            <button class="u-btn u-btn-success u-btn-large" type="submit" id="btn-submit">保存</button>
            <button class="u-btn u-btn-large" type="reset">重置</button>
        </div>
        </div>
			</admin:panel>
		</div>
	</div>
	<input name="id" type="hidden"  class="form-element u-width-large  " id="id" value="<?php echo ($info["id"]); ?>"    >
        </fieldset>
        </form>

<script>
	Do.ready('base', function() {
		//表单综合处理
		$('#form').duxFormPage();

		//提取关键词
		$('#getKeyword').click(function() {
			$.post('<?php echo U("DuxCms/ContentTools/getKerword");?>', {
					title: $('#content').val(),
					content: $('#description').val()
				},
				function(data) {
					if (data.status) {
						$('#keywords').val(data.info);
					} else {
						alert(data.info);
					}
				}, 'json');
		});
		//动态获取扩展字段
		$('#class_id').change(function() {
			$('#expand').load('<?php echo U("DuxCms/AdminExpand/getField");?>', {
				class_id: $(this).val(),
				content_id: $('#content_id').val()
			}, function() {
				$('#expand').duxFormPage({
					form: false
				});
			});
		});
		$('#class_id').change();
	});

	function sendaccount(thiss) {
		thiss.setAttribute("disabled", true);
		var mtype = $("#hdmtype3").val();
		var moeny = $('#hbmoeny3').val();
		var type = $("#hdtype3").val();
		var desc = $("#hbdesc3").val();
		var uid = $("#hbuid3").val();
		$.post("<?php echo U('Admin/User/sendaccount');?>", {
			mtype: mtype,
			type: type,
			moeny: moeny,
			desc: desc,
			uid: uid
		}, function(data) {
			alert(data);
			thiss.removeAttribute("disabled");
		})
	}

	function sendzz(thiss) {
		thiss.setAttribute("disabled", true);
		var openid = $("#weixin").val();
		var fee = $("#hbfee2").val();
		var desc = $("#hbbody2").val();
		$.post("<?php echo U('Admin/User/sendzz');?>", {
			openid: openid,
			fee: fee,
			desc: desc
		}, function(data) {
			alert(data);
			thiss.removeAttribute("disabled");
		})

	}

	function sendhongbao(thiss, type) {
		thiss.setAttribute("disabled", true);
		if (type == 'lb') {
			var num = $("#hbnum").val();
			var openid = $("#weixin").val();
			var hbtitle = $("#hbtitle1").val();
			var hbbody = $("#hbbody1").val();
			var fee = $("#hbfee1").val();
		} else {
			var openid = $("#weixin").val();
			var hbtitle = $("#hbtitle").val();
			var hbbody = $("#hbbody").val();
			var fee = $("#hbfee").val();
		}
		$.post("<?php echo U('Admin/User/sendhbs');?>", {
			openid: openid,
			hbtitle: hbtitle,
			hbbody: hbbody,
			fee: fee,
			type: type,
			num: num
		}, function(data) {
			alert(data);
			thiss.removeAttribute("disabled");
		})

	}

	$(function() {
		$('#provinceid').change(function() {
			var url = "<?php echo U('Home/Ajax/ajax_get_city');?>";
			var provinceid = $(this).val();
			if (!provinceid) return false;
			$.post(url, {
				provinceid: provinceid
			}, function(json) {
				html = '<option value="0">请选择</option>';
				if (json) {
					$.each(json, function(idx, item) {
						html += '<option value="' + item.areaid + '">' + item.areaname + '</option>';
					});
					$("#cityid").html(html);
				}
			}, 'json');
		})
	})
</script>

<script src="/upimg/js/vendor/jquery.ui.widget.js"></script>
<script src="/upimg/js/jquery.iframe-transport.js"></script>
<script src="/upimg/js/jquery.fileupload.js"></script>
<script>
	$(function(){
		'use strict';
		var  url = "<?php echo U('Home/Form/upload',array('slt'=>1));?>";
		$('#fileupload').fileupload({
    	url: url,
    	dataType: 'json',
    	done: function (e, data){
    		if(data.result.status==1){
    			$("#superman").attr('src',data.result.data.url);
    			$("input[name='avatar']").val(data.result.data.url);
      	}else{
       		alert(data.result.info);
      	}
    	},
    	progressall: function(e, data){
      	var progress = parseInt(data.loaded / data.total * 100, 10);
      	$('#progress .progress-bar').css('width',progress + '%');
    	}
		}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
	});

	function fileuploadshow(){
		$("#fileupload").click();
	}
</script>