<?php
define("JIEQI_MODULE_NAME", "article");
require_once("../../global.php");
jieqi_checklogin();
if (empty($_SESSION['jieqiUserId'])) jieqi_printfail("登录验证失败！");
jieqi_loadlang("article", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_getconfigs(JIEQI_MODULE_NAME, "sort");
jieqi_getconfigs(JIEQI_MODULE_NAME, "ebook", "jieqiConfigs");
$articleid = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
if ($articleid < 1) jieqi_printfail(LANG_ERROR_PARAMETER);
jieqi_includedb();
include_once($jieqiModules['article']['path']."/class/article.php");
$article_handler =& jieqiarticlehandler::getinstance("JieqiArticleHandler");
$article = $article_handler->get($articleid);
if (!$article) jieqi_printfail($jieqiLang['article']['article_not_exists']);
if ($article->getvar("display") == 0 && $jieqiUsersStatus != JIEQI_GROUP_ADMIN) jieqi_printfail($jieqiLang['article']['noper_edit_article']);
if ($article->getvar("posterid") != $_SESSION['jieqiUserId'] && $jieqiUsersStatus != JIEQI_GROUP_ADMIN) jieqi_printfail($jieqiLang['article']['noper_manage_article']);
$article_static_url = empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl'];
$article_dynamic_url = empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl'];
$time = microtime(true);
$data = array('userid' => $_SESSION['jieqiUserId'], 'ip' => $_SERVER['REMOTE_ADDR'], 'time' => $time);
$data['sign'] = md5('mc_' . serialize($data));
$token = rtrim(strtr(base64_encode(serialize($data)), '+/', '-_'), '=');
if (empty($_REQUEST['action']) || strtolower($_REQUEST['action']) !== 'check') {
    include_once(JIEQI_ROOT_PATH."/header.php");
    $jieqiTpl->assign("token", $token);
    $jieqiTpl->assign("article_static_url", $article_static_url);
    $jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
    $jieqiTpl->assign_by_ref("sortrows", $jieqiSort['article']);
    $jieqiTpl->assign("articleid", $article->getvar("articleid"));
    $jieqiTpl->assign("sortid", $article->getvar("sortid"));
    $jieqiTpl->assign("articlename", $article->getvar("articlename"));
    $jieqiTpl->assign("author", $article->getvar("author"));
    $jieqiTpl->assign("keywords", $article->getvar("keywords", "e"));
    $jieqiTpl->assign("intro", $article->getvar("intro", "e"));
    $jieqiTpl->assign("fullflag", $article->getvar("fullflag"));
    $jieqiTpl->setcaching(0);
    $jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path']."/templates/ebookedit.html";
    include_once(JIEQI_ROOT_PATH."/footer.php");
    exit;
}
if (empty($_POST['token'])) jieqi_printfail("数据验证失败！");
$data = unserialize(base64_decode(str_pad(strtr($_POST['token'], '-_', '+/'), strlen($_POST['token']) % 4, '=', STR_PAD_RIGHT)));
if (empty($data)) jieqi_printfail('数据验证失败！');
$sign = array_pop($data);
if ($sign !== md5('mc_' . serialize($data))) jieqi_printfail('指纹验证失败！');
if ($data['userid'] !== $_SESSION['jieqiUserId']) jieqi_printfail('用户验证失败！');
if ($data['ip'] !== $_SERVER['REMOTE_ADDR']) jieqi_printfail('IP验证失败！');
if ($data['time'] < $time - 3600) jieqi_printfail('操作超时！');
$errtext = "";
include_once(JIEQI_ROOT_PATH."/lib/text/textfunction.php");
$_POST['articlename'] = trim($_POST['articlename']);
if (strlen($_POST['articlename']) == 0) {
	$errtext .= $jieqiLang['article']['need_article_title']."<br />";
} else if (!jieqi_safestring($_POST['articlename'])) {
	$errtext .= $jieqiLang['article']['limit_article_title']."<br />";
}
$_POST['author'] = trim($_POST['author']);
if (strlen($_POST['author']) == 0) {
	$errtext .= "作者名不能为空！<br />";
} else if (!jieqi_safestring($_POST['author'])) {
	$errtext .= "作者名不能有空格及特殊字符！<br />";
}
$_POST['sortid'] = intval($_POST['sortid']);
if (!isset($jieqiSort['article'][$_POST['sortid']])) {
    $errtext .= "作品分类不存在！<br />";
}
if (!isset($jieqiConfigs['system'])) jieqi_getconfigs("system", "configs");
if (!empty($jieqiConfigs['system']['postdenywords'])) {
    include_once(JIEQI_ROOT_PATH."/include/checker.php");
    $checker = new jieqichecker();
    $matchwords1 = $checker->deny_words($_POST['articlename'], $jieqiConfigs['system']['postdenywords'], true);
    $matchwords2 = $checker->deny_words($_POST['intro'], $jieqiConfigs['system']['postdenywords'], true);
    if (is_array($matchwords1) || is_array($matchwords2))
    {
        if (!isset($jieqiLang['system']['post'])) jieqi_loadlang("post", "system");
        $matchwords = array();
        if (is_array($matchwords1)) $matchwords = array_merge($matchwords, $matchwords1);
        if (is_array($matchwords2)) $matchwords = array_merge($matchwords, $matchwords2);
        $errtext .= sprintf($jieqiLang['system']['post_words_deny'], implode(" ", jieqi_funtoarray("htmlspecialchars", $matchwords)));
    }
}
if (!empty($errtext)) jieqi_printfail($errtext);
if ($article->getvar("articlename", "n") !== $_POST['articlename']) {
	if ($jieqiConfigs['article']['samearticlename'] != 1 && 0 < $article_handler->getcount(new criteria("articlename", $_POST['articlename'], "="))) {
		jieqi_printfail(sprintf($jieqiLang['article']['articletitle_has_exists'], jieqi_htmlstr($_POST['articlename'])));
	}
	$article->setvar("articlename", $_POST['articlename']);
	$article->setvar("initial", jieqi_getinitial($_POST['articlename']));
}
$query_handler = jieqiqueryhandler::getinstance("JieqiQueryHandler");
if (!empty($_POST['cover'])) {
	$query = $query_handler->db->query("SELECT * FROM ".jieqi_dbprefix("article_upload")." WHERE id='".intval($_POST['cover'])."' AND type='cover' AND sign='$sign' AND status='0'");
	$upinfo = $query_handler->getobject($query);
	if (empty($upinfo)) jieqi_printfail("封面图片上传失败！");
	$cover = unserialize(file_get_contents(jieqi_uploadpath($jieqiConfigs['article']['uploaddir'], "article")."/".floor($upinfo->getvar("id")/1000)."/".$upinfo->getvar("id").".tmp"));
	$article->setvar("imgflag", 1);
}
$article->setvar("author", $_POST['author']);
$article->setvar("lastupdate", JIEQI_NOW_TIME);
$article->setvar("keywords", trim($_POST['keywords']));
$article->setvar("fullflag", intval($_POST['fullflag']) ? 1 : 0);
$article->setvar("sortid", $_POST['sortid']);
$article->setvar("intro", $_POST['intro']);
if ($jieqiConfigs['article']['needcheck']) {
    $article->setvar("display", 1);
} else {
    $article->setvar("display", 0);
}
if (!$article_handler->insert($article)) jieqi_printfail($jieqiLang['article']['article_edit_failure']);
$query_handler->db->query("UPDATE ".jieqi_dbprefix("article_upload")." SET status='1' WHERE sign='$sign' AND status='0'");
include_once($jieqiModules['article']['path']."/class/chapter.php");
$chapter_handler =& jieqichapterhandler::getinstance("JieqiChapterHandler");
include_once($jieqiModules['article']['path']."/class/package.php");
$package = new jieqipackage($articleid);
$package->editpackage(array(
    "id" => $article->getvar("articleid", "n"),
    "title" => $article->getvar("articlename", "n"),
    "creatorid" => $article->getvar("authorid", "n"),
    "creator" => $article->getvar("author", "n"),
    "subject" => $article->getvar("keywords", "n"),
    "description" => $article->getvar("intro", "n"),
    "publisher" => JIEQI_SITE_NAME,
    "contributorid" => $article->getvar("posterid", "n"),
    "contributor" => $article->getvar("poster", "n"),
    "sortid" => $article->getvar("sortid", "n"),
    "typeid" => $article->getvar("typeid", "n"),
    "articletype" => $article->getvar("articletype", "n"),
    "permission" => $article->getvar("permission", "n"),
    "firstflag" => $article->getvar("firstflag", "n"),
    "fullflag" => $article->getvar("fullflag", "n"),
    "imgflag" => $article->getvar("imgflag", "n"),
    "power" => $article->getvar("power", "n"),
    "display" => $article->getvar("display", "n")
));
if (!empty($cover)) jieqi_writefile($package->getdir("imagedir")."/".$articleid."s.jpg", $cover);
if (!empty($jieqiConfigs['article']['scorearticle'])) {
	include_once(JIEQI_ROOT_PATH."/class/users.php");
	$users_handler =& jieqiusershandler::getinstance("JieqiUsersHandler");
	$users_handler->changescore($_SESSION['jieqiUserId'], $jieqiConfigs['article']['scorearticle'], true);
}
if (0 < $jieqiConfigs['article']['fakestatic']) {
    include_once($jieqiModules['article']['path']."/include/funstatic.php");
    article_update_static("articlenew", $articleid, $_POST['sortid']);
}
jieqi_jumppage($article_static_url."/ebook.php", LANG_DO_SUCCESS, $jieqiLang['article']['article_edit_success']);
?>