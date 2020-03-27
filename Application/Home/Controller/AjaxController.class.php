<?php

namespace Home\Controller;

use Home\Controller\SiteController;

	/**

	*  @author 玖芯科技

	 * https://www.ninexin.com

	 * 石家庄玖芯信息技术有限公司

	 */





class AjaxController extends SiteController {

	

	public function getvcodebymob(){

		

		$mob = I("post.mob");
        //登录的类型  message短信登录  account账号登录
        $login_type = I("post.login_type");

		/*if(!$this->CheckCaptcha()){

			 $this->ajaxReturn(array('status'=>-1,'msg'=>"请输入正确的验证码！"));

		}*/


		$type = I('post.type',0,'intval');//接收类型   用于判断是    注册时  的还是   修改密码	

		if($type == 1){	//忘记密码  和修改密码    需要对手机号进行处理		

			$res = M('Users') -> where('user_login = '.$mob) -> find();

			if(!$res){

				$data = array('status'=>-1,'msg'=>"输入的手机号尚未注册！");

				$this->ajaxReturn($data);

				exit;

			}

		}
        //获取短信登录的验证码
		if ($login_type == 'message'){

		    if (!is_mobile($mob)) {
		        $this->error('手机号码格式错误');
            }

            $user_info = D('Users')->where(array('user_login' => $mob))->find();

		    if (!$user_info) {
		        $this->error('该手机号码没有注册！');
            }

		    $start_time = date('Y-m-d',time()).'00:00:00';
		    $end_time   = date('Y-m-d',time()).'23:59:59';

            $where = array();
            $where['input_time'] = array('between',strtotime($start_time).','.strtotime($end_time));
            $where['phone']      = $mob;
            $where['status']     = 1;

            $count = D('SmsLog')->where($where)->count();

            if ($count > 5) {
                $this->error('今日获取短信次数已用完，请明日再试');
            }

            $res = send_sms(3,$mob);

            if ($res) {
                $this->success('获取成功');
            } else {
                $this->error('获取失败');
            }

        }



		if(!cookie("lxphpcode")){

			$data = array('status'=>-1,'msg'=>"输入的手机有误！");

			 $this->ajaxReturn($data);

			 exit;

		}		

		$code = rand(111111,999999);

		$re = $this->send_mobcode($mob,$code);

		if($re===true){

			$data = array('status'=>1,'msg'=>'success');

		}else{

			$data = array('status'=>-1,'msg'=>"短信接口:".$re);

		}

		$this->ajaxReturn($data);

	}	

		

	public function CheckCaptcha($captcha){

		$captcha = I('post.captcha','','trim');//接收图文验证码	

		$type = I('post.type',0,'intval');//接收类型   用于判断是    注册时  的还是   修改密码 		

	    /*if($type == 1){	//忘记密码  和修改密码    需要对手机号进行处理

			//if( C() ==  ){  //后期开关								

				if(!$this->check_verify($captcha)){   //如果验证码不正确

					return false;

				}

				//return true;				

			//}							

		}*/

		return true;

	}

	

	

