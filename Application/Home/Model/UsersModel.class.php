<?php
namespace Home\Model;
use Think\Model;

class UsersModel extends Model {
	
	
	/**
	*  openid 返回用户信息字段。
	* @param undefined $openid
	* @param undefined $field
	* 
*/
	public function wreuval($openid,$field='id'){
		return $this->where("weixin='{$openid}'")->getField($field);
	}
	
	public function idreinfo($id,$field='weixin'){//id获取 info
	$re = $this->find($id);
	return $re[$field];
	} 

	public function qd(){
		
	}
	
	public function myfens($uid){
		return $this->where("parent_id='{$uid}'")->count();
	}
	
	
	//纯手机注册
	/*public function reg($log="",$pwd="",$sex="",$age=""){
		$age = date('Y')-$age;
		$arr ['user_login'] = $log;
		$re = $this->where($arr)->find();
		if($re) return false;
		$arr ['last_login_ip'] = $arr ['regip'] = get_client_ip ();
		$arr ['create_time'] = time ();
		$parent_id = cookie('yq');
		if($parent_id>0){
			$re2 = $this->where("id=".$parent_id)->find();
			if($re2)
			$arr ['parent_id'] = $parent_id;
		}		
		$arr ['sex'] = $sex;
	    $arr ['age'] = $age;
		$arr ['idmd5'] = md5($log. C ( 'PWD_SALA' ).$pwd);
		$arr ['last_login_time'] = time ();
		$arr ['user_pass'] = md5 ( $log . $pwd . C ( 'PWD_SALA' ) );
		$openid = cookie("regopenid");
		$wxinfo = S("reginfo".$openid);	
	    if($wxinfo){
			$arr= array_merge($arr,$wxinfo);
			S("reginfo".$openid,null);		
		}			
		$res = $this->add ( $arr );
		if($res) {
			$data['uid']=$res;
			$data['birthday']=$age."-01-01";
			$arr = array('mob'=>'hot','qq'=>'hot','weixin'=>'hot');
			$data['lxfs_config'] = serialize($arr);
			M("User_profile")->add($data);
			$userymod = M("User_y_reg");
			$reyreg = $userymod->where("code='$openid'")->save(array('regtime'=>time(),'reguid'=>$res));			
			return $res;
			}
		return false;
	}*/
    public function reg($param = []){

        if (empty($param['phone'])) {
            $this->error = '手机号码不能为空';
            return false;
        }
        if (empty($param['pwd'])) {
            $this->error = '密码不能为空';
            return false;
        }
        if (empty($param['sex'])) {
            $this->error = '请选择性别';
            return false;
        }
        if (empty($param['age'])) {
            $this->error = '请填写年龄';
            return false;
        }
        if (empty($param['weixin'])) {
            $this->error = '请填写微信';
            return false;
        }
        if (!is_mobile($param['phone'])) {
            $this->error = '手机号码格式错误';
            return false;
        }

        $sqlMap = [];
        $sqlMap['user_login'] = $param['phone'];

        $check_user = $this->where($sqlMap)->count();
        if ($check_user) {
            $this->error = '该手机号码已被注册';
            return false;
        }

        $year = date('Y');

        $age_Y = $year - $param['age'];
        if ($age_Y > $year - 18) {
            $this->error = '年龄需满18岁或以上';
            return false;
        }

        $sqlMap['age']             = $age_Y;
        $sqlMap['sex']             = $param['sex'];
        $sqlMap['idmd5']           = md5($param['phone'].C ( 'PWD_SALA' ).$param['pwd']);
        $sqlMap['user_pass']       = md5 ( $param['phone'].$param['pwd']. C ( 'PWD_SALA' ) );
        $sqlMap['month_income']    = $param['month_income'];
        $sqlMap['education']       = $param['education'];

        $sqlMap['create_time']   = $sqlMap['last_login_time'] = time ();
        $sqlMap['last_login_ip'] = $sqlMap['regip']           = get_client_ip ();

        $parent_id = cookie('yq');
        if ($parent_id > 0) {
            $re2 = $this->where("id=".$parent_id)->count();
            if ($re2) {
                $sqlMap['parent_id'] = $parent_id;
            }
        }

        $openid = cookie("regopenid");
        $wxinfo = S("reginfo".$openid);
        if ($wxinfo) {
            $sqlMap = array_merge($sqlMap,$wxinfo);
            S("reginfo".$openid,null);
        }

        $res = $this->add($sqlMap);

        if($res) {//更新副表数据和头像
            $pro = [];
            $pro['uid']      = $res;
            $pro['height']   = $param['height'];
            $pro['code4']    = $param['code4'];
            $pro['birthday'] = $param['birthday'];
            $pro['weixin']   = $param['weixin'];

            $arr = array('mob'=>'hot','qq'=>'hot','weixin'=>'hot');
            $pro['lxfs_config'] = serialize($arr);

            $sqlMap = [];
            $sqlMap['user_number'] = $this->getUserNumber($res,$param['sex']);

            $this->where(['id' => $res])->save($sqlMap);

            M("User_profile")->add($pro);
            //上传用户头像
            $u_check = A('Ajax')->uploadAvatar($res,$param['image'],$param['thumb_image']);
            if ($u_check) {
                //更新等级名称
                upgrade_level($res);
            }
            return $res;
        }
        return false;
    }
	
	
	
	
	//上传照片
	public function upPhoto($uid=0,$title="",$phototype=0,$uploadfiles=array(),$thumbfiles=array()){
		if(!$uploadfiles) return false;
		$flag = C('photo_flag')>0?0:1;
		$time = time();
		foreach ($uploadfiles as $k => $v){			
			$data[] = array('uid'=>$uid,'title'=>$title,'uploadfiles'=>$v,'thumbfiles'=>$thumbfiles[$k],'timeline'=>$time,'phototype'=>$phototype,'flag'=>$flag,'idmd5'=>md5($thumbfiles[$k]));			
		}
    	//$data =array('uid'=>$uid,'title'=>$title,'title'=>I('post.title','','trim'),'title'=>I('post.title','','trim'),'title'=>I('post.title','','trim'));
		return  M('UserPhoto')->addAll($data);
	
	}
	//更改发放佣金字段
	public function savePhotoMoney($num,$uid){
		$mod = M('UserPhoto');
		$photoids  = $mod->where("uid ='".$uid."'")->order('photoid desc')->limit($num)->getField('photoid',true);
		//$sql = "select photoid from ".$mod->trueTableName." where uid ='".$uid."' order by photoid desc limit 0,".$num;
		$photoids = count($photoids)>1?implode(',', $photoids):$photoids[0];
		return $mod ->where('photoid in('.$photoids.')')->setField('payMoney',1);
	
	}
    /**
     * 设置用户的编码
     * @param int $id 用户ID
     * @param int $sex 用户性别
     * @return string
     * @author：Enthusiasm
     * @date：2020/2/1
     * @time：21:50
     */
    public function getUserNumber($id = 0,$sex)
    {
        if (!$id) return false;
        //A为男性 B为女性
        $num = ($sex == 1 ? 'B' : 'A');
        $num = $num.$id;
        return $num;
    }

    public function getError()
    {
        return $this->error;
    }
}

?>