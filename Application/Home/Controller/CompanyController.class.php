<?php
// +----------------------------------------------------------------------
// | 关于公司
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Enthusiasm
// +----------------------------------------------------------------------
namespace Home\Controller;
use Home\Controller\SiteController;

class CompanyController extends SiteController {
    public function index()
    {
        $type = I('type',1);
        //标题
        $navTitle = $type == 1 ? '公司简介' : '联系红娘';

        $setting = ($type == 1 ? C('company_setting') : C('hongniang_setting'));

        $this->assign('navTitle',$navTitle);
        $this->assign('media', $this->getMedia($navTitle));
        $this->assign('setting',htmlspecialchars_decode($setting));

        $this->siteDisplay('about_company');
    }
}
