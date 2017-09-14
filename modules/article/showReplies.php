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
define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';
if (empty($_REQUEST['rid']) || !is_numeric($_REQUEST['rid'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}
$conn=mysql_connect(JIEQI_DB_HOST,JIEQI_DB_USER,JIEQI_DB_PASS) or die('链接失败');mysql_select_db(JIEQI_DB_NAME, $conn);@mysql_query("SET names gbk");//SQL连接

include_once(JIEQI_ROOT_PATH.'/header.php');

$type = intval($_REQUEST['mid']);
$b = $_REQUEST['CALLBACK'];	
$bg ='("';
$c =$_REQUEST['CALLBACK'];	
$aid=$_REQUEST['aid'];
$rid=$_REQUEST['rid'];
$jieqiTpl->assign( "aid", $aid );
$jieqiTpl->assign( "rid", $rid );
//$page = intval($_REQUEST["page"]);
@$page = max(1, intval($_REQUEST["page"]));
$aid=$_REQUEST['aid'];
$result = mysql_query("SELECT * FROM `jieqi_article_reviews` WHERE `ownerid` = $aid"); 
$num = mysql_num_rows($result);//总记录数 
$pagesize=10;
$pagenum=ceil($num/$pagesize);
$startindex=($page-1)*$pagesize;
if($page<=1){
$pages=1;
}
if($page < $pagenum){
$pages=1;
}
else if($page == $pagenum){
$pages=0;
}
else if($page > $pagenum){
$pages=0;
}
$jieqiTpl->assign( "pages", $pages );	
$jieqiTpl->assign( "page", $page );
$jieqiTpl->assign( "pagenum", $pagenum );


$url = str_replace('',"",JIEQI_URL);
	if (empty($_REQUEST['ajax_request'])) {
		$jieqiTpl->assign('ajax_request', 0);
	}
	else {
		$jieqiTpl->assign('ajax_request', 1);
	}
	if($page <= $pagenum ){
		
        $sql3 = mysql_query("SELECT * FROM `jieqi_article_replies` WHERE `topicid`= $rid AND `ownerid` = $aid AND `istopic`= 0 order by `posttime` desc");
        while($list = mysql_fetch_array($sql3,1)){
            $listdd[] = $list;
        }
		
        foreach((array)$listdd as $v){
			$rt = jieqi_getsubdir($v[articleid]);
			$uurl=str_replace('',"",jieqi_geturl('article', 'article', $v[articleid]));
			$egoldname = JIEQI_EGOLD_NAME;
			$userurl = str_replace('',"",jieqi_geturl('system', 'user',$v[posterid]));
			//VIP徽章
			include_once(JIEQI_ROOT_PATH.'/class/users.php');
            $users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
            $jieqiUsers = $users_handler->get($v[posterid]);
			jieqi_getconfigs('system', 'vips');
			$vipid=jieqi_getvipid($jieqiUsers->getVar('expenses'), $jieqiVips);
			$vipurl = '/files/badge/image/3/0/'.$vipid.'.png';  
            	if ($v['posttext'] !== false) {
		if ($enableubb) {
			if (!is_object($jieqiTxtcvt)) {
				include_once JIEQI_ROOT_PATH . '/lib/text/textconvert.php';
				$jieqiTxtcvt = TextConvert::getInstance('TextConvert');
			}

			$v['posttext'] = $jieqiTxtcvt->displayTarea($v['posttext'], 0, 1, 1, 1, 1);
		}
		else {
			if (!is_object($jieqiTxtcvt)) {
				include_once JIEQI_ROOT_PATH . '/lib/text/textconvert.php';
				$jieqiTxtcvt = TextConvert::getInstance('TextConvert');
			}

			$v['posttext'] = jieqi_htmlstr(preg_replace(array('/\\[\\/?(code|url|color|font|align|email|b|i|u|d|img|quote|size)[^\\[\\]]*\\]/is'), '', $v['posttext']));
			$v['posttext'] = $jieqiTxtcvt->smile(preg_replace('/https?:\\/\\/[^\\s\\r\\n\\t\\f<>]+/i', '<a href="\\0">\\0</a>', $v['posttext']));
		}
	}
	
	if($_REQUEST['ajax_request'] > 0){
			$log .= '
      <dl class="list_comm2 pl15">
      	
           <dd class="clearfix">
            <p class="txt"><a href="'.$userurl.'" class="lev f-green" ajaxhover="true" uid="'.$v[posterid].'">'.$v[poster].'</a><img src="'.$vipurl.'"/>：'.$v['posttext'].'</p>
            <div class="ope f-green"><em class="date">'.date("Y-m-d H:i:s",$v[posttime]).'</em></div>
           </dd>
      	
      </dl>
   ';	
			$name=iconv('GBK', 'UTF-8', $log);
			$logs=json_encode($name);
           // $logs = str_replace('\n',"n",$logs);
			//$logs = str_replace('\t',"t",$logs);
			$logs = str_replace('"\r\n','\r\n',$logs);
 			//$logs = str_replace('this,',"this,'",$logs);
			//$logs = str_replace('showReplies&display=',"showReplies&display='",$logs);
			$logs = str_replace("''","'",$logs);
			$logs = str_replace('\r\n   "','\r\n',$logs);
			$logs=$logs;
			
		 }
	else {
            $logs .= '
	           
			';
 			$logs = str_replace('this,',"this,'",$logs);
			$logs = str_replace('showReplies&display=',"showReplies&display='",$logs);
			$logs = str_replace("''","'",$logs);
			$logs=$logs;
 }
}
 }
	else{
}
        $jieqiTpl->assign( "logs", $logs );	
	$jieqiTpl->setCaching(0);
$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
$jieqiTpl->assign('c', $c);
$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['article']['path'] . '/templates/showReplies.html'));
//$jieqiTset['jieqi_page_template'] = JIEQI_ROOT_PATH.'/user/templates/myDynamic.html';
include_once(JIEQI_ROOT_PATH.'/footer.php');

?>