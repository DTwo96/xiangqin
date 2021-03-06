<?php
/**
 * 获取所有模块Service
 * @param string $name 指定Service名
 * @return ServiceList
 */
function getAllService($name,$method,$vars=array()){
    if(empty($name))return null;
    $apiPath = APP_PATH.'*/Service/'.$name.'Service.class.php';
	//echo $apiPath;
    $apiList = glob($apiPath);
    if(empty($apiList)){
        return;
    }
    $appPathStr = strlen(APP_PATH);
    $method = 'get'.$method.$name;
    $data = array();
    foreach ($apiList as $value) {
        $path = substr($value, $appPathStr,-10);
        $path = str_replace('\\', '/',  $path);
        $AppName = explode('/', $path);
        $AppName = $AppName[0];
        $class = A($AppName.'/'.$name,'Service');
        if(method_exists($class,$method)){
            $data[$AppName] = $class->$method($vars);
        }
    }
    return $data;
}

/**
 * 获取指定模块Service
 * @param string $name 指定Service名
 * @return Service
 */
function service($AppName,$name,$method,$vars=array()){
    $class = A($AppName.'/'.$name,'Service');
    if(method_exists($class,$method)){
        return $class->$method($vars);
    }
}

/**
 * 调用指定模块的API
 * @param string $api
 * @return Api
 */
function api($module,$api,$method,$vars=array())
{
    return A("$module/$api","Api")->$method($vars);
}

/**
 * 二维数组排序
 * @param array $array 排序的数组
 * @param string $key 排序主键
 * @param string $type 排序类型 asc|desc
 * @param bool $reset 是否返回原始主键
 * @return ApiList
 */
function array_order($array, $key, $type = 'asc', $reset = false)
{
    if (empty($array) || !is_array($array)) {
        return $array;
    }
    foreach ($array as $k => $v) {
        $keysvalue[$k] = $v[$key];
    }
    if ($type == 'asc') {
        asort($keysvalue);
    } else {
        arsort($keysvalue);
    }
    $i = 0;
    foreach ($keysvalue as $k => $v) {
        $i++;
        if ($reset) {
            $new_array[$k] = $array[$k];
        } else {
            $new_array[$i] = $array[$k];
        }
    }
    return $new_array;
}

/**
 * 写入配置文件
 * @param  array $config 配置信息
 */
function write_config($file, $config){
    if(is_array($config)){
        //读取配置内容
        $conf = file_get_contents($file);
        //替换配置项
        foreach ($config as $key => $value) {
            if (is_string($value) && !in_array($value, array('true','false'))){
                if (!is_numeric($value)) {
                    $value = "'" . $value . "'"; //如果是字符串，加上单引号
                }
            }
            $conf = preg_replace("/'" . $key . "'\s*=\>\s*(.*?),/iU", "'".$key."'=>".$value.",", $conf);
        }
        //写入应用配置文件
        if(!IS_WRITE){
            return false;
        }else{
            if(file_put_contents($file, $conf)){
                return true;
            } else {
                return false;
            }
            return '';
        }

    }
}

/**
 * 保存配置文件 重新写入
 * @param  array $config 配置信息
 */
function save_config($file, $newConfig)
{
    if (is_file($file)) {
        $config = require($file);
        $config = array_merge_multi($config, $newConfig);
    } else {
        $config = $newConfig;
    }
    $content = var_export($config, true);
    if (file_put_contents($file, "<?php \r\nreturn " . $content . ';')) {
        return true;
    }
    return false;
}

/**
 * 合并多维数组
 */
function array_merge_multi() {
    $args = func_get_args();
    
    if ( !isset( $args[0] ) && !array_key_exists( 0, $args ) ) {
        return array();
    }
    
    $arr = array();
    foreach ( $args as $key => $value ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $k => $v ) {
                if ( is_array( $v ) ) {
                    if ( !isset( $arr[$k] ) && !array_key_exists( $k, $arr ) ) {
                        $arr[$k] = array();
                    }
                    $arr[$k] = array_merge_multi( $arr[$k], $v );
                } else {
                    $arr[$k] = $v;
                }
            }
        }
    }
    return $arr;
} 

/**
 * 遍历删除目录和目录下所有文件
 * @param string $dir 路径
 * @return bool
 */