	public function reg(){

		$mob = I("post.mob",'','trim');

		$sex = I("post.sex",'','intval');

		$age = I("post.age",'','intval');

		//if(!$sex) $this->error('性别未填');

		if(!$mob) $this->error('手机号必填');

		if(!$this->isTel($mob)) $this->error('请输入正确手机号');

		//$openid = cookie("regopenid");

		//$wxinfo = S("reginfo".$openid);	

		$openid = cookie("regopenid");
		//$mob='13'.rand(100,999).rand(100000,999999);
		if(iswx()&&cookie("regopenid")&&S("reginfo".cookie("regopenid"))){

			$pass = substr($mob,5);

			$sendpass = $pass;

		}else{

			$pass = I("post.pass",'','trim');

			if(!$pass) $this->error('密码必填');

			if(S($mob)!=I("post.yzm")) $this->error("手机验证码错误！");  //上线后开启验证码

		}

		$this->success('SUCCESS',U('Public/setInformation',['mob' => $mob,'pass' => $pass,'yzm' => I("post.yzm")]));

		//if(!$age) $this->error('年龄必填');

		$uid = D("Users")->reg($mob,$pass,$sex,$age);

		if($uid){

			/*if($sendpass&&$openid) A("Home/Weixin")->makeTextbygm('恭喜您注册成功。

您的账号为：'.$mob.'

您的密码为手机号后6位：'.$pass.'

您可以使用此账号密码在微信外登录。',$openid);*/

			$re = M("Users")->find($uid);

			if($re['parent_id']>0){//上级奖励操作

			$ip = get_client_ip();

				$this->changejifen(C('gz_jifen'),5,'邀请好友'.$re['user_nicename'].'获得',$re['parent_id'],1,$uid,$ip);

				$this->send_parent_money($re['parent_id'],$re);

			}

			$this->changemoney($uid,C('reg_send'),5,'注册奖励','','',1,$ip,0,1);

			A("Public")->loginbyname($re,0);

			$field = $sex==1?array('manUser'=>1,'manUserDay'=>1):array('girlUser'=>1,'girlUserDay'=>1);			

			$this->setSystemTj($field);

			cookie('renwu'.$uid,1,86400*30);

			$this->success($uid);

		}		

		else{

			$this->error("注册失败,请确认此号是否已经注册过！".$uid);

		}

		

	}
    /**
     * 设置用户信息
     * @return array | bool
     * @author：Enthusiasm
     * @date：2020/2/18
     * @time：13:52
     */
    public function setUserInformation()
    {
        if (IS_POST) {
            $param = I('post.');
            $res   = D("Users")->reg($param);
            if (!$res) {
                $msg = D('Users')->getError() ? D('Users')->getError() :  '注册失败，请稍后再试';
                $this->error($msg);
            } else {
                $uid = $res;
                $re  = M("Users")->find($res);

                if ($re['parent_id'] > 0) {//上级奖励操作
                    $ip = get_client_ip();
                    $this->changejifen(C('gz_jifen'),5,'邀请好友'.$re['user_nicename'].'获得',$re['parent_id'],1,$uid,$ip);
                    $this->send_parent_money($re['parent_id'],$re);
                }

                $this->changemoney($uid,C('reg_send'),5,'注册奖励','','',1,$ip,0,1);

                A("Public")->loginbyname($re,0);

                $field = $param['sex'] == 1 ? array('manUser'=>1,'manUserDay'=>1) : array('girlUser'=>1,'girlUserDay'=>1);

                $this->setSystemTj($field);

                cookie('renwu'.$uid,1,86400*30);

                $this->success('SUCCESS');
            }
        }
	}
    /**
     * 设置用户头像
     * @param int $userid 用户ID
     * @param string $image
     * @param string $thumb_image 缩略图
     * @return bool
     * @author：Enthusiasm
     * @date：2020/2/18
     * @time：13:52
     */
    public function uploadAvatar($userid = 0,$image = '',$thumb_image = '')
    {
        $uid = (int)$userid;

        if ($uid < 1)  {
            return false;
        }
        if(!$image || !$thumb_image) {
            return false;
        }

        $imageArr[] = $image; $thumb_imageArr[] = $thumb_image;

        $lastId = D('Users')->upPhoto($uid,"我上传了新的头像照片~",0,$imageArr,$thumb_imageArr);

        if ($lastId) {
            if (C('photo_flag')!=1) {
                $this->tongji($uid, 'photonum',1);
            } else {
                $this->setSystemTj('photoFlag',1);
            }
        } else {
            return false;
        }

        $ext       = explode('.',$image);
        $file_path = ROOT_PATH.'Uploads/avatar/';

        if (!is_dir($file_path)) {
            mkdir($file_path,0777);
        }

        $file_name = '/Uploads/avatar/'.$uid.'_'.time().'.'.$ext[1];

        $copy_file = ROOT_PATH.$image;
        $copy_path = $file_path.$uid.'_'.time().'.'.$ext[1];
        //固定尺寸缩放图片
        $tool = new \Think\Image();
        $tool->open($copy_file);
        $tool->thumb(363, 363,6)->save($copy_path);

        if (C('avatar_flag') > 0) {

            $Auditmod = M('Audit');

            $AudiData = $Auditmod->field('id,status')->where('uid = '.$uid.' and type = 0')->find();
            $oid      = $AudiData['id'];

            if ($oid) {
                $name ='save';
                $arr  = array('id'=>$oid,'created_time'=>time(),'text'=> $file_name,'status'=>0,'photoid'=>$lastId);
            } else {
                $name ='add';
                $arr = array('uid'=>$uid,'created_time'=>time(),'text'=> $file_name,'type'=>0,'status'=>0,'photoid'=>$lastId);

            }

            $re = $Auditmod->$name($arr);

            if ($re) {
                if($name =='add' || (isset($AudiData['status']) && $AudiData['status'] >= 1)){
                    $this->setSystemTj('avatarFlag',1);
                }
            }
        } else {
            $model = M('UserPhoto');
            $re    = M('Users')->where('id='.$uid)->setField('avatar',$file_name);

            if ($re) {
                $model -> where('uid ='.$uid.' and isavatr = 1')->setField('isavatr',0);
                $model -> where('photoid ='.$lastId)->setField('isavatr',1);
            }
        }

        if ($re) {
            $this->newbchange($uid,1);
            return true;
        }

        return false;
    }
    /**
     * 用户登录
     * @return array
     * @author：Enthusiasm
     * @date：2020/2/1
     * @time：18:08
     */
	public function login(){

		$mob = I("post.mob",'','trim');

		$pass = I("post.pass",'','trim');

		$login_type = I("post.login_type");

		$w['user_login']=$mob;
        //用户昵称
        $w['user_number'] = $mob;
		//或者查询
        $w['_logic'] = 'or';

		$temp = S("logtimes".$mob);

		$temp = $temp?$temp:0;

		$temp++;

		S("logtimes".$mob,$temp,86400);

		//if($temp>=20) $this->error("今日登陆请求超过20次，已被禁止登陆，请明日再试。");
        //检查用户输入的手机号码或者昵称是否存在
		$re = M("Users")->where($w)->find();

		if($re){
            //当是短信登录的时候
            if ($login_type == 'message') {
                if (empty($pass)) {
                    $this->error('请输入短信验证码');
                }
                //检查验证码是否正确
                $where = array();
                $where['phone']  = $re['user_login'];
                $where['code']   = $pass;
                $where['status'] = 1;

                $sms_info = D('SmsLog')->where($where)->find();
                if ($sms_info) {
                    //检查验证码是否过期
                    $interval_time = (time() - $sms_info['input_time']) / 60;
                    if ($interval_time > 10) {
                        $this->error('验证码已过期,请重新获取');
                    }
                } else {
                    $this->error('验证码错误');
                }

            } else {
                $user_login =  $re['user_login'];
                //密码登录的时候
                if ($re['user_pass'] != md5 ( $user_login . $pass . C ( 'PWD_SALA' ) )){
                    $this->error("登录失败，请检查您的账户和密码是否正确！");
                }

            }

            cookie('renwu'.$re['id'],1,86400*30);

            A("Public")->loginbyname($re,0);

            $this->success("ok");


		}else{

			$this->error("登录失败，请检查您的账户是否正确！");

		}

	}

	

	

	/**

	* 定位地区

	* 20160505

	* 紫竹

*/

