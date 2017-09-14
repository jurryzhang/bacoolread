<?php
class Admin {
	public $user;
	public $userinfo=false;
    public function __construct() {
        $this->smarty = new mySmarty ( "admin" );
        $this->Success = true;
        if($this->Success){
        	$this->user=new user();
        	$userinfo = $this->user->blogin();
        	if($userinfo){
        		$this->smarty->assign(array("userinfo"=>$userinfo));
        	}else{
        		$this->Success = false;
            	$this->Msg = "请登录后再访问！";
        	}
        }
    }
    public function Index() {
        echo $this->smarty->show ( "index.tpl", array (
            "title" => "内容合作平台" ,
            "breadcrumb" => array(),
        ) );
    }
    public function Dashboard() {
        if($this->Success){
            $book = new book();
            echo $this->smarty->show ( "dashboard.tpl", array (
                "title" => "仪表盘",
                "totalshare" => miyue::readconfiglist("app"),
                "totalspider" => miyue::readconfiglist("spider"),
                "totalbook" => $book->gettotalbooknumbyrobot(),
                "breadcrumb" => array(),
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Set() {
        if($this->Success){
            echo $this->smarty->show ( "set.tpl", array (
                "title" => "平台设置" ,
                "breadcrumb" => array(array("link"=>"JavaScript:void(0)","text"=>"平台设置")),
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Share_add() {
        if($this->Success){
            echo $this->smarty->show ( "share_add.tpl", array (
                "title" => "新增渠道",
                "breadcrumb" => array(array("link"=>urlconfigs::URL_auto(array("m"=>"admin/share")),"text"=>"渠道管理"),array("link"=>"JavaScript:void(0)","text"=>"新增渠道")),
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Share() {
        if($this->Success){
            echo $this->smarty->show ( "share.tpl", array (
                "title" => "渠道管理",
                "data" => miyue::readconfiglist("app"),
                "breadcrumb" => array(array("link"=>"JavaScript:void(0)","text"=>"渠道管理")),
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Share_edit() {
        $id = $_GET["id"];
        if($this->Success && $id==""){
            $this->Success = false;
            $this->Msg = "未知渠道ID！";
        }
        if($this->Success){
            $data = miyue::readconfig("app/".$id);
            $batch = miyue::readconfiglist("batch/".$id);
            $api = miyue::readconfiglist("api/".$id);
            $temp1 = array();
            if(include_once(iconv("utf-8","gbk",SORTPATH))){
            	if(is_array($jieqiSort)){
            		foreach($jieqiSort['article'] as $k=>$v){
            			$temp["sortid"]=$k;
            			$temp["sortname"]=iconv("gbk","utf-8",$v["shortname"]);
            			$temp1[]=$temp;
            		}
            	}
            }
            echo $this->smarty->show ( "share_edit.tpl", array (
                "title" => "渠道详情管理",
                "data" => $data,
                "batch" => $batch,
                "api" => $api,
                "breadcrumb" => array(array("link"=>urlconfigs::URL_auto(array("m"=>"admin/share")),"text"=>"渠道管理"),array("link"=>"JavaScript:void(0)","text"=>"编辑渠道信息")),
                "apimodel" => configs::apimodel(),
                "apitype" => configs::apitype(),
            	"sortlist" => $temp1
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Batch_edit() {
        $id = $_GET["id"];
        if($this->Success && $id==""){
            $this->Success = false;
            $this->Msg = "未知渠道ID！";
        }
        $batchid = $_GET["batchid"];
        if($this->Success && $batchid==""){
            $this->Success = false;
            $this->Msg = "无效的批次！";
        }
        if($this->Success){
            $data = miyue::readconfig("batch/".$id."/".$batchid);
            $books = $data["books"];
            $book = new book();
            echo $this->smarty->show ( "batch_edit.tpl", array (
                "title" => "批次详情",
                "data" => $data,
                "breadcrumb" => array(array("link"=>urlconfigs::URL_auto(array("m"=>"admin/share")),"text"=>"渠道管理"),array("link"=>urlconfigs::URL_auto(array("m"=>"admin/share_edit","id"=>$id)),"text"=>"渠道信息"),array("link"=>"JavaScript:void(0)","text"=>"编辑批次详情")),
                "books" => $book->getbookinfobyarray($books),
                "bookstring"=>implode(",",$books),
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Api_edit() {
        $id = $_GET["id"];
        if($this->Success && $id==""){
            $this->Success = false;
            $this->Msg = "未知渠道ID！";
        }
        $apiid = $_GET["apiid"];
        if($this->Success && $apiid==""){
            $this->Success = false;
            $this->Msg = "无效的接口！";
        }
        if($this->Success){
            $data = miyue::readconfig("api/".$id."/".$apiid);
            $apimodel = configs::apimodel();
            $apitype = configs::apitype();
            $queryinfo = configs::apiquery();
            $query = $apimodel[$data["apimodel"]]["query"];
            echo $this->smarty->show ( "api_edit.tpl", array (
                "title" => "接口详情",
                "data" => $data,
                "breadcrumb" => array(array("link"=>urlconfigs::URL_auto(array("m"=>"admin/share")),"text"=>"渠道管理"),array("link"=>urlconfigs::URL_auto(array("m"=>"admin/share_edit","id"=>$id)),"text"=>"渠道信息"),array("link"=>"JavaScript:void(0)","text"=>"编辑接口详情")),
                "apimodel" => $apimodel,
                "apitype" => $apitype,
                "queryinfo" => $queryinfo,
                "query" => $query
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Spider_add() {
        if($this->Success){
            echo $this->smarty->show ( "spider_add.tpl", array (
                "title" => "新增内容源",
                "breadcrumb" => array(array("link"=>urlconfigs::URL_auto(array("m"=>"admin/spider")),"text"=>"内容源管理"),array("link"=>"JavaScript:void(0)","text"=>"新增内容源")),
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Spider() {
        if($this->Success){
            echo $this->smarty->show ( "spider.tpl", array (
                "title" => "内容源管理",
                "data" => miyue::readconfiglist("spider"),
                "breadcrumb" => array(array("link"=>"JavaScript:void(0)","text"=>"内容源管理")),
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Spider_edit() {
        $id = $_GET["id"];
        if($this->Success && $id==""){
            $this->Success = false;
            $this->Msg = "未知内容源！";
        }
        if($this->Success){
            $data = miyue::readconfig("spider/".$id);
            //$log = miyue::readconfiglist("spiderlog/".$id);
            $api = miyue::readconfig("spiderapi/".$id);
            $temp1 = array();
            if(include_once(iconv("utf-8","gbk",SORTPATH))){
                if(is_array($jieqiSort)){
                    foreach($jieqiSort['article'] as $k=>$v){
                        $temp["sortid"]=$k;
                        $temp["sortname"]=iconv("gbk","utf-8",$v["shortname"]);
                        $temp1[]=$temp;
                    }
                }
            }
            echo $this->smarty->show ( "spider_edit.tpl", array (
                "title" => "内容源详情管理",
                "data" => $data,
                //"log" => $log,
                "api" => $api,
                "breadcrumb" => array(array("link"=>urlconfigs::URL_auto(array("m"=>"admin/spider")),"text"=>"内容源管理"),array("link"=>"JavaScript:void(0)","text"=>"编辑内容源详情")),
                "sortlist" => $temp1
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Spider_test() {
        $id = $_GET["id"];
        if($this->Success && $id==""){
            $this->Success = false;
            $this->Msg = "未知内容源！";
        }
        if($this->Success){
            $data = miyue::readconfig("spider/".$id);
            $api = miyue::readconfig("spiderapi/".$id);
            $temp1 = array();
            if(include_once(iconv("utf-8","gbk",SORTPATH))){
                if(is_array($jieqiSort)){
                    foreach($jieqiSort['article'] as $k=>$v){
                        $temp["sortid"]=$k;
                        $temp["sortname"]=iconv("gbk","utf-8",$v["shortname"]);
                        $temp1[]=$temp;
                    }
                }
            }
            echo $this->smarty->show ( "spider_test.tpl", array (
                "title" => "接口测试",
                "data" => $data,
                "api" => $api,
                "breadcrumb" => array(array("link"=>urlconfigs::URL_auto(array("m"=>"admin/spider")),"text"=>"内容源管理"),array("link"=>urlconfigs::URL_auto(array("m"=>"admin/spider_edit","id"=>$id)),"text"=>"编辑内容源详情"),array("link"=>"JavaScript:void(0)","text"=>"接口测试")),
                "sortlist" => $temp1
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function spider_book(){
        $id = $_GET["id"];
        if($this->Success && $id==""){
            $this->Success = false;
            $this->Msg = "未知内容源！";
        }
        if($this->Success){
            $data = miyue::readconfig("spider/".$id);
            $temp1 = array();
            if(include_once(iconv("utf-8","gbk",SORTPATH))){
                if(is_array($jieqiSort)){
                    foreach($jieqiSort['article'] as $k=>$v){
                        $temp["sortid"]=$k;
                        $temp["sortname"]=iconv("gbk","utf-8",$v["shortname"]);
                        $temp1[]=$temp;
                    }
                }
            }
            $book = new book();
            echo $this->smarty->show ( "spider_book.tpl", array (
                "title" => "内容管理",
                "data" => $data,
                "breadcrumb" => array(array("link"=>urlconfigs::URL_auto(array("m"=>"admin/spider")),"text"=>"内容源管理"),array("link"=>"JavaScript:void(0)","text"=>"内容管理")),
                "sortlist" => $temp1,
                "books" => $book->getbookinfobyspiderid($id)
            ) );
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
}
?>