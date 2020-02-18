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
        //用户身高
        /*$sql = 'ALTER TABLE `lx_users`
ADD COLUMN `height`  int(3) NOT NULL DEFAULT 0 COMMENT \'身高\' AFTER `user_number`;';
        M()->query($sql);*/

        $sql = 'ALTER TABLE `lx_users` DROP COLUMN `height`;';
        M()->query($sql);
    }
}
