<?php
echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
<title>'.$this->_tpl_vars['title'].'</title>
</head>
<body>
'.$this->_tpl_vars['uname'].'�����ã�<br />
&nbsp;&nbsp;&nbsp;&nbsp;�յ�����ʼ�����Ϊ���� <a href="'.$this->_tpl_vars['jieqi_local_url'].'" target="_blank">'.$this->_tpl_vars['jieqi_sitename'].'</a> ѡ���������趨���빦�ܡ�<br />
&nbsp;&nbsp;&nbsp;&nbsp;������������ӣ���������ҳ��ʾ�����趨���룺<br />
&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$this->_tpl_vars['url_setpass'].'" target="_blank">'.htmlspecialchars($this->_tpl_vars['url_setpass']).'</a><br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;������������Ӳ���ֱ�ӵ�����븴�����ӵ�ַ���������ַ��������ʡ�<br />
&nbsp;&nbsp;&nbsp;&nbsp;�������û������������趨���룬����Ա��ʼ���<br />
&nbsp;&nbsp;&nbsp;&nbsp;�����ʼ���ϵͳ�Զ����ͣ�����ظ�����л�������ǵ�֧�֣�<br />
<br />
'.$this->_tpl_vars['jieqi_sitename'].'<br />
'.date('Y-m-d H:i:s',$this->_tpl_vars['jieqi_time']).'
</body>
</html>';
?>