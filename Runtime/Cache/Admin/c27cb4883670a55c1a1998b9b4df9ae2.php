<?php if (!defined('THINK_PATH')) exit();?><h1>虚拟货币逻辑计费设置</h1>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          <h3>亲密度</h3>
  
   
        <div class="formitm">
            <label class="lab">送礼获得</label>
            <div class="ipt">
                <input name="gift_qmd" type="text"  class="form-element u-width-large  " id="gift_qmd" value="<?php echo ($info["gift_qmd"]); ?>" maxlength="50"   >
                <p class="help-block">礼物没有设置亲密度值则按照此设置（固定值/个礼物）</p>
            </div>
        </div>
  
        
        <div class="formitm">
            <label class="lab">相互关注获得</label>
            <div class="ipt">
                <input name="qmd_qi" type="text"  class="form-element u-width-large  " id="qmd_qi" value="<?php echo ($info["qmd_qi"]); ?>" maxlength="50"   >
                <p class="help-block">相互关注获得亲密度（固定值）</p>
            </div>
        </div> 
	   
	    
        <div class="formitm">
            <label class="lab">聊天获得</label>
            <div class="ipt">
                <input name="qmd_lt" type="text"  class="form-element u-width-large  " id="qmd_lt" value="<?php echo ($info["qmd_lt"]); ?>" maxlength="50"   >
                <p class="help-block">聊天获得亲密度，每相互聊天多少条数获得1亲密度（固定值）</p>
            </div>
        </div> 	   
	   
	    
        <div class="formitm">
            <label class="lab">查看私密相册默认</label>
            <div class="ipt">
                <input name="check_simi_moren" type="text"  class="form-element u-width-large  " id="check_simi_moren" value="<?php echo ($info["check_simi_moren"]); ?>" maxlength="50"   >
                <p class="help-block">男查看女私密相册需要亲密度(男)（固定值）</p>
            </div>
        </div>
	   
	     <h3><?php echo ($config["jifen_name_nv"]); ?>/<?php echo ($config["jifen_name"]); ?></h3>
	   
   
         
        <div class="formitm">
            <label class="lab">送礼默认</label>
            <div class="ipt">
                <input name="gift_def" type="text"  class="form-element u-width-large  " id="gift_def" value="<?php echo ($info["gift_def"]); ?>" maxlength="50"   >
                <p class="help-block">礼物没有设置<?php echo ($config["jifen_name_nv"]); ?>/<?php echo ($config["jifen_name"]); ?>值则按照此设置（礼物金额的%/个礼物)</p>
            </div>
        </div>
	   
	    
        <div class="formitm">
            <label class="lab">购买VIP获得</label>
            <div class="ipt">
                <input name="buy_vip_jifen" type="text"  class="form-element u-width-large  " id="buy_vip_jifen" value="<?php echo ($info["buy_vip_jifen"]); ?>" maxlength="50"   >
                <p class="help-block">购买VIP获得<?php echo ($config["jifen_name_nv"]); ?>/<?php echo ($config["jifen_name"]); ?>（固定值）</p>
            </div>
        </div>
	   
	   
        <div class="formitm">
            <label class="lab">充值获得</label>
            <div class="ipt">
                <input name="buy_cz_jifen" type="text"  class="form-element u-width-large  " id="buy_cz_jifen" value="<?php echo ($info["buy_cz_jifen"]); ?>" maxlength="50"   >
                <p class="help-block">充值获得<?php echo ($config["jifen_name_nv"]); ?>/<?php echo ($config["jifen_name"]); ?>（充值<?php echo ($config["money_name"]); ?>的%）</p>
            </div>
        </div>
	   
	    
        <div class="formitm">
            <label class="lab">被关注得<?php echo ($config["jifen_name_nv"]); ?>（女)</label>
            <div class="ipt">
                <input name="gz_jifen_nv" type="text"  class="form-element u-width-large  " id="gz_jifen_nv" value="<?php echo ($info["gz_jifen_nv"]); ?>" maxlength="50"   >
                <p class="help-block">被关注获得<?php echo ($config["jifen_name_nv"]); ?>（女）（固定值）</p>
            </div>
        </div>
	   
	     
        <div class="formitm">
            <label class="lab">邀请好友(男)</label>
            <div class="ipt">
                <input name="gz_jifen" type="text"  class="form-element u-width-large  " id="gz_jifen" value="<?php echo ($info["gz_jifen"]); ?>" maxlength="50"   >
                <p class="help-block">邀请好友获得<?php echo ($config["jifen_name"]); ?>(男)（固定值）</p>
            </div>
        </div>
	   
       
       
	 
       
	   
	     <h3><?php echo ($config["money_name"]); ?>获得</h3>	 
		 
        <div class="formitm">
            <label class="lab">注册赠送</label>
            <div class="ipt">
                <input name="reg_send" type="text"  class="form-element u-width-large  " id="reg_send" value="<?php echo ($info["reg_send"]); ?>" maxlength="50"   >
                <p class="help-block">注册赠送<?php echo ($config["money_name"]); ?>（固定值）</p>
            </div>
        </div>
	
        <div class="formitm">
            <label class="lab">上传公开照获得</label>
            <div class="ipt">
                <input name="up_photo_gk" type="text"  class="form-element u-width-large  " id="up_photo_gk" value="<?php echo ($info["up_photo_gk"]); ?>" maxlength="50"   >
                <p class="help-block">每天上传一张公开照获得<?php echo ($config["money_name"]); ?>（固定值）</p>
            </div>
        </div>
	
        <div class="formitm">
            <label class="lab">公开照前N张上传</label>
            <div class="ipt">
                <input name="up_photo_gk_num" type="text"  class="form-element u-width-large  " id="up_photo_gk_num" value="<?php echo ($info["up_photo_gk_num"]); ?>" maxlength="50"   >
                <p class="help-block">每天上传公开照的前N张才有给<?php echo ($config["money_name"]); ?>，超过此设置不给钱（固定值）</p>
            </div>
        </div>
	   
	   
        <div class="formitm">
            <label class="lab">上传私密照获得(女)</label>
            <div class="ipt">
                <input name="up_photo_sm" type="text"  class="form-element u-width-large  " id="up_photo_sm" value="<?php echo ($info["up_photo_sm"]); ?>" maxlength="50"   >
                <p class="help-block">每天上传一张私密照获得<?php echo ($config["money_name"]); ?>（固定值）</p>
            </div>
        </div>
	
        <div class="formitm">
            <label class="lab">私密照前N张上传(女)</label>
            <div class="ipt">
                <input name="up_photo_sm_num" type="text"  class="form-element u-width-large  " id="up_photo_sm_num" value="<?php echo ($info["up_photo_sm_num"]); ?>" maxlength="50"   >
                <p class="help-block">每天上传私密照的前N张才有给<?php echo ($config["money_name"]); ?>，超过此设置不给钱（固定值）</p>
            </div>
        </div>
	   
	    
        <div class="formitm">
            <label class="lab">邀请好友</label>
            <div class="ipt">
                <input name="gz_money" type="text"  class="form-element u-width-large  " id="gz_money" value="<?php echo ($info["gz_money"]); ?>" maxlength="50"   >
                <p class="help-block">邀请好友获得<?php echo ($config["money_name"]); ?>（固定值，多级好友使用逗号隔开，如设置为：500,400,300,200,100。则你邀请一级粉丝获得500，二级粉丝获得400，三级获得300……）</p>
            </div>
        </div>
	   
	    
        <div class="formitm">
            <label class="lab">邀请好友购买vip</label>
            <div class="ipt">
                <input name="gz_money_vip" type="text"  class="form-element u-width-large  " id="gz_money_vip" value="<?php echo ($info["gz_money_vip"]); ?>" maxlength="50"   > %
                <p class="help-block">邀请好友第一次购买vip获得<?php echo ($config["money_name"]); ?>返利（百分比%，多级好友使用逗号隔开）</p>
            </div>
        </div>
	   
	    
        <div class="formitm">
            <label class="lab">邀请好友充值</label>
            <div class="ipt">
                <input name="gz_money_cz" type="text"  class="form-element u-width-large  " id="gz_money_cz" value="<?php echo ($info["gz_money_cz"]); ?>" maxlength="50"   > %
                <p class="help-block">邀请好友每次充值后获得<?php echo ($config["money_name"]); ?>返利（充值<?php echo ($config["money_name"]); ?>%，多级好友使用逗号隔开）</p>
            </div>
        </div>
	   
	     
        <div class="formitm">
            <label class="lab">送礼默认返利（女）</label>
            <div class="ipt">
                <input name="gift_fld_nv" type="text"  class="form-element u-width-large  " id="gift_fld_nv" value="<?php echo ($info["gift_fld_nv"]); ?>" maxlength="50"   >
                <p class="help-block">礼物没有设置返利点值则按照此设置（礼物金额的%)</p>
            </div>
        </div>
	   
     
        <div class="formitm">
            <label class="lab">聊天返利（女）</label>
            <div class="ipt">
                <input name="lt_fld_nv" type="text"  class="form-element u-width-large  " id="lt_fld_nv" value="<?php echo ($info["lt_fld_nv"]); ?>" maxlength="50"   >
                <p class="help-block">单条聊天记录金额的百分比（%)。当前聊天单条金额设置为：<?php echo ($info["lt_zc_money"]); ?></p>
            </div>
        </div>
       
      
        <div class="formitm">
            <label class="lab">查看私密相册默认</label>
            <div class="ipt">
                <input name="sphoto_default" type="text"  class="form-element u-width-large  " id="sphoto_default" value="<?php echo ($info["sphoto_default"]); ?>" maxlength="50"   >
                <p class="help-block">男查看女私密相册需要支付<?php echo ($config["money_name"]); ?>(男)（固定值）</p>
            </div>
        </div>
       
       
        <div class="formitm">
            <label class="lab">查看私密照返利%（女）</label>
            <div class="ipt">
                <input name="sphoto_fld_nv" type="text"  class="form-element u-width-large  " id="sphoto_fld_nv" value="<?php echo ($info["sphoto_fld_nv"]); ?>" maxlength="50"   >
                <p class="help-block">当男方付费查看女方私密照，女获得的<?php echo ($config["money_name"]); ?>返利</p>
            </div>
        </div>
       
     <h3><?php echo ($config["money_name"]); ?>支出</h3>
	 
	    
        <div class="formitm">
            <label class="lab">聊天支付</label>
            <div class="ipt">
                <input name="lt_zc_money" type="text"  class="form-element u-width-large  " id="lt_zc_money" value="<?php echo ($info["lt_zc_money"]); ?>" maxlength="50"   >
                <p class="help-block">男和女聊天每条聊天需要支付N<?php echo ($config["money_name"]); ?>(男)（固定值）</p>
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