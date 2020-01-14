<?php if (!defined('THINK_PATH')) exit();?><h3>特权提示设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">购买VIP会员-特权介绍</label>
            <div class="ipt">
                <textarea name="buyvipintro" type="text"  class="form-element u-width-full u-editor" id="buyvipintro" value="" rows="10"   ><?php echo ($info["buyvipintro"]); ?></textarea>
                <p class="help-block">购买VIP会员-特权介绍内容，字数不可超过50个一行，多个请回车</p>
            </div>
        </div>
    
	
	 
        <div class="formitm">
            <label class="lab">充值<?php echo ($config["money_name"]); ?>-特权介绍</label>
            <div class="ipt">
                <textarea name="buycoinintro" type="text"  class="form-element u-width-full u-editor" id="buycoinintro" value="" rows="10"   ><?php echo ($info["buycoinintro"]); ?></textarea>
                <p class="help-block">充值<?php echo ($config["money_name"]); ?>-特权介绍内容，字数不可超过50个一行，多个请回车</p>
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
	$('#form').duxFormPage();
});
</script>