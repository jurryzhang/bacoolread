<?php
$apikey = 'C7dzxte6PjFTVYxCzKJtRTasA';

define('JIEQI_MODULE_NAME', 'article');  //定义程序所属模块
define('JIEQI_CHAR_SET', 'utf-8');  //本接口需要转换成utf-8编码输出
define('JIEQI_CHARSET_CONVERT', 0);  //其他页面不需要转换
require_once ('../../global.php');  //包含通用预处理程序
define('JIEQI_NOCONVERT_CHAR', '1');  //生成的url网址不考虑编码转换的情况

$pagerows = 500000; //每页输出几条记录
//if($_GET['apikey'] == $apikey){
$filepath = !empty($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : !empty($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/api/baidu_sitemap.php'; //本程序的地址和名称
$indexstyle = 'info'; //默认小说首页，信息页设置成：'info'，目录页设置成：'index'

//载入数据库
jieqi_includedb();
$query_handler = jieqiqueryhandler::getinstance("JieqiQueryHandler");
//输出全部作品还是几个小时内有更新的作品
$_GET['update'] = (empty($_GET['update']) || intval($_GET['update']) <= 0) ? 0 : intval($_GET['update']);
$_GET['page'] = (empty($_GET['page']) || intval($_GET['page']) <= 0) ? 0 : intval($_GET['page']);
//$where = $_GET['update'] > 0 ? 'lastupdate > ' . (time() - 3600 * $_GET['update']) . 'ORDER BY lastupdate DESC' : '1 ORDER BY articleid ASC';

header("Content-type: text/xml");
	//输出某一页小说列表
	include_once($jieqiModules['article']['path'] . '/include/funurl.php');
	//$sql = "SELECT * FROM " . jieqi_dbprefix('article_article') . " WHERE " . $where . " LIMIT " . (($_GET['page'] - 1) * $pagerows) . ", " . $pagerows;
	$query = $query_handler->db->query("SELECT * FROM " . jieqi_dbprefix('article_article') . " WHERE  shenma = 1 AND articleid= ".$_GET['id'] );
	$upinfo = $query_handler->getobject($query);
if($upinfo){
	echo '<?xml version="1.0" encoding="UTF-8"?>
<data><vol>';
$item['id'] = $upinfo->getvar("articleid");
if(empty($_REQUEST['id'])) jieqi_printfail(LANG_ERROR_PARAMETER);
jieqi_loadlang('manage', JIEQI_MODULE_NAME);
include_once($jieqiModules['article']['path'].'/class/article.php');
$article_handler =& JieqiArticleHandler::getInstance('JieqiArticleHandler');
$article=$article_handler->get($_REQUEST['id']);
//包含区块参数
jieqi_getconfigs('article', 'authorblocks', 'jieqiBlocks');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'sort');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
include_once(JIEQI_ROOT_PATH.'/header.php');
$article_static_url = (empty($jieqiConfigs['article']['staticurl'])) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl'];
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl'])) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl'];
$jieqiTpl->assign('article_static_url',$article_static_url);
$jieqiTpl->assign('article_dynamic_url',$article_dynamic_url);

//章节属性
include_once($jieqiModules['article']['path'].'/class/chapter.php');
$chapter_handler =& JieqiChapterHandler::getInstance('JieqiChapterHandler');
$criteria=new CriteriaCompo(new Criteria('articleid', $_REQUEST['id'], '='));
$criteria->setSort('chapterorder');
$criteria->setOrder('ASC');
$chapter_handler->queryObjects($criteria);
$i=0;
$chapterrows=array();
$k=0;
while($chapter = $chapter_handler->getObject()){
	$chapterrows['chapterid'] = $chapter->getVar('chapterid');
	$chapterrows['chaptertype'] = $chapter->getVar('chaptertype');
	$chapterrows['isvip'] = $chapter->getVar('isvip');
	$txt = $chapter->getVar('chaptername');
	$txtcontent=$txt;
	$txtcontent=str_replace('&nbsp;&nbsp;',' ',$txtcontent);
	$order=array("\r\n","\n","\r","\t");   
	$chapterrows['chaptername']=str_replace($order,$replace,$txtcontent);
	$chapterrows['chapterorder'] = $chapter->getVar('chapterorder');
	$chapterrows['volumeid'] = $chapter->getVar('volumeid');
	$chapterrows['lastupdate'] = date('Y-m-d G:i:s',$chapter->getVar('lastupdate'));
	$k++;

if($k == 1 && $chapterrows['chaptertype'] == 0){
	echo "
	<volumename><![CDATA[正文]]></volumename>";
	}
if($chapterrows['chaptertype'] == 1){
	echo "
<volumename><![CDATA[正文]]></volumename>
";
}else{
if($chapterrows['isvip'] == 1){
echo "
<chaptername><![CDATA[{$chapterrows['chaptername']}]]></chaptername>
<chapterid><![CDATA[{$chapterrows['chapterid']}]]></chapterid>
 <license><![CDATA[{$chapterrows['isvip']}]]></license>                
";	
}else{	
echo "
<chaptername><![CDATA[{$chapterrows['chaptername']}]]></chaptername>
<chapterid><![CDATA[{$chapterrows['chapterid']}]]></chapterid>
 <license><![CDATA[{$chapterrows['isvip']}]]></license>                
";	
}
}

}	
	echo '
</vol></data>';
}else{
echo '<?xml version="1.0" encoding="UTF-8"?>
<error/>
';
}
/*}else{
echo '<?xml version="1.0" encoding="UTF-8"?>
<error/>
';
}*/
//转换成xml内容
function jieqi_apis_xmltext($text){
	$entities = array("&" => "&amp;", "<" => "&lt;", ">" => "&gt;", "'" => "&apos;", '"' => "&quot;");
	$text = strtr($text, $entities);
	$text = preg_replace("/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/", '', $text);
	return $text;
}
//生成小说首页地址，$type参数：'info'-返回信息页，'index'-返回目录页，'full'-返回全文阅读页
function jieqi_url_article($aid, $type = '', $acode = ''){
	global $jieqiConfigs;
	global $article_dynamic_url;
	global $article_static_url;
	
	if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
	if(empty($acode)) $acode = $aid;
	switch($type){
		case 'index':
			//使用url_rewrite
			if(!empty($jieqiConfigs['article']['fakearticle']) || (!empty($jieqiConfigs['article']['htmlurl']) && strpos($jieqiConfigs['article']['htmlurl'], '<{$aid}>') != false)){
				if(empty($jieqiConfigs['article']['fakearticle'])) $jieqiConfigs['article']['fakearticle'] = $jieqiConfigs['article']['htmlurl'];
				if($jieqiConfigs['article']['makehtml'] > 0 && JIEQI_CHAR_SET != JIEQI_SYSTEM_CHARSET && !defined('JIEQI_NOCONVERT_CHAR') && strpos($jieqiConfigs['article']['fakearticle'], '<{$newset}>') === false){
					return $article_static_url . '/reader.php?aid=' . $aid;
				}else{
					if(JIEQI_CHAR_SET != JIEQI_SYSTEM_CHARSET && !defined('JIEQI_NOCONVERT_CHAR')) $newset = JIEQI_CHAR_SET;
					else $newset = '';
					$repfrom = array(
							'<{$jieqi_url}>',
							'<{$aid}>',
							'<{$aid|subdirectory}>',
							'<{$acode}>',
							'<{$newset}>'
					);
					$repto = array(
							JIEQI_URL,
							$aid,
							jieqi_getsubdir($aid),
							$acode,
							$newset
					);
					$ret = str_replace($repfrom, $repto, $jieqiConfigs['article']['fakearticle']);
					if(substr($ret, 0, 4) != 'http') $ret = JIEQI_URL . $ret;
					return $ret;
				}
			}elseif($jieqiConfigs['article']['makehtml'] == 0 || (JIEQI_CHAR_SET != JIEQI_SYSTEM_CHARSET && !defined('JIEQI_NOCONVERT_CHAR'))){
				return $article_static_url . '/reader.php?aid=' . $aid;
			}else{
				return jieqi_uploadurl($jieqiConfigs['article']['htmldir'], $jieqiConfigs['article']['htmlurl'], 'article', $article_static_url) . jieqi_getsubdir($aid) . '/' . $aid . '/index' . $jieqiConfigs['article']['htmlfile'];
			}
			break;
		case 'full':
			if($jieqiConfigs['article']['makefull'] == 0 || (JIEQI_CHAR_SET != JIEQI_SYSTEM_CHARSET && !defined('JIEQI_NOCONVERT_CHAR'))){
				$ret = $article_static_url . '/reader.php?aid=' . $aid;
			}else{
				$ret = jieqi_uploadurl($jieqiConfigs['article']['fulldir'], $jieqiConfigs['article']['fullurl'], 'article', $article_static_url) . jieqi_getsubdir($aid) . '/' . $aid . $jieqiConfigs['article']['htmlfile'];
			}
			return $ret;
			break;
		case 'info':
		default:
			if(!empty($jieqiConfigs['article']['fakeinfo'])){
				$repfrom = array(
						'<{$jieqi_url}>',
						'<{$id|subdirectory}>',
						'<{$id}>',
						'<{$acode}>'
				);
				$repto = array(
						JIEQI_URL,
						jieqi_getsubdir($aid),
						$aid,
						$acode
				);
				$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['article']['fakeinfo']));
				if(substr($ret, 0, 4) != 'http') $ret = JIEQI_URL . $ret;
				return $ret;
			}else{
				return $article_dynamic_url . '/articleinfo.php?id=' . $aid;
			}
			break;
	}
}
//生成章节页地址
function jieqi_url_chapter($cid, $aid, $isvip = 0, $acode = ''){
	global $jieqiConfigs;
	global $jieqiModules;
	global $article_dynamic_url;
	global $article_static_url;
	if($isvip > 0){
		if(!isset($jieqiConfigs['obook'])) jieqi_getconfigs('obook', 'configs', 'jieqiConfigs');
		return $jieqiModules['obook']['url'] . '/reader.php?cid=' . $cid . '&aid=' . $aid;
	}
	if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
	if(empty($acode)) $acode = $aid;
	//使用url_rewrite
	if(!empty($jieqiConfigs['article']['fakechapter']) || (!empty($jieqiConfigs['article']['htmlurl']) && strpos($jieqiConfigs['article']['htmlurl'], '<{$aid}>') != false)){
		if(empty($jieqiConfigs['article']['fakechapter'])){
			$jieqiConfigs['article']['fakechapter'] = $jieqiConfigs['article']['htmlurl'];
			if(strpos($jieqiConfigs['article']['fakechapter'], '<{$cid}>') === false){
				$jieqiConfigs['article']['fakechapter'] = str_replace(array(
						'index',
						$jieqiConfigs['article']['htmlfile']
				), '', $jieqiConfigs['article']['fakechapter']);
				if(substr($jieqiConfigs['article']['fakechapter'], -1) != '/') $jieqiConfigs['article']['fakechapter'] .= '/';
				$jieqiConfigs['article']['fakechapter'] .= '<{$cid}>' . $jieqiConfigs['article']['htmlfile'];
			}
		}
		if($jieqiConfigs['article']['makehtml'] > 0 && JIEQI_CHAR_SET != JIEQI_SYSTEM_CHARSET && !defined('JIEQI_NOCONVERT_CHAR') && strpos($jieqiConfigs['article']['fakechapter'], '<{$newset}>') === false){
			return $article_static_url . '/reader.php?aid=' . $aid . '&cid=' . $cid;
		}else{
			if(JIEQI_CHAR_SET != JIEQI_SYSTEM_CHARSET && !defined('JIEQI_NOCONVERT_CHAR')) $newset = JIEQI_CHAR_SET;
			else $newset = '';
			$repfrom = array(
					'<{$jieqi_url}>',
					'<{$aid}>',
					'<{$cid}>',
					'<{$aid|subdirectory}>',
					'<{$cid|subdirectory}>',
					'<{$acode}>',
					'<{$newset}>'
			);
			$repto = array(
					JIEQI_URL,
					$aid,
					$cid,
					jieqi_getsubdir($aid),
					jieqi_getsubdir($cid),
					$acode,
					$newset
			);
			$ret = str_replace($repfrom, $repto, $jieqiConfigs['article']['fakechapter']);
			if(substr($ret, 0, 4) != 'http') $ret = JIEQI_URL . $ret;
			return $ret;
		}
	}elseif($jieqiConfigs['article']['makehtml'] == 0 || (JIEQI_CHAR_SET != JIEQI_SYSTEM_CHARSET && !defined('JIEQI_NOCONVERT_CHAR'))){
		return $article_static_url . '/reader.php?aid=' . $aid . '&cid=' . $cid;
	}else{
		return jieqi_uploadurl($jieqiConfigs['article']['htmldir'], $jieqiConfigs['article']['htmlurl'], 'article', $article_static_url) . jieqi_getsubdir($aid) . '/' . $aid . '/' . $cid . $jieqiConfigs['article']['htmlfile'];
	}
}
//生成小说封面地址
function jieqi_url_cover($aid, $type = 's', $flag = -1){
	global $jieqiConfigs;
	global $article_dynamic_url;
	global $article_static_url;
	$nocover = $article_static_url . '/images/nocover.jpg';
	if($flag < 0){
		global $article;
		if(!is_a($article, 'JieqiArticle')){
			include_once ($GLOBALS['jieqiModules']['article']['path'] . '/class/article.php');
			$article_handler = & JieqiArticleHandler::getInstance('JieqiArticleHandler');
			$article = $article_handler->get($aid);
			if(is_object($article)) $flag = $article->getVar('imgflag', 'n');
		}
	}
	$flag = intval($flag);
	if($flag <= 0) return $nocover;
	
	$imageinfo = array(
			'stype' => '',
			'ltype' => ''
	);
	if(($flag & 1) > 0) $imageinfo['stype'] = $jieqiConfigs['article']['imagetype'];
	if(($flag & 2) > 0) $imageinfo['ltype'] = $jieqiConfigs['article']['imagetype'];
	$imgtype = $flag >> 2;
	if($imgtype > 0){
		$imgtary = array(
				1 => '.gif',
				2 => '.jpg',
				3 => '.jpeg',
				4 => '.png',
				5 => '.bmp'
		);
		$tmpvar = round($imgtype & 7);
		if(isset($imgtary[$tmpvar])) $imageinfo['stype'] = $imgtary[$tmpvar];
		$tmpvar = round($imgtype >> 3);
		if(isset($imgtary[$tmpvar])) $imageinfo['ltype'] = $imgtary[$tmpvar];
	}
	
	switch($type){
		case 'l':
			if(!empty($imageinfo['ltype'])){
				return jieqi_uploadurl($jieqiConfigs['article']['imagedir'], $jieqiConfigs['article']['imageurl'], 'article', $article_static_url) . jieqi_getsubdir($aid) . '/' . $aid . '/' . $aid . 'l' . $imageinfo['ltype'];
			}elseif(!empty($imageinfo['stype'])){
				return jieqi_uploadurl($jieqiConfigs['article']['imagedir'], $jieqiConfigs['article']['imageurl'], 'article', $article_static_url) . jieqi_getsubdir($aid) . '/' . $aid . '/' . $aid . 's' . $imageinfo['stype'];
			}else{
				return '';
			}
			break;
		case 's':
		default:
			if(!empty($imageinfo['stype'])){
				return jieqi_uploadurl($jieqiConfigs['article']['imagedir'], $jieqiConfigs['article']['imageurl'], 'article', $article_static_url) . jieqi_getsubdir($aid) . '/' . $aid . '/' . $aid . 's' . $imageinfo['stype'];
			}else{
				return $nocover;
			}
			break;
	}
}
?>