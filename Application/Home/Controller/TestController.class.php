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

class TestController extends SiteController {
    public function index()
    {
        $sql = 'CREATE TABLE `lx_article` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `author` varchar(255) NOT NULL COMMENT \'作者\',
            `title` varchar(255) NOT NULL COMMENT \'标题\',
            `content` text NOT NULL,
            `type` tinyint(1) NOT NULL COMMENT \'类型 1 情感文章 2 线下活动\',
            `read` int(11) NOT NULL COMMENT \'阅读人数\',
            `star` int(11) NOT NULL DEFAULT \'0\' COMMENT \'点赞数量\',
            `input_time` int(11) NOT NULL COMMENT \'写入时间\',
            `update_time` int(11) NOT NULL COMMENT \'更新时间\',
            PRIMARY KEY (`id`)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT=\'情感文章和线下活动表\';';
          M()->query($sql);
    }
    /**
     * 文章详情
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/7 0007
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
