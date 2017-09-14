<?php
class user{
    public function __construct() {
        
    }
    public function clogin(){
    	$user=self::blogin();
        if(!$user){
            $_SESSION["backurls"] = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            header("location:".HTTPURL.urlconfigs::URL_auto(array("m"=>"site/Login")));
            exit();
        }else{
            return $user;
        }
    }
    public function blogin(){
        if(isset($_COOKIE["sid"])&&isset($_COOKIE["uid"])){/*登录标记判断，筛选第一层*/
            $userinfo = miyue::readconfig("user/".intval($_COOKIE["uid"]));
            if($userinfo->sid==$_COOKIE["sid"]) {
                return $userinfo;
            }else{
                setcookie("sid", "", time() - 3600 * 24 * 30, "/");
                setcookie("uid", "", time() - 3600 * 24 * 30, "/");
                return false;
            }
        }else{
            setcookie("sid", "", time() - 3600 * 24 * 30, "/");
            setcookie("uid", "", time() - 3600 * 24 * 30, "/");
            return false;
        }
    }
	public function checklogin($username,$password){
		$this->db = new mysql();
		$this->db -> mysql_link();
		return $this->db->query_object("SELECT * FROM ".MYSQL_PRE."system_users WHERE groupid = 2 AND uname = '".$username."' AND pass='".md5($password)."'");
	}
 	
	public function getauthorinfobyuserid($userid){		
		if(intval($userid)!=0){
			$this->db = new mysql();
			$this->db -> mysql_link();
			$Result = $this->db->query_object("SELECT intro,avatar FROM ".MYSQL_PRE."system_users A WHERE uid='".$userid."'");
            return $Result;
        }else{
            return array();
        }
	}	  
}