<?php
function jieqi_url_obook_buychapter($cid)
{
	global $jieqiConfigs;
	global $jieqiModules;
	global $obook_static_url;
	global $obook_dynamic_url;

	if (!isset($jieqiConfigs['obook'])) {
		jieqi_getconfigs('obook', 'configs', 'jieqiConfigs');
	}

	if (!empty($cid) && !empty($jieqiConfigs['obook']['buychaptervip'])) {
		$repfrom = array('<{$jieqi_url}>', '<{$cid|subdirectory}>', '<{$cid}>');
		$repto = array(JIEQI_URL, jieqi_getsubdir($cid), $cid);
		$ret = str_replace($repfrom, $repto, $jieqiConfigs['obook']['buychaptervip']);

		if (substr($ret, 0, 4) != 'http') {
			$ret = JIEQI_URL . $ret;
		}

		return $ret;
	}
	else {
			return $obook_dynamic_url . '/buychapter.php?cid=' . $cid;
	}
}
?>