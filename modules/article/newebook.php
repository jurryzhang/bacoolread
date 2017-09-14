<?php
define("JIEQI_MODULE_NAME", "article");
require_once("../../global.php");

jieqi_checklogin();

if (empty($_SESSION['jieqiUserId']))
{
	jieqi_printfail("登录验证失败！");
}

jieqi_loadlang("article", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_getconfigs(JIEQI_MODULE_NAME, "option", "jieqiOption");
jieqi_getconfigs(JIEQI_MODULE_NAME, "sort", "jieqiSort");
jieqi_getconfigs("system", "sites", "jieqiSites");
jieqi_getconfigs("article", "action", "jieqiAction");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

$time = microtime(true);
$data = array('userid' => $_SESSION['jieqiUserId'], 'ip' => $_SERVER['REMOTE_ADDR'], 'time' => $time);
$data['sign'] = md5('mc_' . serialize($data));
$token = rtrim(strtr(base64_encode(serialize($data)), '+/', '-_'), '=');

if (empty($_REQUEST['action']) || strtolower($_REQUEST['action']) !== 'check')
{
	include_once(JIEQI_ROOT_PATH."/header.php");
	
	jieqi_getconfigs(JIEQI_MODULE_NAME, "sort", "jieqiSort");
	$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiSort["article"]));
	
	foreach ($jieqiOption["article"] as $k => $v )
	{
		$jieqiTpl->assign_by_ref($k, $jieqiOption["article"][$k]);
	}
	
	if (2 <= floatval(JIEQI_VERSION))
	{
		$jieqiTpl->assign("taglimit", intval($jieqiConfigs["article"]["taglimit"]));
		$tagwords = array();
		$tmpary = preg_split("/\s+/s", $jieqiConfigs["article"]["tagwords"]);
		$k = 0;
		
		foreach ($tmpary as $v )
		{
			if (0 < strlen($v))
			{
				$tagwords[$k]["name"] = jieqi_htmlstr($v);
				$k++;
			}
		}
		
		$jieqiTpl->assign_by_ref("tagwords", $tagwords);
		$jieqiTpl->assign_by_ref("tagnum", count($tagwords));
	}
	
	$jieqiTpl->assign("ismanager", intval($ismanager));
	
	if (2 <= floatval(JIEQI_VERSION))
	{
		$customsites = array();
		
		foreach ($jieqiSites as $k => $v )
		{
			if (!empty($v["custom"]))
			{
				$customsites[$k] = $v;
			}
		}
		
		$jieqiTpl->assign("customsites", jieqi_funtoarray("jieqi_htmlstr", $customsites));
		$jieqiTpl->assign("customsitenum", count($customsites));
		$jieqiTpl->assign("jieqisites", jieqi_funtoarray("jieqi_htmlstr", $jieqiSites));
	}
	
	if (jieqi_checkpower($jieqiPower["article"]["transarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true))
	{
		$jieqiTpl->assign("allowtrans", 1);
	}
	else
	{
		$jieqiTpl->assign("allowtrans", 0);
		
		$jieqiTpl->assign("author", $_SESSION['jieqiUserName']);
		
		$authorid  = $_SESSION['jieqiUserId'];
		
		$jieqiTpl->assign("authorid", $authorid);
	}
	
	$jieqiTpl->assign("token", $token);
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	//$jieqiTpl->assign_by_ref("sortrows", $jieqiSort['article']);
	$jieqiTpl->setcaching(0);
	$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path']."/templates/newebook.html";
	include_once(JIEQI_ROOT_PATH."/footer.php");
	exit;
}

if (empty($_POST['token']))
{
	jieqi_printfail("数据验证失败！");
}

$data = unserialize(base64_decode(str_pad(strtr($_POST['token'], '-_', '+/'), strlen($_POST['token']) % 4, '=', STR_PAD_RIGHT)));

if (empty($data))
{
	jieqi_printfail('数据验证失败！');
}

$sign = array_pop($data);

if ($sign !== md5('mc_' . serialize($data)))
{
	jieqi_printfail('指纹验证失败！');
}

if ($data['userid'] !== $_SESSION['jieqiUserId'])
{
	jieqi_printfail('用户验证失败！');
}

if ($data['ip'] !== $_SERVER['REMOTE_ADDR'])
{
	jieqi_printfail('IP验证失败！');
}

if ($data['time'] < $time - 3600)
{
	jieqi_printfail('操作超时！');
}

$errtext = "";

include_once(JIEQI_ROOT_PATH."/lib/text/textfunction.php");

$_POST['articlename'] = trim($_POST['articlename']);

if (strlen($_POST['articlename']) == 0)
{
	$errtext .= $jieqiLang['article']['need_article_title']."<br />";
}
else if (!jieqi_safestring($_POST['articlename']))
{
	$errtext .= $jieqiLang['article']['limit_article_title']."<br />";
}

$_POST['author'] = trim($_POST['author']);

if($_POST['allowtrans'] != 0)
{
	if (strlen($_POST['author']) == 0)
	{
		$errtext .= "作者名不能为空！<br />";
	}
	else if (!jieqi_safestring($_POST['author']))
	{
		$errtext .= "作者名不能有空格及特殊字符！<br />";
	}
}

$_POST['sortid'] = intval($_POST['sortid']);

if (!isset($jieqiSort['article'][$_POST['sortid']]))
{
	$errtext .= "作品分类不存在！<br />";
}

if (!isset($jieqiConfigs['system']))
{
	jieqi_getconfigs("system", "configs");
}

if (!empty($jieqiConfigs['system']['postdenywords']))
{
	include_once(JIEQI_ROOT_PATH."/include/checker.php");
	
	$checker = new jieqichecker();
	$matchwords1 = $checker->deny_words($_POST['articlename'], $jieqiConfigs['system']['postdenywords'], true);
	$matchwords2 = $checker->deny_words($_POST['intro'], $jieqiConfigs['system']['postdenywords'], true);
	
	if (is_array($matchwords1) || is_array($matchwords2))
	{
		if (!isset($jieqiLang['system']['post']))
		{
			jieqi_loadlang("post", "system");
		}
		
		$matchwords = array();
		
		if (is_array($matchwords1))
		{
			$matchwords = array_merge($matchwords, $matchwords1);
		}
		
		if (is_array($matchwords2))
		{
			$matchwords = array_merge($matchwords, $matchwords2);
		}
		
		$errtext .= sprintf($jieqiLang['system']['post_words_deny'], implode(" ", jieqi_funtoarray("htmlspecialchars", $matchwords)))."<br />";
	}
}

if (!empty($errtext))
{
	jieqi_printfail($errtext);
}

jieqi_includedb();

$query_handler = jieqiqueryhandler::getinstance("JieqiQueryHandler");

if (!empty($_POST['cover']))
{
	$query = $query_handler->db->query("SELECT * FROM ".jieqi_dbprefix("article_upload")." WHERE id='".intval($_POST['cover'])."' AND type='cover' AND sign='$sign' AND status='0'");
	$upinfo = $query_handler->getobject($query);
	
	if (empty($upinfo))
	{
		jieqi_printfail("封面图片上传失败！");
	}
	
	$cover = unserialize(file_get_contents(jieqi_uploadpath($jieqiConfigs['article']['uploaddir'], "article")."/".floor($upinfo->getvar("id")/1000)."/".$upinfo->getvar("id").".tmp"));
}

if (empty($_POST['ebook']))
{
	jieqi_printfail("电子书上传失败1！");
}

$query = $query_handler->db->query("SELECT * FROM ".jieqi_dbprefix("article_upload")." WHERE id='".intval($_POST['ebook'])."' AND type='ebook' AND sign='$sign' AND status='0'");

$upinfo = $query_handler->getobject($query);
//var_dump($upinfo);

if (empty($upinfo))
{
	jieqi_printfail("电子书上传失败2！");
}

$readlist = unserialize(file_get_contents(jieqi_uploadpath($jieqiConfigs['article']['uploaddir'], "article")."/".floor($upinfo->getvar("id")/1000)."/".$upinfo->getvar("id").".tmp"));

if (empty($readlist))
{
	$errtext .= "电子书解析失败！<br />";
}

include_once JIEQI_ROOT_PATH . '/lib/text/textfunction.php';
include_once($jieqiModules['article']['path']."/class/article.php");
$article_handler =& jieqiarticlehandler::getinstance("JieqiArticleHandler");

if ($jieqiConfigs['article']['samearticlename'] != 1)
{
	if (0 < $article_handler->getcount(new criteria("articlename", $_POST['articlename'], "=")))
	{
		jieqi_printfail(sprintf($jieqiLang['article']['articletitle_has_exists'], jieqi_htmlstr($_POST['articlename'])));
	}
}

$newArticle = $article_handler->create();
$newArticle->setvar("siteid", JIEQI_SITE_ID);
$newArticle->setvar("sourceid", 0);
$newArticle->setvar("postdate", JIEQI_NOW_TIME);
$newArticle->setvar("lastupdate", JIEQI_NOW_TIME);
$newArticle->setvar("articlename", $_POST['articlename']);
$newArticle->setvar("articlecode", jieqi_getpinyin($_POST['articlename']));
$newArticle->setvar("backupname", $_POST['backupname']);
$newArticle->setvar("keywords", trim($_POST['keywords']));
$newArticle->setvar("roles", "");
$newArticle->setvar("initial", jieqi_getinitial($_POST['articlename']));

//burn修改，2016-12-07
$authorid = $_POST['authorid'] ? $_POST['authorid'] : 0;

$newArticle->setvar("authorid", $authorid);
$newArticle->setvar("author", $_POST['author']);
$newArticle->setvar("posterid", $_SESSION['jieqiUserId']);
$newArticle->setvar("poster", $_SESSION['jieqiUserName']);
/*$newArticle->setvar("agentid", 0);
$newArticle->setvar("agent", "");
$newArticle->setvar("masterid", 0);
$newArticle->setvar("master", "");*/
$newArticle->setvar("sortid", $_POST['sortid']);
$newArticle->setvar("typeid", $_POST['typeid']);
$newArticle->setvar("libid", 0);
$newArticle->setvar("intro", $_POST['intro']);
$newArticle->setvar("notice", "");
$newArticle->setvar("foreword", "");
$newArticle->setvar("setting", "");
$newArticle->setvar("lastvolumeid", 0);
$newArticle->setvar("lastvolume", "");
$newArticle->setvar("lastchapterid", 0);
$newArticle->setvar("lastchapter", "");
$newArticle->setvar("lastsummary", "");
$newArticle->setvar("chapters", count($readlist));
$newArticle->setvar("size", array_sum(column($readlist, 'size')));
/*$newArticle->setvar("daysize", 0);
$newArticle->setvar("weeksize", 0);
$newArticle->setvar("monthsize", 0);
$newArticle->setvar("presize", 0);
$newArticle->setvar("monthupds", 0);
$newArticle->setvar("preupds", 0);
$newArticle->setvar("monthupdt", 0);
$newArticle->setvar("preupdt", 0);
$newArticle->setvar("lastvisit", 0);
$newArticle->setvar("dayvisit", 0);
$newArticle->setvar("weekvisit", 0);
$newArticle->setvar("monthvisit", 0);
$newArticle->setvar("allvisit", 0);
$newArticle->setvar("lastvote", 0);
$newArticle->setvar("dayvote", 0);
$newArticle->setvar("weekvote", 0);
$newArticle->setvar("monthvote", 0);
$newArticle->setvar("allvote", 0);
$newArticle->setvar("lastdown", 0);
$newArticle->setvar("daydown", 0);
$newArticle->setvar("weekdown", 0);
$newArticle->setvar("monthdown", 0);
$newArticle->setvar("alldown", 0);
$newArticle->setvar("lastflower", 0);
$newArticle->setvar("dayflower", 0);
$newArticle->setvar("weekflower", 0);
$newArticle->setvar("monthflower", 0);
$newArticle->setvar("allflower", 0);
$newArticle->setvar("preflower", 0);
$newArticle->setvar("hotnum", 0);
$newArticle->setvar("goodnum", 0);
$newArticle->setvar("toptime", 0);
$newArticle->setvar("saleprice", 0);
$newArticle->setvar("salenum", 0);
$newArticle->setvar("totalcost", 0);
$newArticle->setvar("power", 0);
$newArticle->setvar("articletype", 1);
$newArticle->setvar("permission", 0);
$newArticle->setvar("firstflag", 0);*/
$newArticle->setvar("fullflag", intval($_POST['fullflag']) ? 1 : 0);
$newArticle->setvar("imgflag", empty($cover) ? 0 : 1);

if ($jieqiConfigs['article']['needcheck'])
{
	$newArticle->setvar("display", 1);
}
else
{
	$newArticle->setvar("display", 0);
}

if (!$article_handler->insert($newArticle))
{
	jieqi_printfail($jieqiLang['article']['article_add_failure']);
}

$articleid = $newArticle->getvar("articleid");
$query_handler->db->query("UPDATE ".jieqi_dbprefix("article_upload")." SET status='1' WHERE sign='$sign' AND status='0'");
include_once($jieqiModules['article']['path']."/class/chapter.php");
$chapter_handler =& jieqichapterhandler::getinstance("JieqiChapterHandler");
include_once($jieqiModules['article']['path']."/class/package.php");
$package = new jieqipackage($articleid);
$package->initpackage(array
(
	"id"            => $newArticle->getvar("articleid", "n"),
	"title"         => $newArticle->getvar("articlename", "n"),
	"creatorid"     => $newArticle->getvar("authorid", "n"),
	"creator"       => $newArticle->getvar("author", "n"),
	"subject"       => $newArticle->getvar("keywords", "n"),
	"description"   => $newArticle->getvar("intro", "n"),
	"publisher"     => JIEQI_SITE_NAME,
	"contributorid" => $newArticle->getvar("posterid", "n"),
	"contributor"   => $newArticle->getvar("poster", "n"),
	"sortid"        => $newArticle->getvar("sortid", "n"),
	"typeid"        => $newArticle->getvar("typeid", "n"),
	"articletype"   => $newArticle->getvar("articletype", "n"),
	"permission"    => $newArticle->getvar("permission", "n"),
	"firstflag"     => $newArticle->getvar("firstflag", "n"),
	"fullflag"      => $newArticle->getvar("fullflag", "n"),
	"imgflag"       => $newArticle->getvar("imgflag", "n"),
	"power"         => $newArticle->getvar("power", "n"),
	"display"       => $newArticle->getvar("display", "n")
), false);

$chapterid = 0;
$chaptername = "";

foreach ($readlist as $key => $val)
{
	$summary = jieqi_substr($val['content'], 0, 500, "……");
	$newChapter = $chapter_handler->create();
	$newChapter->setvar("siteid", JIEQI_SITE_ID);
	$newChapter->setvar("articleid", $articleid);
	$newChapter->setvar("articlename", $_POST['articlename']);
	$newChapter->setvar("volumeid", 0);
	$newChapter->setvar("posterid", $_SESSION['jieqiUserId']);
	$newChapter->setvar("poster", $_SESSION['jieqiUserName']);
	$newChapter->setvar("postdate", JIEQI_NOW_TIME);
	$newChapter->setvar("lastupdate", JIEQI_NOW_TIME);
	$newChapter->setvar("chaptername", $val['name']);
	$newChapter->setvar("chapterorder", $key + 1);
	$newChapter->setvar("size", $val['size']);
	$newChapter->setvar("summary", $summary);
	$newChapter->setvar("chaptertype", 0);
	$newChapter->setvar("attachment", "");
	$newChapter->setvar("saleprice", 0);
	$newChapter->setvar("salenum", 0);
	$newChapter->setvar("totalcost", 0);
	$newChapter->setvar("isvip", 0);
	$newChapter->setvar("power", 0);
	$newChapter->setvar("display", 0);
	
	if (!$chapter_handler->insert($newChapter))
	{
		continue;
	}
	
	$chapterid = $newChapter->getvar("chapterid");
	$lastsummary = str_replace("<br />", "", $newChapter->getvar("summary"));
	$chaptername = $val['name'];
	jieqi_writefile($package->getdir("txtdir")."/".$chapterid.".txt", $val['content']);
	$package->chapters[$key] = array( "id" => $chaptername, "href" => $chapterid.".txt", "media-type" => "text/html", "content-type" => "chapter");
}

$package->isload = true;
$package->createopf();

if (!empty($chapterid))
{
	$article = $article_handler->get($articleid);
	$article->setvar("lastchapterid", $chapterid);
	$article->setvar("lastchapter", $chaptername);
	$article->setvar("lastsummary", $lastsummary);
	$article_handler->insert($article);
}

if (!empty($cover))
{
	jieqi_writefile($package->getdir("imagedir")."/".$articleid."s.jpg", $cover);
}

if (!empty($jieqiConfigs['article']['scorearticle']))
{
	include_once(JIEQI_ROOT_PATH."/class/users.php");
	
	$users_handler =& jieqiusershandler::getinstance("JieqiUsersHandler");
	$users_handler->changescore($_SESSION['jieqiUserId'], $jieqiConfigs['article']['scorearticle'], true);
}

if ($newArticle->getvar("display") == 0)
{
	jieqi_getcachevars("article", "articleuplog");
	
	if (!is_array($jieqiArticleuplog))
	{
		$jieqiArticleuplog = array("articleuptime" => 0, "chapteruptime" => 0);
	}
	
	$jieqiArticleuplog['articleuptime'] = JIEQI_NOW_TIME;
	jieqi_setcachevars("articleuplog", "jieqiArticleuplog", $jieqiArticleuplog, "article");
}

if (0 < $jieqiConfigs['article']['makehtml'])
{
	include_once($jieqiModules['article']['path']."/include/repack.php");
	article_repack($articleid, array("makehtml" => 1), 0);
	$package->makeindex();
}

if (0 < $jieqiConfigs['article']['fakestatic'])
{
	include_once($jieqiModules['article']['path']."/include/funstatic.php");
	article_update_static("articlenew", $articleid, $_POST['sortid']);
}

jieqi_jumppage($article_static_url."/masterpage.php", LANG_DO_SUCCESS, $jieqiLang['article']['article_add_success']);

function column($input, $column_key, $index_key = null)
{
	if (function_exists('array_column'))
	{
		return array_column($input, $column_key, $index_key);
	}
	
	if (!is_array($input))
	{
		return array();
	}
	
	foreach ($input as $key => $val)
	{
		if (!is_null($index_key))
		{
			$key = isset($val[$index_key]) ? $val[$index_key] : null;
		}
		
		if (!is_null($column_key))
		{
			$val = isset($val[$column_key]) ? $val[$column_key] : null;
		}
		
		if (!is_null($key))
		{
			$output[$key] = $val;
		}
	}
	
	return $output;
}
?>