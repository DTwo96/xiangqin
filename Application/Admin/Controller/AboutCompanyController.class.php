<?php
// +----------------------------------------------------------------------
// | 关于公司
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Enthusiasm
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Think;

class AboutCompanyController extends AdminController{
    /**
     * 当前模块操作项参数
     */
    protected function _infoModule(){
        if (I('type') == 1) {
            $arr = [
                'name' => '联系红娘',
                'description' => '展示红娘信息',
            ];
        } else if (I('type') == 2){
            $arr = [
                'name' => '公司简介',
                'description' => '展示公司信息',
            ];
        }

        $res = array(
            'info' => $arr,
            'menu' => array(
                array(
                    'name' => '联系红娘',
                    'url' => U('admin/AboutCompany/hongniang',['type' => 1]),
                    'icon' => 'list',
                ),
                array(
                    'name' => '公司简介',
                    'url' => U('admin/AboutCompany/introduction',['type' => 2]),
                    'icon' => 'list',
                ),
                array(
                    'name' => '招商合作',
                    'url' => U('admin/Company/lists'),
                    'icon' => 'list',
                ),
                array(
                    'name' => '添加招商合作',
                    'url' => U('admin/Company/add'),
                    'icon' => 'list',
                ),
            ),
        );

        if (I('type' == 99)) {
            $res = [
                'menu' => array(
                    array(
                        'name' => '立即注册',
                        'url' => U('Home/Public/index'),
                        'icon' => 'list',
                    ),
                    array(
                        'name' => '马上登录',
                        'url' => U('Home/Public/index'),
                        'icon' => 'list',
                    ),
                ),
            ];
        }

        return $res;
    }
    /**
     * 
     * @return 
     * @param
     * @author：Enthusiasm
     * @date：2020/4/5
     * @time：17:30
     */
    public function tuodan()
    {
        //定位当前位置
        $breadCrumb = array('我要脱单' => U(''));

        $this->adminDisplay();
    }
    /**
     * 公司简介
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：19:44
     */
    public function introduction()
    {
        //定位当前位置
        $breadCrumb = array('公司简介' => U(''));

        $this->assign('setting',C('company_setting'));

        $this->assign('breadCrumb',$breadCrumb);

        $this->adminDisplay();
    }
    /**
     * 红娘
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/4
     * @time：19:01
     */
    public function hongniang()
    {
        //定位当前位置
        $breadCrumb = array('联系红娘' => U(''));

        $this->assign('breadCrumb',$breadCrumb);

        $this->assign('setting',C('hongniang_setting'));

        $this->adminDisplay();
    }
    /**
     * 保存数据
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/9
     * @time：17:17
     */
    public function save()
    {
        if (IS_POST) {
            $param = I('post.');
            $type  = I('post.type');

            $file_path = COMMON_PATH.'Conf/'.$type.'.php';

            @file_put_contents($file_path, "<?php \n return ".arrayToString(array_change_key_case($param)).";\n?>");

            $this->success('操作成功');
        }
    }
}
?>