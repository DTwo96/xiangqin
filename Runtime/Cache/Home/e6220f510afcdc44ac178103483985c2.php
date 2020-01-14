<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta content="black" name="apple-mobile-web-app-status-bar-style">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
		<title><?php echo ($media["title"]); ?></title>
		<link rel="stylesheet" type="text/css" href="css/css.css">
		<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>

	</head>
	<style type="text/css">
           .fx_header {
              position: fixed;
              top: 0px;
                }
     </style>

	<body onload="words_deal()">
		
		<div class="hd_main">
		<div style="height:40px;display:none ;" class="appdiv fx_header_new"></div>
  <!--#include file="app_share.html"-->
			<div class="fujinderen_header">
				内心独白
				<a href="javascript:history.go(-1);" class="fl" id="ddd"><img src="images/zuojian.png" style="width:11px;">返回</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>

			<div class="mt22 neixinduba">
				<textarea name="textarea" id="TextArea1" data="1" cols="45" rows="5" onkeyup="words_deal();" placeholder="添加内心独白，不超过50个字…"><?php if(isset($text)): echo ($text); else: echo ($info); endif; ?></textarea>
				<span id="textCount">50</span><img src="images/suiji.png" id="suiji">
			</div>
			<p class="shenghezhong">
			<?php if(isset($status)): echo ($status); endif; ?>
			</p>
			<input name="button" value="保存" class="baocui" onclick="words_deal()"   style="width: 90%;border-radius: 4px;margin-top: 0px;">

			<!--#include file="footer.html"-->
		</div>
	</body>
	<script>
		//提交
		$(function() {
			$('.baocui').live('click', function() {
				
				
				var o = $(this);
				setDisabled(o, '保存中');
				var molog = $('#TextArea1').val();
				var type = $("#TextArea1").attr('data');
				
				if(molog == text){
					type = 2;
				}
				
				$.post('<?php echo U();?>', {
					molog: molog,
					type:type
				}, function(data) {
					
					if(data.status == -2) { //提示 在审中
						$('.shenghezhong').html('*审核中…');
					}else if( data.status == 1 ){ //成功
						
					}else{ //跳出错误信息
						alert(data.info);
					}
					unDisabled(o, '保存');
				}, 'json')
			});
		});
	</script>
	
	<script type="text/javascript">
		function words_deal() {
			var curLength = $("#TextArea1").val().length;
			if (curLength > 50) {
				var num = $("#TextArea1").val().substr(0, 50);
				$("#TextArea1").val(num);
				alertmsg("超过字数限制，多出的字将被截断！");
			} else {
				$("#textCount").text(50 - $("#TextArea1").val().length);
			}
		}
	</script>
	
	<script>
	   var text = "";
	
		//随机内心独白
		$('#suiji').click(function(){
    		  $.post('<?php echo U("getSjTitle");?>',{type:2},function(data){
    			if(data.status == 1){
    				$('#TextArea1').val(data.info);
    				text = data.info;
    				words_deal();
    			}
    		},'json')
    	});	
	</script>
</html>