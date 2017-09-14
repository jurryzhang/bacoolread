<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>'.$this->_tpl_vars['articlename'].'-'.$this->_tpl_vars['sort'].'-'.$this->_tpl_vars['jieqi_sitename'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
<meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'" />
<meta name="description" content="'.$this->_tpl_vars['meta_description'].'" />
<meta name="author" content="'.$this->_tpl_vars['meta_author'].'" />
<meta name="copyright" content="'.$this->_tpl_vars['meta_copyright'].'" />
<meta name="generator" content="jieqi.com" />
<link rel="stylesheet" href="'.$this->_tpl_vars['static_url'].'/css/page.css" type="text/css" media="all"  />
</head>
<body bgcolor="#e7f4fe">

<div class="ad"><script type="text/javascript" src="'.$this->_tpl_vars['static_url'].'/scripts/fulltop.js"></script></div>

<div class="headlink">
<div class="linkleft"><a href="'.$this->_tpl_vars['jieqi_main_url'].'/">'.$this->_tpl_vars['jieqi_sitename'].'</a>-&gt;<a href="'.$this->_tpl_vars['url_bookroom'].'">�����ҳ</a>-&gt;<a href="'.$this->_tpl_vars['url_articleinfo'].'">'.$this->_tpl_vars['articlename'].'</a></div>

<div class="linkright"><a href="'.$this->_tpl_vars['dynamic_url'].'/addbookcase.php?bid='.$this->_tpl_vars['articleid'].'" target="_blank">�������</a> | <a href="'.$this->_tpl_vars['dynamic_url'].'/uservote.php?id='.$this->_tpl_vars['articleid'].'" target="_blank">�Ƽ�����</a> | <a href="'.$this->_tpl_vars['url_articleinfo'].'">������ҳ</a></div>
</div>

<div class="title">'.$this->_tpl_vars['book_title'].'</div>

<div class="info">���ߣ�'.$this->_tpl_vars['author'].'</div>

<div class="index">
';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['chapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] > 0){
echo '
		';
if($this->_tpl_vars['i']['order'] > 1){
echo '</ul>';
}
echo '
		<div class="volume">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</div>
		';
if($this->_tpl_vars['i']['order'] < $this->_tpl_vars['i']['count']){
echo '<ul class="chapters">';
}
echo '
	';
}else{
echo '
		';
if($this->_tpl_vars['i']['order'] == 1){
echo '<ul class="chapters">';
}
echo '
		<li class="chapter"><a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'" title="'.date('Y-m-d H:i',$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'���£���'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['size_c'].'��">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></li>
		';
if($this->_tpl_vars['i']['order'] == $this->_tpl_vars['i']['count']){
echo '</ul>';
}
echo '
	';
}
}
echo '
</div>

';
if (empty($this->_tpl_vars['chapters'])) $this->_tpl_vars['chapters'] = array();
elseif (!is_array($this->_tpl_vars['chapters'])) $this->_tpl_vars['chapters'] = (array)$this->_tpl_vars['chapters'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['chapters']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['chapters']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['chapters']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapters']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['chapters']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
<div class="chapterblock">
	<div class="chaptertitle">'.$this->_tpl_vars['chapters'][$this->_tpl_vars['i']['key']]['title'].'</div>
	<div class="chaptercontent">'.$this->_tpl_vars['chapters'][$this->_tpl_vars['i']['key']]['content'].'</div>
</div>
';
}
echo '

<div class="ad"><script type="text/javascript" src="'.$this->_tpl_vars['static_url'].'/scripts/fullbottom.js"></script></div>

<div class="copyright">
��Ʒ������������߱��˵Ĺ۵㣬�뱾վ�����޹ء�������ɴ˵����κη��������������վ�������κ����Ρ�<br />
��վ��Ȩ���У�'.$this->_tpl_vars['jieqi_sitename'].'
</div>

</body>
</html>
';
?>