	public function area(){

		$lat = I("post.lat",'','trim');

		$lon = I("post.lon",'','trim');

		$uid = $this->uinfo['id'];
		
		
		if($uid){				

			$data['uid']=$uid;

			$data['lon']=$lon;

			$data['lat']=$lat;

			$data['addtime']=time();

			$re = A("Api2")->getarea($lat,$lon);			

			if($re){

			$User_area = M("User_area");	

			$data['provincename']=str_replace('省','',$re['result']['addressComponent']['province']);

			$data['provincename']=str_replace('市','',$data['provincename']);

			$data['cityname']=str_replace('市','',$re['result']['addressComponent']['city']);			

			$data['district']=str_replace('区','',$re['result']['addressComponent']['district']);

			$data['provinceid'] = $data2['provinceid']=$this->get_areaid_byname($data['provincename']);

			if($data['provincename']==$data['cityname']){

				$data['cityname']=$data['district'];				

			}		

			$data['cityid'] = $data2['cityid'] =$this->get_areaid_byname($data['cityname']);

			if($User_area->where("uid=".$uid)->find()){

				$User_area->where("uid=".$uid)->save($data);

			}			

			else{

				$re = A("Api2")->bdlbsapi2($lat,$lon);

				if($re>0)$data['lbsid']=$re;

				$User_area->add($data);

			}			

			}

			if(!$this->uinfo['provinceid']&&!$this->uinfo['cityid'])

			M("Users")->where("id=".$uid)->save($data2);		

			

			cookie("dw",1,86400*30);

			cookie("dw_provinceid",$data['provinceid'],86400*30);

			cookie("dw_cityid",$data['cityid'],86400*30);

			cookie("dw_provincename",$data['provincename'],86400*30);

			cookie("dw_cityname",$data['cityname'],86400*30);

			cookie("dw_district",$data['district'],86400*30);
			
	

			//S("lon2",$data);

			$this->success($data);

			exit;

		}

		$this->error("ok");

		

	}

	

	

	/**

	* 关注操作

	*/

	

	public function guanzhu(){		

		$tuid = I("post.touid",'','intval');

		$adminuid = $_SESSION['admin_user']['user_id'];			

		$fromuid = I("post.fromuid",'','intval');

		$status = I("post.status");

        $User_subscribe = M("User_subscribe");

		if ($status == 0) {//取消关注
            if (!$this->uinfo) {
                $this->error('请先登录!');
            }

            $where = [];
            $where['fromuid'] = $this->uinfo['id'];
            $where['touid']   = $tuid;

            $id = $User_subscribe->where($where)->getField('id');
            if (!$id) {
                $this->error('您还没有关注对方');
            }
            //关注人数 -1
            M('UserCount')->where(['uid' => $tuid])->setDec('fansnum');

            $rs = $User_subscribe->delete($id);

            if ($rs) {
                $this->success('SUCCESS');
            }
        } else {

            if($adminuid>0 && $fromuid)//客服接入

                $uid = $fromuid;

            else{

                if($msg = $this->checkbasedata()) $this->error($msg);

                $uid=$this->uinfo['id'];

            }

            if($tuid==$uid)$this->error("自己不能关注自己");

            if($uid&&$tuid){

                $data2['touid']=$data['fromuid']=$uid;

                $data2['fromuid']=$data['touid']=$tuid;

                $re = $User_subscribe->where($data)->find();

                if($re){

                    $this->success("已关注");

                }

                $data['time']=time();

                $re2 = $User_subscribe->add($data);

                if($re2){

                    $re3 = $User_subscribe->where($data2)->find();

                    if($re3){//相互关注

                        $this->changeqinmidu($tuid,$uid,C('qmd_qi'),1,'相互关注',1);

                    }

                    $this->changejifen(C('gz_jifen_nv'),4,'被关注获得',$tuid,0,$uid);

                    $tongji['gznum']=1;

                    $tongji['fansnum']=1;

                    $tongji['wdgznum']=1;

                    $this->tongjiarr($tuid,$tongji);

                    $this->success("已关注",'real');

                }

            }
        }



		$this->error("err");

	}

	

	/**

		* 私信操作

		* @author lxphp

		* 20160505

		* $dzh  =1 打招呼  $kf =1 后台客服

	*/

	public function sendmsg(){		

		$uid = $this->uinfo['id'];

		$tuid = I("post.touid",'','intval');

		$dzh = I("post.dzh",'','intval');		

		$adminuid = $_SESSION['admin_user']['user_id'];

		$fromuid = I("post.fromuid",'','intval');

		$usermod = M("Users");

		$kf=0;

		if($adminuid>0&& $fromuid){//客服接入			

			$uid = $fromuid;

			$kflogid = I("post.kflogid",'','intval');	

			$kfname = I("post.kfname",'','trim');	

			$data['kfname']=$kfname;

			$kf=1;	

			$ismj= $fromuid;	

		}else{

			if($msg = $this->checkbasedata()) $this->error($msg);

		    $user_status = $this->uinfo['user_status']; 

		    if($user_status>time()&&$dzh!=1){

		    	$jyday = ceil(($user_status-time())/86400);

		    	$this->error('您已被禁言'.$jyday.'天！');

		    } 

		}			

		if($tuid==$uid){

			$this->error("自己不能和自己发消息");

		}

		if($uid&&$tuid){

			if($kf!=1 && $dzh!=1 && $this->uinfo['sex']==1){//计费					

				$rec = $this->changemoney($uid,(-1)*C('lt_zc_money'),1,'聊天支出',"lt",'',0,get_client_ip(),$tuid);

				if($rec>=0){

					$this->setUserinfo('money',$rec);

					$this->changemoney($tuid,C('lt_zc_money'),2,'聊天收入',"lt",'',0,get_client_ip(),$uid);

				}else{

					$this->error("请检查您的".C('money_name')."是否充足。",$rec);

				}

			}else{

				$rec = $usermod->where('id='.$uid)->getField('money');

				$this->setUserinfo('money',$rec);

			}	

			$my_message = M("Message");			

			if($dzh==1){	

				$this->check_ltdanum($uid);

				$data['content']= '你好，可以认识你一下吗';

				$data['is_zh']= 1;

				cookie("dzh".$tuid,1,3600);

				$totjarr['wdghnum']=1;		

			}			

			else{

				$data['content']= $this->string_filter(I("post.content",'','trim'));	

			}

			if(!$ismj)

				$ismj = $usermod->where("id=".$tuid.' and ismj>0')->getField('id');

			$data['fromuid']= $uid;

			$data['touid']= $tuid;

			$data['mj']= $ismj?$ismj:0;

			$data['sendtime']= time();

			$data["hash"]=$this->uidgethash($tuid,$uid);						

			$re = $my_message->add($data);
			
			if($dzh!=1){
				$code_reply=M('code_reply');
				$mwhere['code']=array('like','%'.$data['content'].'%');
				$code_reply_arr=$code_reply->where($mwhere)->select();
				if(!$code_reply_arr){
					$code_reply_arr=$code_reply->where(array('code'=>array('eq','')))->select();
					}
				$reply=$code_reply_arr[array_rand($code_reply_arr)];
				if($reply['type']==2){
					$data['type']= 2;
					}else{
					$data['type']= 1;
					}	
				$data['content']=$reply['reply'];
				
				$data['fromuid']= $tuid;

				$data['touid']= $uid;
				
				$my_message->add($data);
			}
			
			if($re){

				if($kflogid){//客服					

					$data2['rpnum']=array('exp','rpnum+1');

					$data2['uptime']=time();

					$data2['lastmsgid']=$re;

					M("Message_kf_log")->where("id=".$kflogid)->save($data2);

				}				

				$ltlogarr = $this->ltlog($uid,$tuid);//log和亲密度计算

				if($ltlogarr['wdltnum']==1)

				$mytjarr['ltrennum']=1;

				$mytjarr['ltmoney']=C('lt_zc_money');

				if($dzh==1) $mytjarr['ltdanum']=1;

				$this->tongjiarr($uid,$mytjarr);				

				$totjarr['wdsxnum']=1;

				$this->tongjiarr($tuid,$totjarr);

				$this->success("ok",$rec);  //$ltlogarr['wdltnum'] 发送几条未回复 

				}			

		}

		$this->error("err");

	}

	

