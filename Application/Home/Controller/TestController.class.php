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
        $this -> siteDisplay('test');
    }
}