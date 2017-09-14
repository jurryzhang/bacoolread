<?php
echo '<form name="batchreplace" id="batchreplace" action="'.$this->_tpl_vars['url_batchclean'].'" method="post" target="_blank" onsubmit="return confirm(\'确实要开始内容批量替换么？\');">
<table width="100%" class="grid" align="center">
<caption>小说内容批量替换</caption>
<tr>
  <td class="tdl" width="25%">限制条件：</td>
  <td class="tdr" width="75%">
  <input name="action" type="radio" value="replacewithid" checked="checked"> 小说ID从 <input type="text" class="text" name="fromid" id="fromid" size="10" maxlength="15" value="'.$this->_tpl_vars['minaid'].'" /> 到 <input type="text" class="text" name="toid" id="toid" size="10" maxlength="15" value="'.$this->_tpl_vars['maxaid'].'" /> <span class="hottext">当前数据库小说ID为：'.$this->_tpl_vars['minaid'].' - '.$this->_tpl_vars['maxaid'].'</span>
  <hr />
  <input name="action" type="radio" value="replacewithtime"> 更新时间从 <input type="text" class="text" name="starttime" id="starttime" size="20" maxlength="20" value="" /> 到 <input type="text" class="text" name="stoptime" id="stoptime" size="20" maxlength="20" value="" /> <span class="hottext">时间格式举例：2005-01-23 23:06:30</span>
  </td>
</tr>
<tr>
  <td class="tdl">分类：</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="checkbox" class="checkbox" name="sortid[]" value="'.$this->_tpl_vars['i']['key'].'" />'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'].'&nbsp;&nbsp; 
  ';
}
echo '
  </td>
</tr>
<tr>
  <td class="tdl">查找字符串</td>
  <td class="tdr"><textarea class="textarea" name="txtsearch" id="txtsearch" rows="5" cols="60"></textarea></td>
</tr>
<tr>
  <td class="tdl">替换成</td>
  <td class="tdr"><textarea class="textarea" name="txtreplace" id="txtreplace" rows="5" cols="60"></textarea></td>
</tr>
<tr>
  <td class="tdl">替换方法</td>
  <td class="tdr"><input type="radio" class="radio" name="replacetype" value="0" checked="checked" />整个内容作为一个字符串替换
<input type="radio" class="radio" name="replacetype" value="1" />每行内容作为一个字符串替换
</td>
</tr>
<tr>
  <td class="tdl">替换文件类型</td>
  <td class="tdr">
  <input type="checkbox" class="checkbox" name="replaceflag[]" value="filetxt" />小说原始内容(txt)
  <input type="checkbox" class="checkbox" name="replaceflag[]" value="filetxtjs" />章节JS格式内容(js)
  <input type="checkbox" class="checkbox" name="replaceflag[]" value="filehtml" />分章节阅读(html)
  <input type="checkbox" class="checkbox" name="replaceflag[]" value="filefull" />全文阅读(html)
  </td>
</tr>
<tr>
  <td class="tdl">文件大小</td>
  <td class="tdr"><select class="select"  size="1" name="filesize" id="filesize">
<option value="sizeunlimit">不限制</option>
<option value="sizeless">小于1K</option>
<option value="sizemore">大于1K</option>
</select></td>
</tr>
<tr>
  <td class="tdl">&nbsp;</td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="开始生成" /></td>
</tr>
</table>
</form>';
?>