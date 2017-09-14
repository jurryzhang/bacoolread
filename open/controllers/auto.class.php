<?php
class Auto {
	// public $ip="123.57.204.32";//原始
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
        echo $this->smarty->show("auto_index.tpl", array(
            "title" => "内容源采集器",
            "breadcrumb" => array(),
        ));
    }
    public function Start() {
        if($this->Success) {
            echo $this->smarty->show("auto_start.tpl", array(
                "title" => "test内容源采集器",
                "breadcrumb" => array(),
            ));
        }else{
            echo miyue::Apijson($this->Success, $this->Msg, "");
        }
    }
    public function Spiderlist(){
        if($this->Success) {
            $temp = miyue::readconfiglist("spider");
            if(is_array($temp)){
                $temp2 = array();
                $nowtime = time();
                foreach($temp as $k=>$v){
                    if(in_array("online",$v["data"]["status"])){//筛选上线接口
                        if($nowtime>$v["data"]["begintime"]&&$nowtime<$v["data"]["overtime"]){
                            $temp2[]=$v["data"];
                        }else{
                            continue;
                        }
                    }else{
                        continue;
                    }
                }
                $this->Data = $temp2;
            }else{
                $this->Success = false;
                $this->Msg = "暂无可抓取内容源！";
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Articlelist(){
        $spiderid = $_POST["spiderid"];
        if ($this->Success and $spiderid == "") {
            $this->Msg="无效的内容源ID！";
            $this->Success = false;
        }
        if($this->Success) {
            $api = miyue::readconfig("spiderapi/" . $spiderid);
            $uri = $api["uri_articlelist"];
            $uri = $this->token9ku($uri);
            if(strstr($uri,"http://")===false){
                $this->Msg="分析接口URI失败！";
                $this->Success = false;
            }else{
                $f = new Hon6FetchURL();
                $this->Msg = $uri;
                $this->Data = json_decode(str_replace('\u00a0','',$f->get($uri)));
                /*和数据库数据对比*/
                $book = new book();
                $Temp = $book->getbooklistbyspiderid($spiderid);
                if(is_array($this->Data)) {
                    $temp2 = array();
                    foreach ($this->Data as $k=>$v) {
                        if(!in_array($v->id,$Temp)){
                            $temp2[]=$v;
                        }
                    }
                    $this->Data = $temp2;
                }
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Chapterlist(){		
        $spiderid = $_POST["spiderid"];
		$userid = $_POST["userid"];
        if ($this->Success and $spiderid == "") {
            $this->Msg="无效的内容源ID！";
            $this->Success = false;
        }
        $bookid = $_POST["bookid"];
        if ($this->Success and $bookid == "") {
            $this->Msg="bookid不能为空！";
            $this->Success = false;
        }
        if($this->Success) {
            $api = miyue::readconfig("spiderapi/" . $spiderid);
            $chapterlisturi = $api["uri_chapterlist"];
            $chapterlisturi = $this->token9ku($chapterlisturi);
            $infouri = $api["uri_articleinfo"];
            $infouri = $this->token9ku($infouri);
            if(strstr($chapterlisturi,"http://")===false||strstr($infouri,"http://")===false){
                $this->Msg="分析接口URI失败！【".$chapterlisturi."】【".$infouri."】";
                $this->Success = false;
            }else{
                $f = new Hon6FetchURL();
                $infouri = str_replace("{bookid}", $bookid, $infouri);
                $chapterlisturi = str_replace("{bookid}", $bookid, $chapterlisturi);
                $this->Msg = $chapterlisturi;
                $articleinfo = json_decode(str_replace('\u00a0','',$f->get($infouri)));
				
				
                if(intval($articleinfo->articleid)==0||$articleinfo->articlename==""||$articleinfo->author==""){
                    $this->Msg="获取小说信息失败！".$infouri;
                    $this->Success = false;
                }else{
                    $articleinfo->sortid=0;

                    if(include_once(iconv("utf-8","gbk",SORTPATH))){
						
                        if(is_array($jieqiSort)){
                            foreach($jieqiSort['article'] as $k=>$v){
                                if($articleinfo->category==iconv("gbk","utf-8",$v["caption"])){
                                    $articleinfo->sortid=$k;
                                }
                            }
                        }
                    }
					
                    if($articleinfo->sortid==0){
						
                        $this->Msg="分类对应错误！".$infouri;
                        $this->Success = false;
                    }
					
					
                }
                if($this->Success) {
                    $chapterlist = json_decode(str_replace('\u00a0','',$f->get($chapterlisturi)));
                    if(!is_array($chapterlist)||count($chapterlist)<1){
                        $this->Msg="获取小说章节列表失败！".$chapterlisturi;
                        $this->Success = false;
                    }
                    if($this->Success) {
                        $book = new book();
                        /*if($_POST["spiderid"]=="陌上香坊") {
                            $articleinfo->cover = str_replace("files", "www", $articleinfo->cover);
                        }*/
                        $this->Data = $book->checkchapterandinsert($spiderid, $articleinfo, $chapterlist, $userid);
                        //$this->Data = json_decode($this->Data);
                    }
                }
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Chapter(){
        $spiderid = $_POST["spiderid"];
        if ($this->Success and $spiderid == "") {
            $this->Msg="无效的内容源ID！";
            $this->Success = false;
        }
        $bookid = $_POST["bookid"];
        if ($this->Success and $bookid == "") {
            $this->Msg="bookid不能为空！";
            $this->Success = false;
        }
        $chapterid = $_POST["chapterid"];
        if ($this->Success and $chapterid == "") {
            $this->Msg="chapterid不能为空！";
            $this->Success = false;
        }
        if($this->Success) {
            $api = miyue::readconfig("spiderapi/" . $spiderid);
            $uri = $api["uri_chapter"];
            $uri = $this->token9ku($uri);
            if(strstr($uri,"http://")===false){
                $this->Msg="分析接口URI失败！".$uri;
                $this->Success = false;
            }else{
                $uri = str_replace("{bookid}", $bookid, $uri);
                $uri = str_replace("{chapterid}", $chapterid, $uri);
                $f = new Hon6FetchURL();
                $this->Msg = $uri;
                $chapter = json_decode(str_replace('\u00a0','',$f->get($uri)));
                if(intval($chapter->chaptertype)==0 && (empty($chapter->chapterid) || empty($chapter->content))){
                    $this->Msg=$chapter->chaptername." 空章！".$uri;
                    $this->Success = false;
                }else {
                    $chapter->content = $this->format($chapter->content);
                    $book = new book();
                    $this->Data = $book->insertchapter($spiderid,$bookid,$chapter);
                }
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    private function token9ku($uri){
        if($_POST["spiderid"]=="九库文学"){
            return str_replace("{token}",md5("pid=21&key=b09d43a794e1cc471a2350faf144e271"),$uri);
        }else{
            return $uri;
        }
    }
    private function format($str){
        if($_POST["spiderid"]=="九库文学"){
            $str = "　　".str_replace("<br/>",PHP_EOL.PHP_EOL."　　",$str);
            $str = str_replace(" ","",$str);
            return $str;
        }else if($_POST["spiderid"]=="陌上香坊"){
            $str = str_replace("\n",PHP_EOL.PHP_EOL,$str);
            return $str;
        }else if($_POST["spiderid"]=="沃读"){
            $str = str_replace("<br/>",PHP_EOL,$str);
            $str = str_replace("</br>",PHP_EOL,$str);
            return $str;
        }else if($_POST["spiderid"]=="阅书中文网"){
            $str = str_replace("　　","\r\n",$str);
            $str = str_replace("\r\n\r\n","\r\n",$str);
            $str = str_replace("\r\n",PHP_EOL.PHP_EOL."　　",$str);
            $str = str_replace("　　　","　　",$str);
            $str = str_replace("\u201c","",$str);
            return $str;
        }else if($_POST["spiderid"]=="起创文学"){
            $str = "　　".str_replace("\n",PHP_EOL.PHP_EOL."　　",$str);
            return $str;
        }else{
            return $str;
        }
    }
    function test(){
        $book=new book();
        $result = $book->getimg("87367","http://www.msxf.net/upload/book/68/6895.png");
        var_dump($result);
    }
	
}
?>