function del_dir($dir){
    if (!is_dir($dir)){
        return false;
    }
    $handle = opendir($dir);
    while (($file = readdir($handle)) !== false){
        if ($file != "." && $file != ".."){
            is_dir("$dir/$file")?   del_dir("$dir/$file"):@unlink("$dir/$file");
        }
    }
    if (readdir($handle) == false){
        closedir($handle);
        @rmdir($dir);
    }
}

/**
 * 获取文件或文件大小
 * @param string $directoty 路径
 * @return int
 */
function dir_size($directoty)
{
    $dir_size = 0;
    if ($dir_handle = @opendir($directoty)) {
        while ($filename = readdir($dir_handle)) {
            $subFile = $directoty . DIRECTORY_SEPARATOR . $filename;
            if ($filename == '.' || $filename == '..') {
                continue;
            } elseif (is_dir($subFile)) {
                $dir_size += dir_size($subFile);
            } elseif (is_file($subFile)) {
                $dir_size += filesize($subFile);
            }
        }
        closedir($dir_handle);
    }
    return ($dir_size);
}

/**
 * 字符串转布尔
 * @param string $directoty 路径
 * @return bool
 */
function string_to_bool($val)
{
    switch ($val) {
        case 'true':
            return true;
            break;
        case 'false':
            return false;
            break;
        
        default:
            return $val;
            break;
    }
}

/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data) {
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}

/**
 * 生成唯一数字
 */
function unique_number()
{
    return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

/**
 * 生成随机字符串
 */
function random_str()
{
    $year_code = array('A','B','C','D','E','F','G','H','I','J');
    $order_sn = $year_code[intval(date('Y'))-2010].
    strtoupper(dechex(date('m'))).date('d').
    substr(time(),-5).substr(microtime(),2,5).sprintf('d',rand(0,99));
    return $order_sn;
}


/**
 * 判断不为空
 * @param string $directoty 路径
 * @return bool
 */
function not_empty($data)
{
    if(!empty($data)){
        return true;
    }else{
        return false;
    }
}

 //中文字符串截取
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(empty($str)){
        return;
    }
    $sourcestr=$str;
    $cutlength=$length;
    $returnstr = '';
    $i = 0;
    $n = 0.0;
    $str_length = strlen($sourcestr); //字符串的字节数
    while ( ($n<$cutlength) and ($i<$str_length) ){
       $temp_str = substr($sourcestr, $i, 1);
       $ascnum = ord($temp_str); 
       if ( $ascnum >= 252){
        $returnstr = $returnstr . substr($sourcestr, $i, 6); 
        $i = $i + 6; 
        $n++; 
       }elseif ( $ascnum >= 248 ){
        $returnstr = $returnstr . substr($sourcestr, $i, 5);
        $i = $i + 5;
        $n++;
       }elseif ( $ascnum >= 240 ){
        $returnstr = $returnstr . substr($sourcestr, $i, 4);
        $i = $i + 4;
        $n++;
       }elseif ( $ascnum >= 224 ){
        $returnstr = $returnstr . substr($sourcestr, $i, 3);
        $i = $i + 3 ; 
        $n++; 
       }elseif ( $ascnum >= 192 ){
        $returnstr = $returnstr . substr($sourcestr, $i, 2);
        $i = $i + 2; 
        $n++; 
       }elseif ( $ascnum>=65 and $ascnum<=90 and $ascnum!=73){
        $returnstr = $returnstr . substr($sourcestr, $i, 1);
        $i = $i + 1;
        $n++;
       }elseif ( !(array_search($ascnum, array(37, 38, 64, 109 ,119)) === FALSE) ){
        $returnstr = $returnstr . substr($sourcestr, $i, 1);
        $i = $i + 1;
        $n++; 
       }else{
        $returnstr = $returnstr . substr($sourcestr, $i, 1);
        $i = $i + 1;
        $n = $n + 0.5; 
       }
    }
    if ( $i < $str_length && $suffix){
       $returnstr = $returnstr . '…';
    }
    return $returnstr;
}

 //字符串截取
function len($str, $len=0)
{
    if(!empty($len)){
        return msubstr($str, 0, $len);
    }else{
        return $str;
    }
}

