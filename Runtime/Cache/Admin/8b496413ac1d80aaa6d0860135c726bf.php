<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>用户</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U();?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">用户组</label>
            <div class="ipt">
                <select name="group_id" class="form-element">
        <?php if(is_array($groupList)): foreach($groupList as $key=>$vo): ?><option value="<?php echo ($vo["group_id"]); ?>" 
          <?php if($info["group_id"] == $vo['group_id']): ?>selected="selected"<?php endif; ?>
          ><?php echo ($vo["name"]); ?>
          </option><?php endforeach; endif; ?>
      </select>
                <p class="help-block">请选择用户组</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">用户名/登录名</label>
            <div class="ipt">
                <input name="username" type="text"  class="form-element u-width-large  " id="username" value="<?php echo ($info["username"]); ?>" maxlength="20"  datatype="*" >
                <p class="help-block">用户登录帐号</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">昵称</label>
            <div class="ipt">
                <input name="nicename" type="text"  class="form-element u-width-large  " id="nicename" value="<?php echo ($info["nicename"]); ?>" maxlength="20"  datatype="*" >
                <p class="help-block">用户姓名或昵称</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">邮箱</label>
            <div class="ipt">
                <input name="email" type="text"  class="form-element u-width-large  " id="email" value="<?php echo ($info["email"]); ?>" maxlength="250"  datatype="e" >
                <p class="help-block">用于接受邮件通知</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">密码</label>
            <div class="ipt">
                <input name="password" type="password"  class="form-element u-width-large  " id="password" value="" maxlength="250"   >
                <p class="help-block">请输入密码，不修改请留空</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">重复密码</label>
            <div class="ipt">
                <input name="password2" type="password"  class="form-element u-width-large  " id="password2" value="" maxlength="250"   >
                <p class="help-block">重复刚才输入的密码</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">用户状态</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="status" id="status0" value="1"   <?php if(!isset($info['status'])){ $info['status']= "1"; } if(1 == $info['status']){ ?> checked="checked" <?php } ?> > <span>正常</span>
                    </label> <label>
                      <input type="radio" name="status" id="status1" value="0"   <?php if(!isset($info['status'])){ $info['status']= "1"; } if(0 == $info['status']){ ?> checked="checked" <?php } ?> > <span>禁用</span>
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
    <input name="user_id" type="hidden"  class="form-element u-width-large  " id="user_id" value="<?php echo ($info["user_id"]); ?>"    >
        </fieldset>
        </form>
            </div> </div>
<script>
Do.ready('base',function() {
	$('#form').duxForm();
});
</script>