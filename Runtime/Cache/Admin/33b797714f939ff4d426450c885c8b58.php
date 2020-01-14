<?php if (!defined('THINK_PATH')) exit();?><h3>模板设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('tpl');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">站点模板</label>
            <div class="ipt">
                <div  class="input-group">
      <input name="tpl_name" type="text"  class="form-element u-width-small  " id="tpl_name" value="<?php echo ($info["tpl_name"]); ?>" maxlength="250"  datatype="*" >
      
        <select class="form-element dux-assign " target="#tpl_name" id="" >
            <option value =" ">请选择</option>
            <?php if(is_array($themesList)): foreach($themesList as $key=>$vo): ?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["file"]); ?></option><?php endforeach; endif; ?>
        </select>
    </div>
                <p class="help-block">当前站点所使用的主题</p>
            </div>
        </div>
  
        <div class="formitm">
            <label class="lab">首页模板</label>
            <div class="ipt">
                <div  class="input-group">
      <input name="tpl_index" type="text"  class="form-element u-width-small  " id="tpl_index" value="<?php echo ($info["tpl_index"]); ?>" maxlength="250"  datatype="*" >
      
        <select class="form-element dux-assign " target="#tpl_index" id="" >
            <option value =" ">请选择</option>
            <?php if(is_array($tplList)): foreach($tplList as $key=>$vo): ?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["file"]); ?></option><?php endforeach; endif; ?>
        </select>
    </div>
                <p class="help-block">当前站点所使用的首页模板，无需后缀名</p>
            </div>
        </div>
  <admin:panel title="扩展模板" icon="exclamation-circle" padding="true">
  
        <div class="formitm">
            <label class="lab">Tag模板</label>
            <div class="ipt">
                <input name="tpl_tags" type="text"  class="form-element u-width-small  " id="tpl_tags" value="<?php echo ($info["tpl_tags"]); ?>" maxlength="250"   >
                <p class="help-block">TAG基础模板名，请根据访问提示修改模板名，无需后缀名</p>
            </div>
        </div>
  
        <div class="formitm">
            <label class="lab">搜索模板</label>
            <div class="ipt">
                <input name="tpl_search" type="text"  class="form-element u-width-small  " id="tpl_search" value="<?php echo ($info["tpl_search"]); ?>" maxlength="250"   >
                <p class="help-block">搜索列表的基础模板名，请根据访问提示修改模板名，无需后缀名</p>
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