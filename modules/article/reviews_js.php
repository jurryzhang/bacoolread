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
if (empty($_REQUEST['aid']) || !is_numeric($_REQUEST['aid']))
{
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$conn = mysql_connect(JIEQI_DB_HOST,JIEQI_DB_USER,JIEQI_DB_PASS) or die('链接失败');mysql_select_db(JIEQI_DB_NAME, $conn);@mysql_query("SET names gbk");//SQL连接
//jieqi_checklogin();

include_once(JIEQI_ROOT_PATH.'/class/users.php');
$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
$jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);
//if(!$jieqiUsers) jieqi_printfail(LANG_NO_USER);
include_once(JIEQI_ROOT_PATH.'/header.php');

$type      = intval($_REQUEST['mid']);
$b         = $_REQUEST['CALLBACK'];
$bg        = '("';
$c         = $_REQUEST['CALLBACK'];
//$page    = intval($_REQUEST["page"]);
@$page     = max(1, intval($_REQUEST["page"]));
$aid       = $_REQUEST['aid'];
$result    = mysql_query("SELECT * FROM `jieqi_article_reviews` WHERE `ownerid` = $aid");
$num        = mysql_num_rows($result);//总记录数
$pagesize   = 10;
$pagenum    = ceil($num / $pagesize);
$startindex = ($page - 1) * $pagesize;

if($page <= 1)
{
	$pages = 1;
}
if($page < $pagenum)
{
	$pages = 1;
}
else if($page == $pagenum)
{
	$pages = 0;
}
else if($page > $pagenum)
{
	$pages = 0;
}

$jieqiTpl->assign( "pages", $pages);
$jieqiTpl->assign( "page", $page);
$jieqiTpl->assign( "pagenum", $pagenum);

if (empty($_REQUEST['ajax_request']))
{
	$jieqiTpl->assign('ajax_request', 0);
}
else
{
	$jieqiTpl->assign('ajax_request', 1);
}

//echo '<br><br>$page = ';
//
//var_dump($page);
//
//echo '<br><br>';
//
//echo '<br><br>$pagenum = ';
//
//var_dump($pagenum);
//
//echo '<br><br>';

