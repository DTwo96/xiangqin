<?php if (!defined('THINK_PATH')) exit();?><h3>列表</h3>

        <form action="<?php echo U();?>" method="post" id="form" class="m-form ">
        <fieldset>
          <div class="g-main-body">
    <div class="g-main-content m-form-horizontal">
      <admin:panel>
      <span class="u-btn u-btn-primary">菜单一</span>
      <div class="m-table-mobile"><table id="table1" class="m-table m-table-border"><thead><tr><th width="300">级别</th><th width="50">类型</th><th>名称</th><th>值</th></tr></thead><tbody><?php if(is_array($data['first'])): foreach($data['first'] as $key=>$vo): if($vo['id'] == 1): ?><tr>
    	<td>
        	一级菜单：
        </td>
      <td>
      <select name="first_type[]" id="first_type[]"  class="form-element "><option value="click" <?php if(click == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >click</option><option value="view" <?php if(view == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >view</option></select>
      </td>
      <td> <input name="first[]" type="text"  class="form-element u-width-large  " id="first[]" value="<?php echo ($vo["name"]); ?>" maxlength="50"   ></td>
      <td><input name="first_value[]" type="text"  class="form-element u-width-large  " id="first_value[]" value="<?php echo ($vo["value"]); ?>" maxlength="250"   ></td>
    </tr><?php endif; endforeach; endif; ?>
     <?php if(is_array($data['second1'])): foreach($data['second1'] as $key=>$vo): ?><tr>
    	<td>
        	二级菜单<?php echo ($key+1); ?>：
        </td>
      <td>
      <select name="menu_type1[]" id="menu_type1[]"  class="form-element "><option value="click" <?php if(click == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >click</option><option value="view" <?php if(view == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >view</option></select>
      </td>
      <td> <input name="second1[]" type="text"  class="form-element u-width-large  " id="second1[]" value="<?php echo ($vo["name"]); ?>" maxlength="50"   ></td>
      <td><input name="value1[]" type="text"  class="form-element u-width-large  " id="value1[]" value="<?php echo ($vo["value"]); ?>" maxlength="250"   ></td>
    </tr><?php endforeach; endif; ?></tbody></table></div>
<span class="u-btn u-btn-primary">菜单二</span>
  <div class="m-table-mobile"><table id="table3" class="m-table m-table-border"><thead><tr><th width="300">级别</th><th width="50">类型</th><th>名称</th><th>值</th></tr></thead><tbody><?php if(is_array($data['first'])): foreach($data['first'] as $key=>$vo): if($vo['id'] == 2): ?><tr>
    	<td>
        	一级菜单：
        </td>
      <td>
      <select name="first_type[]" id="first_type[]"  class="form-element "><option value="click" <?php if(click == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >click</option><option value="view" <?php if(view == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >view</option></select>
      </td>
      <td> <input name="first[]" type="text"  class="form-element u-width-large  " id="first[]" value="<?php echo ($vo["name"]); ?>" maxlength="50"   ></td>
      <td><input name="first_value[]" type="text"  class="form-element u-width-large  " id="first_value[]" value="<?php echo ($vo["value"]); ?>" maxlength="250"   ></td>
    </tr><?php endif; endforeach; endif; ?>
     <?php if(is_array($data['second2'])): foreach($data['second2'] as $key=>$vo): ?><tr>
    	<td>
        	二级菜单<?php echo ($key+1); ?>：
        </td>
       <td>
      <select name="menu_type2[]" id="menu_type2[]"  class="form-element "><option value="click" <?php if(click == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >click</option><option value="view" <?php if(view == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >view</option></select>
      </td>
      <td> <input name="second2[]" type="text"  class="form-element u-width-large  " id="second2[]" value="<?php echo ($vo["name"]); ?>" maxlength="50"   ></td>
      <td><input name="value2[]" type="text"  class="form-element u-width-large  " id="value2[]" value="<?php echo ($vo["value"]); ?>" maxlength="250"   ></td>
    </tr><?php endforeach; endif; ?></tbody></table></div>
<span class="u-btn u-btn-primary" >菜单三</span>
      <div class="m-table-mobile"><table id="table" class="m-table m-table-border"><thead><tr><th width="300">级别</th><th width="50">类型</th><th>名称</th><th>值</th></tr></thead><tbody><?php if(is_array($data['first'])): foreach($data['first'] as $key=>$vo): if($vo['id'] == 3): ?><tr>
    	<td >
        	一级菜单：
        </td>
       <td>
      <select name="first_type[]" id="first_type[]"  class="form-element "><option value="click" <?php if(click == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >click</option><option value="view" <?php if(view == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >view</option></select>
      </td>
      <td> <input name="first[]" type="text"  class="form-element u-width-large  " id="first[]" value="<?php echo ($vo["name"]); ?>" maxlength="50"   ></td>
      <td><input name="first_value[]" type="text"  class="form-element u-width-large  " id="first_value[]" value="<?php echo ($vo["value"]); ?>" maxlength="250"   ></td>
    </tr><?php endif; endforeach; endif; ?>
     <?php if(is_array($data['second3'])): foreach($data['second3'] as $key=>$vo): ?><tr>
    	<td>
        	二级菜单<?php echo ($key+1); ?>：
        </td>
       <td>
      <select name="menu_type3[]" id="menu_type3[]"  class="form-element "><option value="click" <?php if(click == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >click</option><option value="view" <?php if(view == $vo['menu_type']){ ?> selected="selected"  <?php } ?> >view</option></select>
      </td>
      <td> <input name="second3[]" type="text"  class="form-element u-width-large  " id="second3[]" value="<?php echo ($vo["name"]); ?>" maxlength="50"   ></td>
      <td><input name="value3[]" type="text"  class="form-element u-width-large  " id="value3[]" value="<?php echo ($vo["value"]); ?>" maxlength="250"   ></td>
    </tr><?php endforeach; endif; ?></tbody></table></div>  
<div class="formitm form-submit">
        <div class="ipt">
            <div class="tip" id="tips"></div>
            <button class="u-btn u-btn-success u-btn-large" type="button" id="btn-submit">保存</button>
            <a href="<?php echo U('create_menu');?>" class="u-btn u-btn-primary" >先点击左边保存，然后再点击此处生成自定义菜单</a>
        </div>
        </div>  
      
      </admin:panel>
    </div>
  </div>
        </fieldset>
        </form>
<style>
	.red1{  background:#2d8cd2 !important;}
</style>
<script>
   function checkmenu(){
   	var sss =1;
	var menuArr = new Array();
	var nameArr = new Array();
	var m = -1;
	var n = 0;
   	$("tr").removeClass("red1");
   	$("tbody tr").each(function(){
		
		//var vall = $(this).val();	
		//var firstname = $(this).find("input").eq(0);
					
		var thisid1 = $(this).find("input").eq(0).val();	
		var thisival2 = $(this).find("input").eq(1).val();
		//alert($(this).find("input").eq(1).attr('id'));
		if( $(this).find("input").eq(1).attr('id')!='first_value[]'){
			if((!thisid1 && thisival2 ) || (thisid1 && !thisival2 ) ){
				$(this).addClass("red1");
				alert("蓝色区域有误。二级菜单两个必填！或者都不填。橙橙软件手写代码！");
				sss =0;
			}
		}
		if(thisival2 && thisival2.indexOf("http:")>-1){
			if($(this).find("select").val()!='view'){
				$(this).addClass("red1");
				alert("蓝色区域有误。类型必须为view");
				sss =0;
			}	
		}else if(thisival2 && thisival2.indexOf("http:")){
			if($(this).find("select").val()!='click'){
				$(this).addClass("red1");
				alert("蓝色区域有误。类型必须为click");
				sss =0;
			}	
			
		}	
			
		
		if( $(this).find("input").eq(1).attr('id') == 'first_value[]'){
			m++;
			menuArr[m] = $(this);
			n = 0;
			nameArr[m] = new Array();
		} 
		
		if(thisival2) nameArr[m][n] = 1;
		else nameArr[m][n] = 0;
		n++;

	
	})
	
	l1:for(var key in menuArr){
		for(var k in nameArr[key]){
			if(k>0 && nameArr[key][k] && nameArr[key][0]){
				menuArr[key].addClass("red1");alert("蓝色区域有误。有二级菜单，一级菜单的值必须为空");
				sss =0;
				break l1;
			}
		}
		
	}
	return sss;
   } 
   
   $("#btn-submit").click(function(){
   //	console.log(checkmenu());
   		if(checkmenu())
   		$("#form").submit();
   	})
</script>