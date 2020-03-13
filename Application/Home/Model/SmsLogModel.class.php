<?php
// +----------------------------------------------------------------------
// | 短信发送日志表
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Enthusiasm
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;

class SmsLogModel extends Model {
    /**
     * 检查会员今日发送短信剩余次数
     * @param string | int $phone 用户手机号
     * @param int $type 验证码类型
     * @return bool
     * @author：Enthusiasm
     * @date：2020/3/7
     * @time：10:29
     */
    public function checkSendStatus($phone,$type)
    {
        if (!is_mobile($phone)) {
            $this->error = '手机号码格式错误';
            return false;
        }

        $user_cnt = M('Users')->where(['user_login' => $phone])->count();

        if (!$user_cnt) {
            $this->error = '该手机号码没有注册';
            return false;
        }

        $start_time = date('Y-m-d',time()).'00:00:00';
        $end_time   = date('Y-m-d',time()).'23:59:59';

        $where = array();
        $where['input_time'] = array('between',strtotime($start_time).','.strtotime($end_time));
        $where['phone']      = $phone;
        $where['status']     = 1;

        $sms_cnt = $this->where($where)->count();

        if ($sms_cnt > 5) {
            $this->error = '今日获取短信次数已用完，请明日再试';
            return false;
        }

        return true;
    }
    /**
     * 检查验证码是否正确
     * @param string $phone 手机号码
     * @param int | string $yzm 验证码
     * @param int $type 验证码类型
     * @return bool
     * @author：Enthusiasm
     * @date：2020/3/7
     * @time：10:59
     */
    public function checkYzm($phone,$yzm,$type)
    {
        $where = [];
        $where['phone']  = $phone;
        $where['code']   = $yzm;
        $where['type']   = $type;
        $where['status'] = 1;

        $info = $this->where($where)->find();

        if (!$info) {
            $this->error = '验证码错误';
            return false;
        }
        //检查验证码是否过期
        $interval_time = (time() - $info['input_time']) / 60;
        if ($interval_time > 10) {
            $this->error = '验证码已过期,请重新获取';
            return false;
        }

        return true;
    }
}
?>