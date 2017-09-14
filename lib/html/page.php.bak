<?php

class JieqiPage extends JieqiObject
{
	public $totalrows;
	public $pagerows;
	public $pagelinks;
	public $current;
	public $totalpages;
	public $linkurl;
	public $pagevar;
	public $useajax;
	public $ajax_parm = '{outid:\'content\', tipid:\'pagestats\', onLoading:\'loading...\', parameters:\'ajax_gets=jieqi_contents\'}';

	public function JieqiPage($totalrows, $pagerows = 30, $current = 1, $pagelinks = 10, $pagevar = 'page', $pageajax = 0)
	{
		global $jieqiTpl;

		if (!is_array($totalrows)) {
			$this->totalrows = $totalrows;
			$this->pagerows = $pagerows;
			$this->current = $current;
			$this->pagelinks = $pagelinks;
			$this->pagevar = $pagevar;
			if ((0 < $pageajax) || (defined('JIEQI_AJAX_PAGE') && (0 < JIEQI_AJAX_PAGE))) {
				$this->useajax = 1;
			}
			else {
				$this->useajax = 0;
			}
		}
		else {
			$this->totalrows = isset($totalrows['count']) ? $totalrows['count'] : 1;
			$this->pagerows = isset($totalrows['rows']) ? $totalrows['rows'] : $pagerows;
			$this->current = isset($totalrows['page']) ? $totalrows['page'] : $current;
			$this->pagelinks = isset($totalrows['links']) ? $totalrows['links'] : $pagelinks;
			$this->pagevar = isset($totalrows['var']) ? $totalrows['var'] : $pagevar;
			if ((0 < $pageajax) || !empty($totalrows['ajax']) || (defined('JIEQI_AJAX_PAGE') && (0 < JIEQI_AJAX_PAGE))) {
				$this->useajax = 1;
			}
			else {
				$this->useajax = 0;
			}
		}

		$this->totalpages = @ceil($this->totalrows / $this->pagerows);
		if (defined('JIEQI_MAX_PAGES') && (0 < JIEQI_MAX_PAGES) && (JIEQI_MAX_PAGES < $this->totalpages)) {
			$this->totalpages = intval(JIEQI_MAX_PAGES);
		}

		if ($this->totalpages <= 1) {
			$this->totalpages = 1;
		}

		$this->linkurl = jieqi_addurlvars(array($this->pagevar => ''), true, false);
		if (isset($jieqiTpl) && is_a($jieqiTpl, 'JieqiTpl')) {
			
			$jieqiTpl->assign('jieqi_page_totalrows', $this->totalrows);
			$jieqiTpl->assign('jieqi_page_pagerows', $this->pagerows);
			$jieqiTpl->assign('jieqi_page_totalpages', $this->totalpages);
			$jieqiTpl->assign('jieqi_page_pagelinks', $this->pagelinks);
			$jieqiTpl->assign('jieqi_page_pagevar', $this->pagevar);
			$jieqiTpl->assign('jieqi_page_useajax', $this->useajax);
			$jieqiTpl->assign('jieqi_page_linkurl', $this->linkurl);
			$jieqiTpl->assign('jieqi_page_current', $this->current);
			$jieqiTpl->assign('jieqi_page_currenturl', $this->pageurl($this->current));
			$jieqi_page_previous = (1 < $this->current ? $this->current - 1 : 0);
			$jieqi_page_previousurl = (0 < $jieqi_page_previous ? $this->pageurl($jieqi_page_previous) : '');
			$jieqi_page_next = ($this->current < $this->totalpages ? $this->current + 1 : 0);
			$jieqi_page_nexturl = (0 < $jieqi_page_next ? $this->pageurl($jieqi_page_next) : '');
			$jieqiTpl->assign('jieqi_page_previous', $jieqi_page_previous);
			$jieqiTpl->assign('jieqi_page_previousurl', $jieqi_page_previousurl);
			$jieqiTpl->assign('jieqi_page_next', $jieqi_page_next);
			$jieqiTpl->assign('jieqi_page_nexturl', $jieqi_page_nexturl);
		}
	}

	public function setlink($link = '', $addget = true, $addpost = false)
	{
		global $jieqiTpl;

		if (!empty($link)) {
			$this->linkurl = $link;
		}
		else {
			$this->linkurl = jieqi_addurlvars(array($this->pagevar => ''), $addget, $addpost);
		}

		if (isset($jieqiTpl) && is_a($jieqiTpl, 'JieqiTpl')) {
			$jieqiTpl->assign('jieqi_page_linkurl', $this->linkurl);
		}
	}

	public function pageurl($page)
	{
		if (strpos($this->linkurl, '<{$' . $this->pagevar) === false) {
			$url = $this->linkurl . $page;
		}
		else {
			$url = str_replace(array('<{$' . $this->pagevar . '|subdirectory}>', '<{$' . $this->pagevar . '}>'), array(jieqi_getsubdir($page), $page), $this->linkurl);
		}

		if ($this->useajax == 1) {
			$url = 'javascript:Ajax.Update(\'' . urldecode($url) . '\',' . $this->ajax_parm . ');';
		}

		return $url;
	}

	public function pagelink($page, $char, $class = '')
	{
		$link_url = $this->pageurl($page);

		if (empty($class))
		{
			return '<a href="' . $link_url . '">' . $char . '</a>';
		}
		else
		{
			return '<a href="' . $link_url . '" class="' . $class . '">' . $char . '</a>';
		}
	}