/**
 * 加解密函数
 * @param string $string 明文 或 密文 
 * @param string $operation DECODE表示解密,其它表示加密  
 * @param string $key 密匙  
 * @param string $expiry 密文有效期
 * @return bool
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {  
    // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙  
    $ckey_length = 4;  
      
    // 密匙  
    $key = md5($key ? $key : C('SAFE_KEY'));  
      
    // 密匙a会参与加解密  
    $keya = md5(substr($key, 0, 16));  
    // 密匙b会用来做数据完整性验证  
    $keyb = md5(substr($key, 16, 16));  
    // 密匙c用于变化生成的密文  
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';  
    // 参与运算的密匙  
    $cryptkey = $keya.md5($keya.$keyc);  
    $key_length = strlen($cryptkey);  
    // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性  
    // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确  
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;  
    $string_length = strlen($string);  
    $result = '';  
    $box = range(0, 255);  
    $rndkey = array();  
    // 产生密匙簿  
    for($i = 0; $i <= 255; $i++) {  
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);  
    }  
    // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度  
    for($j = $i = 0; $i < 256; $i++) {  
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;  
        $tmp = $box[$i];  
        $box[$i] = $box[$j];  
        $box[$j] = $tmp;  
    }  
    // 核心加解密部分  
    for($a = $j = $i = 0; $i < $string_length; $i++) {  
        $a = ($a + 1) % 256;  
        $j = ($j + $box[$a]) % 256;  
        $tmp = $box[$a];  
        $box[$a] = $box[$j];  
        $box[$j] = $tmp;  
        // 从密匙簿得出密匙进行异或，再转成字符  
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));  
    }  
    if($operation == 'DECODE') {  
        // substr($result, 0, 10) == 0 验证数据有效性  
        // substr($result, 0, 10) - time() > 0 验证数据有效性  
        // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性  
        // 验证数据有效性，请看未加密明文的格式  
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {  
            return substr($result, 26);  
        } else {  
            return '';  
        }  
    } else {  
        // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因  
        // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码  
        return $keyc.str_replace('=', '', base64_encode($result));  
    }  
 }
 /**
 * 时间格式化
 */
 function format_time($time, $type = 1 , $date = 'Y-m-d H:i:s') {
    if(is_numeric($type)){
        switch ($type) {
            case 1:
                return date($date,$time);
                break;
            case 2:
                $d=time()-$time;
                if($d<0){ 
                    return date($date,$time);
                }
                if($d<60){ 
                    return $d.'秒前'; 
                }else{ 
                    if($d<3600){ 
                        return floor($d/60).'分钟前'; 
                    }else{ 
                        if($d<86400){ 
                            return floor($d/3600).'小时前'; 
                        }else{ 
                            if($d<259200){
                                return floor($d/86400).'天前'; 
                            }else{ 
                                return date($date,$time); 
                            } 
                        } 
                    } 
                }
                break;
        }
    }else{
        return date($type, $time);
    }
}


//html代码输入
function html_in($str){
    $str=htmlspecialchars($str);
    if(!get_magic_quotes_gpc()) {
        $str = addslashes($str);
    }
   return $str;
}

//html代码输出
function html_out($str){
    if(function_exists('htmlspecialchars_decode')){
        $str=htmlspecialchars_decode($str);
    }else{
        $str=html_entity_decode($str);
    }
    $str = stripslashes($str);
    return $str;
}

//判断是否是在微信里访问
 function iswx(){
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
		return true;
	}
	return false;
}

