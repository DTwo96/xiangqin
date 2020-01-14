<?php if (!defined('THINK_PATH')) exit();?><h3>上传设置</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('upload');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">最大文件大小</label>
            <div class="ipt">
                <input name="upload_size" type="text"  class="form-element u-width-small  " id="upload_size" value="<?php echo ($info["upload_size"]); ?>" maxlength="250"  datatype="n" >
                <p class="help-block">单位：M</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">上传文件格式</label>
            <div class="ipt">
                <input name="upload_exts" type="text"  class="form-element u-width-large  " id="upload_exts" value="<?php echo ($info["upload_exts"]); ?>" maxlength="250"  datatype="*" >
                <p class="help-block">请使用英文逗号分割格式</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">覆盖同名文件</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="upload_replace" id="upload_replace0" value="1"   <?php  if(1 == $info['upload_replace']){ ?> checked="checked" <?php } ?> > <span>覆盖</span>
                    </label> <label>
                      <input type="radio" name="upload_replace" id="upload_replace1" value="0"   <?php  if(0 == $info['upload_replace']){ ?> checked="checked" <?php } ?> > <span>不覆盖</span>
                    </label> 
                <p class="help-block">只对比文件名称</p>
            </div>
        </div>
    
    
     
        <div class="formitm">
            <label class="lab">缩图方式</label>
            <div class="ipt">
                <select name="thumb_type" id="thumb_type"  class="form-element "><option value="1" <?php if(1 == $info['thumb_type']){ ?> selected="selected"  <?php } ?> >等比例缩放</option><option value="2" <?php if(2 == $info['thumb_type']){ ?> selected="selected"  <?php } ?> >缩放后填充</option><option value="3" <?php if(3 == $info['thumb_type']){ ?> selected="selected"  <?php } ?> >居中裁剪</option><option value="4" <?php if(4 == $info['thumb_type']){ ?> selected="selected"  <?php } ?> >左上角裁剪</option><option value="5" <?php if(5 == $info['thumb_type']){ ?> selected="selected"  <?php } ?> >右下角裁剪</option><option value="6" <?php if(6 == $info['thumb_type']){ ?> selected="selected"  <?php } ?> >固定尺寸缩放</option></select>
                <p class="help-block">选择开启缩图后有效</p>
            </div>
        </div>
    
      
        <div class="formitm">
            <label class="lab">列表缩图开关</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="list_thumb_status" id="list_thumb_status0" value="1"   <?php  if(1 == $info['list_thumb_status']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="list_thumb_status" id="list_thumb_status1" value="0"   <?php  if(0 == $info['list_thumb_status']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">开启后缩略图设置才会生效</p>
            </div>
        </div>
    
    
      
        <div class="formitm">
            <label class="lab">前台列表缩图宽度</label>
            <div class="ipt">
                <input name="list_thumb_width" type="text"  class="form-element u-width-small  " id="list_thumb_width" value="<?php echo ($info["list_thumb_width"]); ?>" maxlength="250"  datatype="n" >
                <p class="help-block">单位：像素</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">前台列表缩图高度</label>
            <div class="ipt">
                <input name="list_thumb_height" type="text"  class="form-element u-width-small  " id="list_thumb_height" value="<?php echo ($info["list_thumb_height"]); ?>" maxlength="250"  datatype="n" >
                <p class="help-block">单位：像素</p>
            </div>
        </div>
    
    
    
    
        <div class="formitm">
            <label class="lab">全局缩图开关</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="thumb_status" id="thumb_status0" value="1"   <?php  if(1 == $info['thumb_status']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="thumb_status" id="thumb_status1" value="0"   <?php  if(0 == $info['thumb_status']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">开启后缩略图设置才会生效</p>
            </div>
        </div>
    
    
    
    
   
    
        <div class="formitm">
            <label class="lab">其他全局缩图宽度</label>
            <div class="ipt">
                <input name="thumb_width" type="text"  class="form-element u-width-small  " id="thumb_width" value="<?php echo ($info["thumb_width"]); ?>" maxlength="250"  datatype="n" >
                <p class="help-block">单位：像素</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">其他全局缩图高度</label>
            <div class="ipt">
                <input name="thumb_height" type="text"  class="form-element u-width-small  " id="thumb_height" value="<?php echo ($info["thumb_height"]); ?>" maxlength="250"  datatype="n" >
                <p class="help-block">单位：像素</p>
            </div>
        </div>
    
    
    
        <div class="formitm">
            <label class="lab">水印开关</label>
            <div class="ipt">
                <label>
                      <input type="radio" name="water_status" id="water_status0" value="1"   <?php  if(1 == $info['water_status']){ ?> checked="checked" <?php } ?> > <span>开启</span>
                    </label> <label>
                      <input type="radio" name="water_status" id="water_status1" value="0"   <?php  if(0 == $info['water_status']){ ?> checked="checked" <?php } ?> > <span>关闭</span>
                    </label> 
                <p class="help-block">开启后水印设置才会生效</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">水印图片</label>
            <div class="ipt">
                <input name="water_image" type="text"  class="form-element u-width-large  " id="water_image" value="<?php echo ($info["water_image"]); ?>" maxlength="250"  datatype="*" >
                <p class="help-block">位于public/watermark下的图片文件</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">水印位置</label>
            <div class="ipt">
                <select name="water_position" id="water_position"  class="form-element "><option value="1" <?php if(1 == $info['water_position']){ ?> selected="selected"  <?php } ?> >左上角水印</option><option value="2" <?php if(2 == $info['water_position']){ ?> selected="selected"  <?php } ?> >上居中水印</option><option value="3" <?php if(3 == $info['water_position']){ ?> selected="selected"  <?php } ?> >右上角水印</option><option value="4" <?php if(4 == $info['water_position']){ ?> selected="selected"  <?php } ?> >左居中水印</option><option value="5" <?php if(5 == $info['water_position']){ ?> selected="selected"  <?php } ?> >居中水印</option><option value="6" <?php if(6 == $info['water_position']){ ?> selected="selected"  <?php } ?> >右居中水印</option><option value="7" <?php if(7 == $info['water_position']){ ?> selected="selected"  <?php } ?> >左下角水印</option><option value="8" <?php if(8 == $info['water_position']){ ?> selected="selected"  <?php } ?> >下居中水印</option><option value="9" <?php if(9 == $info['water_position']){ ?> selected="selected"  <?php } ?> >右下角水印</option></select>
                <p class="help-block">选择开启缩图后有效</p>
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