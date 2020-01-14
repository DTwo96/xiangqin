<?php if (!defined('THINK_PATH')) exit();?><h3>支付设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">MCHID</label>
            <div class="ipt">
                <input name="MCHID" type="text"  class="form-element u-width-large  " id="MCHID" value="<?php echo ($info["MCHID"]); ?>" maxlength="250"   >
                <p class="help-block">微信商户id</p>
            </div>
        </div>
	
	
        <div class="formitm">
            <label class="lab">KEY</label>
            <div class="ipt">
                <input name="MCKEY" type="text"  class="form-element u-width-large  " id="MCKEY" value="<?php echo ($info["MCKEY"]); ?>" maxlength="250"   >
                <p class="help-block">微信商户key，微信支付设置教程：http://www.yueai.me/help/weipay.html</p>
            </div>
        </div>  
       
     
        <div class="formitm">
            <label class="lab">支付宝合作身份者id</label>
            <div class="ipt">
                <input name="alipay_config_partner" type="text"  class="form-element u-width-large  " id="alipay_config_partner" value="<?php echo ($info["alipay_config_partner"]); ?>" maxlength="250"   >
                <p class="help-block">合作身份者id，以2088开头的16位纯数字</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">收款支付宝账号</label>
            <div class="ipt">
                <input name="alipay_config_seller_id" type="text"  class="form-element u-width-large  " id="alipay_config_seller_id" value="<?php echo ($info["alipay_config_seller_id"]); ?>" maxlength="250"   >
                <p class="help-block">收款支付宝账号，一般情况下收款账号就是签约账号</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">支付宝查询安全校验码(key)</label>
            <div class="ipt">
                <input name="alipay_config_key" type="text"  class="form-element u-width-large  " id="alipay_config_key" value="<?php echo ($info["alipay_config_key"]); ?>" maxlength="250"   >
                <p class="help-block">查询安全校验码(key)</p>
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