function useragent($mobile=null){
	$ua1 = 'Mozilla/5.0 (Windows NT 5.1; rv:25.0) Gecko/20100101 Firefox/25.0';
	$ua2= 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1';
	$ua3 = 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0';
	$ua4 = 'Mozilla/5.0 (Windows NT 6.2; rv:25.0) Gecko/20100101 Firefox/25.0';
	$ua5 = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1';
	$ua6 = 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1';
	$ua7 = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2';
	$ua8 = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; .NET CLR 1.1.4322; .NET4.0C; .NET CLR 3.0.04506.30; InfoPath.2; .NET4.0E; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)';
	$ua9 = 'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 1.1.4322; .NET4.0C; .NET CLR 3.0.04506.30; InfoPath.2; .NET4.0E; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)';
	$ua10 = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 1.1.4322; .NET4.0C; .NET CLR 3.0.04506.30; InfoPath.2; .NET4.0E; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)';
	$ua11 = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 1.1.4322; .NET4.0C; .NET CLR 3.0.04506.30; InfoPath.2; .NET4.0E; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)';
	$uaarr = array($ua1,$ua2,$ua3,$ua4,$ua5,$ua6,$ua7,$ua8,$ua9,$ua10,$ua11);
	if($mobile){
		return 'Mozilla/5.0 (Linux; Android 4.4.4; HM NOTE 1LTEW Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36 MicroMessenger/6.0.2.56_r958800.520 NetType/3gnet';
		//Mozilla/5.0 (Linux; Android 4.4.4; HM NOTE 1LTEW Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36 MicroMessenger/6.0.2.56_r958800.520 NetType/3gnet
		//Mozilla/5.0 (iPhone; CPU iPhone OS 7_0_4 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Mobile/11B554a MicroMessenger/5.2
	}else{
		return $uaarr[rand(0,count($uaarr)-1)];
	}
}


function curlg($url,$fromurl=NULL,$fromip=NULL,$uagent=NULL,$timeout=1,$host=NULL){//php 模拟get
	ob_start();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //ssl证书不检验
	if($fromip) curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.$fromip, 'CLIENT-IP:'.$fromip));  //构造IP
	if($fromurl) curl_setopt($ch, CURLOPT_REFERER,$fromurl);   //构造来路
	//curl_setopt($ch, CURLOPT_ENCODING ,gzip);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT,$uagent ? useragent(1) :useragent());
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$timeout);
	$file_msg = curl_exec($ch);
	curl_close($ch);
	//dump($ch);
	if($file_msg===false) return file_get_contents($url);
	return $file_msg;
}

//删除文件
function del_file($ourl){
	$ourl = ROOT_PATH.$ourl;	
	if(file_exists($ourl)){
		
		$isdel　= @unlink ($ourl);
	}
	
}


//获取随机标题

/**
* 
* @param undefined $type  1 招呼 2内心独白 0 照片随机上传
* 
*/
function getPhotoTitle($type=0){	
	if($type==1){
		$dm = C('upPhoto_zh');
	}else if($type==2){
		$dm = C('nxdbsj');
	}else{
		$dm = C('upPhoto_title');
	}
	
	if($dm){
		$dm = explode('；',$dm);
		$dmnum = count($dm);
		$randnum = rand(1,$dmnum);
		$thisdm = trim($dm[$randnum-1]);
		return $thisdm;
	}
	return '';
}
/**
 * 发送短信
 * @param int $sms_type 发送短信的类型  1 注册类  2 修改密码 3 短信登录
 * @return bool | string
 * @author：Enthusiasm
 * @date：2020/2/2
 * @time：22:24
 */
function send_sms($sms_type = 1,$phone){

    if (!is_mobile($phone)) {
        return false;
    }

    $code = rand(111111,999999);

    $content = "您的验证码是：".$code."【".C('site_title')."】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！";

    $url = 'http://106.dxton.com/webservice/sms.asmx/Submit?account='.C('mobaccount').'&password='.C('mobpass').'&mobile='.$phone.'&content='.$content;

    //写入日志
    $sqlMap = array();
    $sqlMap['content'] = $content;
    $sqlMap['phone']   = $phone;
    $sqlMap['type']    = $sms_type;
    $sqlMap['ip']      = get_ip();
    $sqlMap['code']    = $code;
    $sqlMap['input_time'] = time();

    $sms_id = D('SmsLog')->add($sqlMap);

    $res = curl_get_contents($url);

    $res = json_decode(json_encode((array) simplexml_load_string($res)), true);

    if ($res['result'] == 100) {
        //更新短信发送状态
        D('SmsLog')->where(array('id' => $sms_id))->save(array('status' => '1'));
        return true;
    } else {
        //发送错误时记录错误信息
        $error_msg = '错误码: 【' . $res['result']  .'】,'.$res['message'];
        D('SmsLog')->where(array('id' => $sms_id))->save(array('error_msg' => $error_msg,'status' => '-1'));
        return false;
    }
}
/**
 * 手机号码判断
 * @param int | string $string验证的数据
 * @return bool
 * @author：Enthusiasm
 * @date：2020/2/3
 * @time：12:51
 */
