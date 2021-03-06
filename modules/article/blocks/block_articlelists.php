<?php

class BlockArticleArticlelist extends JieqiBlock
{
	public $module = 'article';
	public $template = 'block_articlelist.html';
	public $exevars = array('order' => 'allvisit', 'listnum' => 10, 'sortid' => 0, 'original' => 0, 'isfull' => 0, 'asc' => 0, 'isvip' => 0, 'rgroup' => 0);

	public function BlockArticleArticlelist(&$vars)
	{
		global $jieqiModules;
		global $jieqiTpl;
		global $jieqiTop;

		if (!isset($jieqiTop['article'])) {
			jieqi_getconfigs('article', 'top', 'jieqiTop');
		}

		$this->JieqiBlock($vars);

		if (!empty($this->blockvars['vars'])) {
			$varary = explode(',', trim($this->blockvars['vars']));
			$arynum = count($varary);

			if (0 < $arynum) {
				$varary[0] = trim($varary[0]);

				if ($varary[0] == 'mouthvisit') {
					$varary[0] = 'monthvisit';
				}
				else if ($varary[0] == 'mouthvote') {
					$varary[0] = 'monthvote';
				}

				if (isset($jieqiTop['article'][$varary[0]])) {
					$this->exevars['order'] = $varary[0];
				}
			}

			if (1 < $arynum) {
				$varary[1] = trim($varary[1]);
				if (is_numeric($varary[1]) && (0 < $varary[1])) {
					$this->exevars['listnum'] = intval($varary[1]);
				}
			}

			if (2 < $arynum) {
				$varary[2] = trim($varary[2]);
				$tmpvar = str_replace('|', '', $varary[2]);

				if (is_numeric($tmpvar)) {
					$this->exevars['sortid'] = $varary[2];
				}
				else if (substr($varary[2], 0, 1) == '$') {
					$tmpvar1 = $jieqiTpl->get_assign(substr($varary[2], 1));

					if (is_numeric(str_replace('|', '', $tmpvar1))) {
						$this->exevars['sortid'] = $tmpvar1;
					}
				}
				else {
					if (isset($_REQUEST[$tmpvar]) && is_numeric($_REQUEST[$tmpvar])) {
						$this->exevars['sortid'] = $_REQUEST[$tmpvar];
					}
				}
			}

			if (3 < $arynum) {
				$varary[3] = trim($varary[3]);

				if (in_array($varary[3], array('0', '1', '2'))) {
					$this->exevars['original'] = $varary[3];
				}
			}

			if (4 < $arynum) {
				$varary[4] = trim($varary[4]);

				if (in_array($varary[4], array('0', '1', '2'))) {
					$this->exevars['isfull'] = $varary[4];
				}
			}

			if (5 < $arynum) {
				$varary[5] = trim($varary[5]);

				if (in_array($varary[5], array('0', '1'))) {
					$this->exevars['asc'] = $varary[5];
				}
			}

			if (6 < $arynum) {
				$varary[6] = trim($varary[6]);

				if (in_array($varary[6], array('0', '1', '2', '3'))) {
					$this->exevars['isvip'] = $varary[6];
				}
			}

			if (7 < $arynum) {
				$varary[7] = trim($varary[7]);
				$tmpvar = str_replace('|', '', $varary[7]);

				if (is_numeric($tmpvar)) {
					$this->exevars['rgroup'] = $varary[7];
				}
				else if (substr($varary[7], 0, 1) == '$') {
					$tmpvar1 = $jieqiTpl->get_assign(substr($varary[7], 1));

					if (is_numeric(str_replace('|', '', $tmpvar1))) {
						$this->exevars['rgroup'] = $tmpvar1;
					}
				}
				else {
					if (isset($_REQUEST[$tmpvar]) && is_numeric($_REQUEST[$tmpvar])) {
						$this->exevars['rgroup'] = $_REQUEST[$tmpvar];
					}
				}

//				if (is_numeric($varary[7])) {
//					$this->exevars['rgroup'] = intval($varary[7]);
//				}
			}
		}

		$this->blockvars['cacheid'] = md5(serialize($this->exevars) . '|' . $this->blockvars['template']);
		if (($this->exevars['order'] == 'lastupdate') || ($this->exevars['order'] == 'postdate')) {
			include_once $jieqiModules['article']['path'] . '/include/funarticle.php';
			$this->blockvars['overtime'] = jieqi_article_getuptime();
		}
	}

