<?php


//更新标记用户编码字段
$sql = 'ALTER TABLE `lx_users`
ADD COLUMN `user_number`  char(6) NULL DEFAULT NULL COMMENT \'用户编码 A为男性 B为女性\' AFTER `rank_time`;';
M()->query($sql);
//新增加短信发送日志记录表
$sql = 'CREATE TABLE `lx_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT \'用户ID\',
  `content` varchar(255) NOT NULL COMMENT \'短信内容\',
  `type` tinyint(1) NOT NULL COMMENT \'短信类型 1 注册 2 短信登录 3 修改密码\',
  `ip` varchar(255) NOT NULL COMMENT \'IP地址\',
  `status` tinyint(1) NOT NULL COMMENT \'短信发送状态 -1 发送失败 1 发送成功\',
  `input_time` int(11) NOT NULL COMMENT \'写入时间\',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;';
M()->query($sql);
?>


