<?php if (!defined('THINK_PATH')) exit();?><h3>公众号设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">公众号</label>
            <div class="ipt">
                <input name="gzhcode" type="text"  class="form-element u-width-large  " id="gzhcode" value="<?php echo ($info["gzhcode"]); ?>" maxlength="250"   >
                <p class="help-block">公众号英文如 lxphp</p>
            </div>
        </div>

	
        <div class="formitm">
            <label class="lab">二维码图片</label>
            <div class="ipt">
                <img id="img_gzhqrimg" width="200" src="<?php if(empty($info['gzhqrimg'])): ?>/Public/admin/images/placeholder.jpg<?php else: echo ($info["gzhqrimg"]); endif; ?>" /><br>
      <input name="gzhqrimg" type="text"  class="form-element u-width-large  " id="gzhqrimg" value="<?php echo ($info["gzhqrimg"]); ?>" maxlength="250"   >
	  <a class="u-btn u-btn-primary" data="image" href="javascript:;" id="upload">上传</a>
                <p class="help-block">公众号二维码图片,通过代理推广过来的用户，可以刷此二维码关注公众号</p>
            </div>
        </div>
    
	 
        <div class="formitm">
            <label class="lab">管理员OPENID</label>
            <div class="ipt">
                <input name="adminopenid" type="text"  class="form-element u-width-large  " id="adminopenid" value="<?php echo ($info["adminopenid"]); ?>" maxlength="250"   >
                <p class="help-block">重要通知发送到管理员微信号！</p>
            </div>
        </div>
    
   

    
        <div class="formitm">
            <label class="lab">自定义token</label>
            <div class="ipt">
                <input name="wxtoken" type="text"  class="form-element u-width-large  " id="wxtoken" value="<?php echo ($info["wxtoken"]); ?>" maxlength="250"   >
                <p class="help-block">微信后台token接口，默认为 lxphpweixin 。备注：token网址为：http://<?php echo ($info["site_url"]); echo U('Home/Weixin/index');?></p>
            </div>
        </div>
    
    
    
	
        <div class="formitm">
            <label class="lab">APPID</label>
            <div class="ipt">
                <input name="APPID" type="text"  class="form-element u-width-large  " id="APPID" value="<?php echo ($info["APPID"]); ?>" maxlength="250"   >
                <p class="help-block">主微信APPID，一般有微信支付的服务号</p>
            </div>
        </div>
	
	
        <div class="formitm">
            <label class="lab">SCRETID</label>
            <div class="ipt">
                <input name="SCRETID" type="text"  class="form-element u-width-large  " id="SCRETID" value="<?php echo ($info["SCRETID"]); ?>" maxlength="250"   >
                <p class="help-block">微信AppSecret</p>
            </div>
        </div>
	

   
    
  <!--  
        <div class="formitm">
            <label class="lab">APPID_jsapi</label>
            <div class="ipt">
                <input name="APPID_jsapi" type="text"  class="form-element u-width-large  " id="APPID_jsapi" value="<?php echo ($info["APPID_jsapi"]); ?>" maxlength="250"   >
                <p class="help-block">当分享接口失效时。应急分享接口appid</p>
            </div>
        </div>
	
	
        <div class="formitm">
            <label class="lab">SCRETID_jsapi</label>
            <div class="ipt">
                <input name="SCRETID_jsapi" type="text"  class="form-element u-width-large  " id="SCRETID_jsapi" value="<?php echo ($info["SCRETID_jsapi"]); ?>" maxlength="250"   >
                <p class="help-block">当分享接口失效时。应急分享接口AppSecret</p>
            </div>
        </div>
    -->
	
        <div class="formitm">
            <label class="lab">引导关注URL</label>
            <div class="ipt">
                <input name="newsubscribeurl" type="text"  class="form-element u-width-large  " id="newsubscribeurl" value="<?php echo ($info["newsubscribeurl"]); ?>" maxlength=""   >
                <p class="help-block">引导关注URL</p>
            </div>
        </div>
    
    <h3>公众号通知</h3>
	
	
	
        <div class="formitm">
            <label class="lab">个人消息通知ID</label>
            <div class="ipt">
                <input name="moneymb" type="text"  class="form-element u-width-large  " id="moneymb" value="<?php echo ($info["moneymb"]); ?>" maxlength="250"   >
                <p class="help-block">个人消息通知模板id，配置教程：http://www.yueai.me/help/weimsg.html</p>
            </div>
        </div>
    
	
    
     
        <div class="formitm">
            <label class="lab">自定义关注回复（男）。</label>
            <div class="ipt">
                <textarea name="diygzhf" type="text"  class="form-element u-width-large " id="diygzhf" value="" rows="5"   ><?php echo ($info["diygzhf"]); ?></textarea>
                <p class="help-block">自定义关注回复,不填则不回复。</p>
            </div>
        </div>
	
	
        <div class="formitm">
            <label class="lab">自定义关注回复（女）。</label>
            <div class="ipt">
                <textarea name="diygzhfnv" type="text"  class="form-element u-width-large " id="diygzhfnv" value="" rows="5"   ><?php echo ($info["diygzhfnv"]); ?></textarea>
                <p class="help-block">自定义关注回复,不填则不回复。</p>
            </div>
        </div>
	
	  
        <div class="formitm">
            <label class="lab">关注推送</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="gztstw" id="gztstw0" value="1"   <?php  if(1 == $info['gztstw']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="gztstw" id="gztstw1" value="0"   <?php  if(0 == $info['gztstw']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">关注推送异性资料图文消息</p>
            </div>
        </div>
	
	
        <div class="formitm">
            <label class="lab">收到礼物</label>
            <div class="ipt">
                <input name="giftnotice" type="text"  class="form-element u-width-large  " id="giftnotice" value="<?php echo ($info["giftnotice"]); ?>" maxlength="250"   >
                <p class="help-block">收到的礼物价值(<?php echo ($config["money_name"]); ?>)大于以上设置时通知给对方。</p>
            </div>
        </div>
	
	<!--
	
        <div class="formitm">
            <label class="lab">未读私信</label>
            <div class="ipt">
                <input name="wdsxnotice" type="text"  class="form-element u-width-large  " id="wdsxnotice" value="<?php echo ($info["wdsxnotice"]); ?>" maxlength="250"   >
                <p class="help-block">未读私信数量大于以上设置时通知到微信。</p>
            </div>
        </div>
	-->
       
	 
        <div class="formitm">
            <label class="lab">个人主页被访问</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="homehit" id="homehit0" value="1"   <?php  if(1 == $info['homehit']){ ?> checked="checked" <?php } ?> > <span>通知男</span>
                    </label> <label>
                      <input type="radio" name="homehit" id="homehit1" value="2"   <?php  if(2 == $info['homehit']){ ?> checked="checked" <?php } ?> > <span>通知女</span>
                    </label> <label>
                      <input type="radio" name="homehit" id="homehit2" value="3"   <?php  if(3 == $info['homehit']){ ?> checked="checked" <?php } ?> > <span>全部通知</span>
                    </label> <label>
                      <input type="radio" name="homehit" id="homehit3" value="0"   <?php  if(0 == $info['homehit']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">个人主页被访问通知,默认30分钟通知一次，配置文件可修改频率，源*码/由-折*翼/天-使*资/源*社-区*提/供</p>
            </div>
        </div>
    
    
        <div class="formitm form-submit">
        <div class="ipt">
            <div class="tip" id="tips"></div>
            <button class="u-btn u-btn-success u-btn-large" type="submit" id="btn-submit">保存</button>
            <button class="u-btn u-btn-large" type="reset">重置</button>
        </div>
        </div>
        </fieldset>
        </form>
            </div> </div>
<script>
Do.ready('base', function() {
	$('#form').duxForm();

	//上传缩略图
	$('#upload').duxFileUpload({
		type: 'jpg,png,gif,bmp',
		complete: function (data) {
			$('#gzhqrimg').get(0).value = data.url;
			$('#img_gzhqrimg').attr('src', data.url);
		}
	});
});
</script>