function is_mobile($string)
{
    if (!empty($string)) {
        return preg_match('/^(1(([356789][0-9])|(47)|[8][0126789]))\d{8}$/', $string);
    }
    return false;
}
/**
 * 请求接口
 * @param string $url 接口地址
 * @return bool | array
 * @author：Enthusiasm
 * @date：2020/2/3
 * @time：13:00
 */
function curl_get_contents($url){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    curl_setopt($ch, CURLOPT_USERAGENT, "IE 6.0");

    $r = curl_exec($ch);

    curl_close($ch);

    if($r===false) return file_get_contents($url);

    return $r;

}
/**
 * 获取IP
 * @return string
 * @author：Enthusiasm
 * @date：2020/2/3 0003
 * @time：13:39
 */

function get_ip()
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) {
            unset($arr[$pos]);
        }
        $ip = trim(current($arr));
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = '127.0.0.1';
    }
    return $ip;
}
/**
 * 格式化时间戳
 * @param string | int $time 时间戳
 * @param string $format 日期格式
 * @return string
 * @author：Enthusiasm
 * @date：2020/2/4 0004
 * @time：21:51
 */
function timeFormat($time,$format='Y-m-d H:i:s'){
    if (empty($time)) {
        return date($format,time());
    } else {
        return date($format,$time);
    }
}
/**
 * 生成短链接
 * @param string $url链接
 * @return string
 * @author：Enthusiasm
 * @date：2020/2/9
 * @time：12:10
 */
function get_t_url($url = '')
{
    if ($url == '') {
        //当前网址域名
        $url = 'http://' . $_SERVER['HTTP_HOST'];
    }
    if (!preg_match('/^http/', $url)) {
        $url = 'http:' . $url;
    }
    $contents = @file_get_contents('http://api.t.sina.com.cn/short_url/shorten.json?source='.C('SINA_APP_KEY').'&url_long=' . $url);
    if (!$contents) {
        return '';
    }
    $contents = json_decode($contents, true);

    return $contents[0]['url_short'];
}
/**
 * 数组转换
 * @param array $data
 * @return string
 * @author：Enthusiasm
 * @date：2020/2/9
 * @time：12:10
 */
function arrayToString($data, $isformdata = 1) {
    if($data == '') return '';
    if($isformdata) $data = dstripslashes($data);
    return var_export($data, TRUE);
}
/**
 * 过滤一些特殊字符
 * @param string $string
 * @return string
 * @author：Enthusiasm
 * @date：2020/2/9
 * @time：12:10
 */
function dstripslashes($string) {
    if(!is_array($string)) return stripslashes($string);
    foreach($string as $key => $val) $string[$key] = dstripslashes($val);
    return $string;
}
/**
 * 写入系统日志
 * @param string $msg
 * @param int $type 日志类型 1.系统 2.用户
 * @param int $userid
 * @return string
 * @author：Enthusiasm
 * @date：2020/2/9
 * @time：12:10
 */
function writeSystemLog($msg = '',$type = 1,$userid = 0) {
    $sqlMap = [];
    $sqlMap['userid']      = $userid;
    $sqlMap['ip']          = get_client_ip();
    $sqlMap['content']     = $msg;
    $sqlMap['input_time']  = time();
    $sqlMap['update_time'] = time();
    $sqlMap['type'] = $type;

    $rs = M('SystemLog')->add($sqlMap);
    if ($rs) {
        return true;
    } else {
        return false;
    }
}
/**
 * 退出登录
 * @author：Enthusiasm
 * @date：2020/3/7
 * @time：12:22
 */
function logOut() {
    $cook    = cookie('checklogin');
    $ucookie = json_decode(stripslashes($cook), true);
    S('uinfo' . $ucookie['check'], null);
    cookie('checklogin', null,  3600);
    cookie('gourl', null,  3600);
}
/**
 * xss过滤函数
 * @return string
 * @author：Enthusiasm
 * @date：2020/3/8
 * @time：18:29
 */
