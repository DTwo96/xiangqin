<?php
namespace DuxCms\Controller;
use Home\Controller\SiteController;
/**
 * 表单列表
 */

class FormController extends SiteController {

	/**
     * 列表
     */
    public function index(){
        $name = urldecode(I('get.name'));
        $table = len($name,0,20);
		
        if(empty($table)){
            $this->error404();
        }
        //获取表单信息
        $where = array();
        $where['table'] = $table;
        $formInfo = D('DuxCms/FieldsetForm')->getWhereInfo($where);
        if(empty($formInfo)){
            $this->error404();
        }
        if(!$formInfo['show_list']){
            $this->error404();
        }
		//dump($formInfo);
        //分页参数
        $size = intval($info['list_page']); 
        if (empty($size)) {
            $listRows = 20;
        } else {
            $listRows = $size;
        }
        //设置模型
        $model = D('DuxCms/FieldData');
        $model->setTable($formInfo['table']);
        //查询数据
        //$where = array();
        //$where['_string'] = $formInfo['list_where'];
		$where = $formInfo['list_where']?$formInfo['list_where']:' 1=1 ';
        $count = $model->countList($where);
        $limit = $this->getPageLimit($count,$listRows);
		
		
        //查询内容
        $list = $model->loadList($where,$limit,$formInfo['list_order']);
		
		
	//	dump($list);
        //字段列表
		
        $where = array();
        $where['A.fieldset_id'] = $formInfo['fieldset_id'];
        $fieldList = D('FieldForm')->loadList($where);
        //格式化表单内容为基本数据
        $data = array();
        if(!empty($list)){
            foreach ($list as $key => $value) {
                $data[$key]=$value;
                foreach ($fieldList as $v) {
                    $data[$key][$v['field']] = D('DuxCms/FieldData')->revertField($value[$v['field']],$v['type'],$v['config']);
                }                
            }
        }
        //URL参数
		//var_dump($list);
        $pageMaps = array();
        $pageMaps['name'] = $name;
        //获取分页
        $page = $this->getPageShow($pageMaps);
        //位置导航
        $crumb = array(array('name'=>$formInfo['name'],'url'=>U('DuxCms/Form/index',$pageMaps)));
        //MEDIA信息
        $media = $this->getMedia($formInfo['name']);
        $this->assign('crumb',$crumb);
        $this->assign('media', $media);
        $this->assign('pageList',$data);
        $this->assign('count', $count);
        $this->assign('page', $page);
        $this->assign('formInfo', $formInfo);
        $this->siteDisplay($formInfo['tpl_list']);
    }

    /**
     * 表单内容
     */
    public function info(){
        $name = urldecode(I('get.name'));
        $table = len($name,0,20);
        $id = I('get.id');
        if(empty($table)||empty($id)){
            $this->error404();
        }
        //获取表单信息
        $where = array();
        $where['table'] = $table;
        $formInfo = D('DuxCms/FieldsetForm')->getWhereInfo($where);
        if(empty($formInfo)){
            $this->error404();
        }
        if(!$formInfo['show_info']){
            $this->error404();
        }
        //设置模型
        $model = D('DuxCms/FieldData');
        $model->setTable($formInfo['table']);
        $info = $model->getInfo($id);
        if(empty($info)){
             $this->error404();
        }
        //字段列表
        $where = array();
        $where['A.fieldset_id'] = $formInfo['fieldset_id'];
        $fieldList = D('FieldForm')->loadList($where);
        //格式化表单内容为基本数据
        foreach ($fieldList as $v) {
            $info[$v['field']] = D('DuxCms/FieldData')->revertField($info[$v['field']],$v['type'],$v['config']);
        }
        //位置导航
        $crumb = array(
            array('name'=>$formInfo['name'],'url'=>U('DuxCms/Form/index',array('name'=>$name))),
            array('name'=>'详情','url'=>U('DuxCms/Form/index',array('name'=>$name,'id'=>$id))),
            );
        //MEDIA信息
        $media = $this->getMedia($formInfo['name'] . '- 详情 ');
        $this->assign('crumb',$crumb);
        $this->assign('media', $media);
        $this->assign('formInfo', $formInfo);
        $this->assign('info', $info);
        $this->siteDisplay($formInfo['tpl_info']);
    }

    /**
     * 发布
     */
    public function push(){
        if(!IS_POST){
            $this->error404();
        }
        $table = I('post.table');      
        $token = I('post.token');
        $token = trim($token);
        if(empty($table)||empty($token)){
            $this->errorBlock();
        }
        //验证token
        if(!D('FieldsetForm')->validToken($table,$token)){
            $this->error('安全验证失败，请刷新页面后重新提交！');
        }
        
        //提现限制20150906  by  lxphp.Memcache
        
        if($table=='tixian'){
        	$uid = I("post.Fieldset_uid");
        	$money = I("post.Fieldset_money");
        	$w['id']=$uid;
        	$w['money']= array("egt", $money);
        	$re = M("Users")->where($w)->find();
        	if(!$re){
				$this->error("获取用户金额信息错误，请稍后再试");
			}
			$re = M("ext_tixian")->where("uid=".$uid." and status=0")->order('data_id desc')->find();
			if($re){
				$this->error("您有一笔提现正在进行中，请等待管理员操作。提现金额：".$re['money']);
			}			
		}
        
        
        
        //获取表单信息
        $where = array();
        $where['table'] = $table;
        $formInfo = D('DuxCms/FieldsetForm')->getWhereInfo($where);
        if(empty($formInfo)){
            $this->errorBlock();
        }
        if(!$formInfo['post_status']){
            $this->errorBlock();
        }
        //设置模型
        $model = D('DuxCms/FieldData');
        $model->setTable($formInfo['table']);
        //增加信息
        if ($model->saveData('add',$formInfo['fieldset_id'])){
			if($table=='tixian'){
				//支付宝提现申请成功，提醒管理员
				A('Home/Weixin')->makeTextbygm('您有一条支付宝提现申请，请及时处理！', C('adminopenid'));
			}
            $this->success($formInfo['post_msg'],$formInfo['post_return_url']);
        }else{
            $msg = $model->getError();
            if (empty($msg))
            {
                $this->error($formInfo['name'].'发布失败，请刷新后重新尝试！');
            }else{
                $this->error($msg);
            }
        }
    }


}

