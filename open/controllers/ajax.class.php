<?php
class Ajax {
    public function __construct(){
        //检查用户登录状态
        $this->Success = true;
        $this->Data = "null";
        if($this->Success){
            $this->user=new user();
            $userinfo = $this->user->blogin();
            if(!$userinfo){
                $this->Success = false;
                $this->Msg = "请登录后再访问！";
            }
        }
    }
    public function AdminSetsubmit(){
        $domain = $_POST["domain"];
        if ($this->Success and $domain == "") {
            $this->Msg="域名不能为空！";
            $this->Success = false;
        }
        $urlmode = $_POST["urlmode"];
        if ($this->Success and $urlmode == "") {
            $this->Msg="URL模式不能为空！";
            $this->Success = false;
        }
        $dbhost = $_POST["dbhost"];
        if ($this->Success and $dbhost == "") {
            $this->Msg="数据库地址不能为空！";
            $this->Success = false;
        }
        $dbport = $_POST["dbport"];
        if ($this->Success and $dbhost == "") {
            $this->Msg="数据库端口不能为空！";
            $this->Success = false;
        }
        $dbname = $_POST["dbname"];
        if ($this->Success and $dbname == "") {
            $this->Msg="数据库名称不能为空！";
            $this->Success = false;
        }
        $dbuser = $_POST["dbuser"];
        if ($this->Success and $dbuser == "") {
            $this->Msg="数据库用户名不能为空！";
            $this->Success = false;
        }
        $dbpassword = $_POST["dbpassword"];
        if ($this->Success and $dbpassword == "") {
            $this->Msg="数据库密码不能为空！";
            $this->Success = false;
        }
        $dbcharset = $_POST["dbcharset"];
        if ($this->Success and $dbcharset == "") {
            $this->Msg="数据库编码不能为空！";
            $this->Success = false;
        }
        $sortpath = $_POST["sortpath"];
        if ($this->Success and $sortpath == "") {
            $this->Msg="分类文件路径不能为空！";
            $this->Success = false;
        }else{
            $sortpath = miyue::configencode($sortpath);
        }
        $txtpath = $_POST["txtpath"];
        if ($this->Success and $txtpath == "") {
            $this->Msg="TXT物理路径不能为空！";
            $this->Success = false;
        }else{
            $txtpath = miyue::configencode($txtpath);
        }
        $imgurl= $_POST["imgurl"];
        if ($this->Success and $imgurl == "") {
            $this->Msg="封面访问路径不能为空！";
            $this->Success = false;
        }else{
            $imgurl = miyue::configencode($imgurl);
        }
        $dbpre = $_POST["dbpre"];
        if($this->Success){
            $Data = "<?php\n";
            $Data .= "define ( \"MYSQL_HOST\", \"$dbhost\" );\n";
            $Data .= "define ( \"MYSQL_PORT\", \"$dbport\" );\n";
            $Data .= "define ( \"MYSQL_DB\", \"$dbname\" );\n";
            $Data .= "define ( \"MYSQL_USER\", \"$dbuser\" );\n";
            $Data .= "define ( \"MYSQL_PASS\", \"$dbpassword\" );\n";
            $Data .= "define ( \"MYSQL_CHARSET\", \"$dbcharset\" );\n";
            $Data .= "define ( \"MYSQL_PRE\", \"$dbpre\" );\n";
            $Data .= "define ( \"URL_MODE\", \"$urlmode\" );\n";
            $Data .= "define ( \"SITEURL\", \"$domain\" );\n";
            $Data .= "define ( \"SORTPATH\", miyue::configdecode(\"$sortpath\"));\n";
            $Data .= "define ( \"TXTPATH\", miyue::configdecode(\"$txtpath\"));\n";
            $Data .= "define ( \"IMGURL\", miyue::configdecode(\"$imgurl\"));\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("config",$Data);
            if($re){
                $this->Msg = "修改成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminSharesubmit(){
        $name = $_POST["name"];
        if ($this->Success and $name == "") {
            $this->Msg="渠道名称不能为空！";
            $this->Success = false;
        }
        $token = $_POST["token"];
        $passip = $_POST["passip"];
        if ($this->Success && $token == "undefined" && $passip == "undefined") {
            $this->Msg="请至少选择一种鉴权方式！";
            $this->Success = false;
        }
        if($this->Success){
            $access = array();
            if($token=="checked"){
                array_push($access,"token");
            }
            if($passip=="checked"){
                array_push($access,"passip");
            }
            $access = addslashes(serialize($access));
            $appid = miyue::randstring(6);
            $appsecret = miyue::randstring(16);
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"name\" => \"$name\",\n";
            $Data .= "\"access\" => unserialize(stripslashes(\"$access\")),\n";
            $Data .= "\"appid\" => \"$appid\",\n";
            $Data .= "\"appsecret\" => \"$appsecret\",\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("/app/".$appid,$Data);
            if($re){
                $this->Msg = "添加成功！";
				mkdir(ROOT_PATH.'/configs/batch/'.iconv("utf-8","gbk",$appid).'/',0777);
				mkdir(ROOT_PATH.'/configs/api/'.iconv("utf-8","gbk",$appid).'/',0777);
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminSharesave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $name = $_POST["name"];
        if ($this->Success and $name == "") {
            $this->Msg="渠道名称不能为空！";
            $this->Success = false;
        }
        $token = $_POST["token"];
        $passip = $_POST["passip"];
        if ($this->Success && $token == "undefined" && $passip == "undefined") {
            $this->Msg="请至少选择一种鉴权方式！";
            $this->Success = false;
        }
        $ip = addslashes($_POST["ip"]);
        if ($this->Success && $passip =="checked" && $ip == "") {
            $this->Msg="选择IP地址授权后请输入允许访问的IP地址白名单！";
            $this->Success = false;
        }
        $free = $_POST["free"];
        if ($this->Success and $free == "") {
            $this->Msg="免费章节数量不能为空！";
            $this->Success = false;
        }
        if($this->Success){
            $access = array();
            if($token=="checked"){
                array_push($access,"token");
            }
            if($passip=="checked"){
                array_push($access,"passip");
            }
            $access = addslashes(serialize($access));
            $temp = miyue::readconfig("app/".$id);
            $appid = $temp["appid"];
            $appsecret = $temp["appsecret"];
            parse_str($_POST["sortids"],$sortids);
            parse_str($_POST["sortnames"],$sortnames);
            $sortlist = array();
            foreach($sortids as $k=>$v){
                $sortlist[$k]["sortid"]=$v;
                $sortlist[$k]["sortname"]=$sortnames[$v];
            }
            $sortlist = addslashes(serialize($sortlist));
            $data = miyue::readconfig("api/".$id."/".$apiid);
            $apimodel = $data["apimodel"];
            $apitype = $data["apitype"];
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"name\" => \"$name\",\n";
            $Data .= "\"access\" => unserialize(stripslashes(\"$access\")),\n";
            $Data .= "\"appid\" => \"$appid\",\n";
            $Data .= "\"appsecret\" => \"$appsecret\",\n";
            $Data .= "\"ip\" => stripslashes(\"$ip\"),\n";
            $Data .= "\"free\" => \"$free\",\n";
            $Data .= "\"sortlist\" => unserialize(stripslashes(\"$sortlist\")),\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("/app/".$id,$Data);
            if($re){
                $this->Msg = "保存成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminBatchsubmit(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $begintime = strtotime($_POST["begintime"]." 00:00");
        if ($this->Success and $begintime == "") {
            $this->Msg="请选择起始时间！";
            $this->Success = false;
        }
        $overtime = strtotime($_POST["overtime"]." 00:00");
        if ($this->Success and $overtime == "") {
            $this->Msg="请选择结束时间！";
            $this->Success = false;
        }
        if($this->Success&&$begintime>=$overtime){
            $this->Msg="请选择合理的时间区间！";
            $this->Success = false;
        }
        if($this->Success){
            $books = array();
            $books = addslashes(serialize($books));
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"begintime\" => \"$begintime\",\n";
            $Data .= "\"overtime\" => \"$overtime\",\n";
            $Data .= "\"books\" => unserialize(stripslashes(\"$books\")),\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("/batch/".$id."/".time(),$Data);
            if($re){
                $this->Msg = "添加成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminBatchdelete(){
        $shareid = $_POST["shareid"];
        if ($this->Success and $shareid == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $batchid = $_POST["batchid"];
        if ($this->Success and $batchid == "") {
            $this->Msg="无效的批次！";
            $this->Success = false;
        }
        if($this->Success){
            $re = miyue::deleteconfigs("batch/".$shareid."/".$batchid);
            if($re){
                $this->Msg = "删除成功！";
            }else{
                $this->Msg = "文件删除失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminApisubmit(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $apiuse = $_POST["apiuse"];
        if ($this->Success and $apiuse == "") {
            $this->Msg="请输入接口用途！";
            $this->Success = false;
        }
        $apimodel = $_POST["apimodel"];
        if ($this->Success and $apimodel == "") {
            $this->Msg="请选择数据模型！";
            $this->Success = false;
        }
        $apitype = $_POST["apitype"];
        if ($this->Success and $apitype == "") {
            $this->Msg="请选择数据类型！";
            $this->Success = false;
        }
        if($this->Success){
            $books = array();
            $books = addslashes(serialize($books));
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"apiuse\" => \"$apiuse\",\n";
            $Data .= "\"apimodel\" => \"$apimodel\",\n";
            $Data .= "\"apitype\" => \"$apitype\",\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("/api/".$id."/".time(),$Data);
            if($re){
                $this->Msg = "添加成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminApidelete(){
        $shareid = $_POST["shareid"];
        if ($this->Success and $shareid == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $apiid = $_POST["apiid"];
        if ($this->Success and $apiid == "") {
            $this->Msg="无效的接口！";
            $this->Success = false;
        }
        if($this->Success){
            $re = miyue::deleteconfigs("api/".$shareid."/".$apiid);
            if($re){
                $this->Msg = "删除成功！";
            }else{
                $this->Msg = "文件删除失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminSharedelete(){
        $shareid = $_POST["shareid"];
        if ($this->Success and $shareid == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        if($this->Success){
            $re = miyue::deleteall($shareid);
            if($re){
                $this->Msg = "删除成功！";
            }else{
                $this->Msg = "文件删除失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminBatchsave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $batchid = $_POST["batchid"];
        if ($this->Success and $batchid == "") {
            $this->Msg="无效的批次！";
            $this->Success = false;
        }
        $begintime = strtotime($_POST["begintime"]." 00:00");
        if ($this->Success and $begintime == "") {
            $this->Msg="请选择起始时间！";
            $this->Success = false;
        }
        $overtime = strtotime($_POST["overtime"]." 00:00");
        if ($this->Success and $overtime == "") {
            $this->Msg="请选择结束时间！";
            $this->Success = false;
        }
        if($this->Success&&$begintime>=$overtime){
            $this->Msg="请选择合理的时间区间！";
            $this->Success = false;
        }
        if($this->Success){
            $addbook = explode(",",$_POST["addbook"]);
            $addbook = array_filter($addbook);
            $data = miyue::readconfig("batch/".$id."/".$batchid);
            $books = $data["books"];
            if(!$books){
                $books = array();
            }
            $books = array_merge($books,$addbook);
            $books = array_unique($books);
            array_walk($books,"miyue::Intarray");
            $books = addslashes(serialize($books));
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"begintime\" => \"$begintime\",\n";
            $Data .= "\"overtime\" => \"$overtime\",\n";
            $Data .= "\"books\" => unserialize(stripslashes(\"$books\")),\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("/batch/".$id."/".$batchid,$Data);
            if($re){
                $this->Msg = "保存成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Adminbookdeletefrombatch(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $batchid = $_POST["batchid"];
        if ($this->Success and $batchid == "") {
            $this->Msg="无效的批次！";
            $this->Success = false;
        }
        $bookid = $_POST["bookid"];
        if ($this->Success and $bookid == "") {
            $this->Msg="请选择要取消授权的书操作！";
            $this->Success = false;
        }
        if($this->Success){
            $data = miyue::readconfig("batch/".$id."/".$batchid);
            if(!$data){
                $this->Msg="无法读取批次配置文件！";
                $this->Success = false;
            }
        }
        if($this->Success&&!in_array($bookid,$data["books"])){
            $this->Msg="该批次中无此书信息！";
            $this->Success = false;
        }
        if($this->Success){
            $bookdiff = array($bookid);
            $books = array_diff($data["books"], $bookdiff);
            $books = addslashes(serialize($books));
            $begintime=$data["begintime"];
            $overtime=$data["overtime"];
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"begintime\" => \"$begintime\",\n";
            $Data .= "\"overtime\" => \"$overtime\",\n";
            $Data .= "\"books\" => unserialize(stripslashes(\"$books\")),\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("/batch/".$id."/".$batchid,$Data);
            if($re){
                $this->Msg = "删除成功！";
            }else{
                $this->Msg = "授权删除失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminApisave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $apiid = $_POST["apiid"];
        if ($this->Success and $apiid == "") {
            $this->Msg="无效的接口！";
            $this->Success = false;
        }
        $apiuse = $_POST["apiuse"];
        if ($this->Success and $apiuse == "") {
            $this->Msg="请描述接口用途！";
            $this->Success = false;
        }
        $template = $_POST["template"];
        if ($this->Success and $template == "") {
            $this->Msg="请设置输出模板！";
            $this->Success = false;
        }
        if($this->Success){
            parse_str($_POST["queryarray"],$query);
            $data = miyue::readconfig("api/".$id."/".$apiid);
            $apimodel = $data["apimodel"];
            $apitype = $data["apitype"];
            $query = addslashes(serialize($query));
            $template = miyue::configencode($template);
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"apiuse\" => \"$apiuse\",\n";
            $Data .= "\"apimodel\" => \"$apimodel\",\n";
            $Data .= "\"apitype\" => \"$apitype\",\n";
            $Data .= "\"query\" => unserialize(stripslashes(\"$query\")),\n";
            $Data .= "\"template\" => miyue::configdecode(\"$template\"),\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("/api/".$id."/".$apiid,$Data);
            if($re){
                $this->Msg = "保存成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
	public function AdminSpiderdelete(){
        $mark = $_POST["mark"];
        if ($this->Success and $mark == "") {
            $this->Msg="内容源标记不能为空！";
            $this->Success = false;
        }
        if($this->Success){
            $re = miyue::deletemark($mark);
            if($re){
                $this->Msg = "删除成功！";
            }else{
                $this->Msg = "文件删除失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipdersubmit(){
        $name = $_POST["name"];
        if ($this->Success and $name == "") {
            $this->Msg="内容源名称不能为空！";
            $this->Success = false;
        }
        $mark = $_POST["mark"];
        if ($this->Success and $mark == "") {
            $this->Msg="内容源标记不能为空！";
            $this->Success = false;
        }
		$userid = $_POST["userid"];
        if ($this->Success and $userid == "") {
            $this->Msg="合作UID不能为空！";
            $this->Success = false;
        }
        if($this->Success){
            $Spiderarray = miyue::readconfiglist("spider");
            foreach($Spiderarray as $k=>$v){
                if($v["mark"]==$mark){
                    $this->Msg="该内容源标记已被使用，请使用其他标记！";
                    $this->Success = false;
                    break;
                }
            }
        }
		$times = str_replace("/","","{i:0;s:5:\/\"debug\/\";}");
        if($this->Success){
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"name\" => \"$name\",\n";
            $Data .= "\"mark\" => \"$mark\",\n";
			$Data .= "\"userid\" => \"$userid\",\n";
			$Data .= "\"status\" => unserialize(stripslashes(\"a:1:$times\")),\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("/spider/".$mark,$Data);
            if($re){
                $this->Msg = "添加成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipdersave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        $name = $_POST["name"];
        if ($this->Success and $name == "") {
            $this->Msg="内容源名称不能为空！";
            $this->Success = false;
        }
		$userid = $_POST["userid"];
        if ($this->Success and $userid == "") {
            $this->Msg="合作方UID不能为空！";
            $this->Success = false;
        }
        $online = $_POST["online"];
        $debug = $_POST["debug"];
        if ($this->Success && $online == "undefined" && $debug == "undefined") {
            $this->Msg="请选择上线或调试模式！";
            $this->Success = false;
        }
        $begintime = strtotime($_POST["begintime"]." 00:00");
        if ($this->Success and $begintime == "") {
            $this->Msg="请选择起始时间！";
            $this->Success = false;
        }
        $overtime = strtotime($_POST["overtime"]." 00:00");
        if ($this->Success and $overtime == "") {
            $this->Msg="请选择结束时间！";
            $this->Success = false;
        }
        if($this->Success&&$begintime>=$overtime){
            $this->Msg="请选择合理的时间区间！";
            $this->Success = false;
        }
        if($this->Success){
            if($online=="checked"){
                $api = miyue::readconfig("spiderapi/".$id);
                if($api["status_articlelist"]==1&&$api["status_articleinfo"]==1&&$api["status_chapterlist"]==1&&$api["status_chapter"]==1){

                }else{
                    $this->Msg="请先测试接口再开启上线模式！";
                    $this->Success = false;
                }
            }
        }
        if($this->Success){
            $status = array();
            if($online=="checked"){
                array_push($status,"online");
            }
            if($debug=="checked"){
                array_push($status,"debug");
            }
            $status = addslashes(serialize($status));
            $temp = miyue::readconfig("spider/".$id);
            $mark = $temp["mark"];
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"name\" => \"$name\",\n";
            $Data .= "\"mark\" => \"$mark\",\n";
			$Data .= "\"userid\" => \"$userid\",\n";
            $Data .= "\"status\" => unserialize(stripslashes(\"$status\")),\n";
            $Data .= "\"begintime\" => \"$begintime\",\n";
            $Data .= "\"overtime\" => \"$overtime\",\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("spider/".$mark,$Data);
            if($re){
                $this->Msg = "保存成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipderapisave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        if ($this->Success) {
            $temp = miyue::readconfig("spider/" . $id);
            if(in_array("online",$temp["status"])){
                $this->Msg="上线中的接口不允许更改，请切换至调试模式后重新提交！";
                $this->Success = false;
            }
        }
        $uri_articlelist = $_POST["uri_articlelist"];
        if ($this->Success and $uri_articlelist == "") {
            $this->Msg="获取小说列表接口不能为空！";
            $this->Success = false;
        }
        $uri_articleinfo = $_POST["uri_articleinfo"];
        if ($this->Success and $uri_articleinfo == "") {
            $this->Msg="获取小说详情接口不能为空！";
            $this->Success = false;
        }
        if ($this->Success and strstr($uri_articleinfo,"{bookid}")===false) {
            $this->Msg="获取小说详情接口缺少bookid参数，请添加！";
            $this->Success = false;
        }
        $uri_chapterlist = $_POST["uri_chapterlist"];
        if ($this->Success and $uri_chapterlist == "") {
            $this->Msg="获取小说目录接口不能为空！";
            $this->Success = false;
        }
        if ($this->Success and strstr($uri_chapterlist,"{bookid}")===false) {
            $this->Msg="获取小说目录接口缺少bookid参数，请添加！";
            $this->Success = false;
        }
        $uri_chapter = $_POST["uri_chapter"];
        if ($this->Success and $uri_chapter == "") {
            $this->Msg="获取章节内容接口不能为空！";
            $this->Success = false;
        }
        if ($this->Success and strstr($uri_chapter,"{bookid}")===false) {
            $this->Msg="获取章节内容接口缺少bookid参数，请添加！";
            $this->Success = false;
        }
        if ($this->Success and strstr($uri_chapter,"{chapterid}")===false) {
            $this->Msg="获取章节内容接口缺少chapterid参数，请添加！";
            $this->Success = false;
        }
        if($this->Success){
            $api = miyue::readconfig("spiderapi/".$id);
            if($api["uri_articlelist"]==$uri_articlelist&&$api["uri_articleinfo"]==$uri_articleinfo&&$api["uri_chapterlist"]==$uri_chapterlist&&$api["uri_chapter"]==$uri_chapter){
                $this->Msg="无更改！";
                $this->Success = false;
            }
        }
        if($this->Success){
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"uri_articlelist\" => \"$uri_articlelist\",\n";
            $Data .= "\"uri_articleinfo\" => \"$uri_articleinfo\",\n";
            $Data .= "\"uri_chapterlist\" => \"$uri_chapterlist\",\n";
            $Data .= "\"uri_chapter\" => \"$uri_chapter\",\n";
            $Data .= "\"status_articlelist\" => 0,\n";
            $Data .= "\"status_articleinfo\" => 0,\n";
            $Data .= "\"status_chapterlist\" => 0,\n";
            $Data .= "\"status_chapter\" => 0,\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("spiderapi/".$id,$Data);
            if($re){
                $this->Msg = "保存成功！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipderapi(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        $type = $_POST["type"];
        if ($this->Success and $type == "") {
            $this->Msg="接口类型不能为空！";
            $this->Success = false;
        }else{
            switch($type){
                case "uri_articlelist":
                    break;
                case "uri_articleinfo":
                    $bookid = $_POST["bookid"];
                    if ($this->Success and $bookid == "") {
                        $this->Msg="bookid不能为空！";
                        $this->Success = false;
                    }
                    break;
                case "uri_chapterlist":
                    $bookid = $_POST["bookid"];
                    if ($this->Success and $bookid == "") {
                        $this->Msg="bookid不能为空！";
                        $this->Success = false;
                    }
                    break;
                case "uri_chapter":
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
                    break;
                default:
                    $this->Msg="非法的接口类型！";
                    $this->Success = false;
                    break;
            }
        }
        if($this->Success) {
            $api = miyue::readconfig("spiderapi/" . $id);
            $uri = $api[$type];
            if($id=="九库文学") {
                $uri = str_replace("{token}", md5("pid=21&key=b09d43a794e1cc471a2350faf144e271"), $uri);
            }
            if(strstr($uri,"http://")===false){
                $this->Msg="获取接口URI失败！";
                $this->Success = false;
            }else{
                if($type=="uri_articleinfo"||$type=="uri_chapterlist"||$type=="uri_chapter") {
                    $uri = str_replace("{bookid}", $bookid, $uri);
                }
                if($type=="uri_chapter"){
                    $uri = str_replace("{chapterid}", $chapterid, $uri);
                }
                $f = new Hon6FetchURL();
                $this->Msg = $uri;
                $this->Data = json_decode($f->get($uri));
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipderapipass(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        if($_POST["status_articlelist"]==1&&$_POST["status_articleinfo"]==1&&$_POST["status_chapterlist"]==1&&$_POST["status_chapter"]==1){
            //
        }else{
            $this->Msg="请检验所有的接口后再通过！";
            $this->Success = false;
        }
        if($this->Success){
            $temp = miyue::readconfig("spiderapi/".$id);
            $uri_articlelist=$temp["uri_articlelist"];
            $uri_articleinfo=$temp["uri_articleinfo"];
            $uri_chapterlist=$temp["uri_chapterlist"];
            $uri_chapter=$temp["uri_chapter"];
            $Data = "<?php\n";
            $Data .= "return array(\n";
            $Data .= "\"uri_articlelist\" => \"$uri_articlelist\",\n";
            $Data .= "\"uri_articleinfo\" => \"$uri_articleinfo\",\n";
            $Data .= "\"uri_chapterlist\" => \"$uri_chapterlist\",\n";
            $Data .= "\"uri_chapter\" => \"$uri_chapter\",\n";
            $Data .= "\"status_articlelist\" => 1,\n";
            $Data .= "\"status_articleinfo\" => 1,\n";
            $Data .= "\"status_chapterlist\" => 1,\n";
            $Data .= "\"status_chapter\" => 1,\n";
            $Data .= ");\n";
            $Data .= "?>\n";
            $re = miyue::writeconfigs("spiderapi/".$id,$Data);
            if($re){
                $this->Msg = "测试成功，可以安排上线！";
            }else{
                $this->Msg = "文件写入失败！";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spiderrefresh(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="请选择要操作的小说！";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->refreshbook($id,$idstring);
            $this->Msg="操作成功";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spiderrefreshcover(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="请选择要操作的小说！";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->refreshbookcover($id,$idstring);
            $this->Msg="操作成功";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spideronline(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="请选择要操作的小说！";
            $this->Success = false;
        }
        $answer = $_POST["answer"];
        if ($this->Success and $answer == "") {
            $this->Msg="未知操作！";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->setonline($id,$idstring,$answer);
            $this->Msg="操作成功";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spiderdisplay(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="请选择要操作的小说！";
            $this->Success = false;
        }
        $answer = $_POST["answer"];
        if ($this->Success and $answer == "") {
            $this->Msg="未知操作！";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->setdisplay($id,$idstring,$answer);
            $this->Msg="操作成功";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spidershenhe(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="未知的内容源！";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="请选择要操作的小说！";
            $this->Success = false;
        }
        $answer = $_POST["answer"];
        if ($this->Success and $answer == "") {
            $this->Msg="未知操作！";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->setshenhe($id,$idstring,$answer);
            $this->Msg="操作成功";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminBatchExcel(){
        $id = $_GET["id"];
        if ($this->Success and $id == "") {
            $this->Msg="渠道ID不能为空！";
            $this->Success = false;
        }
        $batchid = $_GET["batchid"];
        if ($this->Success and $batchid == "") {
            $this->Msg="无效的批次！";
            $this->Success = false;
        }
        if($this->Success) {
            $data = miyue::readconfig("batch/".$id."/".$batchid);
            $appdata = miyue::readconfig("app/".$id);
            $books = $data["books"];
            $book = new book();
            $total=$book->getbookinfobyarray($books);
            header("Content-type:application/vnd.ms-excel;charset=".MYSQL_CHARSET);
            header("Content-Disposition:filename=" . $id."_".$batchid. ".xls");
            echo "渠道".$id."第".$batchid."批次授权小说列表\t\n";
            echo "书号\t";
            echo "书名\t";
            echo "作者\t";
            echo "分类\t";
            echo "字数\t";
            echo "状态\t";
            echo "章节数\t\n";
            foreach($total as $k => $v){
                echo $v["articleid"] . "\t";
                echo iconv("utf-8","gbk",$v["articlename"]) . "\t";
                echo iconv("utf-8","gbk",$v["author"]) . "\t";
                echo iconv("utf-8","gbk",$appdata["sortlist"][$v["sortid"]]["sortname"])."\t";
                echo ceil($v["size"]/2) . "\t";
                if($v["fullflag"]==0){
                    echo "连载\t";
                }else{
                    echo "完结\t";
                }
                echo $v["chapters"] . "\t\n";
            }
        }else{
           exit($this->Msg);
        }
    }
}
?>