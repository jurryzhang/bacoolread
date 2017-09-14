<?php
echo '
<link rel="stylesheet" type="text/css" href="/sink/css/au.css"/>

<!---------------------------------------新闻显示开始-------------------------------------->
<div>
<!--栏目导航-->
<div class="c_nav"><a href="'.$this->_tpl_vars['jieqi_url'].'/">首页</a> &gt; 新闻中心</div>

<div class="c_title">'.$this->_tpl_vars['title'].'</div>
<div class="c_head" style="text-align:center">
  <span class="c_lebel">作者：</span><span class="c_value">'.$this->_tpl_vars['author'].'</span>
  <span class="c_lebel">来源：</span><span class="c_value">'.$this->_tpl_vars['source'].'</span>
  <span class="c_lebel">发布者：</span><span class="c_value">'.$this->_tpl_vars['poster'].'</span>
  <span class="c_lebel">发布时间：</span><span class="c_value">'.$this->_tpl_vars['date'].'</span>
</div>
<hr />
<!--获取新闻内容-->
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
//获取新闻统计列表
function geTopBar(){
	Ajax.Update(\''.$this->_tpl_vars['stat_url'].'?method=fetch&id='.$this->_tpl_vars['id'].'\', {outid:\'top_list\',tipid:\'top_list\',onLoading:\'新闻统计数据加载中...\'});
}

function getRelateNewsList(){
	Ajax.Update(\''.$this->_tpl_vars['relt_url'].'?method=fetch&id='.$this->_tpl_vars['id'].'\', {outid:\'relt_list\',tipid:\'relt_list\',onLoading:\'相关新闻列表加载中...\'});
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