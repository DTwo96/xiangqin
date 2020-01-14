<?php if (!defined('THINK_PATH')) exit();?><h3>站点信息</h3>

        <div class="m-panel ">
            <div class="panel-body">
            
        <form action="<?php echo U('site');?>" method="post" id="form" class="m-form m-form-horizontal">
        <fieldset>
          
        <div class="formitm">
            <label class="lab">站点标题</label>
            <div class="ipt">
                <input name="site_title" type="text"  class="form-element u-width-large  " id="site_title" value="<?php echo ($info["site_title"]); ?>" maxlength="250"  datatype="*" >
                <p class="help-block">网站标题栏处显示</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">站点副标题</label>
            <div class="ipt">
                <input name="site_subtitle" type="text"  class="form-element u-width-large  " id="site_subtitle" value="<?php echo ($info["site_subtitle"]); ?>" maxlength="250"   >
                <p class="help-block">站点标题后面显示的副标题</p>
            </div>
        </div>
    
        <div class="formitm">
            <label class="lab">站点关键词</label>
            <div class="ipt">
                <input name="site_keywords" type="text"  class="form-element u-width-large  " id="site_keywords" value="<?php echo ($info["site_keywords"]); ?>" maxlength="250"   >
                <p class="help-block">搜索引擎所收录的关键词</p>
            </div>
        </div>
   
    
        <div class="formitm">
            <label class="lab">站点域名</label>
            <div class="ipt">
                <input name="site_url" type="text"  class="form-element u-width-large  " id="site_url" value="<?php echo ($info["site_url"]); ?>" maxlength="250"   >
                <p class="help-block">当前网站的主域名，请不要填写成了网址。</p>
            </div>
        </div>
	
    
    
        <div class="formitm">
            <label class="lab">短信账号</label>
            <div class="ipt">
                <input name="mobaccount" type="text"  class="form-element u-width-large  " id="mobaccount" value="<?php echo ($info["mobaccount"]); ?>" maxlength="250"   >
                <p class="help-block">短信账号（http://www.dxton.com/申请）</p>
            </div>
        </div>
    
    
        <div class="formitm">
            <label class="lab">短信密码</label>
            <div class="ipt">
                <input name="mobpass" type="text"  class="form-element u-width-large  " id="mobpass" value="<?php echo ($info["mobpass"]); ?>" maxlength="250"   >
                <p class="help-block">短信密码</p>
            </div>
        </div>
    
    
	<!--
    
        <div class="formitm">
            <label class="lab">多域名设置</label>
            <div class="ipt">
                <textarea name="moredomai" type="text"  class="form-element u-width-large " id="moredomai" value="" rows="5"   ><?php echo ($info["moredomai"]); ?></textarea>
                <p class="help-block">分享出去后的域名，一个域名一行，泛域名用类似：*.lxphp.com</p>
            </div>
        </div>-->
    
	 
        <div class="formitm">
            <label class="lab">自动刷新聊天</label>
            <div class="ipt">
                <input name="reshtime" type="text"  class="form-element u-width-mini  " id="reshtime" value="<?php echo ($info["reshtime"]); ?>" maxlength="250"   >（秒）
                <p class="help-block">当用户开启聊天窗口时，对方如果有回复，自动刷新间隔时间,时间越短服务器消耗越大。</p>
            </div>
        </div>
  
	
       
        <div class="formitm">
            <label class="lab">站点统计</label>
            <div class="ipt">
                <textarea name="site_statistics" type="text"  class="form-element u-width-large " id="site_statistics" value="" rows="5"   ><?php echo ($info["site_statistics"]); ?></textarea>
                <p class="help-block">用于统计代码调用</p>
            </div>
        </div>
    
	  
	
        <div class="formitm">
            <label class="lab">注册条款</label>
            <div class="ipt">
                <textarea name="site_tiaokuan" type="text"  class="form-element u-width-large u-editor" id="site_tiaokuan" value="" rows="20"   ><?php echo (html_out($info["site_tiaokuan"])); ?></textarea>
                <p class="help-block"></p>
            </div>
        </div>
	
	 
        <div class="formitm">
            <label class="lab">苹果app</label>
            <div class="ipt">
                <input name="app_url2" type="text"  class="form-element u-width-large  " id="app_url2" value="<?php echo ($info["app_url2"]); ?>" maxlength="250"   >
                <p class="help-block">苹果app下载地址。生成地址：http://<?php echo ($info["site_url"]); echo U('Home/Public/app');?></p>
            </div>
        </div>
    	
	
	 
        <div class="formitm">
            <label class="lab">安卓app</label>
            <div class="ipt">
                <input name="app_url" type="text"  class="form-element u-width-large  " id="app_url" value="<?php echo ($info["app_url"]); ?>" maxlength="250"   >
                <p class="help-block">安卓app下载地址。 生成地址：http://<?php echo ($info["site_url"]); echo U('Home/Public/app');?></p>
            </div>
        </div>
    
	
	
	
    <!-- 
        <div class="formitm">
            <label class="lab">首页公告</label>
            <div class="ipt">
                <textarea name="sygg" type="text"  class="form-element u-width-large " id="sygg" value="" rows="5"   ><?php echo ($info["sygg"]); ?></textarea>
                <p class="help-block">首页公告</p>
            </div>
        </div>
    -->
    
    
    
    
    
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
	//表单综合处理
    $('#form').duxFormPage();
});
</script>