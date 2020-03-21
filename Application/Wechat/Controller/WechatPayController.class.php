<?php
// +----------------------------------------------------------------------
// | 微信支付
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Time: 2020-02-26
// +----------------------------------------------------------------------
// | Author: Enthusiasm
// +----------------------------------------------------------------------

namespace Wechat\Controller;
use Home\Controller\SiteController;
use Think\Log;
use Wechat\Library\WxPayApi;
use Wechat\Library\WxPayConfig;
use Wechat\Library\WxPayNotifyReply;
use Wechat\Library\WxPayOrderQuery;
use Wechat\Library\WxPayUnifiedOrder;
use Wechat\Library\WxPayJsApiPayTool;

class WechatPayController extends SiteController {

	public function __construct() {

		parent::__construct();
        //TODO:请配置伪静态

        $url = $_SERVER['HTTP_HOST'].'/notify';

		$this->notify_url = is_ssl() ? 'https://'.$url : 'http://'.$url;
	}
    /**
     * 微信创建订单
     * @return mixed
     * @author：Enthusiasm
     * @date：2020/2/29
     * @time：22:34
     */
    public function pay($order_info = [],$openid = 0)
    {
        $input  = new WxPayUnifiedOrder();
        $config = new WxPayConfig();
        $tool   = new WxPayJsApiPayTool();

        $input->SetBody($order_info['subject']);
        $input->SetAttach($order_info['userid']);
        $input->SetOut_trade_no($order_info['trade_sn']);
        $input->SetTotal_fee($order_info['total_fee'] * 100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("");
        $input->SetNotify_url($this->notify_url);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openid);

        $order = WxPayApi::unifiedOrder($config, $input);

        if ($order['prepay_id']) {
            return $tool->GetJsApiParameters($order);
        } else {
            $this->error = $order['return_msg'] ? $order['return_msg'] : '微信创建订单失败';
            return false;
        }

    }
    /**
     * 微信回调处理
     * @return bool
     * @author：Enthusiasm
     * @date：2020/2/28
     * @time：12:14
     */
    public function notify()
    {
        $input       = new WxPayOrderQuery();
        $config      = new WxPayConfig();

        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"] ? $GLOBALS["HTTP_RAW_POST_DATA"] : file_get_contents("php://input");
        $param   = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $receive_data = $this->filterParameter($param);
        if ($receive_data) {

            $input->SetOut_trade_no($param['out_trade_no']);
            //查询订单
            $result = WxPayApi::orderQuery($config,$input);

            if(array_key_exists("return_code", $result)
                && array_key_exists("result_code", $result)
                && $result["return_code"] == "SUCCESS"
                && $result["result_code"] == "SUCCESS"
                && !empty($result["trade_state"])
                && $result["trade_state"] == 'SUCCESS'
            ){
                $sqlMap = [];
                $sqlMap['trade_sn'] = $result['out_trade_no'];

                $order = M('PayOrder')->where($sqlMap)->find();
                //付款金额 = 实际金额 * 100
                $total_fee = $result['total_fee'] / 100;
                //实际金额
                $money = $order['total_fee'];
                //检查付款金额是否和实际金额一致,注意单位是分
                if (round($total_fee,2) != round($money,2)) {
                    return false;
                }

                if ($order['status'] != 1 && $order['userid'] > 0) {

                    try {
                        M()->startTrans();

                        $orderMap = [];
                        $orderMap['status'] = '1';
                        $orderMap['notify_time'] = time();

                        $rs = [];

                        $rs[0] = M('PayOrder')->where(['id' => $order['id']])->save($orderMap);
                        //订单日志
                        $vipLog = M('UpgradeVipLog')->where(['order_id' => $order['id']])->find();
                        //用户信息
                        $rank_time = M('Users')->where(['id' => $order['userid']])->getField('rank_time');
                        //购买的vip天数
                        $vipDays = $vipLog['day'];
                        //到期时间
                        $expiresTime = time() + ($vipDays * 24 * 60 * 60);

                        if ($rank_time > 0) {
                            $expiresTime = $rank_time + ($vipDays * 24 * 60 * 60);
                        }

                        $userMap = [];
                        $userMap['user_rank'] = $vipLog['c_id'];
                        $userMap['rank_time'] = $expiresTime;
                        //标记是否为年会员
                        $expires_m = floor(($expiresTime - time()) / 30 * 24 * 60 * 60);
                        if ($expires_m >= 12) {
                            $userMap['is_year_vip'] = 1;
                        }

                        $rs[1] = M('Users')->where(['id' => $order['userid']])->save($userMap);

                        Log::write('异步通知更新会员到期时间执行结果:'.M('Users')->getLastSql());

                        foreach ($rs as $k => $v) {
                            if (!$v) {
                                Log::write('微信异步通知SQL错误信息:'.$k.'执行失败');
                                M()->rollback();
                                $this->ReplyNotify('FAIL');
                                return false;
                            }
                        }

                        M()->commit();

                    } catch (\Exception $e) {
                        M()->rollback();
                        Log::write('微信异步通知捕获的错误信息:'.$e->getMessage());
                        $this->ReplyNotify('FAIL');
                        return false;
                    }

                }

            } else {
                $this->ReplyNotify('FAIL','订单查询失败');
            }
        } else {
           $this->ReplyNotify('FAIL');
        }

        $this->ReplyNotify('SUCCESS');
    }
    /**
     * 回复通知
     * @return void
     * @author：Enthusiasm
     * @date：2020/3/1
     * @time：17:28
     */
    public function ReplyNotify($code = '',$msg = '')
    {
        if (!$msg) {
            $msg = $code == 'SUCCESS' ? 'Ok' : 'FAIL';
        }

        $notifyReply = new WxPayNotifyReply();
        $notifyReply->SetReturn_code($code);
        $notifyReply->SetReturn_msg($msg);
        $xml = $notifyReply->ToXml();
        WxPayApi::replyNotify($xml);
    }
    /**
     * 过滤一些没用的数据
     * @return array
     * @author：Enthusiasm
     * @date：2020/2/29
     * @time：22:33
     */
    private function filterParameter($parameter){
        $para = array();
        foreach ($parameter as $key => $value)
        {
            if ('sign' == $key || 'sign_type' == $key || '' == $value || 'm' == $key  || 'a' == $key  || 'c' == $key   || 'code' == $key || 'method' == $key) continue;
            else $para[$key] = $value;
        }
        return $para;
    }
    /**
     * 获取错误信息
     * @return mixed
     * @author：Enthusiasm
     * @date：2020/2/29
     * @time：22:33
     */
    public function getError()
    {
        return $this->error;
    }
}