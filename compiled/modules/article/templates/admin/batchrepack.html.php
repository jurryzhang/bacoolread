<?php
echo '<form name="batchrepack" id="batchrepack" action="'.$this->_tpl_vars['url_batchclean'].'" target="_blank" method="post" onsubmit="return confirm(\'确实要开始重新生成么？\');">
<table class="grid" width="100%" align="center">
<caption>小说批量生成</caption>
<tr>
  <td class="tdl" width="25%">限制条件：</td>
  <td class="tdr" width="75%">
  <input name="action" type="radio" value="packwithid" checked="checked"> 小说ID从 <input type="text" class="text" name="fromid" id="fromid" size="10" maxlength="15" value="'.$this->_tpl_vars['minaid'].'" /> 到 <input type="text" class="text" name="toid" id="toid" size="10" maxlength="15" value="'.$this->_tpl_vars['maxaid'].'" /> <span class="hottext">当前数据库小说ID为：'.$this->_tpl_vars['minaid'].' - '.$this->_tpl_vars['maxaid'].'</span>
  <hr />
  <input name="action" type="radio" value="packwithtime"> 更新时间从 <input type="text" class="text" name="starttime" id="starttime" size="20" maxlength="20" value="" /> 到 <input type="text" class="text" name="stoptime" id="stoptime" size="20" maxlength="20" value="" /> <span class="hottext">时间格式举例：2005-01-23 23:06:30</span>
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
  <td class="tdl">生成选项：</td>
  <td class="tdr"><input type="checkbox" class="checkbox" name="packflag[]" value="makeopf" />生成OPF(小说目录结构文件)
<input type="checkbox" class="checkbox" name="packflag[]" value="makeindex" />生成目录页HTML
<input type="checkbox" class="checkbox" name="packflag[]" value="makechapter" />生成章节页HTML
<input type="checkbox" class="checkbox" name="packflag[]" value="maketxtjs" />生成章节内容JS
<input type="checkbox" class="checkbox" name="packflag[]" value="makezip" />生成ZIP
<input type="checkbox" class="checkbox" name="packflag[]" value="makefull" />生成HTML全文阅读
<input type="checkbox" class="checkbox" name="packflag[]" value="maketxtfull" />生成TXT全文阅读
<input type="checkbox" class="checkbox" name="packflag[]" value="makeumd" />生成手机电子书UMD
<input type="checkbox" class="checkbox" name="packflag[]" value="makejar" />生成手机电子书JAR
</td>
</tr>
<tr>
  <td class="tdl">&nbsp;</td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="开始生成" /></td>
</tr>
</table>
</form>';
?>