<?php if (!defined('THINK_PATH')) exit();?><h1>会员私信提示设置</h1>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('Admin/Compose/setting');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          <h3>私信提示设置</h3>
  
	
        <div class="formitm">
            <label class="lab">私信提示</label>
            <div class="ipt">
                <input name="msg_count" type="text"  class="form-element u-width-mini  " id="msg_count" value="<?php echo ($info["msg_count"]); ?>" maxlength="3"   > 条
                <p class="help-block">设置当会员有多少条私信未读时，微信发提示信息</p>
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
});
</script>