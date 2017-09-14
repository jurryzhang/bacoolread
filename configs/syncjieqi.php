<?php
//资源站服务相关参数设置
$jieqiSetting = array();
$jieqiSetting['siteid'] = '1'; //本站在资源站的ID
$jieqiSetting['siteip'] = '127.0.0.3'; //本站服务器IP
$jieqiSetting['getkey'] = 'N3Ur6C6pZlNMxTeS3T2dbBWMWx996xcV'; //通讯密钥
//本站和资源站服务的小说列表地址
$jieqiSetting['articlelist'] = 'http://www.iwodu.com/apis/demo/articlelist.php'; 
//本站和资源站服务的小说信息地址
$jieqiSetting['articleinfo'] = 'http://www.iwodu.com/apis/demo/articleinfo.php'; 
//本站和资源站服务的章节列表地址
$jieqiSetting['articlechapter'] = 'http://www.iwodu.com/apis/demo/articlechapter.php'; 
//本站和资源站服务的章节内容地址
$jieqiSetting['chaptercontent'] = 'http://www.iwodu.com/apis/demo/chaptercontent.php'; 
//更新时间(时间格式的数字字符串，包含4位年、2位月、2位日、2位时、2位分、2位秒，比如：2014年11月6日8点30分，表示为：20141106083000)
$jieqiSetting['uptime'] = ''; 
//资源站的小说分类名称和本站的分类ID对应关系（default 表示对应不上时候的默认分类）
$jieqiSetting['articlesort'] = array('玄幻魔法'=>1, '武侠修真'=>2, '都市言情'=>3, '历史军事'=>4, '穿越架空'=>5, '游戏竞技'=>6, '科幻灵异'=>7, '同人动漫'=>8, '社会文学'=>9, '综合其他'=>10, 'default'=>10) ;
?>