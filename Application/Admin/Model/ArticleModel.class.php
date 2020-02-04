<?php
namespace Admin\Model;
use Think\Model;
/**
 * 用户组操作
 */
class ArticleModel extends Model {
    //完成
    protected $_auto = array(
        array('input_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
    );
    //验证
    protected $_validate = array(
        array('title','require','标题不能为空!'),
        array('content','require','内容不能为空!'),
    );

    public function _add($param)
    {
        $rs = array();

        if ($this->create($param)) {
            $res = $this->add();
            if ($res) {
                $rs['id']    = $res;
                $rs['code']  = 1;
            } else {
                $rs['msg'] = '操作失败';
                $rs['code']  = 0;
            }
        } else {
            $rs['msg'] = $this->getError();
            $rs['code']  = 0;
        }

        return $rs;
    }
    /**
     * 删除文章
     * @param int $id
     * @return bool
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：22:06
     */
    public function _del($id)
    {
        $rs = $this->where(array('id' => $id))->delete();

        if ($rs) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 删除文章
     * @param int $id
     * @return array
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：22:06
     */
    public function _update($param)
    {
        $rs = array();

        if ($param['id']) {
            $rs['msg']  = '参数错误';
            $rs['code'] = 0;
        }


        if ($this->create($param)) {
            $res = $this->save();
            if ($res) {
                $rs['msg']   = '操作成功';
                $rs['code']  = 1;
            } else {
                $rs['msg']   = '操作失败';
                $rs['code']  = 0;
            }
        } else {
            $rs['msg'] = $this->getError();
            $rs['code']  = 0;
        }

        return $rs;
    }
}