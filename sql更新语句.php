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
ADD COLUMN `month_income`  int(11) NOT NULL DEFAULT 0 COMMENT \'月收入\' AFTER `height`;';
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT=\'短信发送日志表\';';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT=\'情感文章和线下活动表\';';
M()->query($sql);

//删除会员主表下面的身高字段
$sql = 'ALTER TABLE `lx_users` DROP COLUMN `height`;';
M()->query($sql);
//支付订单
$sql = 'CREATE TABLE `lx_pay_order` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT \'递增ID\',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT \'0\' COMMENT \'用户ID\',
  `code` varchar(50) NOT NULL DEFAULT \'\' COMMENT \'支付接口\',
  `trade_sn` varchar(200) NOT NULL DEFAULT \'\' COMMENT \'唯一订单号\',
  `subject` varchar(250) NOT NULL DEFAULT \'\' COMMENT \'商品名称\',
  `total_fee` decimal(11,2) unsigned NOT NULL DEFAULT \'0.00\' COMMENT \'交易总额（单位：分）\',
  `method` varchar(50) NOT NULL DEFAULT \'\' COMMENT \'支付方式\',
  `status` tinyint(2) NOT NULL DEFAULT \'0\' COMMENT \'支付状态 0未支付 1已支付 -1关闭订单\',
  `notify_time` int(10) unsigned NOT NULL COMMENT \'通知时间\',
  `fee` decimal(9,2) unsigned NOT NULL DEFAULT \'0.00\' COMMENT \'手续费\',
  `input_time` int(10) unsigned NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`id`),
  KEY `trade_sn` (`trade_sn`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'支付订单表\';';

M()->query($sql);
//微信授权表
$sql = 'CREATE TABLE `lx_user_oauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT \'0\' COMMENT \'用户id\',
  `subscribe` varchar(255) NOT NULL COMMENT \'用户是否订阅该公众号 0 未订阅 1已订阅\',
  `type` varchar(255) DEFAULT NULL COMMENT \'类型,wechat,sinaweibo,alipay,qqconnect\',
  `openid` varchar(255) DEFAULT NULL COMMENT \'用户的标识，对当前公众号唯一\',
  `nickname` varchar(255) DEFAULT NULL COMMENT \'微信昵称\',
  `sex` varchar(255) DEFAULT NULL COMMENT \'性别 值为man时是男性，值为woman时是女性，值为0时是未知\',
  `city` varchar(255) DEFAULT NULL COMMENT \'所在市\',
  `country` varchar(255) DEFAULT NULL COMMENT \'所在国家\',
  `province` varchar(255) DEFAULT NULL COMMENT \'所在省份\',
  `language` varchar(255) DEFAULT NULL COMMENT \'所用语言 \',
  `headimgurl` varchar(255) DEFAULT NULL COMMENT \'微信头像\',
  `subscribe_time` char(10) DEFAULT NULL COMMENT \'关注时间\',
  `access_token` varchar(255) DEFAULT NULL COMMENT \'token令牌\',
  `expires_time` char(10) DEFAULT NULL COMMENT \'过期时间\',
  `refresh_token` varchar(255) DEFAULT NULL COMMENT \'续期令牌\',
  `concern_status` int(1) DEFAULT NULL COMMENT \'关注状态 1 关注中 0 取消关注\',
  `bind_status` int(1) DEFAULT NULL COMMENT \'是否绑定账号， 1已绑定 2 未绑定\',
  `unionid` varchar(255) DEFAULT NULL COMMENT \'只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。\',
  `remark` varchar(255) DEFAULT NULL COMMENT \'公众号运营者对粉丝的备注\',
  `groupid` int(11) DEFAULT NULL COMMENT \'用户所在的分组ID\',
  `tagid_list` varchar(255) DEFAULT NULL COMMENT \'用户被打上的标签ID列表\',
  `bind_time` int(10) DEFAULT NULL COMMENT \'绑定时间\',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `userid_2` (`userid`,`type`),
  KEY `userid_3` (`userid`,`type`,`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=\'微信公众号关注者的微信信息\';';
M()->query($sql);
//升级会员日志表
$sql = 'CREATE TABLE `lx_upgrade_vip_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT \'订单ID\',
  `c_id` int(11) NOT NULL COMMENT \'关联config_vip的id\',
  `day` int(11) NOT NULL COMMENT \'天数\',
  `original` decimal(10,2) NOT NULL COMMENT \'原价\',
  `price` decimal(10,2) NOT NULL COMMENT \'折扣价\',
  `input_time` int(11) NOT NULL COMMENT \'写入时间\',
  `update_time` int(11) NOT NULL COMMENT \'更新时间\',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT=\'升级会员日志表\';';

M()->query($sql);
//系统日志
$sql = 'CREATE TABLE `lx_system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL COMMENT \'记录ip\',
  `content` varchar(255) DEFAULT NULL COMMENT \'记录内容\',
  `type` smallint(1) NOT NULL COMMENT \'日志类型 1.系统日志 2.用户日志\',
  `input_time` int(11) NOT NULL COMMENT \'写入时间\',
  `update_time` int(11) NOT NULL COMMENT \'更新时间\',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';

M()->query($sql);

$sql = 'ALTER TABLE `lx_config_vip`
ADD COLUMN `description`  varchar(255) NOT NULL COMMENT \'说明\' AFTER `time`;';

M()->query($sql);

$sql = 'ALTER TABLE `lx_user_profile`
ADD COLUMN `real_name`  varchar(255) NOT NULL COMMENT \'真实姓名\' AFTER `code4`,
ADD COLUMN `university`  varchar(255) NOT NULL COMMENT \'大学\' AFTER `real_name`,
ADD COLUMN `work`  varchar(255) NOT NULL COMMENT \'工作\' AFTER `university`,
ADD COLUMN `hobby`  varchar(255) NOT NULL COMMENT \'兴趣爱好\' AFTER `work`;';

M()->query($sql);

$sql = 'ALTER TABLE `lx_user_profile` 
ADD COLUMN `email` varchar(255) NOT NULL COMMENT \'邮箱\' AFTER `hobby`;';

M()->query($sql);

//标记是否为年费会员
$sql = 'ALTER TABLE `lx_users` 
ADD COLUMN `is_year_vip` tinyint(1) NULL DEFAULT 0 COMMENT \'是否为年费会员  0 否 1 是\' AFTER `education`;';
M()->query($sql);
//购房信息和购车信息
$sql = 'ALTER TABLE `lx_user_profile` 
ADD COLUMN `house_info` varchar(255) NOT NULL COMMENT \'购房信息\' AFTER `email`,
ADD COLUMN `car_info` varchar(255) NOT NULL COMMENT \'购车信息\' AFTER `house_info`;';

M()->query($sql);
?>


