<?php
/**
 * 
 * 微信支付API异常类
 * @author widyhu
 *
 */
namespace Wechat\Library;
class WxPayException extends \Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}
}
