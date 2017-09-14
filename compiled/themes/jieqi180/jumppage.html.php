<?php
echo '<html>
<head>
<meta http-equiv="content-type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
<meta http-equiv="refresh" content=\'3; url='.$this->_tpl_vars['url'].'\'>
<title>'.$this->_tpl_vars['pagetitle'].'</title>
<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['jieqi_themeurl'].'style.css" />
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/common.js"></script>
</head>
<body>
<div style="width:100%; text-align:center; padding-top:150px;">
<div id="msgboard" style="margin:auto; width:40%;">
  <div class="block">
    <div class="blocktitle">'.$this->_tpl_vars['title'].'</div>
    <div class="blockcontent"><br />'.$this->_tpl_vars['content'].'<br /><br />如不能自动跳转，<a href="'.$this->_tpl_vars['url'].'">点击这里直接进入！</a><br /><br /></div>
  </div>
</div>
</div>
</body>
</html>';
?>