<?php

//////////////////////////////////////////////////////////////////////////////////////////////
error_reporting(0); 
set_time_limit(0);

$id=$_GET['id']; 
$url="http://www.mianfeidushu.com";
$del=$_GET['del']; 
$up=$_GET['up'];

// 变量处理部分
// 1. 常量定义
define('sysCPIdTest',false);										// 测试开关  true:测试接口		false:正式接口
define('sysCPCopyrighted',277);									// copyrightid

if(sysCPIdTest){
	// 测试接口调用参数
	define('sysPostUrl',"topenapi.tadu.com");					// url 
	define('sysCPSecre',"eb3b82a5447dbe0bd14ffe2742dd2d27");	// secre
	define('sysCPPort',8098);									// port
}else{
	// 正式接口调用参数
	define('sysPostUrl',"http://openapi.tadu.com");				// url 
	define('sysCPSecre',"a6ee716945203bad46bf208b60affdec");	// secre
	define('sysCPPort',80);										// port
}
//////////////////////////////////////////////////////////////////////////////////////////////


function getFiltrationArr(){
	$html="";
	$file_path = "novel.txt";
	$file = fopen($file_path,"r");
	while(!feof($file))
	{
		$html.=fgets($file);
	}
	$arr=explode(",",$html);
	fclose($file);
	return $arr;
}


// 获取书单ID
$arr=getFiltrationArr();

$ids="";
for($i=0;$i<count($arr);$i++){
	if($arr[$i]!=""){
		if($i==count($arr)-1){
			$ids.=str_replace("\n"," ",$arr[$i]);
		}else{
			$ids.=str_replace("\n"," ",$arr[$i])." or articleid=";
		}
	}
}
include("db.php");
$db = new DB;
$db_1 = new DB;



$sql="select * from jieqi_article_article where articleid=".$ids;

if(!empty($id)){
	$sql="select * from jieqi_article_article where articleid=".$id;
}
$db->query($sql);

