<?php if (!defined('THINK_PATH')) exit();?><h3>运营设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">是否开启微信提现</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="open_tx_wx" id="open_tx_wx0" value="1"   <?php  if(1 == $info['open_tx_wx']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="open_tx_wx" id="open_tx_wx1" value="0"   <?php  if(0 == $info['open_tx_wx']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">开后前台用微信提现</p>
            </div>
        </div>
  
    
        <div class="formitm">
            <label class="lab">是否开启支付宝提现</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="open_tx_zfb" id="open_tx_zfb0" value="1"   <?php  if(1 == $info['open_tx_zfb']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="open_tx_zfb" id="open_tx_zfb1" value="0"   <?php  if(0 == $info['open_tx_zfb']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">开后前台用支付宝提现</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">是否开启话费充值</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="open_tx_hf" id="open_tx_hf0" value="1"   <?php  if(1 == $info['open_tx_hf']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="open_tx_hf" id="open_tx_hf1" value="0"   <?php  if(0 == $info['open_tx_hf']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">开后前台用户可提交话费充值</p>
            </div>
        </div>


     
        <div class="formitm">
            <label class="lab">最低提现金额</label>
            <div class="ipt">
                <input name="tx_qt_money" type="text"  class="form-element u-width-large  " id="tx_qt_money" value="<?php echo ($info["tx_qt_money"]); ?>" maxlength="50"   >
                <p class="help-block">最低提现金额</p>
            </div>
        </div>
     
      
        <div class="formitm">
            <label class="lab">微信审核提现</label>
            <div class="ipt">
                <input name="tx_wx_money" type="text"  class="form-element u-width-large  " id="tx_wx_money" value="<?php echo ($info["tx_wx_money"]); ?>" maxlength="50"   >
                <p class="help-block">微信提现达到此设置转为人工发放。0为无需审核</p>
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