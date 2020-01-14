<?php if (!defined('THINK_PATH')) exit();?><div class="g-grid">
 <div class="g-col-2-1">
    <div class="m-panel">
      <div class="panel-header"> <i class="u-icon-bar-chart-o"></i> 程序信息 </div>
      <div class="m-table-mobile">
        <table class="m-table">
          <tbody>
            <tr>
              <td>站点名称</td>
              <td><?php echo C('SITE_TITLE');?></td>
            </tr>
            <tr>
              <td>网站域名：</td>
              <td><a href="http://<?php echo ($_SERVER["SERVER_NAME"]); ?>" target="_blank">http://<?php echo ($_SERVER["SERVER_NAME"]); ?></a></td>
            </tr>
            <tr>
              <td>程序版本</td>
              <td><?php echo DUX_VER;?> (<?php echo ($curv); ?>)</td>
            </tr>
            <tr>
              <td>系统开发</td>
              <td>玖芯科技 www.ninexin.com</td>
            </tr>
			 
            <tr>
              <td>PHP版本</td>
              <td><?php echo phpversion();?></td>
            </tr>
            <tr>
              <td>数据驱动</td>
              <td><?php echo C('DB_TYPE');?></td>
            </tr>
            <tr>
              <td>附件上传目录：</td>
              <td><?php echo APP_PATH;?>upload</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  <div class="g-col-2-1">
    <div class="m-panel">
      <div class="panel-header"> <i class="u-icon-bars"></i> 环境信息 </div>
      <div class="m-table-mobile">
        <table class="m-table">
          <tbody>
            <tr>
              <td>系统环境</td>
              <td><?php echo PHP_OS;?>/<?php echo $_SERVER['SERVER_SOFTWARE'] ; ?></td>
            </tr>
            <tr>
              <td>服务器地址:</td>
              <td><?php echo ($_SERVER["SERVER_ADDR"]); ?>:<?php echo ($_SERVER["SERVER_PORT"]); ?></td>
            </tr>
            <tr>
              <td>服务器时间</td>
              <td><?php echo date('Y-m-d H:i:s');?> <?php echo date_default_timezone_get();?></td>
            </tr>
            <tr>
              <td>脚本超时时间</td>
              <td><?php echo get_cfg_var("max_execution_time") ; ?> 秒</td>
            </tr>
            <tr>
              <td>上传大小</td>
              <td><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传文件" ; ?></td>
            </tr>
            <tr>
              <td>被屏蔽的函数:</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>URL路径：</td>
              <td>/</td>
            </tr>
          <td>物理路径：</td>
            <td><?php echo dirname(THINK_PATH);?></td>
          </tr>
            </tbody>
          
        </table>
      </div>
    </div>
  </div>


<script>
	$(function(){
		$.get("/index.php/Admin/Yueaiyuan/checkup",function(data){
			//alert(data.act);
			if(data.status==1){				
				if(data.act){
					doact(data.act)
				}
			}else{
				$("#uptext").html(data.msg);
			}
		},'json');
		
		
		$("#upclick").click(function(){
			if($("#uptext").text()=='正在获取升级信息……'){
				alert("正在检测，请稍后点击……");
				return false;
			}
			if(!confirm("您确定您已经备份好了您的网站？由于没有备份引起的任何问题，我们不负任何责任！")){
				return false;
			}
			
			$.post("/index.php/Admin/Yueaiyuan/doup",{doup:1},function(data){
				if(data.status==1){
					if(data.act){
						$("#uptext").html('');
						$("#uptext").prepend(data.msg+"<br>");
						doact(data.act);
					}
				}else{
					$("#uptext").html(data.msg);
				}
			},'json')
		})
	})
	
	function doact(act){
		$.post("/index.php/Admin/Yueaiyuan/doact",{act:act},function(data){
			if(data.status==1){
				$("#uptext").prepend(data.msg+"<br>");
				if(data.act){
					doact(data.act);
				}
			}else{
				$("#uptext").prepend(data.msg+"<br>");
			}
		},'json')
	}
</script>