	/**

	* 群打招呼

	* 20160528

	* 

*/

	public function qundzh(){

		$tuid = I("post.touid",'','trim');

		$uid = $this->uinfo['id'];

		$usermod = M("Users");

	    $this->check_ltdanum($uid);

	

		$data['is_zh']= 1;

		$data['fromuid']= $uid;

		$data['touid']= 0;

		$data['sendtime']= time();		

		$idarr = explode(',',$tuid);

		foreach($idarr as $key=>$val){

			$data['content']= '你好，可以认识你一下吗';

			if(cookie("dzh".$val)==1) continue ;

			if($val>0){

			$ismj = $usermod->where("id=".$val)->getField('ismj');	

			$data['touid']=$val;

			$data['mj']=$ismj?$val:0;

			$data["hash"]=$this->uidgethash($data['touid'],$uid);

			cookie("dzh".$val,1,3600);

			$data2[]=$data;

			$ids[]['id']=$val;

			}	

		}

		$my_message = M("Message");

		$re = $my_message->addAll($data2);

		if($re){

			$this->tongji($uid,'ltdanum',count($ids));

			$this->success($ids);

		}

		else

		$this->error('已经打过招呼');

	}

	

	//打招呼是否超限

	private function  check_ltdanum($uid){

		$uinfo = M('Users')->field('user_rank,rank_time')->where('id='.$uid)->find();

		if(!$this->isvip($uinfo)){

			$ltdanum =  M('UserCount')->where('uid='.$uid)->getField('ltdanum');

			$viltda = C('viltda')>0?C('viltda'):100;

			if($ltdanum>=$viltda) $this->ajaxReturn(array('status'=>2,'info'=>'您的打招呼数已超限，购买vip可无限打招呼！','url'=>U('Home/User/VipCenter')));

		}

	}

	

	

	

	/**

	* 拉黑操作 

	* 20160612

	* 

*/

	public function lahei(){

		$uid = $this->uinfo['id'];

		$tuid = I("post.touid",'','intval');

		

		$adminuid = $_SESSION['admin_user']['user_id'];

		$fromuid = I("post.fromuid",'','intval');

		if($adminuid>0&& $fromuid){//客服接入

		$uid = $fromuid;

		}		

		

		if(!$uid||!$tuid) $this->error('err');

		$w['fromuid']=$uid;

		$w['touid']=$tuid;

		$User_lahei = M("User_lahei");

		$re = $User_lahei->where($w)->find();		

		if($re){			

			$lh = $re['status']==1?0:1;

			$re2 = $User_lahei->where($w)->save(array('status'=>$lh,'time'=>time()));			

		}else{

			$w['time']=time();

			$lh = $w['status']=1;

			$re2 = $User_lahei->add($w);

		}		

		$msg = $lh==1?'已拉黑':'拉黑Ta';		

		if($re2){

			$this->success($msg);

		}else{

			$this->error('err');

		}

	}

	

	

	

	/**

	* 聊天log

	* 

*/

	public function ltlog($uid,$tuid){

		$w["hash"]=$this->uidgethash($tuid,$uid);	

		$message_log = M("Message_log");

					$remlog = $message_log->where($w)->find();

					if(!$remlog){

						$data3['fromuid']=$uid;

						$data3['touid']=$tuid;

						$data3['hash']=$w["hash"];

						$data3['log']=1;

						$data3['totallog']=1;

						$data3['time']=time();

						$data3['wdltnum']=1;

						$message_log->add($data3);						

						return array('wdltnum'=>1);

					}else{

						$data3['fromuid']=$uid;

						$data3['touid']=$tuid;	

						if($remlog['log']+1>=C('qmd_lt')){//计算亲密度

							$this->changeqinmidu($uid,$tuid,1,3,"聊天",1);

							$data3['log']=0;

						}else{

							$data3['log']=array('exp','log+1');

						}					

						$data3['totallog']=array('exp','totallog+1');

						if($uid==$remlog['fromuid'])

						$data3['wdltnum']=array('exp','wdltnum+1');

						else

						$data3['wdltnum']=1;

						$data3['uptime']=time();

						$message_log->where($w)->save($data3);						

						return array('wdltnum'=>$remlog['wdltnum']+1,'log'=>$remlog['log']+1);					

					}

	}

	

	

	

	/**

	* 实时获取聊天记录

	* 20160523

*/

