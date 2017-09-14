<?
class miyue {
	public function __construct() {
		// default
	}
	static function Apijson($Success, $Msg, $Data, $TotalItem = 1, $TotalPage = 1, $PageIndex = 1, $PageSize = 0) {
		$Result->Success = $Success;
		$Result->Msg = $Msg;
		$Result->Data = $Data;
		$Result->Pageinfo->TotalItem = $TotalItem;
		$Result->Pageinfo->TotalPage = $TotalPage;
		$Result->Pageinfo->PageIndex = $PageIndex;
		$Result->Pageinfo->PageSize = $PageSize;
		$Result = json_encode ( $Result );
		return $Result;
	}
	static function Intarray(&$value,$key){
		$value=intval($value);
	}
	static function writeconfigs($File, $Data) {
		$Filepath = ROOT_PATH . "/configs/" . iconv("utf-8","gbk",$File) . ".php";
		miyue::check_dir ( dirname ( $Filepath ));
		/* 写入配置文件 */
		$of = fopen ( $Filepath, "w" );
		$Result = fwrite ( $of, $Data );
		fclose ( $of );
		return $Result;
	}
	static function readconfiglist($configlist) {
		
	$dir = ROOT_PATH . "/configs/" . $configlist;
		$dh = opendir ( $dir );
		while ( false !== ($filename = readdir ( $dh )) ) {
			if ($filename != "." && $filename != "..") {
				$temp ["filename"] = iconv("gbk","utf-8",str_replace ( ".php", "", $filename ));
				$temp ["edittime"] = @filemtime ( $dir . "/" . $filename );
				$temp ["data"] = @include_once ($dir . "/" . $filename);
				$Result [] = $temp;
			}
		}
		
		file_put_contents('$Result.txt',print_r($Result,true));
		
		closedir($dh);
		return $Result;
	}
	static function deleteconfiglist($path) {
		$dir = ROOT_PATH . "/configs/" . iconv("utf-8","gbk",$path);
		$dh = opendir ( $dir );
		while ( false !== ($filename = readdir ( $dh )) ) {
			if ($filename != "." && $filename != "..") {
				@unlink ($dir . "/" . $filename);
			}
		}
		closedir($dh);
		if(rmdir($dir)) {
    		return true;
		} else {
			return false;
 		}
	}
	static function deleteconfigs($id){
		$dir = ROOT_PATH . "/configs";
        $id = iconv("utf-8","gbk",$id);
		return @unlink ($dir . "/" . $id.".php");
	}
	static function deleteall($id){
		$dir = ROOT_PATH . "/configs";
        $id = iconv("utf-8","gbk",$id);
		miyue::deleteconfiglist("batch/".$id);
		miyue::deleteconfiglist("api/".$id);
		return @unlink ($dir . "/app/" . $id.".php");
	}
	static function deletemark($id){
		$dir = ROOT_PATH . "/configs";
        $id = iconv("utf-8","gbk",$id);
		@unlink ($dir . "/spider/" . $id.".php");
		return @unlink ($dir . "/spiderapi/" . $id.".php");
	}
	static function readconfig($id){
		$dir = ROOT_PATH . "/configs";
		return @include_once ($dir . "/" . iconv("utf-8","gbk",$id).".php");
	}
	static function randstring($length = 11) { // 密码字符集，可任意添加你需要的字符
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$password = '';
		for($i = 0; $i < $length; $i ++) {
			// $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);// 第一种是使用 substr 截取$chars中的任意一位字符；
			$password .= $chars [mt_rand ( 0, strlen ( $chars ) - 1 )]; // 第二种是取字符数组 $chars 的任意元素
		}
		return $password;
	}
	static function check_dir($dirpath) {
		if (! file_exists ( $dirpath )) {
			mkdir ( $dirpath, "0777", true );
		}
	}
	static function getip() {
		if (isset ( $_SERVER )) {
			if (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
				$realip = $_SERVER ['HTTP_X_FORWARDED_FOR'];
			} elseif (isset ( $_SERVER ['HTTP_CLIENT_IP'] )) {
				$realip = $_SERVER ['HTTP_CLIENT_IP'];
			} else {
				$realip = $_SERVER ['REMOTE_ADDR'];
			}
		} else {
			if (getenv ( "HTTP_X_FORWARDED_FOR" )) {
				$realip = getenv ( "HTTP_X_FORWARDED_FOR" );
			} elseif (getenv ( "HTTP_CLIENT_IP" )) {
				$realip = getenv ( "HTTP_CLIENT_IP" );
			} else {
				$realip = getenv ( "REMOTE_ADDR" );
			}
		}
		if (strpos ( $realip, "," ) === false) {
		} else {
			$realip1 = explode ( ",", $realip );
			$realip = $realip1 [0];
		}
		return $realip;
	}
	static function configencode($str){
		return addslashes(urlencode($str));
	}
	static function configdecode($str){
		if(get_magic_quotes_gpc()){
			return stripslashes(urldecode(stripslashes($str)));
		}else{
			return urldecode(stripslashes($str));
		}
	}
    static function getLetter($string){
        $charlist = preg_split('/(?<!^)(?!$)/u', $string);
        $temp = array_map("miyue::getfirstchar", $charlist);
        return $temp[0];
    }
    static function getfirstchar($s0) {
        $fchar = ord(substr($s0, 0, 1));
        if (($fchar >= ord("a") and $fchar <= ord("z"))or($fchar >= ord("A") and $fchar <= ord("Z"))) return strtoupper(chr($fchar));
        $s = iconv("UTF-8", "GBK", $s0);
        $asc = ord($s{0}) * 256 + ord($s{1})-65536;
        if ($asc >= -20319 and $asc <= -20284)return "A";
        if ($asc >= -20283 and $asc <= -19776)return "B";
        if ($asc >= -19775 and $asc <= -19219)return "C";
        if ($asc >= -19218 and $asc <= -18711)return "D";
        if ($asc >= -18710 and $asc <= -18527)return "E";
        if ($asc >= -18526 and $asc <= -18240)return "F";
        if ($asc >= -18239 and $asc <= -17923)return "G";
        if ($asc >= -17922 and $asc <= -17418)return "H";
        if ($asc >= -17417 and $asc <= -16475)return "J";
        if ($asc >= -16474 and $asc <= -16213)return "K";
        if ($asc >= -16212 and $asc <= -15641)return "L";
        if ($asc >= -15640 and $asc <= -15166)return "M";
        if ($asc >= -15165 and $asc <= -14923)return "N";
        if ($asc >= -14922 and $asc <= -14915)return "O";
        if ($asc >= -14914 and $asc <= -14631)return "P";
        if ($asc >= -14630 and $asc <= -14150)return "Q";
        if ($asc >= -14149 and $asc <= -14091)return "R";
        if ($asc >= -14090 and $asc <= -13319)return "S";
        if ($asc >= -13318 and $asc <= -12839)return "T";
        if ($asc >= -12838 and $asc <= -12557)return "W";
        if ($asc >= -12556 and $asc <= -11848)return "X";
        if ($asc >= -11847 and $asc <= -11056)return "Y";
        if ($asc >= -11055 and $asc <= -10247)return "Z";
        return null;
    }
}
?>