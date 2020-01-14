<?php if (!defined('THINK_PATH')) exit();?><h3>安全设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('shield');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">出错信息</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="SHOW_ERROR_MSG" id="SHOW_ERROR_MSG0" value="true"   <?php  if(true == $info['SHOW_ERROR_MSG']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="SHOW_ERROR_MSG" id="SHOW_ERROR_MSG1" value="false"   <?php  if(false == $info['SHOW_ERROR_MSG']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">网站上线后建议关闭</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">日志记录</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="LOG_RECORD" id="LOG_RECORD0" value="true"   <?php  if(true == $info['LOG_RECORD']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="LOG_RECORD" id="LOG_RECORD1" value="false"   <?php  if(false == $info['LOG_RECORD']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">记录网站出错日志</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">SQL执行日志</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="DB_SQL_LOG" id="DB_SQL_LOG0" value="true"   <?php  if(true == $info['DB_SQL_LOG']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="DB_SQL_LOG" id="DB_SQL_LOG1" value="false"   <?php  if(false == $info['DB_SQL_LOG']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">用于性能调试与安全记录，一般不建议开启</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">加密KEY</label>
            <div class="ipt">
                <input name="SAFE_KEY" type="text"  class="form-element u-width-large  " id="SAFE_KEY" value="<?php echo ($info["SAFE_KEY"]); ?>" maxlength="250"  datatype="s" >
                <p class="help-block">用户外部通讯的加密基准</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">COOKIE前缀</label>
            <div class="ipt">
                <input name="COOKIE_PREFIX" type="text"  class="form-element u-width-large  " id="COOKIE_PREFIX" value="<?php echo ($info["COOKIE_PREFIX"]); ?>" maxlength="250"  datatype="s" >
                <p class="help-block">避免多个站点冲突</p>
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
Do.ready('base',function() {
	$('#form').duxForm();
});
</script>