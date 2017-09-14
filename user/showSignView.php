<?php 
define('JIEQI_MODULE_NAME', 'system');
require_once('../global.php');
//include_once(JIEQI_ROOT_PATH.'/header.php');
jieqi_includedb();
$uid=$_SESSION['jieqiUserId'];
$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
$sql = "SELECT * FROM " . jieqi_dbprefix('system_qiandao') . " WHERE  uid = $uid limit 1";
$query->execute($sql);
$row = $query->getRow();
$arr =array(
'totalsign'=>$row['totalsign'],
'dates'=>$row['dates']
);

echo json_encode($arr);

//$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch(JIEQI_ROOT_PATH.'/user/templates/showSignView.html'));
//$jieqiTset['jieqi_page_template'] = JIEQI_ROOT_PATH.'/user/templates/showSignView.html';
//include_once(JIEQI_ROOT_PATH.'/footer.php');
?>