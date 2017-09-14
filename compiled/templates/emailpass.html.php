<?php
echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
<title>'.$this->_tpl_vars['title'].'</title>
</head>
<body>
'.$this->_tpl_vars['uname'].'，您好：<br />
&nbsp;&nbsp;&nbsp;&nbsp;收到这封邮件是因为您在 <a href="'.$this->_tpl_vars['jieqi_local_url'].'" target="_blank">'.$this->_tpl_vars['jieqi_sitename'].'</a> 选择了重新设定密码功能。<br />
&nbsp;&nbsp;&nbsp;&nbsp;请访问以下链接，并按照网页提示重新设定密码：<br />
&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$this->_tpl_vars['url_setpass'].'" target="_blank">'.htmlspecialchars($this->_tpl_vars['url_setpass']).'</a><br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;·如果以上链接不能直接点击，请复制链接地址到浏览器地址栏输入访问。<br />
&nbsp;&nbsp;&nbsp;&nbsp;·如果您没有申请过重新设定密码，请忽略本邮件。<br />
&nbsp;&nbsp;&nbsp;&nbsp;·本邮件由系统自动发送，请勿回复，感谢您对我们的支持！<br />
<br />
'.$this->_tpl_vars['jieqi_sitename'].'<br />
'.date('Y-m-d H:i:s',$this->_tpl_vars['jieqi_time']).'
</body>
</html>';
?>