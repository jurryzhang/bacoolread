<?php
/**
 * 网站频道
 *
 * 网站频道，允许用户修改载入的区块和模板实现定制效果
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: index.php 344 2013-05-20 03:06:07Z juny $
 */

//定义本页面所属模块（请勿修改）
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