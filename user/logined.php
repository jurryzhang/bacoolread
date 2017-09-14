<?php

define("JIEQI_MODULE_NAME", "system");
require_once('../global.php');

jieqi_getconfigs(JIEQI_MODULE_NAME, "index", "jieqiBlocks");

include_once(JIEQI_ROOT_PATH."/header.php");

$jieqiTset["jieqi_page_template"] = JIEQI_ROOT_PATH."/user/templates/logined.html";

$jieqiTpl->setCaching(0);

include_once(JIEQI_ROOT_PATH."/footer.php");
?>