for($i=0;$i<$db->num_rows();$i++){
	$db->next_record();
	
	$articleid = $db->f(articleid);
	$siteid = substr($articleid,0,strlen($articleid)>"3"?-3:-0)==""?"0":substr($articleid,0,strlen($articleid)>"3"?-3:-0);
	$articlename =  iconv('GB2312', 'UTF-8//IGNORE',$db->f(articlename));
	$size = round($db->f(size)/2,0); 
	$fullflag = $db->f(fullflag)==1?0:1; 
	$author = iconv('GB2312', 'UTF-8//IGNORE', $db->f(author));
	$isvip = $db->f(isvip)==1?:1; //1是vip 0不是
	
	$tagrows=explode(" ",$db->f(keywords)); //标签
	
	$intro = trim(iconv('GB2312', 'UTF-8//IGNORE',$db->f(intro)));
	$img = $url."/api/tadu/cover/".$articleid."s.jpg";
	$lastchapterid=$db->f(lastchapterid); 
	
	$lastchapter=iconv('GB2312', 'UTF-8//IGNORE',$db->f(lastchapter));
	$vipchapter =  iconv('GB2312', 'UTF-8//IGNORE',$db->f(vipchapter));
	
	$lastupdate = $db->f(lastupdate);
	$keywords=iconv('GB2312', 'UTF-8//IGNORE',str_replace(" ",",",$db->f(keywords))); //标签
	
	$sortid=$db->f(sortid);
	switch ($sortid)
	{
	case 1:
	  $sortid='99';
	  break;  
	case 2:
	  $sortid='107';
	  break; 
	case 3:
	  $sortid='109';
	  break;  
	case 4:
	  $sortid='109';
	  break;  
	case 5:
	  $sortid='103';
	  break;  
	case 6:
	  $sortid='103';
	  break;  
	case 7:
	  $sortid='114';
	  break;  
	case 8:
	  $sortid='114';
	  break;  
	case 9:
	  $sortid='104';
	  break;  
	case 10:
	  $sortid='105';
	  break;  
	case 11:
	  $sortid='131';
	  break; 
	case 12:
	  $sortid='119';
	  break;  
	case 13:
	  $sortid='106';
	  break;  
	case 14:
	  $sortid='129';
	  break;  
	case 15:
	  $sortid='133';
	  break;  
	case 16:
	  $sortid='119';
	  break;  
	case 17:
	  $sortid='108';
	  break;  
	case 18:
	  $sortid='113';
	  break; 
	case 19:
	  $sortid='103';
	  break;  
	case 20:
	  $sortid='111';
	  break;  
	case 21:
	  $sortid='112';
	  break;  
	case 22:
	  $sortid='128';
	  break; 
	default:
	  $sortid='128';
	  break; 
	}

	$lastchapterid = $db->f(lastchapterid);
	$vipchapterid = $db->f(vipchapterid);


	// 2. 变量初始化
	$bid=$articleid;			// CP书籍ID

	//////////////////////////////////////////////////////////////////////////////////////////////
	// 程序处理部分

	// 1. 作品信息处理。检测该作品在对方书库中的信息
	$data="";
	$data["key"]=sha1(sysCPCopyrighted.sysCPSecre);
	$data["cpid"]=$bid;
	$data["copyrightid"]=sysCPCopyrighted;

	$str=curlPostTaDu(sysPostUrl."/api/getUpdateInfo",sysCPPort, $data);

	$corpBkInfo=json_decode($str, true);
	if($corpBkInfo["code"]==0){
		echo "塔读最后章节信息：".$corpBkInfo["result"]["chapterid"].":".$corpBkInfo["result"]["chaptername"]."<br>\r\n";
		if($vipchapterid!=0){
			echo "本站最后章节信息：".$vipchapterid.":".$vipchapter."<br>\r\n";
		}else{
			echo "本站最后章节信息：".$lastchapterid.":".$lastchapter."<br>\r\n";
		}
		echo "--------------------------------------------------------------------<br>\r\n";
	}
	
	// 塔读最新章节ID
	$chapterid=$corpBkInfo["result"]["chapterid"];
	$chapterorder=$corpBkInfo["result"]["chapternum"];
	
	echo $chapterorder;
	
	if($corpBkInfo["code"]==-20301){
		echo "作品不存在，创建作品<br />";
		// 1.1 作品不存在，则创建作品
		$data="";
		$data["key"]=sha1(sysCPCopyrighted.sysCPSecre);
		$data["cpid"]=$bid;
		$data["copyrightid"]=sysCPCopyrighted;
		$data["coverimage"]=urlencode($img);
		$data["bookname"]=$articlename;
		$data["authorname"]=$author;
		$data["intro"]=$intro;
		$data["classid"]=$sortid;
		$data["serial"]=$fullflag;
		$data["isvip"]="1";
		$data["url"]= $url."/modules/article/articleinfo.php?id=".$bid;
		
		//echo json_encode($data);	
		
		$str=curlPostTaDu(sysPostUrl."/api/addBook", sysCPPort,$data , $head=true);
		$res=json_decode($str, true);
		
		if($res["code"]<>0){
			echo "新作品添加失败，请和系统管理员联系！错误：".$res["code"];
			exit;
		}else{
			$bookid=$res["result"]["bookid"];	// 作品对应塔读的书号
		}
		// 塔读最新章节ID
		$chapterid=0;
		$chapterorder=0;
	}else{
		$str=curlPostTaDu(sysPostUrl."/api/updateBook", sysCPPort,$data , $head=true);
		$res=json_decode($str, true);
		// 1.2 其它状态处理
		if($corpBkInfo["code"]==0){
			// 读取信息成功，数据初始化
			$bookid=$res["result"]["bookid"];	// 作品对应塔读的书号
		}else{
			echo "系统故障，请和系统管理员联系!错误：".$corpBkInfo["code"];
			exit;
		}
	}
	echo "塔读书号".$bookid."<br />";
	echo "本站书号".$bid."<br />";
	echo "--------------------------------------------------------------------<br>\r\n";
	// 该作品若无塔读对应的书号，不能传章节
	if(empty($bookid)){
		echo "bookid不能为空，请和系统管理员联系！";
		exit;
	}
	
	// 2. 上传章节
	// 2.1 查找待上传章节列表
	// $chList 待上传章节数组
	$chList=Array();
	if(!empty($up)){
		$sql_1="select * FROM  jieqi_article_chapter WHERE articleid=".$articleid." AND chapterid>=".$up." AND chaptertype=0 ORDER BY chapterid";

	}else{
		$sql_1="select * FROM  jieqi_article_chapter WHERE articleid=".$articleid." AND chapterorder>".$chapterorder." AND chaptertype=0 ORDER BY chapterorder";
	}
	
	//echo $sql_1;
	$db_1->query($sql_1);
	//$db_1->num_rows()

	for($j=0;$j<$db_1->num_rows();$j++){
		$db_1->next_record();
	
		$chapterid = $db_1->f(chapterid); //章节ID
		$chaptername = iconv('GB2312', 'UTF-8//IGNORE', $db_1->f(chaptername)); //章节名称
		$postdate =$db_1->f(postdate);
		$lastupdate = date("Y-m-d H:i:s",$db_1->f(postdate));//最后更新时间
		//$chapterorder = $db_1->f(chapterorder); //排序
		$size = $db_1->f(size)/2; //章节内容大小
		$chaptertype = $db_1->f(chaptertype); //1是卷0是章节
		$isvip = $chapterorder<21?0:1; //1是vip 0不是
		$chapterorder ++;
		if($chaptertype==0){
			$temp=Array();
			$temp["chaptername"]=$chaptername;
			$temp["chapterorder"]=$chapterorder;
			$temp["chapterid"]=$chapterid;
			$temp["isvip"]=$isvip;
			$chList[]=$temp;
		}
	}
	

	$error=0;
	$errNum=0;
	if(!empty($chList)){
		// 章节校验上传
		foreach($chList as $chArryChValue){
			//echo json_encode($chArryChValue);
			do{
				$data="";
				$data["key"]=sha1(sysCPCopyrighted.sysCPSecre);
				$data["bookid"]=$bookid;
				$data["copyrightid"]=sysCPCopyrighted;
				$data["title"]=urlencode($chArryChValue["chaptername"]);
				$data["content"]="".getCont($siteid,$bid,$chArryChValue["chapterid"])."";
				$data["chapternum"]=$chArryChValue["chapterorder"];
				$data["isvip"]=$chArryChValue["isvip"];
				$data["chapterid"]=$chArryChValue["chapterid"];
				
				if($error==-20202||!empty($up)){
					$data["updatemode"]=2;
					echo " 修改章节 : ";
				}else{
					$data["updatemode"]=1;
				}
				//echo json_encode($data);
			
				$str=curlPostTaDu(sysPostUrl."/api/addChapter",sysCPPort, $data , $head=true);
				$res=json_decode($str, true);
				
				if($res["code"]<>"0"){
					echo "章节信息:<br>\r\n";
					print_r($res);	
					echo "<br>\r\n";
					print_r($res);
					echo "<br>\r\n第".$chArryChValue["chapterid"]."章　".trim($chArryChValue["chaptername"])."<br>\r\n";
					echo "添加章节失败，请和系统管理员联系！<br>\r\n";
					echo "错误：".$res["code"];		
					$error=$res["code"];					
					//exit;
				}else{
					$error=0;
					// 上传成功后的后续处理
					echo $chArryChValue["chaptername"]."成功<br />";
				}
				$errNum++;
			}while($error==-20202&&$errNum<5);
		}
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////
// 函数部分

// 1. 提交数据
//*****************************************************************
function curlPostTaDu($url, $port, $data , $head=false) {

	// 整理参数
    while (list($k,$v) = each($data)) {
        $encoded .= ($encoded ? "&" : "");
        $encoded .= ($k)."=".($v);
    }
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded);
	curl_setopt($curl, CURLOPT_HTTPHEADER, 'Content-Type: text/plain');
	// 当服务器不能正常连接塔读服务器时，请尝试使用 CURLOPT_INTERFACE 参数。（双线路设定用联通ip连接塔读服务器）有的电信ip连不到塔读服务器
	// curl_setopt($curl, CURLOPT_INTERFACE, 'eth0');
	curl_setopt($curl, CURLOPT_URL,$url);
	curl_setopt($curl, CURLOPT_PORT,$port);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$line=curl_exec($curl);

	if (curl_errno($curl)) echo '<pre><b>错误:</b><br />'.curl_error($curl);

	curl_close($curl);
    return $line;
}


// 获取内容
function getCont($siteid,$bid,$cid){
	
	$html="";
	$db2 = new DB;
	$sql="select * FROM  jieqi_article_chapter WHERE articleid=".$bid." AND chapterid=".$cid."";
	$db2->query($sql);
	$db2->next_record();
	$isvip = $db2->f(isvip); //1是vip 0不是
	
	if($isvip==1){
		$sql="select * FROM  jieqi_obook_ocontent WHERE ochapterid=".$cid." ORDER BY ochapterid ASC LIMIT 0 , 1";
		$db2->query($sql);
		$db2->next_record();
		$ocontent = $db2->f(ocontent); 
		$html = iconv('GBK', 'UTF-8//IGNORE',$ocontent);
	}else{
		$file_path = "../../files/article/txt/".$siteid."/".$bid."/".$cid.".txt";
		$html = iconv('GBK', 'UTF-8//IGNORE', file_get_contents($file_path));
	}
	
	$db2->free();
	mysql_close($db2);
	if(empty($html)){
		echo "章节前后内容不存在<br />";
	}else{
		echo "章节前后内容".mb_substr($html , 0 , 99)."*****".mb_substr($html , -99)."<br />";
	}
	
	//echo urlencode($html);
	//$html=preg_replace("/\s+/","</p><p>",$html);
	//$html=preg_replace("</p>","",$html,1);
	//$html=str_replace("<>","",$html);
	return urlencode($html);
}

?>
