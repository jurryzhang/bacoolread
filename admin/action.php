<?php
//test
define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once (JIEQI_ROOT_PATH . "/class/power.php");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminconfig"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("action", JIEQI_MODULE_NAME);
include_once (JIEQI_ROOT_PATH . "/lib/html/formloader.php");
include_once (JIEQI_ROOT_PATH . "/class/action.php");
$action_handler = &JieqiactionHandler::getInstance("JieqiactionHandler");

if (empty($_REQUEST["action"])) {
	$_REQUEST["action"] = "show";
}

switch ($_REQUEST["action"]) {
/*case "new":
	$errtext = "";

	if (empty($_POST["acttitle"])) {
		$errtext .= $jieqiLang["system"]["need_action_acttitle"] . "<br />";
	}

	if (!is_numeric($_POST["minscore"]) || !is_numeric($_POST["islog"]) || !is_numeric($_POST["isreview"]) || !is_numeric($_POST["isvip"]) || !is_numeric($_POST["ispay"]) || !is_numeric($_POST["ismessage"]) || !is_numeric($_POST["paymin"]) || !is_numeric($_POST["paymax"]) || !is_numeric($_POST["earnscore"]) || !is_numeric($_POST["earncredit"]) || !is_numeric($_POST["earnvipvote"])) {
		$errtext .= $jieqiLang["system"]["need_action_num"] . "<br />";
	}

	$_POST["minscore"] = intval($_POST["minscore"]);
	$_POST["islog"] = intval($_POST["islog"]);
	$_POST["isreview"] = intval($_POST["isreview"]);
	$_POST["isvip"] = intval($_POST["isvip"]);
	$_POST["ispay"] = intval($_POST["ispay"]);
	$_POST["ismessage"] = intval($_POST["ismessage"]);
	$_POST["paymin"] = intval($_POST["paymin"]);
	$_POST["paymax"] = intval($_POST["paymax"]);
	$_POST["earnscore"] = intval($_POST["earnscore"]);
	$_POST["earncredit"] = intval($_POST["earncredit"]);
	$_POST["earnvipvote"] = intval($_POST["earnvipvote"]);

	if ($_POST["paymin"] < $_POST["paymax"]) {
		$errtext .= $jieqiLang["system"]["max_than_min"] . "<br />";
	}

	if (empty($errtext)) {
		$action = $action_handler->create();
		$action->setVar("acttitle", $_POST["acttitle"]);
		$action->setVar("minscore", $_POST["minscore"]);
		$action->setVar("islog", $_POST["islog"]);
		$action->setVar("isreview", $_POST["isreview"]);
		$action->setVar("isvip", $_POST["isvip"]);
		$action->setVar("ispay", $_POST["ispay"]);
		$action->setVar("ispay", $_POST["ispay"]);
		$action->setVar("paytitle", $_POST["paytitle"]);
		$action->setVar("paymin", $_POST["paymin"]);
		$action->setVar("paymax", $_POST["paymax"]);
		$action->setVar("earnscore", $_POST["earnscore"]);
		$action->setVar("earncredit", $_POST["earncredit"]);
		$action->setVar("earnvipvote", $_POST["earnvipvote"]);

		if (!$action_handler->insert($action)) {
			jieqi_printfail($jieqiLang["system"]["add_action_failure"]);
		}
	}
	else {
		jieqi_printfail($errtext);
	}

	break;
*/
case "delete":
	if (!empty($_REQUEST["id"])) {
		$action_handler->delete($_REQUEST["id"]);
	}

	break;

case "update":
	if (!empty($_REQUEST["id"]) && !empty($_POST["acttitle"])) {
		$action = $action_handler->get($_REQUEST["id"]);

		if (is_object($action)) {
			$errtext = "";

			if (empty($_POST["acttitle"])) {
				$errtext .= $jieqiLang["system"]["need_action_acttitle"] . "<br />";
			}

			if (!is_numeric($_POST["minscore"]) || !is_numeric($_POST["islog"]) || !is_numeric($_POST["isvip"]) || !is_numeric($_POST["ispay"]) || !is_numeric($_POST["earnscore"]) || !is_numeric($_POST["earncredit"]) || !is_numeric($_POST["earnvipvote"])) {
				$errtext .= $jieqiLang["system"]["need_action_num"] . "<br />";
			}

			$_POST["minscore"] = intval($_POST["minscore"]);
			$_POST["islog"] = intval($_POST["islog"]);
			$_POST["isvip"] = intval($_POST["isvip"]);
			$_POST["ispay"] = intval($_POST["ispay"]);
			$_POST["earnscore"] = intval($_POST["earnscore"]);
			$_POST["earncredit"] = intval($_POST["earncredit"]);
			$_POST["earnvipvote"] = intval($_POST["earnvipvote"]);
			
			if($action->getVar("acttype") == 'register'){
			$_POST["lenmin"] = intval($_POST["lenmin"]);
			$_POST["lenmax"] = intval($_POST["lenmax"]);
			}

			if ($_POST["paymin"] < $_POST["paymax"]) {
				$errtext .= $jieqiLang["system"]["max_than_min"] . "<br />";
			}

			if (empty($errtext)) {
				$action->setVar("acttitle", $_POST["acttitle"]);
				$action->setVar("minscore", $_POST["minscore"]);
				$action->setVar("islog", $_POST["islog"]);
				$action->setVar("isvip", $_POST["isvip"]);
				$action->setVar("ispay", $_POST["ispay"]);
				$action->setVar("paytitle", $_POST["paytitle"]);
				$action->setVar("earnscore", $_POST["earnscore"]);
				$action->setVar("earncredit", $_POST["earncredit"]);
				$action->setVar("earnvipvote", $_POST["earnvipvote"]);
				if($action->getVar("acttype") == 'register'){
				$action->setVar("lenmin", $_POST["lenmin"]);
				$action->setVar("lenmax", $_POST["lenmax"]);
				}
				if (!$action_handler->insert($action)) {
					jieqi_printfail($jieqiLang["system"]["edit_action_failure"]);
				}
			}
			else {
				jieqi_printfail($errtext);
			}
		}
	}

	break;

case "edit":
	if (!empty($_REQUEST["id"])) {
		$action = $action_handler->get($_REQUEST["id"]);

		if (is_object($action)) {
			include_once (JIEQI_ROOT_PATH . "/admin/header.php");
			$action_form = new JieqiThemeForm($jieqiLang["system"]["edit_action"], "actionedit", JIEQI_URL . "/admin/action.php");
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_acttitle"], "acttitle", 30, 250, $action->getVar("acttitle", "e")), true);
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_minscore"], "minscore", 30, 50, $action->getVar("minscore", "e")), true);
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_islog"], "islog", 30, 50, $action->getVar("islog", "e")), true);
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_isvip"], "isvip", 30, 50, $action->getVar("isvip", "e")), true);
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_ispay"], "ispay", 30, 50, $action->getVar("ispay", "e")), true);
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_paytitle"], "paytitle", 30, 50, $action->getVar("paytitle", "e")));
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_earnscore"], "earnscore", 30, 50, $action->getVar("earnscore", "e")), true);
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_earncredit"], "earncredit", 30, 50, $action->getVar("earncredit", "e")), true);
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_earnvipvote"], "earnvipvote", 30, 50, $action->getVar("earnvipvote", "e")), true);
			if($action->getVar("acttype") == 'register'){
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_lenmin"], "lenmin", 30, 50, $action->getVar("lenmin", "e")), true);
			$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_lenmin"], "lenmax", 30, 50, $action->getVar("lenmax", "e")), true);
			}
			$action_form->addElement(new JieqiFormHidden("mod", JIEQI_MODULE_NAME));
			$action_form->addElement(new JieqiFormHidden("action", "update"));
			$action_form->addElement(new JieqiFormHidden("id", $_REQUEST["id"]));
			$action_form->addElement(new JieqiFormButton("&nbsp;", "submit", LANG_SAVE, "submit"));
			$jieqiTpl->assign("jieqi_contents", "<br />" . $action_form->render(JIEQI_FORM_MAX) . "<br />");
			include_once (JIEQI_ROOT_PATH . "/admin/footer.php");
			exit();
		}
	}

	break;
}

