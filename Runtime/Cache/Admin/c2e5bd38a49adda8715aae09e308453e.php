<?php if (!defined('THINK_PATH')) exit();?><h3>马甲设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">开启马甲招呼</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="openmj" id="openmj0" value="0"   <?php  if(0 == $info['openmj']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> <label>
                      <input type="radio" name="openmj" id="openmj1" value="1"   <?php  if(1 == $info['openmj']){ ?> checked="checked" <?php } ?> > <span>招呼男</span>
                    </label> <label>
                      <input type="radio" name="openmj" id="openmj2" value="2"   <?php  if(2 == $info['openmj']){ ?> checked="checked" <?php } ?> > <span>招呼女</span>
                    </label> <label>
                      <input type="radio" name="openmj" id="openmj3" value="3"   <?php  if(3 == $info['openmj']){ ?> checked="checked" <?php } ?> > <span>招呼全部</span>
                    </label> 
                <p class="help-block">开启自动招呼功能，招呼推送到微信消息。默认图文消息，推送失败则改为模板消息。</p>
            </div>
        </div>	
	
<!--
        <div class="formitm">
            <label class="lab">马甲打招呼</label>
            <div class="ipt">
                <input name="regbegin" type="text"  class="form-element u-width-mini  " id="regbegin" value="<?php echo ($info["regbegin"]); ?>" maxlength="250"   >  -  <input name="regend" type="text"  class="form-element u-width-mini  " id="regend" value="<?php echo ($info["regend"]); ?>" maxlength="250"   > 分钟
                <p class="help-block">注册多久后开始打招呼</p>
            </div>
        </div>-->
    
	<!--
	 
        <div class="formitm">
            <label class="lab">马甲打招呼2</label>
            <div class="ipt">
                <input name="loginbegin" type="text"  class="form-element u-width-mini  " id="loginbegin" value="<?php echo ($info["loginbegin"]); ?>" maxlength="250"   >  -  <input name="loginend" type="text"  class="form-element u-width-mini  " id="loginend" value="<?php echo ($info["loginend"]); ?>" maxlength="250"   > 分钟
                <p class="help-block">用户登录多久内开始不断自动打招呼</p>
            </div>
        </div>
	-->
    
	 
        <div class="formitm">
            <label class="lab">打招呼间隔时间</label>
            <div class="ipt">
                <input name="mjzhpl" type="text"  class="form-element u-width-mini  " id="mjzhpl" value="<?php echo ($info["mjzhpl"]); ?>" maxlength="250"   >  +随机1-5分钟
                <p class="help-block">马甲打招呼间隔时间</p>
            </div>
        </div>
	
	<!-- 马甲自动踩个人主页功能 -->
	
        <div class="formitm">
            <label class="lab">开启马甲踩个人主页</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="openmjhp" id="openmjhp0" value="0"   <?php  if(0 == $info['openmjhp']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> <label>
                      <input type="radio" name="openmjhp" id="openmjhp1" value="1"   <?php  if(1 == $info['openmjhp']){ ?> checked="checked" <?php } ?> > <span>踩男</span>
                    </label> <label>
                      <input type="radio" name="openmjhp" id="openmjhp2" value="2"   <?php  if(2 == $info['openmjhp']){ ?> checked="checked" <?php } ?> > <span>踩女</span>
                    </label> <label>
                      <input type="radio" name="openmjhp" id="openmjhp3" value="3"   <?php  if(3 == $info['openmjhp']){ ?> checked="checked" <?php } ?> > <span>踩全部</span>
                    </label> 
                <p class="help-block">开启自动踩个人主页功能，状态推送到微信消息。默认图文消息，推送失败则改为模板消息。</p>
            </div>
        </div>


	<!--
	
        <div class="formitm">
            <label class="lab">马甲踩个人主页2</label>
            <div class="ipt">
                <input name="mjhploginbegin" type="text"  class="form-element u-width-mini  " id="mjhploginbegin" value="<?php echo ($info["mjhploginbegin"]); ?>" maxlength="250"   >  -  <input name="mjhploginend" type="text"  class="form-element u-width-mini  " id="mjhploginend" value="<?php echo ($info["mjhploginend"]); ?>" maxlength="250"   > 分钟
                <p class="help-block">用户登录多久内开始不断自动踩个人主页</p>
            </div>
        </div>
	-->

	
        <div class="formitm">
            <label class="lab">踩个人主页间隔时间</label>
            <div class="ipt">
                <input name="mjmppl" type="text"  class="form-element u-width-mini  " id="mjmppl" value="<?php echo ($info["mjmppl"]); ?>" maxlength="250"   >  +随机1-5分钟
                <p class="help-block">马甲踩个人主页间隔时间</p>
            </div>
        </div>
	
  <!-- 
  马甲送礼等待需求后开发
    
        <div class="formitm">
            <label class="lab">马甲送礼</label>
            <div class="ipt">
                <input name="gzhcode" type="text"  class="form-element u-width-mini  " id="gzhcode" value="<?php echo ($info["gzhcode"]); ?>" maxlength="250"   >  -  <input name="gzhcode" type="text"  class="form-element u-width-mini  " id="gzhcode" value="<?php echo ($info["gzhcode"]); ?>" maxlength="250"   >
                <p class="help-block">马甲送礼的礼物编号</p>
            </div>
        </div>
    
       
        <div class="formitm">
            <label class="lab">马甲送礼</label>
            <div class="ipt">
                <input name="gzhcode" type="text"  class="form-element u-width-mini  " id="gzhcode" value="<?php echo ($info["gzhcode"]); ?>" maxlength="250"   >  -  <input name="gzhcode" type="text"  class="form-element u-width-mini  " id="gzhcode" value="<?php echo ($info["gzhcode"]); ?>" maxlength="250"   > 分钟
                <p class="help-block">马甲送礼这个时间内送礼给（男）</p>
            </div>
        </div>
	-->
	
	
	
    
    
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
});
</script>