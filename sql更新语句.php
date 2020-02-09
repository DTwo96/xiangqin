<?php
/*
 * ！！！注意执行过的代码第二次不用再执行
 *
 */
//更新标记用户编码字段
$sql = 'ALTER TABLE `lx_users`
ADD COLUMN `user_number`  char(6) NULL DEFAULT NULL COMMENT \'用户编码 A为男性 B为女性\' AFTER `rank_time`;';
M()->query($sql);
//用户身高
$sql = 'ALTER TABLE `lx_users`
ADD COLUMN `height`  int(3) NOT NULL DEFAULT 0 COMMENT \'身高\' AFTER `user_number`;';
M()->query($sql);
//月收入
$sql = 'ALTER TABLE `lx_users`
ADD COLUMN `month_income`  int(11) NOT NULL DEFAULT 0 COMMENT \'月收入\' AFTER `height`,';
M()->query($sql);
//学历
$sql = 'ALTER TABLE `lx_users`
ADD COLUMN `education`  tinyint(1) NOT NULL DEFAULT 0 COMMENT \'学历 参照配置项 Education\' AFTER `month_income`;';
M()->query($sql);



//新增加短信发送日志记录表
$sql = 'CREATE TABLE `lx_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` char(11) NOT NULL COMMENT \'手机号码\',
  `content` varchar(255) NOT NULL COMMENT \'短信内容\',
  `type` tinyint(1) NOT NULL COMMENT \'短信类型 1 注册 2 短信登录 3 修改密码\',
  `ip` varchar(255) NOT NULL COMMENT \'IP地址\',
  `code` char(10) NOT NULL COMMENT \'验证码\',
  `status` tinyint(1) NOT NULL COMMENT \'短信发送状态 -1 发送失败 1 发送成功\',
  `error_msg` varchar(255) NOT NULL COMMENT \'发送错误时的错误信息\',
  `input_time` int(11) NOT NULL COMMENT \'写入时间\',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT=\'短信发送日志表\';';

M()->query($sql);
//新增情感文章和线下活动
$sql = 'CREATE TABLE `lx_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL COMMENT \'作者\',
  `title` varchar(255) NOT NULL COMMENT \'标题\',
  `content` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT \'类型 1 情感文章 2 线下活动\',
  `read_num` int(11) NOT NULL DEFAULT \'0\' COMMENT \'阅读人数\',
  `star` int(11) NOT NULL DEFAULT \'0\' COMMENT \'点赞数量\',
  `input_time` int(11) NOT NULL COMMENT \'写入时间\',
  `update_time` int(11) NOT NULL COMMENT \'更新时间\',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COMMENT=\'情感文章和线下活动表\';';
M()->query($sql);

?>


