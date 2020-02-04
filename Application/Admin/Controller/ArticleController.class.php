<?php
namespace Admin\Controller;
class ArticleController extends AdminController{
    /**
     * 当前模块操作项参数
     */
    protected function _infoModule(){
        return array(
            'info' => array(
                'name' => '情感文章管理',
                'description' => '用于情感文章展示',
            ),
            'menu' => array(
                array(
                    'name' => '文章列表',
                    'url' => U('articleLists'),
                    'icon' => 'list',
                ),
                array(
                    'name' => '添加情感文章',
                    'url' => U('articleAdd'),
                    'icon' => 'plus',
                ),
            ),
        );
    }
    /**
     * 文章列表
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：19:01
     */
    public function articleLists()
    {
        //定位当前位置
        $breadCrumb = array('文章列表' => U(''));
        $this->assign('breadCrumb',$breadCrumb);

        $lists = D('Article')->select();
        $this->assign('lists',$lists);
        $this->adminDisplay();
    }
    /**
     * 添加文章
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：19:44
     */
    public function articleAdd()
    {
        //定位当前位置
        $breadCrumb = array('添加情感文章' => U('articleAdd'));
        $this->assign('breadCrumb',$breadCrumb);

        if (IS_POST) {
            $param = I('post.');

            $rs = D('Article')->_add($param);
            if ($rs['code']) {
                $this->success('添加成功');
            } else {
                $this->error($rs['error']);
            }
        }
        $this->adminDisplay();
    }
    /**
     * 删除文章
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：22:01
     */
    public function del()
    {
        $id = (int) I('data');
        if (!$id) $this->error('参数错误');

        $rs = D('Article')->_del($id);

        if ($rs) {
            $this->success('操作成功!');
        } else {
            $this->error('操作失败');
        }
    }
    /**
     * 修改文章
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：22:10
     */
    public function articleEdit()
    {
        $id = (int)I('id');

        $info = D('Article')->where(array('id' => $id))->find();

        if (!$info) $this->error('没有这条数据!');

        if (IS_POST) {
            $param = I('post.');

            $rs = D('Article')->_update($param);

            if ($rs['code'] == 1) {
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }

        $this->assign('info',$info);

        $this->adminDisplay();
    }
}
?>