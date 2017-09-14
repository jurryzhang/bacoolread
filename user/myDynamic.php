<?php 
/**
 * 用户资料详细信息
 *
 * 查看自己的用户资料
 * 
 * 调用模板：/templates/userdetail.html
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: userdetail.php 332 2009-02-23 09:15:08Z juny $
 */
header('content-type:application/json;charset=utf8'); 
define('JIEQI_MODULE_NAME', 'system');
require_once('../global.php');
$conn=mysql_connect(JIEQI_DB_HOST,JIEQI_DB_USER,JIEQI_DB_PASS) or die('链接失败');mysql_select_db(JIEQI_DB_NAME, $conn);@mysql_query("SET names gbk");//SQL连接
jieqi_checklogin();

include_once(JIEQI_ROOT_PATH.'/class/users.php');
$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
$jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);
if(!$jieqiUsers) jieqi_printfail(LANG_NO_USER);
include_once(JIEQI_ROOT_PATH.'/header.php');

$type = intval($_REQUEST['mid']);
$b = $_REQUEST['CALLBACK'];	
$bg ='("\n\n\t';
$c =$_REQUEST['CALLBACK'].$bg;		
if (empty($_REQUEST['mid'])) {
$cx='';
}
else if ($_REQUEST['mid'] == 'sale'){
$cx="WHERE `actname` = 'buychapter'";
}
else if ($_REQUEST['mid'] == 'reward'){
$cx="WHERE `actname` = 'tip'";
}
else if ($_REQUEST['mid'] == 'goodnum'){
$cx="WHERE `actname` = 'bookcase'";
}
else if ($_REQUEST['mid'] == 'vote'){
$cx="WHERE `actname` = 'poll'";
}
else if ($_REQUEST['mid'] == 'my'){
$cx="WHERE `actname` = 'flower'";
}
function unicode_encode($name)
{
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2)
    {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0)
        {  
            // 两个字节的文字
            $str .= '\u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);
        }
        else
        {
            $str .= $c2;
        }
    }
    return $str;
}
	if (empty($_REQUEST['ajax_request'])) {
		$jieqiTpl->assign('ajax_request', 0);
	}
	else {
		$jieqiTpl->assign('ajax_request', 1);
	}
        $sql3 = mysql_query("SELECT * FROM `jieqi_article_actlog` $cx order by `addtime` desc limit 0,9");
        while($list = mysql_fetch_array($sql3,1)){
            $listdd[] = $list;
        }
        foreach($listdd as $v){
			$rt = jieqi_getsubdir($v[articleid]);
			$uurl=str_replace('',"",jieqi_geturl('article', 'article', $v[articleid]));
			$egoldname = JIEQI_EGOLD_NAME;
			$url = str_replace('',"",JIEQI_URL);
			$userurl = str_replace('',"",jieqi_geturl('system', 'user',$v[uid]));
            
	if($_REQUEST['ajax_request'] > 0){
					if($v[actname] == 'tip'){
				$ec = '打赏了作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》'.$v[actnum].''.$egoldname.'';
			}
           else if($v[actname] == 'poll'){
			    $ec = '给作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》投了1张推荐票。';
			}
           else if($v[actname] == 'bookcase'){
			    $ec = '把作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》放入了书架。';
			}
           else if($v[actname] == 'buychapter'){
			    $ec = '订阅了作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》。';
			}
           else if($v[actname] == 'flower'){
			    $ec = '打赏了作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》'.$v[actnum].'朵鲜花。';
			}
          else if($v[actname] == 'hurry'){
			    $ec = '催更了作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》'.$v[actnum].''.$egoldname.'';
			}
	          //  $log .= ' <dd class=\"fix\">\n     <div class=\"img\"><img src=\"'.$url.'\/avatar.php?uid='.$v[uid].'\" width=\"54\" height=\"50\" \/><span class=\"mask\"><\/span><\/div>\n    <div class=\"info\">\n     <p class=\"txt f_blue4\">\n    <a href=\"'.$userurl.'\" target=\"_blank\" ajaxhover=\"true\" uid=\"'.$v[uid].'\" class=\"pr5\">'.$v[uname].'<\/a>'.$ec.'<\/p>\n    <p class=\"date\">'.date("Y-m-d H:i:s",$v[addtime]).'<\/p>\n   <\/div>\n    <\/dd>\n\t\n\t';	
			//$log .= '   <dd class="fix">\n               <div class="img"><img src="'.$url.'/avatar.php?uid='.$v[uid].'" width="54" height="50" /><span class="mask"></span></div>\n              <div class="info">\n               <p class="txt f_blue4">\n               <a href="'.$userurl.'" target="_blank" ajaxhover="true" uid="'.$v[uid].'" class="pr5">'.$v[uname].'</a>'.$ec.'</p>\n               <p class="date">'.date("Y-m-d H:i:s",$v[addtime]).'</p>\n   </div>\n               </dd>\n\t\n\t';	  
			$log .= '   <dd class="fix">\n              <div class="img"><img src="'.$url.'/avatar.php?uid='.$v[uid].'" width="54" height="50" /><span class="mask"></span></div>\n              <div class="info">\n               <p class="txt f_blue4">\n                 <a href="'.$userurl.'" target="_blank" ajaxhover="true" uid="'.$v[uid].'" class="pr5">'.$v[uname].'</a>'.$ec.'\n               </p>\n               <p class="date">'.date("Y-m-d H:i:s",$v[addtime]).'</p>\n              </div>\n             </dd>\n\t\n\t';	
			$name=iconv('GBK', 'UTF-8', $log);
			$logs=json_encode($name);
            $logs = str_replace('\n',"n",$logs);
			$logs = str_replace('\t',"t",$logs);
			$logs = str_replace('"   <dd class=\"fix\">','   <dd class=\"fix\">',$logs);
			$logs = str_replace('\n\t\n\t"',"",$logs);
			$logs=$logs;
			
		 }
	else {
					if($v[actname] == 'tip'){
				$ec = '打赏了作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》'.$v[actnum].''.$egoldname.'';
			}
           else if($v[actname] == 'poll'){
			    $ec = '给作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》投了1张推荐票。';
			}
           else if($v[actname] == 'bookcase'){
			    $ec = '把作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》放入了书架。';
			}
           else if($v[actname] == 'buychapter'){
			    $ec = '订阅了作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》。';
			}
           else if($v[actname] == 'flower'){
			    $ec = '打赏了作品《<a href="'.$uurl.'" target="_blank">'.$v[articlename].'</a>》'.$v[actnum].'朵鲜花。';
			}
            $logs .= '
	        <dd class="fix">
              <div class="img"><img src="'.$url.'/avatar.php?uid='.$v[uid].'" width="54" height="50" /><span class="mask"></span></div>
              <div class="info">
               <p class="txt f_blue4">
              <a href="'.$userurl.'" target="_blank" ajaxhover="true" uid="'.$v[uid].'" class="pr5">'.$v[uname].'</a>'.$ec.'
               </p>
               <p class="date">'.date("Y-m-d H:i:s",$v[addtime]).'</p>
              </div>
             </dd>			
			';
 
 }

}
        $jieqiTpl->assign( "logs", $logs );	
	$jieqiTpl->setCaching(0);
$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
$jieqiTpl->assign('c', $c);
$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch(JIEQI_ROOT_PATH.'/user/templates/myDynamic.html'));
//$jieqiTset['jieqi_page_template'] = JIEQI_ROOT_PATH.'/user/templates/myDynamic.html';
include_once(JIEQI_ROOT_PATH.'/footer.php');

?>