<?php
class Auto2 {
   // public $ip="123.57.204.32";//原始IP
    //public $ip="120.55.171.228";//服务器IP
    public $ip="125.47.76.134";//服务器IP
	public $user;
    public $userinfo=false;
    public function __construct() {
        $this->smarty = new mySmarty ( "admin" );
        $this->Success = true;
        $this->Msg = "成功";
        $this->Data = "";
        if($this->Success){
            $userip = miyue::getip();
            if($userip!=$this->ip){
                $this->Success = false;
                $this->Msg = "您的IP:".$userip."未被允许访问！";
            }
        }
    }
    public function Index() {
        echo $this->smarty->show("auto2_index.tpl", array(
            "title" => "自动发布监控",
            "breadcrumb" => array(),
        ));
    }
    public function Start() {
        if($this->Success) {
            echo $this->smarty->show("auto2_start.tpl", array(
                "title" => "自动发布监控",
                "breadcrumb" => array(),
            ));
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Autolist(){
        if($this->Success) {
            $book = new book();
            $temp = $book->getautolist();
            if(is_array($temp)){
                $this->Data = $temp;
            }else{
                $this->Success = false;
                $this->Msg = "暂无可发布内容！";
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Autochapter(){
        $id = $_POST["draftid"];
        if ($this->Success and $id == "") {
            $this->Msg="草稿ID不能为空！";
            $this->Success = false;
        }
        if($this->Success) {
            $book = new book();
            $this->Data = $book->autochapter($id);

        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
}
?>