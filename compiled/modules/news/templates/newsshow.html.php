<?php
echo '
<link rel="stylesheet" type="text/css" href="/sink/css/au.css"/>

<!---------------------------------------������ʾ��ʼ-------------------------------------->
<div>
<!--��Ŀ����-->
<div class="c_nav"><a href="'.$this->_tpl_vars['jieqi_url'].'/">��ҳ</a> &gt; ��������</div>

<div class="c_title">'.$this->_tpl_vars['title'].'</div>
<div class="c_head" style="text-align:center">
  <span class="c_lebel">���ߣ�</span><span class="c_value">'.$this->_tpl_vars['author'].'</span>
  <span class="c_lebel">��Դ��</span><span class="c_value">'.$this->_tpl_vars['source'].'</span>
  <span class="c_lebel">�����ߣ�</span><span class="c_value">'.$this->_tpl_vars['poster'].'</span>
  <span class="c_lebel">����ʱ�䣺</span><span class="c_value">'.$this->_tpl_vars['date'].'</span>
</div>
<hr />
<!--��ȡ��������-->
<div class="c_content">
<ul>
<li style="width:100%;line-height:24px; padding:0px 5px 0px 5px; font-size:12px">'.$this->_tpl_vars['body'].'</li>

</ul>
</div>

<hr />
<div class="c_foot" id="top_list"></div>
<br />

</div>
<script language="JavaScript">
<!--
//��ȡ����ͳ���б�
function geTopBar(){
	Ajax.Update(\''.$this->_tpl_vars['stat_url'].'?method=fetch&id='.$this->_tpl_vars['id'].'\', {outid:\'top_list\',tipid:\'top_list\',onLoading:\'����ͳ�����ݼ�����...\'});
}

function getRelateNewsList(){
	Ajax.Update(\''.$this->_tpl_vars['relt_url'].'?method=fetch&id='.$this->_tpl_vars['id'].'\', {outid:\'relt_list\',tipid:\'relt_list\',onLoading:\'��������б������...\'});
}
geTopBar();

';
if($this->_tpl_vars['relt_show'] == 1){
echo 'getRelateNewsList();';
}
echo '
//-->
</script>';
?>