	public function get_lt_list(){

		$uid = $this->uinfo['id'];

		$tuid = I("post.touid",'','intval');		

		$adminuid = $_SESSION['admin_user']['user_id'];

		$fromuid = I("post.fromuid",'','intval');

		if($adminuid>0 && $fromuid){//客服接入

		$uid = $fromuid;		

		}

		if(!$uid || !$tuid) $this->error('err');

			$messagemod =  M("Message");	

			$data["touid"]=$uid;

			$data["fromuid"]=$tuid;

			$data["isread"]=0;

		$list =$messagemod->field('msgid,content,type')->where($data)->order("msgid desc")->limit(20)->select();

		if($list){			

			$re = $messagemod->where($data)->setField("isread",1);

			if($re)$this->tongji($uid,'wdsxnum',-1*count($list));

			$this->success($list);

		}		

		else

		$this->error('err');

	}



	

	/**

	 * 地区切换

	 */

	public function ajax_get_city(){

		$provinceid =  I('post.provinceid',0,'intval');

		$city=array();

		if($provinceid){

			$areaList = $this->get_area();

			foreach ($areaList as $v){

				if($v['rootid']==$provinceid){

					$city[] =$v;

				}

				

			}

		}



		$this->ajaxReturn($city);

	}

	

	

	// 用于地域选择   例: 江苏-苏州-吴中

	public function city($id=0){	

		if($data = $this -> get_city($id)){

			$this -> ajaxReturn($data);

		}		

	}

	

	

	/**

	* 照片点赞

	* 

*/

	public function clickzan(){

		$pid =  I('post.pid',0,'trim');

		if(!$pid) $this->error('参数错误');

		$phohomod = M("User_photo");

		$phoarr = $phohomod->where("idmd5='$pid'")->find();

        if(!$phoarr) $this->error('没有查询到相关数据');
		//点赞的是否是自己的作品
        if ($phoarr['uid'] == $this->uinfo['id']) {
            $this->error('自己不能赞自己哟');
        }

        $zan_cnt = M('DianzanLog')->where(['uid' => $this->uinfo['id'],'pid' => $phoarr['idmd5']])->count();
        if ($zan_cnt) {
            $this->error('同一照片只能点赞一次');
        }


        try {
            M()->startTrans();

            $rs     = [];
            $sqlMap = [];

            $sqlMap['uid']   = $this->uinfo['id'];
            $sqlMap['touid'] = $phoarr['uid'];
            $sqlMap['pid']   = $phoarr['idmd5'];
            $sqlMap['input_time']   = time();

            $rs[0] = $phohomod->where(['photoid' => $phoarr['photoid']])->setInc('hits');
            $rs[1] = M('DianzanLog')->add($sqlMap);
            $rs[2] = $this->tongjiarr($phoarr['uid'],['zan' => 1]);

            foreach ($rs as $k => $v) {
                if (!$v) {
                    M()->rollback();
                    $this->error('服务器繁忙，请稍后再试');
                }
            }

            M()->commit();

            $this->success($phoarr['hits'] + 1);

        } catch (\Exception $e) {
            M()->rollback();
            $this->error($e->getMessage());
        }
	}

	/**

	* 人点赞

	* 总赞数+

	* 

*/

	public function clickzanren(){

			$uid = I('post.uid',0,'trim');

			$uuid = M("Users")->where("idmd5='$uid'")->getField('id');

			if(cookie('uidzan'.$uid))

			$this->error('ok');

			$re = $this->tongji($uuid,'zan',1);

			if(cookie('uidzan'.$uid,1,3600));

			$this->success($re);

	}

	

	/**

	 * 评论点赞

	 */

	public function commentZan(){

		$cid =  I('post.cid',0,'intval');

		if(!$cid) $this->error('系统繁忙,请稍候再试!');

		$mod = M("Comment");

		$phoarr = $mod->where("id='$cid'")->find();

		if(cookie('cidzan'.$cid))

			$this->success($phoarr['zan']);

		if(!$phoarr) $this->error('系统繁忙,请稍候再试!');

		$re = $mod->where("id='$cid'")->setInc('zan');

		if($re){

			cookie('cidzan'.$cid,1,3600);

			$this->tongji($phoarr['uid'],'comment',1);

			$this->success($phoarr['zan']+1);

		}

		else

			$this->error('系统繁忙,请稍候再试!');

	}

	

	/**

	 * 举报

	 * 

	 */	

