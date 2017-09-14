<?php
class site {
    public function __construct() {
        $this->smarty = new mySmarty ( "admin" );
        $this->Success = true;
        $this->Msg = "default";
    }
    public function Config() {
        echo $this->smarty->show ( "config.tpl", array (
            "title" => "配置"
        ) );
    }
    public function Login() {
        echo $this->smarty->show ( "login.tpl", array (
            "title" => "登录"
        ) );
    }
    public function Logincheck(){
        $username = $_POST["username"];
        if($this->Success&&$username==""){
            $this->Success = false;
            $this->Msg = "用户名不能为空！";
        }
        /*登录密码是否为空*/
        $password = $_POST["password"];
        if($this->Success&&$password == ""){
            $this->Msg = "密码不能为空！";
            $this->Success = false;
        }
        /*密码正确验证*/
        if($this->Success){
            $user = new user();
            $userinfo = $user->checklogin($username,$password);
            if(!$userinfo){
                $this->Msg = "账号或密码错误！";
                $this->Success = false;
            }else{
                $userinfo->sid = miyue::randstring(32);
                $temp = addslashes(json_encode($userinfo));
                $Data = "<?php\n";
                $Data .= "return json_decode(\"$temp\");\n";
                $Data .= "?>\n";
                $re = miyue::writeconfigs("/user/".$userinfo->uid,$Data);
                if($re){
                	setcookie("sid",$userinfo->sid,time()+3600*24*30,"/");
                	setcookie("uid",$userinfo->uid,time()+3600*24*30,"/");
                    $this->Msg = "添加成功！";
                }else{
                    $this->Msg = "文件写入失败！";
                    $this->Success = false;
                }
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, "");
    }
    public function logout(){
    	setcookie("sid", "", time() - 3600 * 24 * 30, "/");
            setcookie("uid", "", time() - 3600 * 24 * 30, "/");
    	$this->Msg = "注销成功！";
    	$this->Success = true;
    	echo miyue::Apijson($this->Success, $this->Msg, "");
    }
}
?>