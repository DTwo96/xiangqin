<?php
// +----------------------------------------------------------------------
// | 招商合作
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Enthusiasm
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Think;

class CompanyController extends AdminController{
    /**
     * 当前模块操作项参数
     */
    protected function _infoModule(){
        return array(
            'info' => array(
                'name' => '招商合作管理',
                'description' => '展示招商合作',
            ),
            'menu' => array(
                array(
                    'name' => '联系红娘',
                    'url' => U('admin/AboutCompany/hongniang'),
                    'icon' => 'list',
                ),
                array(
                    'name' => '公司简介',
                    'url' => U('admin/AboutCompany/introduction'),
                    'icon' => 'list',
                ),
                array(
                    'name' => '招商合作',
                    'url' => U('admin/Company/lists'),
                    'icon' => 'list',
                ),
                array(
                    'name' => '添加招商项目',
                    'url' => U('admin/Company/add'),
                    'icon' => 'list',
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
    public function lists()
    {
        //定位当前位置
        $breadCrumb = array('招商合作列表' => U(''));

        $this->assign('breadCrumb',$breadCrumb);

        $param = I('');

        $page = I('p',1);

        $limit = I('limit',10);

        $where = array();

        $where['type'] = 3;

        //搜索条件
        if (!empty($param['search_type']) && !empty($param['keyword'])) {

            $param['keyword'] = trim($param['keyword']);

            switch ($param['search_type']) {
                case 'id':
                    $where['id'] = (int) $param['keyword'];
                    break;
                case 'title':
                    $where['title'] = array('like',"%{$param['keyword']}%");
                    break;
                case 'author':
                    $where['author'] = $param['keyword'];
                    break;
            }
        }

        $lists = D('Article')->where($where)->page($page,$limit)->order('id desc')->select();

        $count = D('Article')->where($where)->count();

        $pager = $this->getPageLimit($count,$limit);

        $show = $this->getPageShow($param);

        $this->assign('page',$show);

        $this->assign('lists',$lists);

        $this->assign('param',$param);

        $this->adminDisplay();
    }
    /**
     * 添加文章
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：19:44
     */
    public function add()
    {
        //定位当前位置
        $breadCrumb = array('添加招商合作' => U('add'));

        $this->assign('breadCrumb',$breadCrumb);

        if (IS_POST) {

            $param = I('post.');
            //标记文章类型  【1】情感文章 【2】线下活动 【3】招商项目
            $param['type'] = 3;

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
        $param = I('post.');

        if (isset($param['type'])) { //删除多条数据

            if (!is_array($param['ids'])) {

                $this->error('参数错误');

            }

            $rs = D('Article')->_del($param['ids'],2);

        } else { //删除单条数据

            $id = (int)$param['data'];

            if (!$id) {

                $this->error('参数错误');
            }

            $rs = D('Article')->_del($id,1);
        }

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
    public function edit()
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