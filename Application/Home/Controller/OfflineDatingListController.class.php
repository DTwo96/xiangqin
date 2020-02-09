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

class OfflineDatingListController  extends SiteController
{
    public function index()
    {
        $this->siteDisplay('xianxiahuodong');
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
        $id = (int) I('id');

        $info = D('Admin/Article')->_info($id);

        $this->assign('info',$info);

        $this->siteDisplay('articleInfo');

    }
}
