<?php

function jieqi_url_news_show($id)
{
	global $jieqiConfigs;
	global $jieqiModules;
	if (!isset($jieqiConfigs['article'])) {
		jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
	}
	if (!empty($id) &&!empty($jieqiConfigs['article']['fakeshow'])) {
		$repfrom = array('<{$jieqi_url}>', '<{$id|subdirectory}>', '<{$id}>');
		$repto = array(JIEQI_URL, jieqi_getsubdir($id), $id);
		$ret = str_replace($repfrom, $repto, $jieqiConfigs['article']['fakeshow']);

		if (substr($ret, 0, 4) != 'http') {
			$ret = JIEQI_URL . $ret;
		}

		return $ret;
	}
	else {
		return $jieqiModules['news']['url'] . '/newshow.php?id=' . $id;
	}
}



?>
