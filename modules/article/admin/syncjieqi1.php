<?php

define("JIEQI_USE_GZIP", "0");
define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs("article", "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false);
jieqi_loadlang("sync", "article");
jieqi_getconfigs("article", "configs");
jieqi_getconfigs("system", "setting", "jieqiSetting");

if (empty($jieqiSetting["siteid"])) {
	jieqi_printfail($jieqiLang["article"]["sync_jieqi_nojoin"]);
}

if ($_REQUEST["confirm"] != 1) {
	jieqi_msgwin(LANG_NOTICE, sprintf($jieqiLang["article"]["sync_start_notice"], jieqi_addurlvars(array("confirm" => 1))));
}

@ignore_user_abort(true);
@set_time_limit(3600);
@session_write_close();

if (empty($_REQUEST["order"])) {
	$_REQUEST["order"] = 1;
}

$_REQUEST["order"] = intval($_REQUEST["order"]);

if ($_REQUEST["order"] < 1) {
	$_REQUEST["order"] = 1;
}

if (empty($_REQUEST["errstop"])) {
	$_REQUEST["errstop"] = 10;
}

$_REQUEST["errstop"] = intval($_REQUEST["errstop"]);

if ($_REQUEST["errstop"] < 1) {
	$_REQUEST["errstop"] = 10;
}

if (empty($_REQUEST["errnum"])) {
	$_REQUEST["errnum"] = 0;
}

$_REQUEST["errnum"] = intval($_REQUEST["errnum"]);

if ($_REQUEST["errnum"] < 0) {
	$_REQUEST["errnum"] = 0;
}

echo str_repeat(" ", 4096);
echo $jieqiLang["article"]["sync_articlelist_start"] . "<br />";
ob_flush();
flush();
include_once (JIEQI_ROOT_PATH . "/include/apiclient.php");
include_once ($jieqiModules["article"]["path"] . "/include/funsync.php");
include_once (JIEQI_ROOT_PATH . "/lib/text/textfunction.php");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
if (!empty($_REQUEST["logid"]) && !empty($_REQUEST["order"])) {
	$_REQUEST["logid"] = intval($_REQUEST["logid"]);
	$_REQUEST["order"] = intval($_REQUEST["order"]);
	$_REQUEST["max"] = intval($_REQUEST["max"]);
	$sql = "SELECT * FROM " . jieqi_dbprefix("article_synclog") . " WHERE logid = " . $_REQUEST["logid"];
	$query->execute($sql);
	$logrow = $query->getRow();

	if (!$logrow) {
		jieqi_printfail($jieqiLang["article"]["sync_log_notexists"]);
	}

	$synccfile = JIEQI_ROOT_PATH . "/files/article/sync" . jieqi_getsubdir($_REQUEST["logid"]) . "/" . $_REQUEST["logid"] . $jieqi_file_postfix["txt"];

	if (!is_file($synccfile)) {
		$sql = "DELETE FROM " . jieqi_dbprefix("article_synclog") . " where logid = " . $_REQUEST["logid"];
		$query->execute($sql);
		jieqi_printfail($jieqiLang["article"]["sync_cfile_notexists"]);
	}

	$crows = file($synccfile);
	$tmax = count($crows);

	if ($tmax < $_REQUEST["order"]) {
		$prows = array();
		$prows["finishnum"] = $tmax;
		$prows["finishtime"] = time();
		$prows["issuccess"] = ($tmax == $logrow["articlenum"] ? 1 : 2);
		$sql = $query->makeupsql(jieqi_dbprefix("article_synclog"), $prows, "UPDATE", array("logid" => $_REQUEST["logid"]));
		$query->execute($sql);
		jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang["article"]["sync_allarticle_success"], $tmax));
	}

	$tmpary = explode(" ", trim($crows[$_REQUEST["order"] - 1]));
	if ((count($tmpary) < 2) || !is_numeric($tmpary[0]) || !is_numeric($tmpary[1])) {
		$sql = "DELETE FROM " . jieqi_dbprefix("article_synclog") . " where logid = " . $_REQUEST["logid"];
		$query->execute($sql);
		jieqi_delfile($synccfile);
		jieqi_printfail($jieqiLang["article"]["sync_cfile_formaterror"]);
	}

	$check_allchapters = true;
	$sourceid = intval($tmpary[0]);
	$sourceupdate = intval($tmpary[1]);
	$sql = "SELECT articleid, articlename, lastupdate, display FROM " . jieqi_dbprefix("article_article") . " WHERE sourceid = $sourceid LIMIT 0, 1";
	$query->execute($sql);
	$arow = $query->getRow();
	if (is_array($arow) && (($sourceupdate <= $arow["lastupdate"]) || ($arow["display"] != 0))) {
		echo sprintf($jieqiLang["article"]["sync_article_notneed"], jieqi_htmlstr($arow["articlename"])) . "<br />";
		ob_flush();
		flush();
	}
	else {
		$jieqiapi = new JieqiApiClient($jieqiSetting);
		$params = array("aid" => $sourceid);
		$ret = $jieqiapi->api("article/get_articleinfo", $params);
		$errstr = false;

		if ($ret["ret"] < 0) {
			$errstr = jieqi_htmlstr($ret["msg"]);
		}
		else if (!is_array($ret["msg"])) {
			$errstr = $jieqiLang["article"]["sync_return_formaterror"];
		}

		if ($errstr === false) {
			$articledata = $ret["msg"];
			unset($ret);
			include_once (JIEQI_ROOT_PATH . "/header.php");
			echo sprintf($jieqiLang["article"]["sync_article_begin"], jieqi_htmlstr($articledata["articlename"])) . "<br />";
			ob_flush();
			flush();
			$sync_article = array();
			$sync_article["siteid"] = $articledata["siteid"];
			$sync_article["sourceid"] = $articledata["articleid"];
			$sync_article["lastupdate"] = $articledata["lastupdate"];
			$sync_article["sortid"] = (isset($jieqiSetting["articlesort"][$articledata["sort"]]) ? intval($jieqiSetting["articlesort"][$articledata["sort"]]) : intval($jieqiSetting["articlesort"]["default"]));
			$sync_article["typeid"] = 0;
			if (!empty($sync_article["sortid"]) && isset($articledata["type"]) && is_array($jieqiSetting["type"])) {
				$sync_article["typeid"] = (isset($jieqiSetting["type"][$articledata["type"]]) ? intval($jieqiSetting["type"][$articledata["type"]]) : intval($jieqiSetting["type"]["default"]));
			}

			$sync_article["rgroup"] = intval($articledata["rgroup"]);
			$sync_article["articlename"] = $articledata["articlename"];
			$sync_article["author"] = $articledata["author"];
			$sync_article["authorflag"] = 0;
			$sync_article["keywords"] = $articledata["keywords"];
			$sync_article["permission"] = 0;
			$sync_article["firstflag"] = 0;
			$sync_article["intro"] = $articledata["intro"];
			$sync_article["notice"] = (isset($articledata["notice"]) ? $articledata["notice"] : "");
			$sync_article["cover"] = (isset($articledata["cover"]) ? $articledata["cover"] : "");
			$sync_article["fullflag"] = intval($articledata["fullflag"]);
			$sync_article["isvip"] = intval($articledata["isvip"]);
			$myarticle = jieqi_sync_articleinfo($sync_article);

			if (!is_object($myarticle)) {
				jieqi_printfail($jieqiLang["article"]["sync_savearticle_failure"]);
			}

			$params = array("aid" => $sourceid);
			$ret = $jieqiapi->api("article/get_chapterlist", $params);
			$errstr = false;

			if ($ret["ret"] < 0) {
				$errstr = jieqi_htmlstr($ret["msg"]);
			}
			else if (!is_array($ret["msg"])) {
				$errstr = $jieqiLang["article"]["sync_return_formaterror"];
			}

			if ($errstr === false) {
				$sync_chapters = array();

				foreach ($ret["msg"] as $k => $chapterone ) {
					$sync_chapters[$k]["siteid"] = $sync_article["siteid"];
					$sync_chapters[$k]["sourceid"] = $sync_article["sourceid"];
					$sync_chapters[$k]["sourcecid"] = $chapterone["chapterid"];
					$sync_chapters[$k]["sourcecorder"] = $chapterone["chapterorder"];
					$sync_chapters[$k]["chapterorder"] = $k + 1;
					$sync_chapters[$k]["articleid"] = $myarticle->getVar("articleid", "n");
					$sync_chapters[$k]["chaptername"] = $chapterone["chaptername"];
					$sync_chapters[$k]["size"] = $chapterone["size"];
					$sync_chapters[$k]["lastupdate"] = $chapterone["lastupdate"];
					$sync_chapters[$k]["isvip"] = intval($chapterone["isvip"]);
					$sync_chapters[$k]["saleprice"] = intval($chapterone["saleprice"]);
					$sync_chapters[$k]["pages"] = intval($chapterone["pages"]);
					$sync_chapters[$k]["chaptertype"] = intval($chapterone["chaptertype"]);
					$sync_chapters[$k]["summary"] = $chapterone["summary"];
					$sync_chapters[$k]["url_content"] = $chapterone["url_content"];
				}

				$myarticleid = intval($myarticle->getVar("articleid", "n"));
				$up_chapternum = 0;
				$old_chapters = array();
				$map_cids = array();
				$sql = "SELECT * FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = $myarticleid ORDER BY chapterorder ASC";
				$query->execute($sql);
				$k = 0;

				while ($row = $query->getRow()) {
					if ($row["sourcecid"] == 0) {
						$cidx = "i" . $row["chapterid"];
					}
					else if (0 < $row["chaptertype"]) {
						$cidx = "v" . $row["sourcecid"];
					}
					else {
						$cidx = "c" . $row["sourcecid"];
					}

					$map_cids[$cidx] = array("key" => $k, "check" => 0, "chapterid" => $row["chapterid"], "isvip" => $row["isvip"], "chaptertype" => $row["chaptertype"]);
					$old_chapters[$k] = $row;
					$k++;
				}

				$up_corders = array();

				foreach ($sync_chapters as $sk => $sv ) {
					$cidx = (0 < $sv["chaptertype"] ? "v" . intval($sv["sourcecid"]) : "c" . intval($sv["sourcecid"]));

					if (isset($map_cids[$cidx])) {
						$ret = jieqi_sync_chapterupdate($sv, $old_chapters[$map_cids[$cidx]["key"]]);

						if ($ret === true) {
							$up_chapternum++;
							$up_corders[] = $sv["chapterorder"];
						}
						else if (is_string($ret)) {
							$check_allchapters = $ret;
							break;
						}

						$map_cids[$cidx]["check"] = 1;
					}
					else {
						$ret = jieqi_sync_chapternew($sv, $myarticle);

						if ($ret === true) {
							$up_chapternum++;
							$up_corders[] = $sv["chapterorder"];
						}
						else {
							$check_allchapters = $ret;
							break;
						}
					}
				}

				if ($check_allchapters === true) {
					$del_cids = array();

					foreach ($map_cids as $v ) {
						if ($v["check"] == 0) {
							$del_cids[] = $v;
						}
					}

					if (0 < count($del_cids)) {
						$up_chapternum += count($del_cids);
						jieqi_sync_delchapters($del_cids, $myarticle);
					}
				}

				if (0 < $up_chapternum) {
					include_once ($jieqiModules["article"]["path"] . "/include/actarticle.php");
					$lastinfo = jieqi_article_searchlast($myarticle, "full");
					$sql = $query->makeupsql(jieqi_dbprefix("article_article"), $lastinfo, "UPDATE", array("articleid" => $myarticle->getVar("articleid", "n")));
					$query->execute($sql);
					if ((0 < $myarticle->getVar("vipid", "n")) || (0 < $lastinfo["isvip"])) {
						$lastobook = array("lastupdate" => $lastinfo["viptime"], "chapters" => $lastinfo["vipchapters"], "size" => $lastinfo["vipsize"], "lastvolumeid" => $lastinfo["vipvolumeid"], "lastvolume" => $lastinfo["vipvolume"], "lastchapterid" => $lastinfo["vipchapterid"], "lastchapter" => $lastinfo["vipchapter"], "lastsummary" => $lastinfo["vipsummary"]);
						$sql = $query->makeupsql(jieqi_dbprefix("obook_obook"), $lastobook, "UPDATE", array("articleid" => $myarticle->getVar("articleid", "n")));
						$query->execute($sql);
					}

					include_once ($jieqiModules["article"]["path"] . "/include/repack.php");
					article_repack($myarticleid, array("makeopf" => 1), 1);
					$package = new JieqiPackage($myarticleid);
					$package->loadOPF();
					$makeparams = array("makezip" => intval($jieqiConfigs["article"]["makezip"]), "makefull" => intval($jieqiConfigs["article"]["makefull"]), "maketxtfull" => intval($jieqiConfigs["article"]["maketxtfull"]), "makeumd" => intval($jieqiConfigs["article"]["makeumd"]), "makejar" => intval($jieqiConfigs["article"]["makejar"]), "makeindex" => intval($jieqiConfigs["article"]["makehtml"]));
					if (empty($del_cids) && !empty($up_corders)) {
						$make_orders = array();
						$max_order = count($sync_chapters);

						foreach ($up_corders as $o ) {
							$o = intval($o);

							if (0 < ($o - 1)) {
								$make_orders[$o - 1] = 1;
							}

							$make_orders[$o] = 1;

							if (($o + 1) <= $max_order) {
								$make_orders[$o + 1] = 1;
							}
						}

						foreach ($make_orders as $corder => $v ) {
							if ($jieqiConfigs["article"]["makehtml"]) {
								$package->makeHtml($corder, false, false, true);
							}

							if ($jieqiConfigs["article"]["maketxtjs"]) {
								$package->makeTxtjs($corder, true);
							}
						}
					}
					else {
						$makeparams["makechapter"] = intval($jieqiConfigs["article"]["makehtml"]);
						$makeparams["maketxtjs"] = intval($jieqiConfigs["article"]["maketxtjs"]);
					}

					article_repack($myarticleid, $makeparams, 1);

					if (0 < $jieqiConfigs["article"]["fakestatic"]) {
						include_once ($jieqiModules["article"]["path"] . "/include/funstatic.php");
						article_update_static("articleedit", $myarticleid, 0);
					}
				}
			}
			else {
				$$_REQUEST["errnum"]++;

				if ($_REQUEST["errstop"] <= $_REQUEST["errnum"]) {
					jieqi_printfail($errstr);
				}
				else {
					echo "<font color=\"red\">" . $errstr . "</font><br />";
					ob_flush();
					flush();
				}
			}
		}
		else {
			$$_REQUEST["errnum"]++;

			if ($_REQUEST["errstop"] <= $_REQUEST["errnum"]) {
				jieqi_printfail($errstr);
			}
			else {
				echo "<font color=\"red\">" . $errstr . "</font><br />";
				ob_flush();
				flush();
			}
		}
	}

	if ($check_allchapters !== true) {
		$$_REQUEST["errnum"]++;

		if ($_REQUEST["errstop"] <= $_REQUEST["errnum"]) {
			jieqi_printfail(strval($check_allchapters));
		}
		else {
			echo "<font color=\"red\">" . strval($check_allchapters) . "</font><br />";
			ob_flush();
			flush();
		}
	}

	$prows = array();
	$prows["finishnum"] = $_REQUEST["order"];
	$prows["finishtime"] = time();
	if (($tmax <= $_REQUEST["order"]) || ($logrow["articlenum"] <= $_REQUEST["order"])) {
		$prows["issuccess"] = ($tmax == $logrow["articlenum"] ? 1 : 2);
	}

	$sql = $query->makeupsql(jieqi_dbprefix("article_synclog"), $prows, "UPDATE", array("logid" => $_REQUEST["logid"]));
	$query->execute($sql);
	if (($tmax <= $_REQUEST["order"]) || ($logrow["articlenum"] <= $_REQUEST["order"])) {
		if (is_file($synccfile)) {
			jieqi_delfile($synccfile);
		}

		jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang["article"]["sync_allarticle_success"], $_REQUEST["order"]));
	}
	else {
		$$_REQUEST["order"] += 1;
		$self_name = ($_SERVER["PHP_SELF"] ? basename($_SERVER["PHP_SELF"]) : basename($_SERVER["SCRIPT_NAME"]));
		$url = $self_name . "?confirm=1&logid={$_REQUEST["logid"]}&order={$_REQUEST["order"]}&errstop={$_REQUEST["errstop"]}&errnum={$_REQUEST["errnum"]}";
		if (isset($_REQUEST["jieqi_username"]) && isset($_REQUEST["jieqi_userpassword"])) {
			$url .= "&jieqi_username=" . urlencode($_REQUEST["jieqi_username"]) . "&jieqi_userpassword=" . urlencode($_REQUEST["jieqi_userpassword"]);
		}

		echo sprintf($jieqiLang["article"]["sync_next_html"], JIEQI_CHAR_SET, $tmax, $_REQUEST["order"], $url, $url);
		
		exit();
	}
}
else {
	$sql = "SELECT * FROM " . jieqi_dbprefix("article_synclog") . " WHERE 1 ORDER BY logid DESC LIMIT 0, 1";
	$query->execute($sql);
	$logrow = $query->getRow();
	if (is_array($logrow) && ($logrow["issuccess"] == 0)) {
		if ((time() - $logrow["finishtime"]) < 180) {
			jieqi_printfail($jieqiLang["article"]["sync_maybe_doing"]);
		}

		$_REQUEST["logid"] = $logrow["logid"];
		$_REQUEST["order"] = $logrow["finishnum"] + 1;
		$self_name = ($_SERVER["PHP_SELF"] ? basename($_SERVER["PHP_SELF"]) : basename($_SERVER["SCRIPT_NAME"]));
		$url = $self_name . "?confirm=1&logid={$_REQUEST["logid"]}&order={$_REQUEST["order"]}&errstop={$_REQUEST["errstop"]}&errnum={$_REQUEST["errnum"]}";
		if (isset($_REQUEST["jieqi_username"]) && isset($_REQUEST["jieqi_userpassword"])) {
			$url .= "&jieqi_username=" . urlencode($_REQUEST["jieqi_username"]) . "&jieqi_userpassword=" . urlencode($_REQUEST["jieqi_userpassword"]);
		}

		echo sprintf($jieqiLang["article"]["sync_next_html"], JIEQI_CHAR_SET, $logrow["articlenum"], $_REQUEST["order"], $url, $url);
		
		exit();
	}

	$jieqiapi = new JieqiApiClient($jieqiSetting);
	$params = array("starttime" => 0);

	if (is_array($logrow)) {
		$params["starttime"] = (600 < $logrow["starttime"] ? $logrow["starttime"] - 600 : 0);
	}

	$ret = $jieqiapi->api("article/get_articlelist", $params);

	if ($ret["ret"] < 0) {
		jieqi_printfail(jieqi_htmlstr($ret["msg"]));
	}

	$prows = array();
	$prows["siteid"] = 0;
	$prows["userid"] = intval($_SESSION["jieqiUserId"]);
	$prows["starttime"] = JIEQI_NOW_TIME;
	$prows["finishtime"] = time();
	$prows["fromtime"] = $params["starttime"];

	if (empty($ret["msg"])) {
		$prows["articlenum"] = 0;
		$prows["finishnum"] = 0;
		$prows["retcode"] = 1;
		$prows["issuccess"] = 1;
		$sql = $query->makeupsql(jieqi_dbprefix("article_synclog"), $prows, "INSERT");
		$query->execute($sql);
		jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang["article"]["sync_article_noupdate"]);
	}
	else {
		$updateanum = count($ret["msg"]);
		$prows["articlenum"] = $updateanum;
		$prows["finishnum"] = 0;
		$prows["retcode"] = 0;
		$prows["issuccess"] = 0;
		$sql = $query->makeupsql(jieqi_dbprefix("article_synclog"), $prows, "INSERT");
		$query->execute($sql);
		$synclogid = intval($query->db->getInsertId());
	}

	$synccfile = JIEQI_ROOT_PATH . "/files/article/sync" . jieqi_getsubdir($synclogid);
	jieqi_checkdir($synccfile, true);
	$synccfile .= "/" . $synclogid . $jieqi_file_postfix["txt"];
	$cfileres = @fopen($synccfile, "wb");

	if (!$cfileres) {
		jieqi_printfail(sprintf($jieqiLang["article"]["sync_cachefile_openfailed"], $synccfile));
	}

	@flock($cfileres, LOCK_EX);

	foreach ($ret["msg"] as $v ) {
		@fwrite($cfileres, $v["id"] . " " . $v["time"] . "\r\n");
	}

	@flock($cfileres, LOCK_UN);
	@fclose($cfileres);
	@chmod($cfileres, 511);
	echo sprintf($jieqiLang["article"]["sync_article_updatenum"], $updateanum) . "<br />";
	ob_flush();
	flush();
	$_REQUEST["logid"] = $synclogid;
	$_REQUEST["order"] = 1;
	$self_name = ($_SERVER["PHP_SELF"] ? basename($_SERVER["PHP_SELF"]) : basename($_SERVER["SCRIPT_NAME"]));
	$url = $self_name . "?confirm=1&logid={$_REQUEST["logid"]}&order={$_REQUEST["order"]}&errstop={$_REQUEST["errstop"]}&errnum={$_REQUEST["errnum"]}";
	if (isset($_REQUEST["jieqi_username"]) && isset($_REQUEST["jieqi_userpassword"])) {
		$url .= "&jieqi_username=" . urlencode($_REQUEST["jieqi_username"]) . "&jieqi_userpassword=" . urlencode($_REQUEST["jieqi_userpassword"]);
	}

	echo sprintf($jieqiLang["article"]["sync_next_html"], JIEQI_CHAR_SET, $updateanum, $_REQUEST["order"], $url, $url);
	
	exit();
}

?>
