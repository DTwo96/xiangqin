<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="/Public/admin/css/base.css"/>
<link rel="stylesheet" href="/Public/admin/css/style.css"/>
<link rel="stylesheet" href="/Public/admin/css/grid.css"/>
<link rel="stylesheet" href="/Public/admin/css/font-awesome.min.css"/>
<!--[if lt IE 9]>
<script src="/Public/js/html5.js"></script>
<![endif]-->
<script>
var baseDir='/Public/js/';
var rootUrl="/";
var sessId='<?php echo session_id();?>';
</script>
<script src="/Public/js/jquery.js"></script>
<script src="/Public/admin/js/admin.js"></script>
<script src="/Public/js/do.js"></script>
<script src="/Public/js/config.js"></script>
</head>
<body>
<div class="g-head"> <a class="m-logo"></a>
  <?php $list = D('Admin/Menu')->getMenu($loginUserInfo); ?>
  <ul class="m-nav f-fl u-menu-mobile" id="main-nav">
    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><li><a href="javascript:;"><?php echo ($vo["name"]); ?> <i class="u-icon-caret-down"></i></a>
        <ul class="m-pulldown">
          <?php if(is_array($vo['menu'])): foreach($vo['menu'] as $key=>$menu): ?><!--
        <li class="u-divider"></li>
        -->
            <li><a href="<?php echo ($menu["url"]); ?>"><?php echo ($menu["name"]); ?></a> </li><?php endforeach; endif; ?>
        </ul>
      </li><?php endforeach; endif; ?>
  </ul>
  <ul class="m-nav f-fr u-menu-mobile" id="tool-nav">
    <li><a href="javascript:;"><?php echo ($loginUserInfo["nicename"]); ?> <i class="u-icon-caret-down"></i></a>
      <ul class="m-pulldown">
        <li><a href="<?php echo U('Admin/AdminUser/edit',array('user_id'=>$loginUserInfo['user_id']));?>">修改资料</a></li>
        <li class="u-divider"></li>
        <li><a href="<?php echo U('Admin/Login/logout');?>">安全退出</a></li>
      </ul>
    </li>
    <li><a href="<?php echo U('Home/Index/index');?>" target="_blank">网站首页</a></li>
  </ul>
  <button type="button" class="u-nav-mobile" target="#sd-nav"><i class="u-icon-th"></i> </button>
  <button type="button" class="u-nav-mobile" target="#main-nav"><i class="u-icon-th"></i> </button>
  <button type="button" class="u-nav-mobile" target="#tool-nav"><i class="u-icon-th"></i> </button>
</div>
<div class="g-sidebar u-menu-mobile" id="sd-nav">
  <ul>
    <?php if(is_array($infoModule['menu'])): foreach($infoModule['menu'] as $key=>$menu): ?><li><a href="<?php echo ($menu["url"]); ?>"><i class="u-icon-<?php echo ($menu["icon"]); ?>"></i> <span><?php echo ($menu["name"]); ?></span></a></li><?php endforeach; endif; ?>
  </ul>
</div>
<div class="g-page-head">
  <h2><i class="u-icon-<?php echo ($infoModule["info"]["icon"]); ?>"></i> <?php echo ($infoModule["info"]["name"]); ?> <span><?php echo ($infoModule["info"]["description"]); ?></span></h2>
  <ul>
    <li>当前位置 </li>
    <li><a href="<?php echo U('Admin/Index/index');?>">系统首页</a></li>
    <?php if(is_array($breadCrumb)): foreach($breadCrumb as $k=>$v): ?><li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endforeach; endif; ?>
  </ul>
</div>
<div class="g-main">
  <!--common-->
</div>
</body>
</html>