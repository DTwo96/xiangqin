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
        return array(
            'info' => array(
                'name' => '公司简介',
                'description' => '展示公司信息',
            ),
            'menu' => array(
                array(
                    'name' => '公司简介',
                    'url' => U('introduction'),
                    'icon' => 'list',
                ),
                array(
                    'name' => '红娘联系方式',
                    'url' => U('hongniang'),
                    'icon' => 'list',
                ),
            ),
        );
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
        $breadCrumb = array('红娘联系方式' => U(''));

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