<?php
// +----------------------------------------------------------------------
// | 邮件发送日志
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Enthusiasm
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;

class EmailLogModel extends Model {
    /**
     * 检查验证码是否正确
     * @param string $email 手机号码
     * @param int | string $yzm 验证码
     * @param int $type 验证码类型
     * @return bool
     * @author：Enthusiasm
     * @date：2020/3/7
     * @time：10:59
     */
    public function checkYzm($email = '',$yzm,$type)
    {
        $where = [];
        $where['email']  = $email;
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