function remove_xss($string) {
    $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

    $parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink','script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

    $parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate',
        'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste',
        'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange',
        'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable',
        'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend',
        'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate',
        'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress',
        'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave',
        'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart',
        'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart',
        'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange',
        'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

    $parm = array_merge($parm1, $parm2);

    for ($i = 0; $i < sizeof($parm); $i++) {
        $pattern = '/';
        for ($j = 0; $j < strlen($parm[$i]); $j++) {
            if ($j > 0) {
                $pattern .= '(';
                $pattern .= '(&#[x|X]0([9][a][b]);?)?';
                $pattern .= '|(&#0([9][10][13]);?)?';
                $pattern .= ')?';
            }
            $pattern .= $parm[$i][$j];
        }
        $pattern .= '/i';
        $string = preg_replace($pattern, '', $string);
    }
    return $string;
}
/**
 * 升级用户等级
 * @return bool
 * @author：Enthusiasm
 * @date：2020/3/8
 * @time：18:29
 */
function upgrade_level($uid) {
    $user_info = M('UserCount')->where(['uid' => (int)$uid])->find();
    if (!$user_info) {
        return false;
    }

    $zan_num    = (int)$user_info['zan'];
    $next_level = 0;
    $level_name = '';

    if ($zan_num >= 520) {
        $level_name = '恋爱高手';
        $next_level = 1314;
    } else if($zan_num >= 1314) {
        $level_name = '幸福达人';
        $next_level = 9999;
    } else {
        $level_name = '情窦初开';
        $next_level = 520;
    }

    if ($zan_num == 0 || ($zan_num >= $next_level && $next_level != 9999)) {
        M('Users')->where(['id' => $uid])->save(['rank_name' => $level_name]);
    }

    return true;
}
/**
 * 是否是邮箱
 * @return bool
 * @author：Enthusiasm
 * @date：2020/3/8
 * @time：18:29
 */
function is_email($email = '')
{
    if (empty($email)) return false;

    return preg_match('/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/', $email);
}

/**
 * 升级用户等级
 * @return bool
 * @author：Enthusiasm
 * @date：2020/3/8
 * @time：18:29
 */
function send_email($email = '',$type = 3) {

    if (!is_email($email)) return false;

    $code = rand(111111,999999);

    $content = "您的验证码是：".$code."【".C('site_title')."】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！";

    $mail = new \Common\Library\PHPMailer\src\PHPMailer();

    //写入日志
    $sqlMap = array();
    $sqlMap['content'] = $content;
    $sqlMap['email']   = $email;
    $sqlMap['type']    = $type;
    $sqlMap['ip']      = get_ip();
    $sqlMap['code']    = $code;
    $sqlMap['input_time'] = time();

    $e_id = D('EmailLog')->add($sqlMap);

    try {
        //服务器配置
        $mail->CharSet ="UTF-8";                     //设定邮件编码
        $mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = 'smtp.qq.com';                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $mail->Username = '342657018@qq.com';                // SMTP 用户名  即邮箱的用户名
        $mail->Password = 'ighixuoypfkycajh';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
        $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

        $mail->setFrom('342657018@qq.com', C('site_title'));  //发件人
        $mail->addAddress($email,$email);  // 收件人
        //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
        $mail->addReplyTo('342657018@qq.com', C('site_title')); //回复的时候回复给哪个邮箱 建议和发件人一致
        //$mail->addCC('cc@example.com');                    //抄送
        //$mail->addBCC('bcc@example.com');                    //密送

        //发送附件
        // $mail->addAttachment('../xy.zip');         // 添加附件
        // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

        //Content
        $mail->isHTML(false);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = '修改邮箱-'.C('site_title');
        $mail->Body    = $content;
        $mail->AltBody = '如果邮件客户端不支持HTML则显示此内容';

        $mail->send();

        D('EmailLog')->where(['id' => $e_id])->save(['status' => '1']);

        return true;

    } catch (Exception $e) {
        D('EmailLog')->where(['id' => $e_id])->save(['status' => '-1','error_msg' => $mail->ErrorInfo]);
        return false;
    }

    return true;
}
/**
 * 获取最新的点赞时间
 * @return
 * @param
 * @author：Enthusiasm
 * @date：2020/4/5
 * @time：16:03
 */
function get_like_time($uid,$touid) {

    $info = M('DianzanLog')->where(['uid' => $uid,'touid' => $touid])->field('input_time')->order('input_time desc')->limit(1)->select();

    if (!$info) return '';

    return timeFormat($info[0]['input_time']);
}


