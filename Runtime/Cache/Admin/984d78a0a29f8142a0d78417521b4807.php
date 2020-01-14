<?php if (!defined('THINK_PATH')) exit();?><h1>佣金提成设置</h1>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('Admin/Tuig/tichensetting');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          <h3>提成(以人民币结算，单位:元)</h3>	 
	
        <div class="formitm">
            <label class="lab">邀请注册(固定值)</label>
            <div class="ipt">
                <input name="gz_money" type="text"  class="form-element u-width-large  " id="gz_money" value="<?php echo ($info["gz_money"]); ?>" maxlength="50"   >
                <p class="help-block">被邀请者注册成功后，可获得金钱（固定值，多级好友使用逗号隔开，如设置为：30,20,10。则你邀请一级粉丝获得30，二级粉丝获得20，三级获得10……）</p>
            </div>
        </div>

	
        <div class="formitm">
            <label class="lab">购买VIP(百分比)</label>
            <div class="ipt">
                <input name="gz_money_vip" type="text"  class="form-element u-width-mini  " id="gz_money_vip" value="<?php echo ($info["gz_money_vip"]); ?>" maxlength="50"   >%
                <p class="help-block">被邀请者第一次购买vip获得提成(元)（百分比，多级好友使用逗号隔开）</p>
            </div>
        </div>

	
        <div class="formitm">
            <label class="lab">聊币充值(百分比)</label>
            <div class="ipt">
                <input name="gz_money_cz" type="text"  class="form-element u-width-mini  " id="gz_money_cz" value="<?php echo ($info["gz_money_cz"]); ?>" maxlength="50"   > %
                <p class="help-block">被邀请者每次充值后获得<?php echo ($config["money_name"]); ?>返利（充值<?php echo ($config["money_name"]); ?>%，多级好友使用逗号隔开）</p>
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