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

		$code = rand(1111,9999);

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

		if(!$sex) $this->error('性别未填');

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

		if(!$age) $this->error('年龄必填');

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

			$this->success("ok");

		}		

		else{

			$this->error("注册失败,请确认此号是否已经注册过！".$uid);

		}

		

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
        $w['user_nicename'] = $mob;
		//或者查询
        $w['_logic'] = 'or';

		$temp = S("logtimes".$mob);

		$temp = $temp?$temp:0;

		$temp++;

		S("logtimes".$mob,$temp,86400);

		if($temp>=20) $this->error("今日登陆请求超过20次，已被禁止登陆，请明日再试。");
        //检查用户输入的手机号码或者昵称是否存在
		$re = M("Users")->where($w)->find();

		if($re){
            //当是短信登录的时候
            if ($login_type == 'message') {
                if (empty($pass)) {
                    $this->error('请输入验证码');
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
                if ($re ['user_pass'] != md5 ( $user_login . $pass . C ( 'PWD_SALA' ) )){
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

		if($adminuid>0 && $fromuid)//客服接入		

		$uid = $fromuid;

		else{

			if($msg = $this->checkbasedata()) $this->error($msg);

			$uid=$this->uinfo['id'];

		}				

		if($tuid==$uid)$this->error("自己不能关注自己");

		if($uid&&$tuid){

			$User_subscribe = M("User_subscribe");

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

		if(!$pid) $this->error('err');

		$phohomod = M("User_photo");

		$phoarr = $phohomod->where("idmd5='$pid'")->find();

		if(cookie('pidzan'.$pid))

		$this->success($phoarr['hits']);

		if(!$phoarr) $this->error('err');

		$re = $phohomod->where("idmd5='$pid'")->setInc('hits');

		if($re){

			cookie('pidzan'.$pid,1,3600);

			$tongji['sevenzan']=1;

			$tongji['zan']=1;

			$this->tongjiarr($phoarr['uid'],$tongji);

			$this->success($phoarr['hits']+1);

		}		

		else

		$this->error('err');

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
     * @date：2020/2/5 0005
     * @time：12:31
     */
    public function getArticleLists()
    {
        $res = array();

        if (IS_POST) {

            $page  = I('page',1);
            $limit = I('limit',10);
            $type  = I('type');

            $lists = D('Admin/Article')->page($page,$limit)->select();

            foreach ($lists as $k => $v) {
                if ($k == 'input_time') {
                    $res[$k] = timeFormat($v);
                }
            }

            $res['status'] = 1;
            $res['lists']  = $lists;
            $res['hasNextPage'] = $lists ? true : false;

            $this->ajaxReturn($res);

        } else {

            $res['status'] = 0;
            $res['lists']  = [];
            $res['hasNextPage'] = false;

            $this->ajaxReturn($res);
        }
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

		

}