	public function Report(){

		

		$data['fromuid'] = $this -> uinfo['id'];

				

		$data['touid'] = I('post.touid',0,'intval');

		$data['type'] = I('post.type','');

		$data['jbdesc'] = I('post.jbdesc','','trim');

		$data['time'] = time();

		

		$model = M("ExtJubao");

		$result = $model -> where('fromuid ='.$data['fromuid'].' and touid ='.$data['touid']) -> find();

		if($result){

			$this -> ajaxReturn("您已经举报过该用户了");

		}

				

		$res = $model -> add($data);

		if($res){

			$this -> ajaxReturn("举报成功，感谢您的参与");

		}else{

			$this -> ajaxReturn("系统繁忙，请稍后再试");

		}

	}
    /**
     * 获取文章或者线下活动数据
     * @param int $page 当前页数
     * @param int $limit 显示的数据条数
     * @param int $type 【1】情感文章 【2】线下活动
     * @return array
     * @author：Enthusiasm
     * @date：2020/2/5
     * @time：12:31
     */
    public function getArticleLists()
    {
        $res = array();

        if (IS_POST) {

            $page   = I('page',1);
            $limit  = I('limit',10);
            $type   = I('type');
            $action = I('action','');

            $order_by = 'id desc';

            if ($action == 'now') { //获取最新数据

                $where = [];
                $where['type'] = 1;
                $where['input_time'] = array('egt',time());

                $lists = D('Admin/Article')->where($where)->order($order_by)->select();

                foreach($lists as $k => $v) {
                    foreach ($v as $kk => $vv) {
                        if ($kk == 'content') {
                            $lists[$k][$kk] = strip_tags(htmlspecialchars_decode($vv));
                        }
                    }
                }

                $res['status'] = 1;
                $res['lists']  = !empty($lists) ? $lists : [];

                return $this->ajaxReturn($res);
            }

            $cnt = D('Admin/Article')->where(array('type' => $type))->count();

            $pages = ceil($cnt/$limit);

            $lists = D('Admin/Article')->where(array('type' => $type))->order($order_by)->page($page,$limit)->select();

            foreach ($lists as $k => $v) {
                foreach ($v as $kk => $vv) {
                   if ($kk == 'input_time' || $kk == 'update_time') {
                       $lists[$k][$kk] = timeFormat($vv);
                   }
                   if ($kk == 'content') {
                       $lists[$k][$kk] =  strip_tags(htmlspecialchars_decode($vv));
                   }
                   if ($kk == 'read_num' && $vv > 999) {
                       $lists[$k][$kk] = '999+';
                   }
                }
            }

            $res['status'] = 1;
            $res['lists']  = !empty($lists) ? $lists : [];
            $res['hasNextPage'] = ($page > $pages) ? false : true;

            $this->ajaxReturn($res);

        } else {

            $res['status'] = 0;
            $res['lists']  = [];
            $res['hasNextPage'] = false;

            $this->ajaxReturn($res);
        }
	}
    /**
     * 获取会员列表
     * @param int $page 当前页数
     * @param int $limit 显示的数据条数
     * @param string $time 获取最新数据的时候用到
     * @param array $param 查询参数
     * @return array
     * @author：Enthusiasm
     * @date：2020/2/5
     * @time：12:31
     */
    public function getUserLists()
    {
        $res = array();

        if (IS_POST) {

            $page   = I('page',1);
            $limit  = I('limit',12);
            $time   = I('time');
            $param  = I('post.');

            $where  = A('Index')->getSearchWhere($param);

            $order_by = 'type desc,last_login_time desc,id desc';
            //地区名称
            $areaList = $this->get_area();
            if ($time == 'now') { //获取最新数据

                $where['u.update_time'] = array('egt',time());

                $lists = M('Users')
                          ->alias('u')
                          ->join('lx_user_profile p on p.uid = u.id')
                          ->where($where)
                          ->order($order_by)
                          ->field('p.real_name,provinceid,age,cityid,idmd5,avatar,sex,user_number')
                          ->page($page,$limit)
                          ->select();

                foreach ($lists as $k => $v) {
                    $lists[$k]['show_url']     = U("Show/index", array("uid" => $v['idmd5']));
                    $lists[$k]['avatar']       = !empty($v['avatar']) ? $v['avatar'] : '/Public/img/mrtx.jpg';
                    $lists[$k]['real_name']    = !empty($v['real_name']) ? $v['real_name'] : '姓名未填';

                    $lists[$k]['sex'] = $v['sex'] == 1 ? '男' : '女';

                    $lists[$k]['province_name'] = $areaList[$v['provinceid']]['areaname'] ? $areaList[$v['cityid']]['areaname'] : '';
                    $lists[$k]['city_name']     = $areaList[$v['cityid']]['areaname'] ? $areaList[$v['cityid']]['areaname'] : '地区未填';
                    $lists[$k]['age']           = date('Y',time()) - $v['age'];
                }

                $res['status'] = 1;
                $res['lists']  = !empty($lists) ? $lists : [];

                $this->ajaxReturn($res);
            }

            $cnt = M('Users')
                    ->alias('u')
                    ->join('lx_user_profile p on p.uid = u.id')
                    ->where($where)
                    ->count();

            $pages = ceil($cnt/$limit);

            $lists = M('Users')
                        ->alias('u')
                        ->join('lx_user_profile p on p.uid = u.id')
                        ->where($where)
                        ->field('p.real_name,provinceid,age,cityid,idmd5,avatar,sex,user_number')
                        ->order($order_by)
                        ->page($page,$limit)
                        ->select();

            foreach ($lists as $k => $v) {
                $lists[$k]['show_url']     = U("Show/index", array("uid" => $v['idmd5']));
                $lists[$k]['avatar']       = !empty($v['avatar']) ? $v['avatar'] : '/Public/img/mrtx.jpg';
                $lists[$k]['real_name']    = !empty($v['real_name']) ? $v['real_name'] : '姓名未填';

                $lists[$k]['sex'] = $v['sex'] == 1 ? '男' : '女';

                $lists[$k]['province_name'] = $areaList[$v['provinceid']]['areaname'] ? $areaList[$v['cityid']]['areaname'] : '';
                $lists[$k]['city_name']     = $areaList[$v['cityid']]['areaname'] ? $areaList[$v['cityid']]['areaname'] : '地区未填';
                $lists[$k]['age']           = date('Y',time()) - $v['age'];
            }

            $res['status'] = 1;
            $res['lists']  = !empty($lists) ? $lists : [];
            $res['hasNextPage'] = ($page > $pages) ? false : true;

            $this->ajaxReturn($res);

        } else {

            $res['status'] = 0;
            $res['lists']  = [];
            $res['hasNextPage'] = false;

            $this->ajaxReturn($res);
        }
    }
    /**
     * 获取点赞列表数据
     * @param int $page 当前页数
     * @param int $limit 显示的数据条数
     * @param string $time 获取最新数据的时候用到
     * @param array $param 查询参数
     * @return array
     * @author：Enthusiasm
     * @date：2020/2/5
     * @time：12:31
     */
    public function getDianzanLists()
    {
        $res = array();

        if (IS_POST) {

            $page   = I('page',1);
            $limit  = I('limit',10);
            $type   = I('type',1,'intval');
            $time   = I('time');
            $where  = [];

            $_fields  = $type == 1 ? 'z.touid' : 'z.uid';

            if ($type == 1) {
                $where['z.uid']   = $this->uinfo['id'];
            } else {
                $where['z.touid'] = $this->uinfo['id'];
            }
            //地区名称
            $areaList = $this->get_area();

            if ($time == 'now') { //获取最新数据

                $where['z.input_time'] = array('egt',time());

                $lists = M('DianzanLog')
                        ->alias('z')
                        ->join('lx_users u on u.id = '.$_fields)
                        ->join('lx_user_profile p on p.uid = u.id')
                        ->join('lx_user_count c on p.uid = c.uid')
                        ->where($where)
                        ->field($_fields.','.'u.avatar,u.id,u.rank_time,u.user_number,u.sex,u.age,u.idmd5,u.provinceid,u.cityid,p.monolog,p.real_name,z.input_time,c.zan')
                        ->group($_fields)
                        ->page($page,$limit)
                        ->select();

                foreach ($lists as $k => $v) {
                    $lists[$k]['province_name'] = $areaList[$v['provinceid']]['areaname'] ? $areaList[$v['provinceid']]['areaname'] : '地区未填';
                    $lists[$k]['city_name']     = $areaList[$v['cityid']]['areaname'] ? $areaList[$v['cityid']]['areaname'] : '';
                    $lists[$k]['input_time']    = date('Y-m-d H:i:s',$v['input_time']);
                    $lists[$k]['age']           = date('Y',time()) - $v['age'];
                    $lists[$k]['real_name']     = mb_strlen($v['real_name']) > 5 ? (substr($v['real_name'],0,5).'...') : $v['real_name'];
                }

                $res['status'] = 1;
                $res['lists']  = !empty($lists) ? $lists : [];

                $this->ajaxReturn($res);
            }

            $cnt = M('DianzanLog')
                    ->alias('z')
                    ->where($where)
                    ->group($_fields)
                    ->select();

            $pages = ceil(count($cnt) / $limit);

            $lists = M('DianzanLog')
                ->alias('z')
                ->join('lx_users u on u.id = '.$_fields)
                ->join('lx_user_profile p on p.uid = u.id')
                ->join('lx_user_count c on p.uid = c.uid')
                ->where($where)
                ->field($_fields.','.'u.avatar,u.id,u.rank_time,u.user_number,u.sex,u.age,u.idmd5,u.provinceid,u.cityid,p.monolog,p.real_name,z.input_time,c.zan')
                ->group($_fields)
                ->page(1,1)
                ->select();

            foreach ($lists as $k => $v) {
                $lists[$k]['province_name'] = $areaList[$v['provinceid']]['areaname'] ? $areaList[$v['provinceid']]['areaname'] : '地区未填';
                $lists[$k]['city_name']     = $areaList[$v['cityid']]['areaname'] ? $areaList[$v['cityid']]['areaname'] : '';
                $lists[$k]['input_time']    = date('Y-m-d H:i:s',$v['input_time']);
                $lists[$k]['age']           = date('Y',time()) - $v['age'];
                $lists[$k]['real_name']     = mb_strlen($v['real_name']) > 5 ? (substr($v['real_name'],0,5).'...') : $v['real_name'];
            }

            $res['status'] = 1;
            $res['lists']  = !empty($lists) ? $lists : [];
            $res['hasNextPage'] = ($page > $pages) ? false : true;

            $this->ajaxReturn($res);

        } else {

            $res['status'] = 0;
            $res['lists']  = [];
            $res['hasNextPage'] = false;

            $this->ajaxReturn($res);
        }
    }
    /**
     * 获取查询的条件
     * @param array $param 传递的参数
     * @return array
     * @author：Enthusiasm
     * @date：2020/2/24
     * @time：15:36
     */
    public function getUserWhere($param = [])
    {
        $where = [];

        //身高
        if (!empty($param['height'])) {
            switch ($param['height']) {
                case 1:
                    $where['p.height'] = ['between','130,140'];
                    break;
                case 2:
                    $where['p.height'] = ['between','141,150'];
                    break;
                case 3:
                    $where['p.height'] = ['between','151,160'];
                    break;
                case 4:
                    $where['p.height'] = ['between','161,170'];
                    break;
                case 5:
                    $where['p.height'] = ['between','171,180'];
                    break;
                case 6:
                    $where['p.height'] = ['between','181,190'];
                    break;
                case 7:
                    $where['p.height'] = ['gt',190];
                    break;
            }

        }
        //年龄
        if (!empty($param['age'])) {

            $s = date('Y',time());

            switch ($param['age']) {
                case 1:
                    $where['_string'] = "age <= ".($s - 17)." and age >= ".($s-25);
                    break;
                case 2:
                    $where['_string'] = "age <= ".($s - 26)." and age >= ".($s-30);
                    break;
                case 3:
                    $where['_string'] = "age <= ".($s - 31)." and age >= ".($s-35);
                    break;
                case 4:
                    $where['_string'] = "age <= ".($s - 36)." and age > ".($s-40);
                    break;
                case 5:
                    $where['_string'] = "age <= ".($s - 41)." and age > ".($s-45);
                    break;
                case 6:
                    $where['_string'] = "age <= ".($s - 46)." and age >= ".($s-50);
                    break;
                case 7:
                    $where['age'] = array('lt',$s - 50);
                    break;
            }
        }
        //用户手机号或ID
        if (!empty($param['keyword'])) {
            $keyword = trim($param['keyword']);
            $where['u.user_login'] = $keyword;
            $where['u.id']         = $keyword;
            $where['_logic']       = 'OR';
        }
        //学历
        if (!empty($param['edu'])) {
            $where['u.education'] = (int)$param['edu'];
        }
        //婚姻状况
        if (!empty($param['love'])) {
            $where['p.code4'] = (int)$param['love'];
        }
        //筛选地区
        if (!empty($param['place'])) {
            $where['u.provinceid'] = (int)$param['place'];
        }
        if (!empty($param['city'])) {
            $where['u.cityid'] = (int)$param['city'];
        }
        if (!empty($param['sex'])) {
            $where['u.sex'] = (int)$param['sex'];
        }

        return $where;
    }
    /**
     * 增加文章阅读人数
     * @return void
     * @author：Enthusiasm
     * @date：2020/2/7
     * @time：20:14
     */
    public function setArticleRead()
    {
        $id = (int)I('post.id');

        M('Article')->where('id ='.$id)->setInc('read_num',1);

        $this->success('操作成功');
    }

