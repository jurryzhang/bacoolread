<?php
define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once (JIEQI_ROOT_PATH . "/class/power.php");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminconfig"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("groups", JIEQI_MODULE_NAME);
jieqi_includedb();
$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
include_once (JIEQI_ROOT_PATH . "/admin/header.php");
if (isset($_REQUEST['action'])) {
$sql = "SELECT * FROM " . jieqi_dbprefix("article_tag") . " order by addtime asc";
$query->execute($sql);
$tag = array();
$tagary = array();
$i = 0;
	while ($v = $query->getObject()) {
		$nameary = explode(" ", $v->getVar("tagname"));
//		$tagary['tag'][$v->getVar("tagid")] = array("tagname" => $nameary[0], "addtime" => $v->getVar("addtime"), "tagsort" => $v->getVar("tagsort"), "userid" => $v->getVar("userid"), "username" => $v->getVar("username"), "linknum" => $v->getVar("linknum"), "display" => $v->getVar("display"));
        $tagary[article][$v->getVar("tagid")] = array("caption" => $nameary[0]);
		$tag[$i]["tagid"] = $v->getVar("tagid");
	    $tag[$i]["caption"] = implode("<br />", $nameary);
//        $tag[$i]["addtime"] = $v->getVar("addtime");
//		$tag[$i]["tagsort"] = $v->getVar("tagsort");
//		$tag[$i]["userid"] = $v->getVar("userid");
//		$tag[$i]["username"] = $v->getVar("username");
//		$tag[$i]["linknum"] = $v->getVar("linknum");
//		$tag[$i]["display"] = $v->getVar("display");
		$i++;
		jieqi_setconfigs("tag", "jieqiTag", $tagary, "article");
	$publicdata = str_replace("?><?php", "",jieqi_readfile(JIEQI_ROOT_PATH . "/configs/article/tag.php"));
	//jieqi_writefile(JIEQI_ROOT_PATH . "/configs/define.php", $publicdata);
				}
$jieqiTpl->assign_by_ref("tag", $tag);

}
include_once (JIEQI_ROOT_PATH . "/admin/footer.php");
//var_dump($map_cids);
?>