	public function first_page($link = 1, $char = '')
	{
		if ($char == '')
		{
			//burn修改，2017-02-04
//			$char = '1';
			
			$char = '第1页';
			
			$char = iconv("UTF-8","GBK//IGNORE",$char);
		}

		if ($link == 1)
		{
			return $this->pagelink(1, $char, 'first');
		}
		else
		{
			return 1;
		}
	}

	public function total_page($link = 1, $char = '')
	{
		if ($char == '')
		{
			//burn修改，2017-02-04
//			$char = $this->totalpages;
			
			$char = '最后一页';
			
			$char = iconv("UTF-8","GBK//IGNORE",$char);
		}

		if ($link == 1)
		{
			return $this->pagelink($this->totalpages, $char, 'last');
		}
		else
		{
			return $this->totalpages;
		}
	}

	public function pre_page($char = '')
	{
		if ($char == '')
		{
			//burn修改，2017-02-04
//			$char = '&lt;';
			
			$char = '前一页';
			
			$char = iconv("UTF-8","GBK//IGNORE",$char);
		
		}

		if (1 < $this->current)
		{
			return $this->pagelink($this->current - 1, $char, 'prev');
		}
		else
		{
			return '';
		}
	}

	public function next_page($char = '')
	{
		if ($char == '')
		{
			//burn修改，2017-02-04
//			$char = '&gt;';
			
			$char = '后一页';
			
			$char = iconv("UTF-8","GBK//IGNORE",$char);
		}

		if ($this->current < $this->totalpages)
		{
			return $this->pagelink($this->current + 1, $char, 'next');
		}
		else
		{
			return '';
		}
	}

	public function num_bar()
	{
		$pagelinks = &$this->pagelinks;
		$mid = floor($pagelinks / 2);
		$last = $pagelinks - 1;
		$current = &$this->current;
		$totalpage = &$this->totalpages;
		$linkurl = &$this->linkurl;
		$minpage = (($current - $mid) < 1 ? 1 : $current - $mid);
		$maxpage = $minpage + $last;

		if ($totalpage < $maxpage) {
			$maxpage = &$totalpage;
			$minpage = $maxpage - $last;
			$minpage = ($minpage < 1 ? 1 : $minpage);
		}

		$linkbar = '';
		$i = $minpage;

		for (; $i <= $maxpage; $i++)
		{
			$char = $i;

			if ($i == $current)
			{
				$linkchar = '<span class="current">' . $char . '</span>';
			}
			else
			{
				$linkchar = $this->pagelink($i, $char);
			}

			//burn修改，2017-02-04
//			$linkbar .= $linkchar;
			
			$linkbar .=   '&nbsp;' . $linkchar;
		}

		return $linkbar;
	}

	public function pre_group($char = '')
	{
		$current = &$this->current;
		$linkurl = &$this->linkurl;
		$pagelinks = &$this->pagelinks;
		$mid = floor($pagelinks / 2);
		$minpage = (($current - $mid) < 1 ? 1 : $current - $mid);
		$char = ($char == '' ? '&lt;&lt;' : $char);
		$pgpage = ($pagelinks < $minpage ? $minpage - $mid : 1);
		return $this->pagelink($pgpage, $char, 'pgroup');
	}

	public function next_group($char = '')
	{
		$current = &$this->current;
		$linkurl = &$this->linkurl;
		$totalpage = &$this->totalpages;
		$pagelinks = &$this->pagelinks;
		$mid = floor($pagelinks / 2);
		$last = $pagelinks;
		$minpage = (($current - $mid) < 1 ? 1 : $current - $mid);
		$maxpage = $minpage + $last;

		if ($totalpage < $maxpage) {
			$maxpage = &$totalpage;
			$minpage = $maxpage - $last;
			$minpage = ($minpage < 1 ? 1 : $minpage);
		}

		$char = ($char == '' ? '&gt;&gt;' : $char);
		$ngpage = (($maxpage + $last) < $totalpage ? $maxpage + $mid : $totalpage);
		return $this->pagelink($ngpage, $char, 'ngroup');
	}

	public function whole_num_bar()
	{
		$num_bar = $this->num_bar();
		return  $this->pre_page() . '&nbsp;&nbsp;' . $num_bar . '&nbsp;&nbsp;' . $this->next_page();
	}

	public function jump_form()
	{
		if ($this->useajax == 1) {
			$linkurl = urldecode($this->linkurl);
		}
		else {
			$linkurl = $this->linkurl;
		}

		$pos = strpos($linkurl, '<{$' . $this->pagevar);

		if ($pos === false) {
			$urlcode = '\'' . $linkurl . '\'+this.value';
		}
		else {
			$urlcode = '\'' . $linkurl . '\'.replace(\'<{$' . $this->pagevar . '|subdirectory}>\', \'/\' + Math.floor(this.value / 1000)).replace(\'<{$' . $this->pagevar . '}>\', this.value)';
		}

		if ($this->useajax == 1) {
			$form = '';
		}
		else {
			$form = '';
		}

		return $form;
	}

	public function whole_bar()
	{  
//		return '<div class="page_wrap"><div class="paginator" id="pageHtml2">' .$this->whole_num_bar(). $this->jump_form() . '</div></div>';
		
		//burn修改，2017-02-04
		return '<div class="page_wrap"><div class="paginator" id="pageHtml2">' . $this->first_page() . '&nbsp;&nbsp;' . $this->whole_num_bar() . '&nbsp;&nbsp;' . $this->jump_form() . '&nbsp;&nbsp;' . $this->total_page() . '</div></div>';
	}
}


?>
