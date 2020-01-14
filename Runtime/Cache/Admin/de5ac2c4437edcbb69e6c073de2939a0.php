<?php if (!defined('THINK_PATH')) exit();?><h3>运营设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">只在微信内打开</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="onlywx" id="onlywx0" value="1"   <?php  if(1 == $info['onlywx']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="onlywx" id="onlywx1" value="0"   <?php  if(0 == $info['onlywx']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">是否只允许前台网站只在微信内打开</p>
            </div>
        </div>
	
 
        <div class="formitm">
            <label class="lab">下级好友称呼</label>
            <div class="ipt">
                <input name="fansName" type="text"  class="form-element u-width-large  " id="fansName" value="<?php echo ($info["fansName"]); ?>" maxlength="50"   >
                <p class="help-block">下级好友称呼,默认(粉丝)</p>
            </div>
        </div> 
  
        
        <div class="formitm">
            <label class="lab">男性积分名称</label>
            <div class="ipt">
                <input name="jifen_name" type="text"  class="form-element u-width-large  " id="jifen_name" value="<?php echo ($info["jifen_name"]); ?>" maxlength="50"   >
                <p class="help-block">积分名称,默认(财富值)</p>
            </div>
        </div> 
	   
        <div class="formitm">
            <label class="lab">女性积分名称</label>
            <div class="ipt">
                <input name="jifen_name_nv" type="text"  class="form-element u-width-large  " id="jifen_name_nv" value="<?php echo ($info["jifen_name_nv"]); ?>" maxlength="50"   >
                <p class="help-block">积分名称,默认(魅力值)</p>
            </div>
        </div>
       
       
        <div class="formitm">
            <label class="lab">金钱名称</label>
            <div class="ipt">
                <input name="money_name" type="text"  class="form-element u-width-large  " id="money_name" value="<?php echo ($info["money_name"]); ?>" maxlength="50"   >
                <p class="help-block">金钱名称,默认(消费点)</p>
            </div>
        </div>
       
       
        <div class="formitm">
            <label class="lab"><?php echo ($info["money_name"]); ?>比例  </label>
            <div class="ipt">
                1：<input name="moneyBL" type="text"  class="form-element u-width-large  " id="moneyBL" value="<?php echo ($info["moneyBL"]); ?>" maxlength="50"   >
                <p class="help-block">设置<?php echo ($info["money_name"]); ?>比例  列如 1:1000 则 1元=1000<?php echo ($info["money_name"]); ?></p>
            </div>
        </div>
	   
	     
        <div class="formitm">
            <label class="lab">VIP购买礼物折扣 </label>
            <div class="ipt">
                <input name="vipgiftzhe" type="text"  class="form-element u-width-large  " id="vipgiftzhe" value="<?php echo ($info["vipgiftzhe"]); ?>" maxlength="50"   >
                <p class="help-block">如果会员是VIP，则购买礼物可享受折扣，没优惠则写10折</p>
            </div>
        </div>
	   
	   
	    
        <div class="formitm">
            <label class="lab">新手任务 </label>
            <div class="ipt">
                <input name="newbe1" type="text"  class="form-element u-width-large  " id="newbe1" value="<?php echo ($info["newbe1"]); ?>" maxlength="50"   >
                <p class="help-block">新手任务上传头像任务获得<?php echo ($info["money_name"]); ?></p>
            </div>
        </div>
	   
	    
        <div class="formitm">
            <label class="lab">新手任务 </label>
            <div class="ipt">
                <input name="newbe2" type="text"  class="form-element u-width-large  " id="newbe2" value="<?php echo ($info["newbe2"]); ?>" maxlength="50"   >
                <p class="help-block">新手任务完善资料任务获得<?php echo ($info["money_name"]); ?></p>
            </div>
        </div>
	   	   
	   
	   
	    
        <div class="formitm">
            <label class="lab">VIP签到 </label>
            <div class="ipt">
                <input name="vipqd" type="text"  class="form-element u-width-large  " id="vipqd" value="<?php echo ($info["vipqd"]); ?>" maxlength="50"   >
                <p class="help-block">VIP签到<?php echo ($info["money_name"]); ?>多+以上固定值</p>
            </div>
        </div>
	   
	   
	   
        <div class="formitm">
            <label class="lab">非VIP聊天人 </label>
            <div class="ipt">
                <input name="viltren" type="text"  class="form-element u-width-large  " id="viltren" value="<?php echo ($info["viltren"]); ?>" maxlength="50"   >
                <p class="help-block">男，非VIP聊天人数限制（默认100），VIP不限制</p>
            </div>
        </div>
	   
	    
        <div class="formitm">
            <label class="lab">非VIP聊天条数 </label>
            <div class="ipt">
                <input name="viltnum" type="text"  class="form-element u-width-large  " id="viltnum" value="<?php echo ($info["viltnum"]); ?>" maxlength="50"   >
                <p class="help-block">男，非VIP和单人的总（双方。）聊天条数（默认1000），VIP不限制</p>
            </div>
        </div>
       
         
        <div class="formitm">
            <label class="lab">非VIP打招呼数 </label>
            <div class="ipt">
                <input name="viltda" type="text"  class="form-element u-width-large  " id="viltda" value="<?php echo ($info["viltda"]); ?>" maxlength="50"   >
                <p class="help-block">男，非VIP打招呼人数限制（默认100），VIP不限制</p>
            </div>
        </div>
       
       	   
        <div class="formitm">
            <label class="lab">VIP邀请好友 </label>
            <div class="ipt">
                <input name="vipyq" type="text"  class="form-element u-width-large  " id="vipyq" value="<?php echo ($info["vipyq"]); ?>" maxlength="50"   >
                <p class="help-block">VIP邀请好友<?php echo ($info["money_name"]); ?>多+以上固定值(只有上级).0关闭</p>
            </div>
        </div>
       
       
        
        <div class="formitm">
            <label class="lab">审核昵称</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="nickname_flag" id="nickname_flag0" value="1"   <?php  if(1 == $info['nickname_flag']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="nickname_flag" id="nickname_flag1" value="0"   <?php  if(0 == $info['nickname_flag']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">用户修改昵称是否需要后台审核</p>
            </div>
        </div>
       
        
        <div class="formitm">
            <label class="lab">审核头像</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="avatar_flag" id="avatar_flag0" value="1"   <?php  if(1 == $info['avatar_flag']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="avatar_flag" id="avatar_flag1" value="0"   <?php  if(0 == $info['avatar_flag']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">用户设置头像是否需要后台审核</p>
            </div>
        </div>
       
          
        <div class="formitm">
            <label class="lab">内心独白审核</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="monolog_flag" id="monolog_flag0" value="1"   <?php  if(1 == $info['monolog_flag']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="monolog_flag" id="monolog_flag1" value="0"   <?php  if(0 == $info['monolog_flag']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">用户填写内心独白是否需要后台审核</p>
            </div>
        </div>
        
        <div class="formitm">
            <label class="lab">相册审核</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="photo_flag" id="photo_flag0" value="1"   <?php  if(1 == $info['photo_flag']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="photo_flag" id="photo_flag1" value="0"   <?php  if(0 == $info['photo_flag']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">上传照片是否需要后台审核，关闭，则上传后前台直接显示。</p>
            </div>
        </div>
       
           
        <div class="formitm">
            <label class="lab">评论审核</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="comment_flag" id="comment_flag0" value="1"   <?php  if(1 == $info['comment_flag']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="comment_flag" id="comment_flag1" value="0"   <?php  if(0 == $info['comment_flag']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">评论照片的内容是否需要后台审核</p>
            </div>
        </div>
       
       
        
        <div class="formitm">
            <label class="lab">签到设置</label>
            <div class="ipt">
                <input name="qd_config" type="text"  class="form-element u-width-large  " id="qd_config" value="<?php echo ($info["qd_config"]); ?>"    >
                <p class="help-block">签到设置，0表示关闭，多个请用,号隔开，例如 :20,40,60,80,90,100,120 表示连续签到 1天送20金币，2天送40,3天送60...</p>
            </div>
        </div>
       
       
        
        <div class="formitm">
            <label class="lab">字符过滤</label>
            <div class="ipt">
                <textarea name="string_config" type="text"  class="form-element u-width-large " id="string_config" value="" rows="5"   ><?php echo ($info["string_config"]); ?></textarea>
                <p class="help-block">过滤敏感字符,用**代替，多个请用,号隔开</p>
            </div>
        </div>
          
        
        <div class="formitm">
            <label class="lab">照片上传随机标题</label>
            <div class="ipt">
                <textarea name="upPhoto_title" type="text"  class="form-element u-width-full " id="upPhoto_title" value="" rows="10"   ><?php echo ($info["upPhoto_title"]); ?></textarea>
                <p class="help-block">上传照片随机标题，字数不可超过50个一行，多个请回车</p>
            </div>
        </div>
       
       
        <div class="formitm">
            <label class="lab">打招呼随机</label>
            <div class="ipt">
                <textarea name="upPhoto_zh" type="text"  class="form-element u-width-full " id="upPhoto_zh" value="" rows="10"   ><?php echo ($info["upPhoto_zh"]); ?></textarea>
                <p class="help-block">打招呼随机内容，字数不可超过50个一行，多个请回车</p>
            </div>
        </div>
    
	
	 
        <div class="formitm">
            <label class="lab">内心独白随机</label>
            <div class="ipt">
                <textarea name="nxdbsj" type="text"  class="form-element u-width-full " id="nxdbsj" value="" rows="10"   ><?php echo ($info["nxdbsj"]); ?></textarea>
                <p class="help-block">内心独白随机内容，字数不可超过50个一行，多个请回车</p>
            </div>
        </div>
    
    
        <div class="formitm">
            <label class="lab">不回复消息随机</label>
            <div class="ipt">
                <textarea name="noreply" type="text"  class="form-element u-width-full " id="noreply" value="" rows="10"   ><?php echo ($info["noreply"]); ?></textarea>
                <p class="help-block">不回复消息随机内容，字数不可超过50个一行，多个请回车</p>
            </div>
        </div>
    
	
        <div class="formitm">
            <label class="lab">马甲昵称</label>
            <div class="ipt">
                <textarea name="name_arr" type="text"  class="form-element u-width-full " id="name_arr" value="" rows="10"   ><?php echo ($info["name_arr"]); ?></textarea>
                <p class="help-block">马甲昵称按顺序，多个请回车</p>
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