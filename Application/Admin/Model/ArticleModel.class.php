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
     * @param int | array $id
     * @param int $type 【1】 删除单条数据 【2】 删除多条数据
     * @return bool
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：22:06
     */
    public function _del($id,$type = 1)
    {
        if ($type == 2) {
            $ids = implode(',',$id);
            $rs  = $this->delete($ids);
        } else {
            $rs = $this->where(array('id' => $id))->delete();
        }

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
    /**
     * 获取一条数据
     * @return array | bool
     * @author：Enthusiasm
     * @date：2020/2/7 0007
     * @time：21:28
     */
    public function _info($id)
    {
        $id = (int) $id;

        $info = $this->where(array('id' => $id))->find();

        foreach ($info as $k => $v) {
            if ($k == 'input_time' || $k == 'update_time') {
                $info[$k] = timeFormat($v);
            }
            if ($k == 'read_num' && $v > 999) {
                $info[$k] = '999+';
            }
            if ($k == 'content') {
                $info[$k] = htmlspecialchars_decode($v);
            }
        }

        return $info;
    }
}
