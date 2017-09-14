<?php
class api {
    /*GET START*/
    public $AppID;
    public $ApiID;
    public $token;
    public $BookId = 0;
    public $ChapterId = 0;
    public $PageIndex = 1;
    public $PageSize = 10;
    /*GET END && CONST START*/
    public $appdata;
    public $books;
    public $apidata;
    public $nowtime;
    public $Success = true;
    public $Msg;
    public $Data;
    public $TotalItem = 0;
    public $TotalPage = 1;
    /*CONST END*/
    public  function __construct() {
        $this->nowtime=time();
        /*APPID验证*/
        $this->getconfig("AppID","APPID","app","appdata");
        /*鉴权*/
        $this->checkaccess();
        /*APIID验证*/
        $this->getconfig("ApiID","APIID","api","apidata");
        /*获取接口下变量信息*/
        $this->getquery();
        if($this->apidata["apimodel"]!=0){
            /*获取渠道所有批次并判断当前ID是否授权*/
            $this->getbatch();
        }
    }
    public function in() {
        if($this->Success){
            if($this->apidata["apitype"]=="xml"){
                header("Content-type:text/xml");
            }else{
                header('Content-type: application/json; charset=utf-8');
            }
            $cache = new Cache();
            $cacheid = "api/".$this->appdata["appid"]."/".$this->apidata["apimodel"]."/".$this->BookId."_".$this->ChapterId."_".$this->PageIndex."_".$this->PageSize;
            $Result = $cache->get($cacheid);
            if(!$Result){
                switch($this->apidata["apimodel"]){
                    case 0:
                        if(is_array($this->appdata["sortlist"])){
                            $this->Data=$this->appdata["sortlist"];
                            $this->Msg="获取成功！";
                        }else{
                            $this->Success = false;
                            $this->Msg="暂无分类！";
                        }
                        break;
                    case 1:
                        $book = new book();
                        $this->Data = $book->getbookinfobyarray($this->books);
                        if(!$this->Data){
                            $this->Success = false;
                            $this->Msg="不存在该小说！";
                        }else{
                            $imgflag = configs::imgflag();
                            foreach($this->Data as $k=>$v){
                                $this->Data[$k]["sortname"] = $this->getsort($v["sortid"],"sortname");
                                $this->Data[$k]["sortid"] = $this->getsort($v["sortid"],"sortid");
                                $this->Data[$k]["imgurl"] = IMGURL.intval($this->Data[$k]["articleid"]/1000)."/".$this->Data[$k]["articleid"]."/".$this->Data[$k]["articleid"]."s".$imgflag[2];
                            }
                        }
                        break;
                    case 2:
                        $book = new book();
						$user = new user();
                        $this->Data = $book->getbookinfobyid($this->BookId);
                        if($this->Data){
                            $this->Data->sortname = $this->getsort($this->Data->sortid,"sortname");
                            $this->Data->sortid = $this->getsort($this->Data->sortid,"sortid");
							if ($this->Data->authorid > 0 )
							{
								$u = $user->getauthorinfobyuserid($this->Data->authorid);
								$this->Data->userintro = $u->intro;
								$this->Data->useravatar = IMGURL.intval($u->avatar/1000)."/".$u->avatar.".jpg";
							}
							else
							{
								$this->Data->userintro = "";
								$this->Data->useravatar = "";					
							}
							$this->Data->bookcomment = $book->getbookcommentbybookid($this->BookId);
                            $imgflag = configs::imgflag();
                            $imgflagint = $this->Data->imgflag;
                            //$imgtype=$imgflagint >> 2;
                            //$tmpvar = round($imgtype & 7);
                            //$tmpvar = round($imgtype >> 3);
                            $this->Data->imgurl = IMGURL.intval($this->BookId/1000)."/".$this->BookId."/".$this->BookId."s".$imgflag[2];
                            if($this->appdata["free"]>0){
                                $this->Data->license=1;
                            }else{
                                $this->Data->license=0;
                            }
                        }else{
                            $this->Success = false;
                            $this->Msg="不存在该小说！";
                        }
                        break;
                    case 3:
                        $book = new book();
                        $this->Data = $book->getbooklistbyid($this->BookId);
                        if($this->Data){
                            $i = 0;
                            foreach($this->Data as $k=>$v){
                                if($v["chaptertype"]==0){
                                    $i++;
                                }
                                if($i<=$this->appdata["free"]){
                                    $this->Data[$k]["license"]=0;
                                }else{
                                    $this->Data[$k]["license"]=1;
                                }
                            }
                        }else{
                            $this->Success = false;
                            $this->Msg="不存在该小说！";
                        }
                        break;
                    case 4:
                        $book = new book();
                        $this->Data = $book->getchapterbyid($this->BookId,$this->ChapterId);
                        if($this->Data){
                            if(!$this->Data->txt){
                                $temp = file_get_contents(iconv("utf-8","gbk",TXTPATH.intval($this->BookId/1000)."/".$this->BookId."/".$this->ChapterId.".txt"));
                                $this->Data->txt = mb_convert_encoding($temp,"utf-8","gbk");//iconv("GBK","utf-8//ignore",$temp);
                            }
                            $this->Data->txt=str_replace("\\","",$this->Data->txt);
                            if($this->Data->chapterorder<=$this->appdata["free"]){
                                $this->Data->license=0;
                            }else{
                                $this->Data->license=1;
                            }
                            $this->Data->txt = str_replace('"',"”",$this->Data->txt);
                        }else{
                            $this->Success = false;
                            $this->Msg="不存在该章节！";
                        }
                        break;
                    default:
                        $this->Success = false;
                        $this->Msg="接口配置错误！";
                        break;
                }
                if($this->Success){
                    $smarty = new mySmarty();
                    $smarty->assign($this->apioutput());
                    $Result = $smarty->show('string:'.stripslashes($this->apidata["template"])); // 下次使用时编译
                    if($this->apidata["apitype"]=="json"){
                        eval($Result);
						$Result = urldecode(json_encode($JSON));
                        //$Result = $JSON;
                    }elseif($this->apidata["apitype"]=="jsonp"){
                        eval($Result);
                        $Result = $_GET["callback"]."_(".json_encode($JSON).")";
                    }elseif($this->apidata["apitype"]=="xml"){
                        $Result = $Result;
                    }
                    $cache->set($cacheid,$Result);
                }
                echo $Result;
            }else{
                echo $Result;
            }
        }else{
            echo $this->Msg;
        }
    }
    private function getsort($localid,$type){
        return $this->appdata["sortlist"][$localid][$type];
    }
    private function apioutput(){
        if(is_array($this->Data)){
            $this->TotalItem=count($this->Data);
            $temp = array_chunk($this->Data,$this->PageSize);
            $this->Data = $temp[$this->PageIndex-1];
        }else{
            $this->TotalItem=1;
        }
        /*输出*/
        $Result["Success"] = $this->Success;
        $Result["Msg"] = $this->Msg;
        $Result["Data"] = $this->Data;
        $Result["TotalItem"] = $this->TotalItem;
        $Result["TotalPage"] = $this->TotalPage;
        $Result["PageIndex"] = $this->PageIndex;
        $Result["PageSize"] = $this->PageSize;
        return $Result;
    }
    private function getconfig($query,$text,$path,$callback){
        if($this->Success){
            $this->$query = $_GET[$query];
            if($this->Success&&$this->$query==""){
                $this->Success = false;
                $this->Msg=$text."丢失！";
            }
            if($this->Success){
                if($path=="app"){
                    $this->$callback=miyue::readconfig($path."/".$this->$query);
                }else{
                    $this->$callback=miyue::readconfig($path."/".$this->AppID."/".$this->$query);
                }
                if(!$this->$query){
                    $this->Success = false;
                    $this->Msg=$text."非法！";
                }
            }
        }
    }
    private function getquery(){
        if($this->Success){
            $urlconfig = configs::apiquery();
            if(@is_array($this->apidata["query"] )){
                foreach($this->apidata["query"] as $k=>$v){
                    if($this->Success){
                        $newquery = $v;
                        if($v==""){
                            $newquery = $k;
                        }
                        $this->$k=isset($_GET[$newquery])?intval($_GET[$newquery]):$urlconfig[$k]["default"];
                        if(!$urlconfig[$k]["isnull"]&&$this->$k==$urlconfig[$k]["default"]){
                            $this->Success = false;
                            $this->Msg=$v."参数丢失！";
                        }
                    }
                }
            }else{
                $this->Success = false;
                $this->Msg="服务异常！";
            }
        }
    }
    private function getbatch(){
        if($this->Success){
            $temp = miyue::readconfiglist("batch/".$this->AppID);
            if(is_array($temp)){
                $books = array();
                foreach($temp as $k=>$v){
                    if($this->nowtime > $v["data"]["begintime"] && $this->nowtime < $v["data"]["overtime"]){
                        $books = array_merge($books,$v["data"]["books"]);
                    }
                }
                $books = array_unique($books);
                array_walk($books,"miyue::Intarray");
                $this->books=$books;
                if(count($this->books)==0){
                    $this->Success = false;
                    $this->Msg="暂无授权内容！";
                }else{
                    if($this->apidata["apimodel"]>1){
                        if(!in_array($this->BookId,$this->books)){
                            $this->Success = false;
                            $this->Msg="该小说尚未对您授权！";
                        }
                    }
                }
            }else{
                $this->Success = false;
                $this->Msg="暂无授权内容！";
            }
        }
    }
    private function checkaccess(){
        if($this->Success){
            if(in_array("token",$this->appdata["access"])){
                /*token鉴权*/
                /*
                 * 搜狗鉴权通道
                 * */
                if($this->AppID=="nKr6zH"){
                    $secret = $this->appdata["appsecret"];
                    switch($_GET["ApiID"]){
                        case "1441175165":
                            $sign = strtoupper(md5($_GET["timestamp"]."#".$_GET["method"]."#".$_GET["mcp"]."#".$secret));
                            break;
                        case "1441175281":
                            $sign = strtoupper(md5($_GET["method"]."#".$_GET["mcp"]."#".$secret));
                            break;
                        case "1441175338":
                            $sign = strtoupper(md5($_GET["bid"]."#".$_GET["method"]."#".$_GET["mcp"]."#".$secret));
                            break;
                        case "1441175684":
                            $sign = strtoupper(md5($_GET["bid"]."#".$_GET["method"]."#".$_GET["mcp"]."#".$secret));
                            break;
                        case "1441176000":
                            $sign = strtoupper(md5($_GET["bid"]."#".$_GET["cid"]."#".$_GET["method"]."#".$_GET["mcp"]."#".$secret));
                            break;
                        default:
                            $this->Success = false;
                            $this->Msg = "错误的接口ID:".$_GET["ApiID"];
                            break;
                    }
                    if($sign!=$_GET["sign"]) {
                        $this->Success = false;
                        $this->Msg = "鉴权失败！";
                    }
                    /*
                     * 爱奇艺鉴权通道
                     * */
                }elseif($this->AppID=="8aIGdl"){
                    $secret = $this->appdata["appsecret"];
                    switch($_GET["ApiID"]){
                        case "1448211870":
                            $str1 = md5($_GET["chapterId"]."#".$this->AppID."#".$secret);
                            $sign = md5($_GET["verify"]."#".$str1);
                            break;
                        default:
                            $this->Success = true;
                            $this->Msg = "无需鉴权";
                            break;
                    }
                    if($sign!=$_GET["sign"]) {
                        header('Content-type: application/json; charset=utf-8');
                        $this->Success = false;
                        $temperror->code = "A00001";
                        $temperror->msg = "Sign Error";
                        $this->Msg = json_encode($temperror);
                    }
                }
            }
            if($this->Success&&in_array("passip",$this->appdata["access"])){
                /*ip鉴权*/
                $myip = miyue::getip();
                $cache = new Cache();
                $cacheid = "ipconfig/".md5(serialize($this->appdata["ip"]));
                $Result = $cache->get($cacheid);
                if($Result){
                    if(!in_array($myip,$Result)){
                        $this->Success=false;
                        $this->Msg="您的IP：{$myip}未在许可范围！";
                    }else{
                        return true;
                    }
                }else{
                    $iparray = explode("\n",$this->appdata["ip"]);
                    if(in_array($myip,$iparray)){
                        return true;
                    }else{
                        foreach($iparray as $k=>$v){
                            $temp = explode(".",$v);
                            $temp2 = explode("-",$temp[3]);
                            if(count($temp2)==2){
                                unset($iparray[$k]);
                                if($temp2[1]>$temp2[0]){
                                    for($i=$temp2[0];$i<=$temp2[1];$i++){
                                        $tempip = $temp[0].".".$temp[1].".".$temp[2].".".$i;
                                        if($myip==$tempip){
                                            return true;
                                        }
                                        array_push($iparray,$tempip);
                                    }
                                }else{
                                    for($i=$temp2[0];$i>=$temp2[1];$i--){
                                        $tempip = $temp[0].".".$temp[1].".".$temp[2].".".$i;
                                        if($myip==$tempip){
                                            return true;
                                        }
                                        array_push($iparray,$tempip);
                                    }
                                }
                            }
                        }
                        $cache->set($cacheid,$iparray);
                        if(!in_array($myip,$iparray)){
                            $this->Success=false;
                            $this->Msg="您的IP：{$myip}未在许可范围！";
                        }
                    }
                }
            }
        }
    }
}
?>