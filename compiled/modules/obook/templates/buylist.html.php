<?php
echo '
<div id="content"><link href="/sink/css/user.css" type="text/css" rel="stylesheet">

<!--wrap begin-->
<div class="wrap2">
  <script type="text/javascript">
$(function(){
	
  var ss = \'userhub\'+\'_\'+\'\';
  if(ss == \'userhub_inbox\' || ss == \'userhub_outbox\' || ss == \'userhub_draft\' || ss == \'userhub_toSysView\' || ss == \'userhub_messagedetail\'){
      $(\'#userhub_newmessage\').parent("dl.list_menu").show();
	  $(\'#userhub_newmessage\').children("a").addClass("focus");
  }
  if(ss == \'chapter_cmView\'){
      $(\'#article_masterPage\').parent("dl.list_menu").show();
	  $(\'#article_masterPage\').children("a").addClass("focus");
  }
//  if(\'\' == \'upaView\'){
//      $(\'#userhub_usereditView\').parent("dl.list_menu").show();
//	  $(\'#userhub_usereditView\').children("a").addClass("focus");
//  }
  if(\'\' == \'hotcomment\'){
      $(\'#userhub_comment\').parent("dl.list_menu").show();
	  $(\'#userhub_comment\').children("a").addClass("focus");
  }
  if(\'\' == \'uservip\'){
      $(\'#userhub_usermember\').parent("dl.list_menu").show();
	  $(\'#userhub_usermember\').children("a").addClass("focus");
  }
  if(\'\' == \'moderatorView\'){
      $(\'#userhub_review_view\').parent("dl.list_menu").show();
	  $(\'#userhub_review_view\').children("a").addClass("focus");
  }
  $(\'#\'+ss).parent("dl.list_menu").show();
  $(\'#\'+ss).children("a").addClass("focus");
  $("li#row em").click(function(){
  $(this).parent().parent().children("dl.list_menu").toggle(300);
  });
});

</script>
<!--sidebar2 begin-->
  <div class="sidebar2 fl bg4 fix">
	
		    <div class="user2 f_blue fix">
'.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'

	'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
  <div class="kf"></div>
  </div>
  <div class="article2 fr">
	<div class="boxm2">
<table class="grid" width="100%" align="center">
<caption>VIP作品订阅记录</caption>
  <tr align="center">
    <th width="20%">书名</th>
	<th width="15%">最近更新</th>
	<th width="15%">最后购买</th>
    <th width="20%">已订阅/总章节</th>
	<th width="30%">操作</th>
  </tr>
  ';
if (empty($this->_tpl_vars['obuyrows'])) $this->_tpl_vars['obuyrows'] = array();
elseif (!is_array($this->_tpl_vars['obuyrows'])) $this->_tpl_vars['obuyrows'] = (array)$this->_tpl_vars['obuyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['obuyrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['obuyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['obuyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['obuyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['obuyrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['articleid'],'index').'" target="_blank">'.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obookname'].'</a></td>
	<td align="center">';
if($this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['lastupdate'] > $this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['buytime']){
echo '<span class="hottext">'.date('Y-m-d H:i',$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</span>';
}else{
echo date('Y-m-d H:i',$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['lastupdate']);
}
echo '</td>
	<td align="center">'.date('Y-m-d H:i',$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['buytime']).'</td>
    <td align="center">'.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['chapternum'].'/'.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['chapters'].'</td>
	<td align="center">
	<a href="'.$this->_tpl_vars['obook_dynamic_url'].'/buylog.php?oid='.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obookid'].'">订阅记录</a>
	';
if($this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['autobuy'] > 0){
echo '
	| <a href="buylist.php?obuyid='.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obuyid'].'&action=unsetautobuy&page='.$this->_tpl_vars['jieqi_page_nowpage'].'" title="自动订阅表示点击一个未订阅VIP章节阅读时，系统不提示购买，自动订阅并显示阅读页面">取消自动订阅</a>
	';
}else{
echo '
	| <a href="buylist.php?obuyid='.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obuyid'].'&action=setautobuy&page='.$this->_tpl_vars['jieqi_page_nowpage'].'" title="自动订阅表示点击一个未订阅VIP章节阅读时，系统不提示购买，自动订阅并显示阅读页面">设为自动订阅</a>
	';
}
echo '
	</td>
  </tr>
  ';
}
echo '
</table>
'.$this->_tpl_vars['url_jumppage'].'
</div>
</div></div></div>

';
?>