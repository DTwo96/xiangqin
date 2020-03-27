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

class ArticleController extends SiteController {
    public function index()
    {
        $type = $nav = I('type',1);
        //标题
        $navTitle = $type == 1 ? '情感美文' : ($type == 2 ? '约会活动' : '招商合作');

        $num = M('Article')->where(['type' => $type])->count();

        $this->assign('num',$num);
        $this->assign('navTitle',$navTitle);
        $this->assign('media', $this->getMedia($navTitle));
        $this->assign('type',$type);
        $this->assign('nav',$nav);

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
        $id = (int) I('id');

        $info = D('Admin/Article')->_info($id);

        //标题
        $navTitle = $info['type'] == 1 ? '情感美文' : ($info['type'] == 2 ? '约会活动' : '招商合作');

        $this->assign('media', $this->getMedia($navTitle.'详情'));

        $this->assign('info',$info);

        $this->siteDisplay('articleInfo');

    }
}
