<?php
//销售统计
?>
<?php

function jieqi_obook_actmreport($params)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $jieqiPower;
	global $obook_handler;
	global $article_handler;
	global $query;
	global $mreport_handler;
	global $ochapter_handler;
	global $jieqiUsersStatus;
	global $jieqiUsersGroup;
	
	if (!is_a($query, 'JieqiQueryHandler')) {
	jieqi_includedb();
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	}	
	$data = date("Ym",intval(time())); 
	$sql = "SELECT * FROM " . jieqi_dbprefix("obook_mreport") . " WHERE data = " . $data . " AND articleid = " . $params['articleid'] . " LIMIT 0, 1";
	$res = $query->execute($sql);
	$mreport = $query->getRow($res);	
	
	if (!is_a($article_handler, "JieqiArticleHandler")) {
		include_once ($jieqiModules["article"]["path"] . "/class/article.php");
		$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
	}
	$article = $article_handler->get($params['articleid'], "articleid");
	
	if (!$mreport) {
	$mreport = array();
	$noperson = true;
	}
	else {
	$noperson = false;
	}
	if($params['intype'] == 'tip'){
		$tip = $params['egold'];
	}else if($params['intype'] == 'egold'){
		$egold = $params['egold'];
	}else if($params['intype'] == 'gift'){
		$gift = $params['egold'];
    }		
	$postrows = array();
	$postrows["data"] = $data;
	$postrows["siteid"] = $article->getVar("siteid", "n");
	$postrows["obookname"] = $article->getVar("articlename", "n");
	$postrows["obookid"] = $article->getVar("articleid", "n");
	$postrows["articleid"] = $article->getVar("articleid", "n");
	$postrows["author"] = $article->getVar("author", "n");
	$postrows["sumgold"] = $egold;
	$postrows["sumtip"] = $tip;
	$postrows["sumgift"] = $gift;
	$postrows["sumemoney"] = $params['egold'];
       if ($noperson) {
		 $fields = "";
		 $values = "";
		 foreach ($postrows as $k => $v ) {
				if ($fields != "") {
					$fields .= ", ";
				}

				$fields .= "`$k`";

				if ($values != "") {
					$values .= ", ";
				}

				$values .= "'" . jieqi_dbslashes($v) . "'";
			}

			$sql = "INSERT INTO `" . jieqi_dbprefix("obook_mreport") . "` ($fields) VALUES ($values);";

        }
		else {

			$sql = "UPDATE `" . jieqi_dbprefix("obook_mreport") . "` SET sumgold = sumgold + '" . $egold. "' , sumtip = sumtip + '" . $tip . "', sumgift = sumgift + '" . $gift. "' , sumemoney = sumemoney + '" . $params['egold']. "' WHERE data = " . $data ." AND articleid = " . $params['articleid'];
        }		
	    $query->execute($sql);

}	
?>
