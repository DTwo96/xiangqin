<?php
// +----------------------------------------------------------------------
// | 微信授权控制器
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

class WechatOauthController extends SiteController {

	public function __construct() {

		parent::__construct();
        //初始化微信公众号配置参数
		$this->config = [
            'appid'  => C('wx_appid'),
            'secret' => C('wx_appsecret'),
        ];
	}
    /**
     * 请求微信接口
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/26
     * @time：18:08
     */
    public function requestWxUrl($callback = '')
    {
        if ($callback == '') {
            $callback =  U('index/wxLogin','','',true);
        }

        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->config['appid'].'&redirect_uri='.urlEncode($callback).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        redirect($url);
	}
    /**
     * 获取用户信息
     * @return array | bool
     * @author：Enthusiasm
     * @date：2020/2/26
     * @time：18:27
     */
    public function buyAccessToken($code = '')
    {
        if (!$code) {
            $this->error = '参数错误';
            return false;
        }

        $param = [
            'appid'      => $this->config['appid'],
            'secret'     => $this->config['secret'],
            'code'       => $code,
            'grant_type' => 'authorization_code',
        ];

        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?'.http_build_query($param);

        $res = curl_get_contents($url);

        $res = json_decode($res,true);

        if (empty($res['access_token'])) {
            $this->error = '获取令牌失败';
            return false;
        }
        $this->openid = $res['openid'];


        return $res;

	}
    /**
     * 获取用户的openid
     * @return bool | string
     * @author：Enthusiasm
     * @date：2020/2/26
     * @time：18:19
     */
    public function getOpenId()
    {
        if (!empty($this->openid)) {
            return $this->openid;
        } else {
            $this->error = '获取openid失败';
            return false;
        }
    }
    /**
     * 获取微信用户信息
     * @return mixed
     * @author：Enthusiasm
     * @date：2020/2/29
     * @time：18:57
     */
    public function WxUserInfo($open_id = '',$access_token = '')
    {
        $param = [
            'access_token' => $access_token,
            'openid'       => $open_id,
        ];

        $url = 'https://api.weixin.qq.com/sns/userinfo?'.http_build_query($param);

        $result = curl_get_contents($url);

        if(empty($result) || !empty($result['errcode'])) {
            $this->error = '用户信息获取失败，请重试';
            return false;
        }

        $result = json_decode($result,true);

        return $result;

    }
    /**
     * 获取错误信息
     * @return string | bool
     * @author：Enthusiasm
     * @date：2020/2/26
     * @time：18:59
     */
    public function getError()
    {
        return $this->error;
    }
}