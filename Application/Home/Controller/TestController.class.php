<?php
// +----------------------------------------------------------------------
// | 测试控制器
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Enthusiasm
// +----------------------------------------------------------------------
namespace Home\Controller;
use Home\Controller\SiteController;
use Think\Exception;

class TestController extends SiteController {
    public function index()
    {
        $type = I('type',1);
        //标题
        $navTitle = $type == 1 ? '情感文章' : ($type == 2 ? '线下活动' : '招商合作');

        $this->assign('navTitle',$navTitle);
        $this->assign('media', $this->getMedia($navTitle));
        $this->assign('type',$type);

        $this->siteDisplay('test');
    }
    /**
     * 文章详情
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/7
     * @time：21:08
     */
    public function articleInfo()
    {
        $this->assign('media', $this->getMedia('详情'));

        $id = (int) I('id');

        $info = D('Admin/Article')->_info($id);

        $this->assign('info',$info);

        $this->siteDisplay('articleInfo');

    }

    public function test2()
    {
        $sql = 'ALTER TABLE `lx_users` 
ADD COLUMN `rank_name` varchar(255) NULL COMMENT \'等级称号\' AFTER `is_year_vip`;';
        M()->query($sql);
    }
}
