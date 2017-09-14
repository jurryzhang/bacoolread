<?php

echo "<meta charset='utf-8' />";
//判斷是否輸入密碼
$pass = isset($_POST['password'])?$_POST['password']:"";
if($pass==="mianfeidushu131897"){echo "已登录<br/>";}else{echo "密码错误<a href='txt.html'>重新上传</a>";die;}


//判斷是否有非法字符
	 
$dir = "./shudan";
$arr = array();
if (is_dir($dir)) {
	if ($dh = opendir($dir)) {
		while (($file = readdir($dh)) != false) {
			$arr[]= $file;

		}
		closedir($dh);
	}
}

foreach($arr as $v){
	if(isset($_POST[$v])){	
		 $str = $_POST[$v];
	
		if (!preg_match("/[0-9,]/", $str)){
		 	echo "有非法字符,上传失败!<a href='txt.html'>重新上传</a>";
		 	die();
		}
	 	echo '<br/>';
		 $strf=substr($str,0,1);
		 $strl=substr($str,-1);
		 if($strf!=","||$strl==","){
		 	echo "输入格式错误。以英文“，”开头，结尾不用加“，”。<a href='txt.html'>重新上传</a>";
		 	die;}
		
		 $filename="./shudan/".$v."/novel.txt";
		 $ltext=file_put_contents($filename,$str);
	 
		 if($ltext==0){
		 	echo $v."上传失败!<a href='txt.html'>重新上传</a>";die();
		 }else{
		 	echo $v."上传成功<hr/>";	
			echo "<a href='txt.html'>继续上传</a>    <a href='shudan/txt/createtxt.php'>生成txt文本</a>"; 
		 }	
	}
}



?>
