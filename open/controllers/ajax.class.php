<?php
class Ajax {
    public function __construct(){
        //����û���¼״̬
        $this->Success = true;
        $this->Data = "null";
        if($this->Success){
            $this->user=new user();
            $userinfo = $this->user->blogin();
            if(!$userinfo){
                $this->Success = false;
                $this->Msg = "���¼���ٷ��ʣ�";
            }
        }
    }
    public function AdminSetsubmit(){
        $domain = $_POST["domain"];
        if ($this->Success and $domain == "") {
            $this->Msg="��������Ϊ�գ�";
            $this->Success = false;
        }
        $urlmode = $_POST["urlmode"];
        if ($this->Success and $urlmode == "") {
            $this->Msg="URLģʽ����Ϊ�գ�";
            $this->Success = false;
        }
        $dbhost = $_POST["dbhost"];
        if ($this->Success and $dbhost == "") {
            $this->Msg="���ݿ��ַ����Ϊ�գ�";
            $this->Success = false;
        }
        $dbport = $_POST["dbport"];
        if ($this->Success and $dbhost == "") {
            $this->Msg="���ݿ�˿ڲ���Ϊ�գ�";
            $this->Success = false;
        }
        $dbname = $_POST["dbname"];
        if ($this->Success and $dbname == "") {
            $this->Msg="���ݿ����Ʋ���Ϊ�գ�";
            $this->Success = false;
        }
        $dbuser = $_POST["dbuser"];
        if ($this->Success and $dbuser == "") {
            $this->Msg="���ݿ��û�������Ϊ�գ�";
            $this->Success = false;
        }
        $dbpassword = $_POST["dbpassword"];
        if ($this->Success and $dbpassword == "") {
            $this->Msg="���ݿ����벻��Ϊ�գ�";
            $this->Success = false;
        }
        $dbcharset = $_POST["dbcharset"];
        if ($this->Success and $dbcharset == "") {
            $this->Msg="���ݿ���벻��Ϊ�գ�";
            $this->Success = false;
        }
        $sortpath = $_POST["sortpath"];
        if ($this->Success and $sortpath == "") {
            $this->Msg="�����ļ�·������Ϊ�գ�";
            $this->Success = false;
        }else{
            $sortpath = miyue::configencode($sortpath);
        }
        $txtpath = $_POST["txtpath"];
        if ($this->Success and $txtpath == "") {
            $this->Msg="TXT����·������Ϊ�գ�";
            $this->Success = false;
        }else{
            $txtpath = miyue::configencode($txtpath);
        }
        $imgurl= $_POST["imgurl"];
        if ($this->Success and $imgurl == "") {
            $this->Msg="�������·������Ϊ�գ�";
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
                $this->Msg = "�޸ĳɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminSharesubmit(){
        $name = $_POST["name"];
        if ($this->Success and $name == "") {
            $this->Msg="�������Ʋ���Ϊ�գ�";
            $this->Success = false;
        }
        $token = $_POST["token"];
        $passip = $_POST["passip"];
        if ($this->Success && $token == "undefined" && $passip == "undefined") {
            $this->Msg="������ѡ��һ�ּ�Ȩ��ʽ��";
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
                $this->Msg = "��ӳɹ���";
				mkdir(ROOT_PATH.'/configs/batch/'.iconv("utf-8","gbk",$appid).'/',0777);
				mkdir(ROOT_PATH.'/configs/api/'.iconv("utf-8","gbk",$appid).'/',0777);
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminSharesave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $name = $_POST["name"];
        if ($this->Success and $name == "") {
            $this->Msg="�������Ʋ���Ϊ�գ�";
            $this->Success = false;
        }
        $token = $_POST["token"];
        $passip = $_POST["passip"];
        if ($this->Success && $token == "undefined" && $passip == "undefined") {
            $this->Msg="������ѡ��һ�ּ�Ȩ��ʽ��";
            $this->Success = false;
        }
        $ip = addslashes($_POST["ip"]);
        if ($this->Success && $passip =="checked" && $ip == "") {
            $this->Msg="ѡ��IP��ַ��Ȩ��������������ʵ�IP��ַ��������";
            $this->Success = false;
        }
        $free = $_POST["free"];
        if ($this->Success and $free == "") {
            $this->Msg="����½���������Ϊ�գ�";
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
                $this->Msg = "����ɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminBatchsubmit(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $begintime = strtotime($_POST["begintime"]." 00:00");
        if ($this->Success and $begintime == "") {
            $this->Msg="��ѡ����ʼʱ�䣡";
            $this->Success = false;
        }
        $overtime = strtotime($_POST["overtime"]." 00:00");
        if ($this->Success and $overtime == "") {
            $this->Msg="��ѡ�����ʱ�䣡";
            $this->Success = false;
        }
        if($this->Success&&$begintime>=$overtime){
            $this->Msg="��ѡ������ʱ�����䣡";
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
                $this->Msg = "��ӳɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminBatchdelete(){
        $shareid = $_POST["shareid"];
        if ($this->Success and $shareid == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $batchid = $_POST["batchid"];
        if ($this->Success and $batchid == "") {
            $this->Msg="��Ч�����Σ�";
            $this->Success = false;
        }
        if($this->Success){
            $re = miyue::deleteconfigs("batch/".$shareid."/".$batchid);
            if($re){
                $this->Msg = "ɾ���ɹ���";
            }else{
                $this->Msg = "�ļ�ɾ��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminApisubmit(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $apiuse = $_POST["apiuse"];
        if ($this->Success and $apiuse == "") {
            $this->Msg="������ӿ���;��";
            $this->Success = false;
        }
        $apimodel = $_POST["apimodel"];
        if ($this->Success and $apimodel == "") {
            $this->Msg="��ѡ������ģ�ͣ�";
            $this->Success = false;
        }
        $apitype = $_POST["apitype"];
        if ($this->Success and $apitype == "") {
            $this->Msg="��ѡ���������ͣ�";
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
                $this->Msg = "��ӳɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminApidelete(){
        $shareid = $_POST["shareid"];
        if ($this->Success and $shareid == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $apiid = $_POST["apiid"];
        if ($this->Success and $apiid == "") {
            $this->Msg="��Ч�Ľӿڣ�";
            $this->Success = false;
        }
        if($this->Success){
            $re = miyue::deleteconfigs("api/".$shareid."/".$apiid);
            if($re){
                $this->Msg = "ɾ���ɹ���";
            }else{
                $this->Msg = "�ļ�ɾ��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminSharedelete(){
        $shareid = $_POST["shareid"];
        if ($this->Success and $shareid == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        if($this->Success){
            $re = miyue::deleteall($shareid);
            if($re){
                $this->Msg = "ɾ���ɹ���";
            }else{
                $this->Msg = "�ļ�ɾ��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminBatchsave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $batchid = $_POST["batchid"];
        if ($this->Success and $batchid == "") {
            $this->Msg="��Ч�����Σ�";
            $this->Success = false;
        }
        $begintime = strtotime($_POST["begintime"]." 00:00");
        if ($this->Success and $begintime == "") {
            $this->Msg="��ѡ����ʼʱ�䣡";
            $this->Success = false;
        }
        $overtime = strtotime($_POST["overtime"]." 00:00");
        if ($this->Success and $overtime == "") {
            $this->Msg="��ѡ�����ʱ�䣡";
            $this->Success = false;
        }
        if($this->Success&&$begintime>=$overtime){
            $this->Msg="��ѡ������ʱ�����䣡";
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
                $this->Msg = "����ɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Adminbookdeletefrombatch(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $batchid = $_POST["batchid"];
        if ($this->Success and $batchid == "") {
            $this->Msg="��Ч�����Σ�";
            $this->Success = false;
        }
        $bookid = $_POST["bookid"];
        if ($this->Success and $bookid == "") {
            $this->Msg="��ѡ��Ҫȡ����Ȩ���������";
            $this->Success = false;
        }
        if($this->Success){
            $data = miyue::readconfig("batch/".$id."/".$batchid);
            if(!$data){
                $this->Msg="�޷���ȡ���������ļ���";
                $this->Success = false;
            }
        }
        if($this->Success&&!in_array($bookid,$data["books"])){
            $this->Msg="���������޴�����Ϣ��";
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
                $this->Msg = "ɾ���ɹ���";
            }else{
                $this->Msg = "��Ȩɾ��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminApisave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $apiid = $_POST["apiid"];
        if ($this->Success and $apiid == "") {
            $this->Msg="��Ч�Ľӿڣ�";
            $this->Success = false;
        }
        $apiuse = $_POST["apiuse"];
        if ($this->Success and $apiuse == "") {
            $this->Msg="�������ӿ���;��";
            $this->Success = false;
        }
        $template = $_POST["template"];
        if ($this->Success and $template == "") {
            $this->Msg="���������ģ�壡";
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
                $this->Msg = "����ɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
	public function AdminSpiderdelete(){
        $mark = $_POST["mark"];
        if ($this->Success and $mark == "") {
            $this->Msg="����Դ��ǲ���Ϊ�գ�";
            $this->Success = false;
        }
        if($this->Success){
            $re = miyue::deletemark($mark);
            if($re){
                $this->Msg = "ɾ���ɹ���";
            }else{
                $this->Msg = "�ļ�ɾ��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipdersubmit(){
        $name = $_POST["name"];
        if ($this->Success and $name == "") {
            $this->Msg="����Դ���Ʋ���Ϊ�գ�";
            $this->Success = false;
        }
        $mark = $_POST["mark"];
        if ($this->Success and $mark == "") {
            $this->Msg="����Դ��ǲ���Ϊ�գ�";
            $this->Success = false;
        }
		$userid = $_POST["userid"];
        if ($this->Success and $userid == "") {
            $this->Msg="����UID����Ϊ�գ�";
            $this->Success = false;
        }
        if($this->Success){
            $Spiderarray = miyue::readconfiglist("spider");
            foreach($Spiderarray as $k=>$v){
                if($v["mark"]==$mark){
                    $this->Msg="������Դ����ѱ�ʹ�ã���ʹ��������ǣ�";
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
                $this->Msg = "��ӳɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipdersave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        $name = $_POST["name"];
        if ($this->Success and $name == "") {
            $this->Msg="����Դ���Ʋ���Ϊ�գ�";
            $this->Success = false;
        }
		$userid = $_POST["userid"];
        if ($this->Success and $userid == "") {
            $this->Msg="������UID����Ϊ�գ�";
            $this->Success = false;
        }
        $online = $_POST["online"];
        $debug = $_POST["debug"];
        if ($this->Success && $online == "undefined" && $debug == "undefined") {
            $this->Msg="��ѡ�����߻����ģʽ��";
            $this->Success = false;
        }
        $begintime = strtotime($_POST["begintime"]." 00:00");
        if ($this->Success and $begintime == "") {
            $this->Msg="��ѡ����ʼʱ�䣡";
            $this->Success = false;
        }
        $overtime = strtotime($_POST["overtime"]." 00:00");
        if ($this->Success and $overtime == "") {
            $this->Msg="��ѡ�����ʱ�䣡";
            $this->Success = false;
        }
        if($this->Success&&$begintime>=$overtime){
            $this->Msg="��ѡ������ʱ�����䣡";
            $this->Success = false;
        }
        if($this->Success){
            if($online=="checked"){
                $api = miyue::readconfig("spiderapi/".$id);
                if($api["status_articlelist"]==1&&$api["status_articleinfo"]==1&&$api["status_chapterlist"]==1&&$api["status_chapter"]==1){

                }else{
                    $this->Msg="���Ȳ��Խӿ��ٿ�������ģʽ��";
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
                $this->Msg = "����ɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipderapisave(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        if ($this->Success) {
            $temp = miyue::readconfig("spider/" . $id);
            if(in_array("online",$temp["status"])){
                $this->Msg="�����еĽӿڲ�������ģ����л�������ģʽ�������ύ��";
                $this->Success = false;
            }
        }
        $uri_articlelist = $_POST["uri_articlelist"];
        if ($this->Success and $uri_articlelist == "") {
            $this->Msg="��ȡС˵�б�ӿڲ���Ϊ�գ�";
            $this->Success = false;
        }
        $uri_articleinfo = $_POST["uri_articleinfo"];
        if ($this->Success and $uri_articleinfo == "") {
            $this->Msg="��ȡС˵����ӿڲ���Ϊ�գ�";
            $this->Success = false;
        }
        if ($this->Success and strstr($uri_articleinfo,"{bookid}")===false) {
            $this->Msg="��ȡС˵����ӿ�ȱ��bookid����������ӣ�";
            $this->Success = false;
        }
        $uri_chapterlist = $_POST["uri_chapterlist"];
        if ($this->Success and $uri_chapterlist == "") {
            $this->Msg="��ȡС˵Ŀ¼�ӿڲ���Ϊ�գ�";
            $this->Success = false;
        }
        if ($this->Success and strstr($uri_chapterlist,"{bookid}")===false) {
            $this->Msg="��ȡС˵Ŀ¼�ӿ�ȱ��bookid����������ӣ�";
            $this->Success = false;
        }
        $uri_chapter = $_POST["uri_chapter"];
        if ($this->Success and $uri_chapter == "") {
            $this->Msg="��ȡ�½����ݽӿڲ���Ϊ�գ�";
            $this->Success = false;
        }
        if ($this->Success and strstr($uri_chapter,"{bookid}")===false) {
            $this->Msg="��ȡ�½����ݽӿ�ȱ��bookid����������ӣ�";
            $this->Success = false;
        }
        if ($this->Success and strstr($uri_chapter,"{chapterid}")===false) {
            $this->Msg="��ȡ�½����ݽӿ�ȱ��chapterid����������ӣ�";
            $this->Success = false;
        }
        if($this->Success){
            $api = miyue::readconfig("spiderapi/".$id);
            if($api["uri_articlelist"]==$uri_articlelist&&$api["uri_articleinfo"]==$uri_articleinfo&&$api["uri_chapterlist"]==$uri_chapterlist&&$api["uri_chapter"]==$uri_chapter){
                $this->Msg="�޸��ģ�";
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
                $this->Msg = "����ɹ���";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Sipderapi(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        $type = $_POST["type"];
        if ($this->Success and $type == "") {
            $this->Msg="�ӿ����Ͳ���Ϊ�գ�";
            $this->Success = false;
        }else{
            switch($type){
                case "uri_articlelist":
                    break;
                case "uri_articleinfo":
                    $bookid = $_POST["bookid"];
                    if ($this->Success and $bookid == "") {
                        $this->Msg="bookid����Ϊ�գ�";
                        $this->Success = false;
                    }
                    break;
                case "uri_chapterlist":
                    $bookid = $_POST["bookid"];
                    if ($this->Success and $bookid == "") {
                        $this->Msg="bookid����Ϊ�գ�";
                        $this->Success = false;
                    }
                    break;
                case "uri_chapter":
                    $bookid = $_POST["bookid"];
                    if ($this->Success and $bookid == "") {
                        $this->Msg="bookid����Ϊ�գ�";
                        $this->Success = false;
                    }
                    $chapterid = $_POST["chapterid"];
                    if ($this->Success and $chapterid == "") {
                        $this->Msg="chapterid����Ϊ�գ�";
                        $this->Success = false;
                    }
                    break;
                default:
                    $this->Msg="�Ƿ��Ľӿ����ͣ�";
                    $this->Success = false;
                    break;
            }
        }
        if($this->Success) {
            $api = miyue::readconfig("spiderapi/" . $id);
            $uri = $api[$type];
            if($id=="�ſ���ѧ") {
                $uri = str_replace("{token}", md5("pid=21&key=b09d43a794e1cc471a2350faf144e271"), $uri);
            }
            if(strstr($uri,"http://")===false){
                $this->Msg="��ȡ�ӿ�URIʧ�ܣ�";
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
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        if($_POST["status_articlelist"]==1&&$_POST["status_articleinfo"]==1&&$_POST["status_chapterlist"]==1&&$_POST["status_chapter"]==1){
            //
        }else{
            $this->Msg="��������еĽӿں���ͨ����";
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
                $this->Msg = "���Գɹ������԰������ߣ�";
            }else{
                $this->Msg = "�ļ�д��ʧ�ܣ�";
                $this->Success = false;
            }
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spiderrefresh(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="��ѡ��Ҫ������С˵��";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->refreshbook($id,$idstring);
            $this->Msg="�����ɹ�";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spiderrefreshcover(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="��ѡ��Ҫ������С˵��";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->refreshbookcover($id,$idstring);
            $this->Msg="�����ɹ�";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spideronline(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="��ѡ��Ҫ������С˵��";
            $this->Success = false;
        }
        $answer = $_POST["answer"];
        if ($this->Success and $answer == "") {
            $this->Msg="δ֪������";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->setonline($id,$idstring,$answer);
            $this->Msg="�����ɹ�";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spiderdisplay(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="��ѡ��Ҫ������С˵��";
            $this->Success = false;
        }
        $answer = $_POST["answer"];
        if ($this->Success and $answer == "") {
            $this->Msg="δ֪������";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->setdisplay($id,$idstring,$answer);
            $this->Msg="�����ɹ�";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function Spidershenhe(){
        $id = $_POST["id"];
        if ($this->Success and $id == "") {
            $this->Msg="δ֪������Դ��";
            $this->Success = false;
        }
        $idstring = $_POST["idstring"];
        if ($this->Success and $idstring == "") {
            $this->Msg="��ѡ��Ҫ������С˵��";
            $this->Success = false;
        }
        $answer = $_POST["answer"];
        if ($this->Success and $answer == "") {
            $this->Msg="δ֪������";
            $this->Success = false;
        }
        if($this->Success){
            $book = new book();
            $book->setshenhe($id,$idstring,$answer);
            $this->Msg="�����ɹ�";
        }
        echo miyue::Apijson($this->Success, $this->Msg, $this->Data);
    }
    public function AdminBatchExcel(){
        $id = $_GET["id"];
        if ($this->Success and $id == "") {
            $this->Msg="����ID����Ϊ�գ�";
            $this->Success = false;
        }
        $batchid = $_GET["batchid"];
        if ($this->Success and $batchid == "") {
            $this->Msg="��Ч�����Σ�";
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
            echo "����".$id."��".$batchid."������ȨС˵�б�\t\n";
            echo "���\t";
            echo "����\t";
            echo "����\t";
            echo "����\t";
            echo "����\t";
            echo "״̬\t";
            echo "�½���\t\n";
            foreach($total as $k => $v){
                echo $v["articleid"] . "\t";
                echo iconv("utf-8","gbk",$v["articlename"]) . "\t";
                echo iconv("utf-8","gbk",$v["author"]) . "\t";
                echo iconv("utf-8","gbk",$appdata["sortlist"][$v["sortid"]]["sortname"])."\t";
                echo ceil($v["size"]/2) . "\t";
                if($v["fullflag"]==0){
                    echo "����\t";
                }else{
                    echo "���\t";
                }
                echo $v["chapters"] . "\t\n";
            }
        }else{
           exit($this->Msg);
        }
    }
}
?>