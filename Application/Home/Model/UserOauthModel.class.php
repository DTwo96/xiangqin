<?php
// +----------------------------------------------------------------------
// | 用户认证
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Enthusiasm
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;

class UserOauthModel extends Model {
    public function isBind($userid = 0)
    {
        if (!$userid) {
            return false;
        }

        $where = [];
        $where['userid']      = $userid;
        $where['type']        = 'wechat';
        $where['bind_status'] = 1;

        $res = $this->where($where)->count();
        
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}

?>