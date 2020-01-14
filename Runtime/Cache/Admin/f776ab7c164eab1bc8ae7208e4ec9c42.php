<?php if (!defined('THINK_PATH')) exit();?><h3>性能设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('performance');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">模板缓存</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="TMPL_CACHE_ON" id="TMPL_CACHE_ON0" value="true"   <?php  if(true == $info['TMPL_CACHE_ON']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="TMPL_CACHE_ON" id="TMPL_CACHE_ON1" value="false"   <?php  if(false == $info['TMPL_CACHE_ON']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">网站上线后建议开启</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">静态缓存</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="HTML_CACHE_ON" id="HTML_CACHE_ON0" value="true"   <?php  if(true == $info['HTML_CACHE_ON']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="HTML_CACHE_ON" id="HTML_CACHE_ON1" value="false"   <?php  if(false == $info['HTML_CACHE_ON']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">网站上线后建议开启</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">SQL查询缓存</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="DB_SQL_BUILD_CACHE" id="DB_SQL_BUILD_CACHE0" value="true"   <?php  if(true == $info['DB_SQL_BUILD_CACHE']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="DB_SQL_BUILD_CACHE" id="DB_SQL_BUILD_CACHE1" value="false"   <?php  if(false == $info['DB_SQL_BUILD_CACHE']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">网站上线后建议开启</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">URL访问模式</label>
            <div class="ipt">
                <select name="URL_MODEL" id="URL_MODEL"  class="form-element "><option value="0" <?php if(0 == $info['URL_MODEL']){ ?> selected="selected"  <?php } ?> >普通模式</option><option value="1" <?php if(1 == $info['URL_MODEL']){ ?> selected="selected"  <?php } ?> >PATHINFO模式</option><option value="2" <?php if(2 == $info['URL_MODEL']){ ?> selected="selected"  <?php } ?> >伪静态模式</option><option value="3" <?php if(3 == $info['URL_MODEL']){ ?> selected="selected"  <?php } ?> >兼容模式</option></select>
                <p class="help-block">请确认已放置伪静态规则</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">URL路由</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="URL_ROUTER_ON" id="URL_ROUTER_ON0" value="true"   <?php  if(true == $info['URL_ROUTER_ON']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="URL_ROUTER_ON" id="URL_ROUTER_ON1" value="false"   <?php  if(false == $info['URL_ROUTER_ON']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">根据URL设置规则进行URL优化</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">伪静态后缀</label>
            <div class="ipt">
                <input name="URL_HTML_SUFFIX" type="text"  class="form-element u-width-mini  " id="URL_HTML_SUFFIX" value="<?php echo ($info["URL_HTML_SUFFIX"]); ?>" maxlength="250"  datatype="s" >
                <p class="help-block">设置后URL后缀将会改变</p>
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