	public function setContent($isreturn = false)
	{
		global $jieqiTpl;
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTop;

		if (!isset($jieqiTop['article'])) {
			jieqi_getconfigs('article', 'top', 'jieqiTop');
		}

		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
		include_once $GLOBALS['jieqiModules']['article']['path'] . '/include/funarticle.php';
		jieqi_getconfigs('article', 'configs');
		jieqi_getconfigs('article', 'sort');
		$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $GLOBALS['jieqiModules']['article']['url'] : $jieqiConfigs['article']['staticurl']);
		$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $GLOBALS['jieqiModules']['article']['url'] : $jieqiConfigs['article']['dynamicurl']);
		$jieqiTpl->assign('article_static_url', $article_static_url);
		$jieqiTpl->assign('article_dynamic_url', $article_dynamic_url);
		$tmpvar = explode('-', date('Y-m-d', JIEQI_NOW_TIME));
		$daystart = mktime(0, 0, 0, (int) $tmpvar[1], (int) $tmpvar[2], (int) $tmpvar[0]);
		$monthstart = mktime(0, 0, 0, (int) $tmpvar[1], 1, (int) $tmpvar[0]);
		$tmpvar = date('w', JIEQI_NOW_TIME);

		if ($tmpvar == 0) {
			$tmpvar = 7;
		}

		$weekstart = $daystart;

		if (1 < $tmpvar) {
			$weekstart -= ($tmpvar - 1) * 86400;
		}

		$repfrom = array('<{$daystart}>', '<{$weekstart}>', '<{$monthstart}>');
		$repto = array($daystart, $weekstart, $monthstart);
		if (($this->exevars['isvip'] == 1) || ($this->exevars['isvip'] == 3)) {
			if ($jieqiTop['article'][$this->exevars['order']]['sort'] != '') {
				$freeorders = array('articleid', 'lastupdate', 'freetime', 'viptime', 'postdate', 'toptime', 'goodnum', 'reviewsnum', 'ratenum', 'ratesum', 'size', 'monthsize', 'weeksize', 'daysize', 'allvipvote', 'monthvipvote', 'weekvipvote', 'dayvipvote', 'previpvote', 'allvisit', 'monthvisit', 'weekvisit', 'dayvisit', 'allvote', 'monthvote', 'weekvote', 'dayvote', 'allflower', 'monthflower', 'weekflower', 'dayflower', 'allegg', 'monthegg', 'weekegg', 'dayegg', 'alldown', 'monthdown', 'weekdown', 'daydown');
				$viporders = array('allsale', 'monthsale', 'weeksale', 'daysale', 'normalsale', 'vipsale', 'freesale', 'bespsale', 'totalsale', 'sumegold', 'sumesilver', 'sumtip', 'sumhurry', 'sumbesp', 'sumaward', 'sumagent', 'sumgift', 'sumother', 'sumemoney', 'summoney');
				$orderfrom = array();
				$orderto = array();

				foreach ($freeorders as $order) {
					$orderfrom[] = $order;
					$orderto[] = 'a.' . $order;
				}

				foreach ($viporders as $order) {
					$orderfrom[] = $order;
					$orderto[] = 'o.' . $order;
				}

				$jieqiTop['article'][$this->exevars['order']]['sort'] = str_replace($orderfrom, $orderto, $jieqiTop['article'][$this->exevars['order']]['sort']);
			}

			$sql = 'SELECT *';

			if ($jieqiTop['article'][$this->exevars['order']]['sort'] != '') {
				$sql .= ', ' . jieqi_dbslashes($jieqiTop['article'][$this->exevars['order']]['sort']) . ' AS ordervalue';
			}

			$sql .= ' FROM ' . jieqi_dbprefix('obook_obook') . ' o LEFT JOIN ' . jieqi_dbprefix('article_article') . ' a ON o.articleid = a.articleid WHERE o.articleid > 0 AND a.display = 0 AND a.size > 0 AND a.isvip > 0';

			if ($this->exevars['isvip'] == 3) {
				$sql .= ' AND a.monthly > 0';
			}

			if (!empty($this->exevars['sortid'])) {
				$sortary = explode('|', $this->exevars['sortid']);

				if (0 < count($sortary)) {
					$ssql = '';

					foreach ($sortary as $ss) {
						if ($ssql != '') {
							$ssql .= ' OR ';
						}

						if (strrchr($ss, '.') == false) {
							$ssql .= 'a.sortid = ' . intval($ss);
						}
						else {
							$ssql .= 'a.typeid = ' . intval(substr(strrchr($ss, '.'), 1));
						}
					}

					if (1 < count($sortary)) {
						$ssql = '(' . $ssql . ')';
					}

					$sql .= ' AND ' . $ssql;
				}
			}

			if ($this->exevars['original'] == 1) {
				$sql .= ' AND a.authorid > 0';
			}
			else if ($this->exevars['original'] == 2) {
				$sql .= ' AND a.authorid = 0';
			}

			if ($this->exevars['isfull'] == 1) {
				$sql .= ' AND a.fullflag = 1';
			}
			else if ($this->exevars['isfull'] == 2) {
				$sql .= ' AND a.fullflag = 0';
			}

			if (is_numeric($this->exevars['rgroup']) && (0 <= $this->exevars['rgroup'])) {
				$sql .= ' AND rgroup = ' . intval($this->exevars['rgroup']);
			}

			$repfrom[] = 'postdate';
			$repto[] = 'a.postdate';
			$repfrom[] = 'last';
			$repto[] = 'a.last';
			$repfrom[] = 'a.lastsale';
			$repto[] = 'o.lastsale';

			if ($jieqiTop['article'][$this->exevars['order']]['where'] != '') {
				$sql .= ' AND ' . str_replace($repfrom, $repto, $jieqiTop['article'][$this->exevars['order']]['where']);
			}

			if ($jieqiTop['article'][$this->exevars['order']]['sort'] != '') {
				$sql .= ' ORDER BY ' . jieqi_dbslashes($jieqiTop['article'][$this->exevars['order']]['sort']);

				if ($this->exevars['asc'] == 1) {
					$sql .= ' ASC';
				}
				else {
					$sql .= ' DESC';
				}
			}
		}
		else {
			$sql = 'SELECT *';

			if ($jieqiTop['article'][$this->exevars['order']]['sort'] != '') {
				$sql .= ', ' . jieqi_dbslashes($jieqiTop['article'][$this->exevars['order']]['sort']) . ' AS ordervalue';
			}

			$sql .= ' FROM ' . jieqi_dbprefix('article_article') . ' WHERE display = 0 AND size > 0';

			if (!empty($this->exevars['sortid'])) {
				$sortary = explode('|', $this->exevars['sortid']);

				if (0 < count($sortary)) {
					$ssql = '';

					foreach ($sortary as $ss) {
						if ($ssql != '') {
							$ssql .= ' OR ';
						}

						if (strrchr($ss, '.') == false) {
							$ssql .= 'sortid = ' . intval($ss);
						}
						else {
							$ssql .= 'typeid = ' . intval(substr(strrchr($ss, '.'), 1));
						}
					}

					if (1 < count($sortary)) {
						$ssql = '(' . $ssql . ')';
					}

					$sql .= ' AND ' . $ssql;
				}
			}

			if ($this->exevars['original'] == 1) {
				$sql .= ' AND authorid > 0';
			}
			else if ($this->exevars['original'] == 2) {
				$sql .= ' AND authorid = 0';
			}

			if ($this->exevars['isfull'] == 1) {
				$sql .= ' AND fullflag = 1';
			}
			else if ($this->exevars['isfull'] == 2) {
				$sql .= ' AND fullflag = 0';
			}

			if ($this->exevars['isvip'] == 1) {
				$sql .= ' AND isvip > 0';
			}
			else if ($this->exevars['isvip'] == 2) {
				$sql .= ' AND isvip = 0';
			}
			else if ($this->exevars['isvip'] == 3) {
				$sql .= ' AND isvip > 0 AND monthly > 0';
			}

			if (is_numeric($this->exevars['rgroup']) && (0 <= $this->exevars['rgroup'])) {
				$sql .= ' AND rgroup = ' . intval($this->exevars['rgroup']);
			}

			if ($jieqiTop['article'][$this->exevars['order']]['where'] != '') {
				$sql .= ' AND ' . str_replace($repfrom, $repto, $jieqiTop['article'][$this->exevars['order']]['where']);
			}

			if ($jieqiTop['article'][$this->exevars['order']]['sort'] != '') {
				$sql .= ' ORDER BY ' . $jieqiTop['article'][$this->exevars['order']]['sort'];

				if ($this->exevars['asc'] == 1) {
					$sql .= ' ASC';
				}
				else {
					$sql .= ' DESC';
				}
			}
		}

		$sql .= ' LIMIT 0, ' . $this->exevars['listnum'];
		$res = $query->execute($sql);
		$articlerows = array();
		$k = 0;

		while ($v = $query->getObject($res)) {
			$articlerows[$k] = jieqi_article_vars($v);
			$articlerows[$k]['order'] = $k + 1;

			if (!isset($articlerows[$k]['ordervalue'])) {
				$articlerows[$k]['ordervalue'] = $v->getVar($this->exevars['order']);
			}

			if ($articlerows[$k]['ordervalue'] === false) {
				$articlerows[$k]['ordervalue'] = '';
			}

			if (is_numeric($articlerows[$k]['ordervalue'])) {
				$articlerows[$k]['ordervalue'] = round($articlerows[$k]['ordervalue']);
			}

			if ($this->exevars['order'] == 'size') {
				$articlerows[$k]['ordervalue'] = jieqi_sizeformat($articlerows[$k]['ordervalue'], 'c');
			}
			else {
				if (($this->exevars['order'] == 'lastupdate') || ($this->exevars['order'] == 'postdate') || ($this->exevars['order'] == 'toptime') || ($this->exevars['order'] == 'lastvote')) {
					$articlerows[$k]['ordervalue'] = date('m-d', $articlerows[$k]['ordervalue']);
				}
			}

			$articlerows[$k]['visitnum'] = $articlerows[$k]['ordervalue'];
			$k++;
		}

		$jieqiTpl->assign_by_ref('articlerows', $articlerows);
		$topsort = $this->exevars['order'];

		if ($topsort == 'lastupdate') {
			if ($this->exevars['original'] == 1) {
				$topsort = 'authorupdate';
			}
			else if ($this->exevars['original'] == 2) {
				$topsort = 'masterupdate';
			}
		}

		if (($this->exevars['original'] == 0) && ($this->exevars['isfull'] == 0) && ($this->exevars['asc'] == 0) && ($this->exevars['isvip'] == 0) && ($this->exevars['rgroup'] < 0)) {
			$jieqiTpl->assign('url_more', jieqi_geturl('article', 'toplist', 1, $this->exevars['order'], $this->exevars['sortid']));
		}
		else {
			$jieqiTpl->assign('url_more', jieqi_geturl('article', 'articlefilter', 1, $this->exevars));
		}
	}
}


?>
