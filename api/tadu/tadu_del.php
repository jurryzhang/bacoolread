<?php

//////////////////////////////////////////////////////////////////////////////////////////////
error_reporting(0); 
set_time_limit(0);

$id=$_GET['id']; 
$url="http://www.mianfeidushu.com";

// 变量处理部分
// 1. 常量定义
define('sysCPIdTest',false);										// 测试开关  true:测试接口		false:正式接口
define('sysCPCopyrighted',227);									// copyrightid

if(sysCPIdTest){
	// 测试接口调用参数
	define('sysPostUrl',"topenapi.tadu.com");					// url 
	define('sysCPSecre',"b912d5ce2dfab8e323d0366a997b2122");	// secre
	define('sysCPPort',8098);									// port
}else{
	// 正式接口调用参数
	define('sysPostUrl',"http://openapi.tadu.com");				// url 
	define('sysCPSecre',"eb3b82a5447dbe0bd14ffe2742dd2d27");	// secre
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
if(!empty($id)){
	$data_del="";
	$data_del["key"]=sha1(sysCPCopyrighted.sysCPSecre);
	$data_del["cpid"]=$id;
	$data_del["copyrightid"]=sysCPCopyrighted;
	$str_del=curlPostTaDu(sysPostUrl."/api/deleteBook", sysCPPort,$data_del);
	
	$ret_del=json_decode($str_del, true);
	echo json_encode($ret_del);	
	
	if($ret_del["code"]==0){
		echo "删除成功";
	}else{
		echo "删除失败:".$ret_del["message"];
	}
}else{
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]!=""){
			$data_del="";
			$data_del["key"]=sha1(sysCPCopyrighted.sysCPSecre);
			$data_del["cpid"]=$arr[$i];
			$data_del["copyrightid"]=sysCPCopyrighted;
			$str_del=curlPostTaDu(sysPostUrl."/api/deleteBook", sysCPPort,$data_del);
			
			$ret_del=json_decode($str_del, true);
			echo json_encode($ret_del);	
			
			if($ret_del["code"]==0){
				echo "-----".$arr[$i]."-----删除成功</br>";
			}else{
				echo "-----".$arr[$i]."-----删除失败:".$ret_del["message"]."</br>";
			}
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



?>