if($page <= $pagenum )
{
	$sql = "SELECT * FROM `jieqi_article_reviews` WHERE `ownerid` = $aid order by `posttime` desc limit $startindex,$pagesize";
	
	$sql3 = mysql_query($sql);
	
	while($list = mysql_fetch_array($sql3,1))
	{
		$listdd[] = $list;
	}
	
	foreach($listdd as $v)
	{
		$rt        = jieqi_getsubdir($v[articleid]);
		$uurl      = str_replace('',"",jieqi_geturl('article', 'article', $v[articleid]));
		$egoldname = JIEQI_EGOLD_NAME;
		$url       = str_replace('',"",JIEQI_URL);
		$userurl   = str_replace('',"",jieqi_geturl('system', 'user',$v[posterid]));
		
		//VIP徽章
		include_once(JIEQI_ROOT_PATH.'/class/users.php');
		$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
		$jieqiUsers    = $users_handler->get($v[posterid]);
		
		if($jieqiUsers)
		{
			jieqi_getconfigs('system', 'vips');
			$vipid  = jieqi_getvipid($jieqiUsers->getVar('expenses'), $jieqiVips);
			$vipurl = JIEQI_URL.'/files/badge/image/3/0/'.$vipid.'.png';
			$re     = mysql_query("SELECT * FROM `jieqi_article_replies` WHERE `topicid`= $v[topicid] AND `istopic`= 1");
			$ret    = mysql_fetch_array($re);
			$re     = $ret['posttext'];
			
			if ($ret['posttext'] !== false)
			{
				if ($enableubb)
				{
					if (!is_object($jieqiTxtcvt))
					{
						include_once JIEQI_ROOT_PATH . '/lib/text/textconvert.php';
						$jieqiTxtcvt = TextConvert::getInstance('TextConvert');
					}
					
					$ret['posttext'] = $jieqiTxtcvt->displayTarea($ret['posttext'], 0, 1, 1, 1, 1);
				}
				else
				{
					if (!is_object($jieqiTxtcvt))
					{
						include_once JIEQI_ROOT_PATH . '/lib/text/textconvert.php';
						$jieqiTxtcvt = TextConvert::getInstance('TextConvert');
					}
					
					$ret['posttext'] = jieqi_htmlstr(preg_replace(array('/\\[\\/?(code|url|color|font|align|email|b|i|u|d|img|quote|size)[^\\[\\]]*\\]/is'), '', $ret['posttext']));
					
					$ret['posttext'] = $jieqiTxtcvt->smile(preg_replace('/https?:\\/\\/[^\\s\\r\\n\\t\\f<>]+/i', '<a href="\\0">\\0</a>', $ret['posttext']));
				}
			}
			
			if($_REQUEST['ajax_request'] > 0)
			{
				$log .= '
<dd class="clearfix">
    <div class="img"><a href="'.$userurl.'" target="_blank">
    	<img src="'.$url.'/avatar.php?uid='.$v[posterid].'"/>
    </a><a href="'.$userurl.'" class="rk1" title="'.$v[replier].'"></a></div>
    <div class="comm">
     <div class="tt">
      <span class="path3"><a href="'.$userurl.'" target="_blank" class="f-green" ajaxhover="true" uid="51400">'.$jieqiUsers->getVar('name').'</a><img src="'.$vipurl.'"/>发表了评论</span>
     </div>         
     <p class="txt">'.$ret['posttext'].'</p>
     <div class="ope f-green">'.date("Y-m-d H:i:s",$v[posttime]).'<a href="javascript:void(0);" onclick="return showReplies(this,'.$url.'/showReplies/?aid='.$v[ownerid].'&rid='.$v[topicid].'&page=&method=showReplies&display=)" id="'.$v[topicid].'" >回复[<span id="'.$v[topicid].'span">'.$v[replies].'</span>]</a></div>
     <div class="reply dn" id="show'.$v[topicid].'"></div>
    </div>
   </dd>
   ';
				$name=iconv('GBK', 'UTF-8', $log);
				$logs=json_encode($name);
				// $logs = str_replace('\n',"n",$logs);
				//$logs = str_replace('\t',"t",$logs);
				$logs = str_replace('"\r\n<dd class=\"clearfix\">','\r\n<dd class=\"clearfix\">',$logs);
				$logs = str_replace('this,',"this,'",$logs);
				$logs = str_replace('showReplies&display=',"showReplies&display='",$logs);
				$logs = str_replace("''","'",$logs);
				$logs = str_replace('\r\n   "','\r\n',$logs);
				$logs = $logs;
			}
			else
			{
				$logs .= '
	           <li class="clearfix">
                            <div class="li-left">
                                <span><img src="'.$url.'/avatar.php?uid='.$v[posterid].'" alt=""/></span>
                                <p>'.$v[replier].'</p>
                                <div class="book-rank"><img src="'.$vipurl.'" width="60" height="24" /></div>
                            </div>
                            <div class="li-right">
                                <div class="right-tit-header clearfix">
                                    <span>'.$v[title].'</span>
                                    <i>'.date("Y-m-d H:i:s",$v[posttime]).'</i>
                                </div>
                                <p>'.$row['subject'].'</p>
                                <div class="clearfix">
                                    <div class="reply-show js-reply-show"><a href="javascript:void(0);" onclick="return showReplies(this,'.$url.'/modules/article/showajax.php?aid='.$v[ownerid].'&rid='.$v[topicid].'&page=&method=showReplies&display=)" id="'.$v[topicid].'" ><span class="on"></span>（<b id="'.$v[topicid].'span">'.$v[replies].'</b>）</a></div>
                                </div>
								<div class="reply dn" id="show'.$v[topicid].'"></div>
                            </div>
                        </li>';
				$logs = str_replace('this,',"this,'",$logs);
				$logs = str_replace('showReplies&display=',"showReplies&display='",$logs);
				$logs = str_replace("''","'",$logs);
				$logs=$logs;
			}
		}
	}
}
else
{
}

$jieqiTpl->assign( "logs", $logs );
$jieqiTpl->setCaching(0);
$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
$jieqiTpl->assign('c', $c);
$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['article']['path'] . '/templates/reviews_js.html'));
//$jieqiTset['jieqi_page_template'] = JIEQI_ROOT_PATH . '/modules/article/templates/reviews_js.html';
include_once(JIEQI_ROOT_PATH.'/footer.php');

?>