<?php if (!defined('THINK_PATH')) exit();?><h3><?php echo ($name); ?>用户组</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U();?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">用户组名称</label>
            <div class="ipt">
                <input name="name" type="text"  class="form-element u-width-large  " id="name" value="<?php echo ($info["name"]); ?>" maxlength="250"  datatype="*" >
                <p class="help-block">用户组标识名称</p>
            </div>
        </div>
  
        <div class="formitm">
            <label class="lab">用户组状态</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="status" id="status0" value="1"   <?php if(!isset($info['status'])){ $info['status']= "1"; } if(1 == $info['status']){ ?> checked="checked" <?php } ?> > <span>正常</span>
                    </label> <label>
                      <input type="radio" name="status" id="status1" value="0"   <?php if(!isset($info['status'])){ $info['status']= "1"; } if(0 == $info['status']){ ?> checked="checked" <?php } ?> > <span>禁用</span>
                    </label> 
                <p class="help-block">禁用后改组用户将无法登录</p>
            </div>
        </div>
  
        <div class="formitm form-submit">
        <div class="ipt">
            <div class="tip" id="tips"></div>
            <button class="u-btn u-btn-success u-btn-large" type="submit" id="btn-submit">保存</button>
            <button class="u-btn u-btn-large" type="reset">重置</button>
        </div>
        </div>
  <input name="group_id" type="hidden"  class="form-element u-width-large  " id="group_id" value="<?php echo ($info["group_id"]); ?>"    >
        </fieldset>
        </form>
            </div> </div>
<script>
Do.ready('base',function() {
	$('#form').duxForm();
});


</script>