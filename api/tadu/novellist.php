<?php
/**
*/
error_reporting(0); 
header("Content-type: text/html; charset=utf-8"); 
// 获取书单ID
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

$url="http://www.mianfeidushu.com";
// 模板格式
$LF="\n\r";
$startHtml="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n\r";
$html="<books>\n\r";
$endHtml="</books>";
$nasp="    ";
$nasp1="        ";
$nasp2="            ";



	
// 获取书单ID
$arr=getFiltrationArr();

include("db.php");
$db = new DB;
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

$sql="select * from jieqi_article_article where articleid=".$ids;
$db->query($sql);

// 过滤
for($i=0;$i<$db->num_rows();$i++){
	$db->next_record();
	
	$siteid = $db->f(siteid);
	$articleid = $db->f(articleid);
	$articlename =  iconv('GB2312', 'UTF-8//IGNORE',$db->f(articlename));
	$size = round($db->f(size)/2,0); 
	$fullflag = $db->f(fullflag); 
	$author = iconv('GB2312', 'UTF-8//IGNORE', $db->f(author));
	$isvip = $db->f(isvip)==1?:1; //1是vip 0不是
	$vipchapter =  iconv('GB2312', 'UTF-8//IGNORE',$db->f(vipchapter));
	$tagrows=explode(" ",$db->f(keywords)); //标签
	
	$intro = trim(iconv('GB2312', 'UTF-8//IGNORE',$db->f(intro)));
	$img = $url."/files/article/image/".$siteid."/".$articleid."/".$articleid."s.jpg";
	$lastchapterid=$db->f(lastchapterid); 
	$lastchapter=iconv('GB2312', 'UTF-8//IGNORE',$db->f(lastchapter));
	$lastupdate = $db->f(lastupdate);
	$keywords=iconv('GB2312', 'UTF-8//IGNORE',str_replace(" ",",",$db->f(keywords))); //标签
	ECHO "<a href='".$url."/api/tadu/tadu_php.php?id=".$articleid."'>".$articlename."</a> ID=".$articleid."<BR />";
	
}
$db->free();
mysql_close($db);
// 组合头尾
$html=$startHtml.$html.$endHtml.$LF;




exit;
?>
