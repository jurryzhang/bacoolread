<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: ����7:12
 *
 * Ƶ���ֲ�ͼ����
 *
 */

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

jieqi_includedb();

//��ȡ���Ѵ�
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_slidebanner');

$query->execute($sql);
$slideBannerList = array();

while ($row = $query->getRow())
{
	$slideBannerList[] = jieqi_query_rowvars($row);
}

$jieqiTpl->assign('slideBannerList',$slideBannerList);

$jieqiTset["jieqi_contents_template"] =  "./templates/slideBannerList.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");