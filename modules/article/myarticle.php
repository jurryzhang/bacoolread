<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs("article", "power");
jieqi_checkpower($jieqiPower["article"]["authorpanel"], $jieqiUsersStatus, $jieqiUsersGroup, false);
include_once (JIEQI_ROOT_PATH . "/header.php");
jieqi_getconfigs("article", "configs");
		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
		$jieqiTpl->assign("article_static_url", $article_static_url);
		$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$jieqiTpl->assign("authorarea", 1);
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/myarticle.html";
include_once (JIEQI_ROOT_PATH . "/footer.php");

?>
