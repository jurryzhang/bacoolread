<?php
echo '
<table width="100%"  border="0" cellspacing="8">
	<tr align="center">
		<td colspan="4" align="center" valign="middle">
            <span style="font-size:16px; font-weight:bold; line-height:150%;">'.$this->_tpl_vars['obookname'].'</span>
		</td>
	</tr>
	<tr>
        <td width="25%">���'.$this->_tpl_vars['sort'].'</td>
        <td width="25%">���ߣ�';
if($this->_tpl_vars['authorid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['authorid']).'" target="_blank">'.$this->_tpl_vars['author'].'</a>';
}else{
echo $this->_tpl_vars['author'];
}
echo '</td>
        <td width="25%">������'.$this->_tpl_vars['size_c'].'</td>
		<td width="25%">���£�'.date('Y-m-d',$this->_tpl_vars['lastupdate']).'</td>
	</tr>
	<tr>
        <td colspan="4">�����½ڣ�<a href="'.$this->_tpl_vars['url_lastchapter'].'">'.$this->_tpl_vars['lastchapter'].'</a></td>
	</tr>
	<tr>
		<td width="25%"><a class="btnlink" href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info').'">��ϸ��Ϣ</a></td>
		<td width="25%"><a class="btnlink" href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'index').'">��ƷĿ¼</a></td>
		<td width="25%"><a class="btnlink" id="a_addbookcase" href="javascript:;" onclick="if('.$this->_tpl_vars['jieqi_userid'].') Ajax.Tip(event, \''.$this->_tpl_vars['url_bookcase'].'\',3000); else openDialog(\''.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'&ajax_gets=jieqi_contents\', false);">�������</a></td>
		<td width="25%"><a class="btnlink" href="'.$this->_tpl_vars['url_manage'].'">������</a></td>
	</tr>
</table>

<form action="'.$this->_tpl_vars['url_buyobook'].'" method="post" name="frmbuy" onsubmit="return checkbuy(this);">
      <div style="text-align:center;padding:5px;">
	  
      </div>
	  <input name="oid" type="hidden" value="'.$this->_tpl_vars['obookid'].'" />
	  <table class="grid" width="100%" align="center">
      <caption>
	  VIP�½�Ŀ¼
	  </caption>
        <tr align="center">
          <th width="45%">�½�����</th>
          <th width="15%">����ʱ��</th>
          <th width="15%">����</th>
          <th width="15%">�۸�</th>
		  <th width="10%">����</th>
        </tr>
        ';
if (empty($this->_tpl_vars['ochapterrows'])) $this->_tpl_vars['ochapterrows'] = array();
elseif (!is_array($this->_tpl_vars['ochapterrows'])) $this->_tpl_vars['ochapterrows'] = (array)$this->_tpl_vars['ochapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['ochapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['ochapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['ochapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['ochapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['ochapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr>
          <td><a href="'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'" target="_blank">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></td>
          <td align="center">'.date('Y-m-d',$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['postdate']).'</td>
          <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['size_c'].'</td>
          <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['saleprice'].'</td>
		  <td align="center"><a href="'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'" target="_blank">����</a></td>
        </tr>
        ';
}
echo '
      </table>
</form>';
?>