<?php
$apikey = 'C7dzxte6PjFTVYxCzKJtRTasA';


define('JIEQI_MODULE_NAME', 'article');  //�����������ģ��
define('JIEQI_CHAR_SET', 'utf-8');  //���ӿ���Ҫת����utf-8�������
define('JIEQI_CHARSET_CONVERT', 0);  //����ҳ�治��Ҫת��
require_once ('../../global.php');  //����ͨ��Ԥ�������
define('JIEQI_NOCONVERT_CHAR', '1');  //���ɵ�url��ַ�����Ǳ���ת�������
//if($_GET['apikey'] == $apikey){
$pagerows = 500000; //ÿҳ���������¼

$filepath = !empty($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : !empty($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/api/baidu_sitemap.php'; //������ĵ�ַ������
$indexstyle = 'info'; //Ĭ��С˵��ҳ����Ϣҳ���óɣ�'info'��Ŀ¼ҳ���óɣ�'index'

//�������ݿ�
jieqi_includedb();
$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
//���ȫ����Ʒ���Ǽ���Сʱ���и��µ���Ʒ
$_GET['update'] = (empty($_GET['update']) || intval($_GET['update']) <= 0) ? 0 : intval($_GET['update']);
$_GET['page'] = (empty($_GET['page']) || intval($_GET['page']) <= 0) ? 0 : intval($_GET['page']);
//$where = $_GET['update'] > 0 ? 'lastupdate > ' . (time() - 3600 * $_GET['update']) . 'ORDER BY lastupdate DESC' : '1 ORDER BY articleid ASC';

header("Content-type: text/xml");

	//���ĳһҳС˵�б�
	include_once($jieqiModules['article']['path'] . '/include/funurl.php');
	//$sql = "SELECT * FROM " . jieqi_dbprefix('article_article') . " WHERE " . $where . " LIMIT " . (($_GET['page'] - 1) * $pagerows) . ", " . $pagerows;
	$sql = "SELECT * FROM " . jieqi_dbprefix('article_article') . " WHERE  baidu = 1  ORDER BY lastupdate DESC";
	$query->execute($sql);

	echo '<?xml version="1.0" encoding="UTF-8"?> 
<result language="zh_CN" version="1.1">
<status>
  <code><![CDATA[0]]></code> 
<msg><![CDATA[�ɹ�]]> 
</msg> 
</status>
<total>10</total> 
<start>1</start> 
<count>10</count> 
<data>
';

		jieqi_getconfigs('article', 'sort');
		jieqi_getconfigs('article', 'configs');
		$sortrows = array();
    foreach ($jieqiSort['article'] as $k => $v) {
			$sortrows['sortid'] = $k;
            $sortrows['sortname'] = $v['91caption'];
			$i++;
		

		$item = jieqi_funtoarray('jieqi_apis_xmltext', $item);

		echo "
<category>
<cate_id><![CDATA[{$sortrows['sortid']}]]></cate_id> 
<cate_name><![CDATA[{$sortrows['sortname']}]]></cate_name> 
</category>

		";
	}
echo '</data></result>';
/*}else{
echo '<?xml version="1.0" encoding="UTF-8"?>

';
}*/
//ת����xml����
function jieqi_apis_xmltext($text){
	$entities = array("&" => "&amp;", "<" => "&lt;", ">" => "&gt;", "'" => "&apos;", '"' => "&quot;");
	$text = strtr($text, $entities);
	$text = preg_replace("/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/", '', $text);
	return $text;
}
//����С˵��ҳ��ַ��$type������'info'-������Ϣҳ��'index'-����Ŀ¼ҳ��'full'-����ȫ���Ķ�ҳ
function jieqi_url_article($aid, $type = '', $acode = ''){
	global $jieqiConfigs;
	global $article_dynamic_url;
	global $article_static_url;
	
	if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
	if(empty($acode)) $acode = $aid;
	switch($type){
		case 'index':
			//ʹ��url_rewrite
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
//�����½�ҳ��ַ
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
	//ʹ��url_rewrite
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
//����С˵�����ַ
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