include_once (JIEQI_ROOT_PATH . "/admin/header.php");
$criteria = new CriteriaCompo(new Criteria("modname", $_REQUEST["mod"], "="));
$criteria->setSort("actionid");
$criteria->setOrder("ASC");
$action_handler->queryObjects($criteria);
$action = array();
$actionary = array();
$i = 0;

while ($rows = $action_handler->getObject()) {
	$action[$i] = jieqi_query_rowvars($rows);
	$actionary[JIEQI_MODULE_NAME][$rows->getVar("acttype")] = array("acttitle" => $rows->getVar("acttitle"), "minscore" => $rows->getVar("minscore"), "islog" => $rows->getVar("islog"), "isvip" => $rows->getVar("isvip"), "ispay" => $rows->getVar("ispay"), "paytitle" => $rows->getVar("paytitle"), "paybase" => 1, "paymin" => $rows->getVar("paymin"), "paymax" => $rows->getVar("paymax"), "earnscore" => $rows->getVar("earnscore"), "earncredit" => $rows->getVar("earncredit"), "earnvipvote" => $rows->getVar("earnvipvote"), "lenmin" => $rows->getVar("lenmin"), "lenmax" => $rows->getVar("lenmax"));
	$i++;
	if ((!empty($_REQUEST["id"]) || !empty($_POST["acttitle"])) && (0 < count($actionary))) {
	jieqi_setconfigs("action", "jieqiAction", $actionary, "system");
}
}

$jieqiTpl->assign_by_ref("action", $action);
/*$action_form = new JieqiThemeForm($jieqiLang["article"]["add_action"], "actionnew", JIEQI_URL . "/modules/article/admin/action.php");
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_acttitle"], "acttitle", 30, 250, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_minscore"], "minscore", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_islog"], "islog", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_isreview"], "isreview", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_isvip"], "isvip", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_ispay"], "ispay", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_ismessage"], "ismessage", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_paytitle"], "paytitle", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_paymin"], "paymin", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_paymax"], "paymax", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_earnscore"], "earnscore", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_earncredit"], "earncredit", 30, 50, ""), true);
$action_form->addElement(new JieqiFormText($jieqiLang["article"]["table_action_earnvipvote"], "earnvipvote", 30, 50, ""), true);
$action_form->addElement(new JieqiFormHidden("action", "new"));
$action_form->addElement(new JieqiFormButton("&nbsp;", "submit", $jieqiLang["article"]["add_action"], "submit"));
$jieqiTpl->assign("form_addhonor", "<br />" . $action_form->render(JIEQI_FORM_MAX) . "<br />");*/
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH . "/templates/admin/action.html";
include_once (JIEQI_ROOT_PATH . "/admin/footer.php");


?>