	public function ggisread(){

		$id = I("post.id",'','intval');

		if($id)

		cookie('gg',$id,86400*30);

	}

		

	public function sixinaclear(){

		$uid =  $this -> uinfo['id'];

		M('User_count')->where("uid=".$uid)->setField('wdsxnum',0);

		cookie('wdsxnum',0,3600);

	}

	

	public function newrw(){

		$uid =  $this -> uinfo['id'];

		cookie('renwu'.$uid,0,10);

		cookie('newberenwu'.$uid,1,86400*365);

	}
    /**
     * 绑定微信
     * @return void
     * @author：Enthusiasm
     * @date：2020/3/1
     * @time：13:58
     */
    public function wechat_bind()
    {
        if (IS_POST) {
            $param  = I('post.');
            $status = I('post.status',1,'intval');

            if (!$this->uinfo) {
                $this->error('请先登录');
            }
            if ($status && empty($param['openid'])) {
                $this->error('参数错误');
            }
            $where = [];
            $where['userid']      = $this->uinfo['id'];
            $where['type']        = 'wechat';
            $where['bind_status'] = 1;

            $check = D('Home/UserOauth')->where($where)->find();

            if (!$status && !$check) {
                $this->error('您还未绑定微信，请先绑定');
            }
            if ($status && $check) {
                $this->error('您已绑定过微信，请先解除绑定');
            }

            $_method = $status ? 'add' : 'save';
            $sqlMap  = [];
            $res     = [];

            if ($status == 1) {//绑定微信
                $sqlMap['type']        = 'wechat';
                $sqlMap['userid']      = $this->uinfo['id'];
                $sqlMap['openid']      = $param['openid'];
                $sqlMap['nickname']    = $param['nickname'];
                $sqlMap['sex']         = $param['sex'];
                $sqlMap['province']    = $param['province'];
                $sqlMap['city']        = $param['city'];
                $sqlMap['country']     = $param['country'];
                $sqlMap['headimgurl']  = $param['headimgurl'];
                $sqlMap['unionid']     = $param['unionid'];
                $sqlMap['bind_time']   = time();
                $sqlMap['bind_status'] = 1;
            } else {
                $sqlMap['id'] = $check['id'];
                $sqlMap['bind_status'] = -1; //取消绑定
            }

            $openID  = $status ? $param['openid'] : '';
            $suc_msg = $status ? '绑定成功' : '解绑成功';
            $err_msg = $status ? '绑定失败' : '解绑失败';

            try {
                M()->startTrans();

                $res[1] = M('Users')->where(['id' => $this->uinfo['id']])->save(['weixin' => $openID]);
                $res[2] = M('UserOauth')->$_method($sqlMap);
                foreach ($res as $v) {
                    if (!$v) {
                        M()->rollback();
                        $this->error($err_msg);
                    }
                }

                M()->commit();
                $this->success($suc_msg);
            } catch (\Exception $e) {
                M()->rollback();
                $this->error($err_msg.':'.$e->getMessage());
            }
        }
    }
    /**
     * 阅读使用条款和注册协议
     * @return void
     * @author：Enthusiasm
     * @date：2020/3/1
     * @time：13:58
     */
    public function agreement()
    {
        $status = I('status',0);

        cookie('agreement',$status);
        $this->success('SUCCESS');
    }
    /**
     * 修改手机号码
     * @return void
     * @author：Enthusiasm
     * @date：2020/3/1
     * @time：13:58
     */
    public function editPhone()
    {
        if (IS_POST) {
            $action = I('action');
            $param  = I('post.');

            if ($action == 'get_yzm') { //获取验证码

                $phone = $this->uinfo['user_login'];
                $type  = 1;
                if ($param['type'] == 'new_phone') {
                    $phone = $param['phone'];
                    $type  = 5;
                }

                $check_status = D('SmsLog')->checkSendStatus($phone,$type);
                if (!$check_status) {
                    $this->error(D('SmsLog')->getError());
                }

                $res = send_sms(5,$phone);
                if ($res) {
                    $this->success('发送成功');
                } else {
                    $this->error('发送失败');
                }

            } else if ($action == 'check_yzm') {
                $yzm = $param['yzm'];
                if (!$yzm) $this->error('请填写验证码');
                if (empty($param['pwd'])) $this->error('请填写登录密码');
                //检查登录密码
                $sign = M('Users')->where(['id' => $this->uinfo['id']])->getField('user_pass');
                $pwd  = md5($this->uinfo['user_login'].$param['pwd'].C ('PWD_SALA'));
                if ($pwd != $sign) {
                    $this->error('登录密码错误');
                }
                //检查验证码
                $res = D('SmsLog')->checkYzm($this->uinfo['user_login'],$yzm,5);
                if (!$res) {
                    $this->error(D('SmsLog')->getError());
                }

                //返回用户的登录密码用于下一步新手机号码的加密
                $this->success($param['pwd']);

            } else if ($action == 'edit') {

                if (!$param['phone'] || !is_mobile($param['phone'])) $this->error('请填写有效的手机号码');
                if (!$param['yzm']) $this->error('请填写验证码');
                if (empty($param['pwd'])) $this->error('请填写登录密码');

                $check_yzm = D('SmsLog')->checkYzm($param['phone'],$param['yzm'],5);
                if (!$check_yzm) {
                    $this->error(D('SmsLog')->getError());
                }

                $check_phone = M('Users')->where(['user_login' => $param['phone']])->count();
                if ($check_phone) {
                    $this->error('此手机号码已被注册');
                }
                //检查登录密码
                $sign = M('Users')->where(['id' => $this->uinfo['id']])->getField('user_pass');
                $pwd  = md5($this->uinfo['user_login'].$param['pwd'].C ('PWD_SALA'));
                if ($pwd != $sign) {
                    $this->error('登录密码错误');
                }

                $sqlMap = [];
                $sqlMap['user_login'] = $param['phone'];
                //重新生成密码
                $sqlMap['user_pass']  = md5($param['phone'].$param['pwd'].C ('PWD_SALA'));

                $res = M('Users')->where(['user_login' => $this->uinfo['user_login']])->save($sqlMap);
                if ($res) {
                    //写入日志
                    writeSystemLog('用户修改了手机号码',$this->uinfo['id']);
                    //更新用户缓存
                    $this->setUserinfo('user_login',$param['phone']);
                    $this->success('修改成功');
                } else {
                    $this->error('修改失败');
                }
            }
        }
    }
}

