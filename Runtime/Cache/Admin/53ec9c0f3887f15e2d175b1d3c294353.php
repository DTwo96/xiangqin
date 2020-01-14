<?php if (!defined('THINK_PATH')) exit();?><h3>运营设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">是否开启阿里云oss</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="open_oss" id="open_oss0" value="1"   <?php  if(1 == $info['open_oss']){ ?> checked="checked" <?php } ?> > <span>是</span>
                    </label> <label>
                      <input type="radio" name="open_oss" id="open_oss1" value="0"   <?php  if(0 == $info['open_oss']){ ?> checked="checked" <?php } ?> > <span>否</span>
                    </label> 
                <p class="help-block">开后则上传照片到阿里云oss</p>
            </div>
        </div>
    
	  
        <div class="formitm">
            <label class="lab">OSS_ACCESS_ID</label>
            <div class="ipt">
                <input name="OSS_ACCESS_ID" type="text"  class="form-element u-width-large  " id="OSS_ACCESS_ID" value="<?php echo ($info["OSS_ACCESS_ID"]); ?>" maxlength="50"  datatype="*" >
                <p class="help-block">OSS_ACCESS_ID</p>
            </div>
        </div> 
         
        <div class="formitm">
            <label class="lab">OSS_ACCESS_KEY</label>
            <div class="ipt">
                <input name="OSS_ACCESS_KEY" type="text"  class="form-element u-width-large  " id="OSS_ACCESS_KEY" value="<?php echo ($info["OSS_ACCESS_KEY"]); ?>" maxlength="50"  datatype="*" >
                <p class="help-block">OSS_ACCESS_KEY</p>
            </div>
        </div> 
         
        <div class="formitm">
            <label class="lab">OSS_ENDPOINT</label>
            <div class="ipt">
                <input name="OSS_ENDPOINT" type="text"  class="form-element u-width-large  " id="OSS_ENDPOINT" value="<?php echo ($info["OSS_ENDPOINT"]); ?>" maxlength="50"  datatype="*" >
                <p class="help-block">OSS_ENDPOINT</p>
            </div>
        </div> 
         
        <div class="formitm">
            <label class="lab">OSS_TEST_BUCKET</label>
            <div class="ipt">
                <input name="OSS_TEST_BUCKET" type="text"  class="form-element u-width-large  " id="OSS_TEST_BUCKET" value="<?php echo ($info["OSS_TEST_BUCKET"]); ?>" maxlength="50"  datatype="*" >
                <p class="help-block">OSS_TEST_BUCKET</p>
            </div>
        </div> 
         
        <div class="formitm">
            <label class="lab">OSS_URL</label>
            <div class="ipt">
                <input name="OSS_URL" type="text"  class="form-element u-width-large  " id="OSS_URL" value="<?php echo ($info["OSS_URL"]); ?>" maxlength="50"  datatype="*" >
                <p class="help-block">OSS_URL</p>
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