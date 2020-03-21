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
        $sql = 'CREATE TABLE `lx_system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL COMMENT \'记录ip\',
  `content` varchar(255) DEFAULT NULL COMMENT \'记录内容\',
  `type` smallint(1) NOT NULL COMMENT \'日志类型 1.系统日志 2.用户日志\',
  `input_time` int(11) NOT NULL COMMENT \'写入时间\',
  `update_time` int(11) NOT NULL COMMENT \'更新时间\',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';

        M()->query($sql);
    }
}
