<?php
/**
 * ��վƵ��
 *
 * ��վƵ���������û��޸�����������ģ��ʵ�ֶ���Ч��
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: index.php 344 2013-05-20 03:06:07Z juny $
 */

//���屾ҳ������ģ�飨�����޸ģ�
define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

//jieqi_getconfigs(JIEQI_MODULE_NAME, 'blocks', 'groupblocks');
jieqi_getconfigs(JIEQI_MODULE_NAME, "groupblocks", "jieqiBlocks");
jieqi_getconfigs("article", "option", "jieqiOption");


include_once JIEQI_ROOT_PATH . '/header.php';

if (empty($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}
$id = $_GET['id'];

$groupname = $jieqiOption['article']['rgroup']['items'][$id];
$jieqiTpl->assign('groupname', $groupname);
$jieqiTpl->assign('id', $id);


$jieqiTset['jieqi_page_template'] = $jieqiModules['article']['path'] . '/templates/group.html';


$jieqiTpl->setCaching(0);


include_once JIEQI_ROOT_PATH . '/footer.php';
?>