<?php

define('JIEQI_MODULE_NAME', 'system');
require_once '../global.php';
include_once JIEQI_ROOT_PATH . '/class/power.php';
$power_handler = &JieqiPowerHandler::getInstance('JieqiPowerHandler');
$power_handler->getSavedVars('system');
jieqi_checkpower($jieqiPower['system']['adminblock'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang('blocks', JIEQI_MODULE_NAME);
jieqi_getconfigs('system', 'blockfiles', 'jieqiBlockfiles');
include_once JIEQI_ROOT_PATH . '/admin/header.php';

if (empty($_REQUEST['action'])) {
	$_REQUEST['action'] = 'files';
}

switch ($_REQUEST['action']) {
case 'blocks':
	if (empty($_REQUEST['module']) || !preg_match('/^\\w+$/', $_REQUEST['module']) || empty($_REQUEST['filename']) || !preg_match('/^\\w+$/', $_REQUEST['filename'])) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	unset($jieqiBlocks);
	jieqi_getconfigs($_REQUEST['module'], $_REQUEST['filename'], 'jieqiBlocks');
	
	if (!isset($jieqiBlocks)) {
		jieqi_printfail($jieqiLang['system']['block_config_notexists']);
	}

	foreach ($jieqiBlocks as $i => $value) {
		$jieqiBlocks[$i]['modname'] = $jieqiModules[$value['module']]['caption'];
		$jieqiBlocks[$i]['side'] = intval($jieqiBlocks[$i]['side']);
		$jieqiBlocks[$i]['contenttype'] = intval($jieqiBlocks[$i]['contenttype']);
		$jieqiBlocks[$i]['showtype'] = intval($jieqiBlocks[$i]['showtype']);
		$jieqiBlocks[$i]['custom'] = intval($jieqiBlocks[$i]['custom']);
		$jieqiBlocks[$i]['publish'] = intval($jieqiBlocks[$i]['publish']);
		$jieqiBlocks[$i]['hasvars'] = intval($jieqiBlocks[$i]['hasvars']);
	}

	$jieqiTpl->assign_by_ref('blocks', $jieqiBlocks);
	$jieqiTpl->assign('module', jieqi_htmlstr($_REQUEST['module']));
	$jieqiTpl->assign('filename', jieqi_htmlstr($_REQUEST['filename']));
	$modname = (isset($jieqiModules[$_REQUEST['module']]['caption']) ? $jieqiModules[$_REQUEST['module']]['caption'] : $_REQUEST['module']);
	$jieqiTpl->assign('modname', jieqi_htmlstr($modname));
	$blockfile = array();

	foreach ($jieqiBlockfiles as $k => $v) {
		if (($v['module'] == $_REQUEST['module']) && ($v['filename'] == $_REQUEST['filename'])) {
			$blockfile = $v;
			break;
		}
	}

	$blockfile = jieqi_funtoarray('jieqi_htmlstr', $blockfile);
	$jieqiTpl->assign_by_ref('blockfile', $blockfile);
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = $jieqiModules['system']['path'] . '/templates/admin/blockblocks.html';
	include_once JIEQI_ROOT_PATH . '/admin/footer.php';
	break;

case 'edit':
	if (empty($_REQUEST['module']) || !preg_match('/^\\w+$/', $_REQUEST['module']) || empty($_REQUEST['filename']) || !preg_match('/^\\w+$/', $_REQUEST['filename']) || !isset($_REQUEST['key']) || !is_numeric($_REQUEST['key'])) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	unset($jieqiBlocks);
	jieqi_getconfigs($_REQUEST['module'], $_REQUEST['filename'], 'jieqiBlocks');

	if (!isset($jieqiBlocks)) {
		jieqi_printfail($jieqiLang['system']['block_config_notexists']);
	}

	if (!isset($jieqiBlocks[$_REQUEST['key']])) {
		jieqi_printfail($jieqiLang['system']['block_not_exists']);
	}

	$blockSet = $jieqiBlocks[$_REQUEST['key']];
	include_once JIEQI_ROOT_PATH . '/class/blocks.php';
	$blocks_handler = &JieqiBlocksHandler::getInstance('JieqiBlocksHandler');
	include_once JIEQI_ROOT_PATH . '/lib/html/formloader.php';

	if ($blockSet['custom'] == 1) {
		$block = $blocks_handler->get(intval($blockSet['bid']));

		if (is_object($block)) {
			$blockSet['content'] = $block->getVar('content', 'n');
		}

		$blocks_form = new JieqiThemeForm($jieqiLang['system']['edit_custom_block'], 'blockedit', JIEQI_URL . '/admin/blockfiles.php?action=update&module=' . urlencode($_REQUEST['module']) . '&filename=' . urlencode($_REQUEST['filename']) . '&key=' . urlencode($_REQUEST['key']));
		$blocks_form->addElement(new JieqiFormText($jieqiLang['system']['table_blocks_blockname'], 'blockname', 30, 50, htmlspecialchars($blockSet['blockname'], ENT_QUOTES)), true);
		$modselect = new JieqiFormSelect($jieqiLang['system']['table_blocks_modname'], 'modname', htmlspecialchars($blockSet['module'], ENT_QUOTES));

		foreach ($jieqiModules as $k => $v) {
			$modselect->addOption($k, htmlspecialchars($v['caption'], ENT_QUOTES));
		}

		$blocks_form->addElement($modselect);
	}
	else {
		$criteria = new CriteriaCompo(new Criteria('modname', $blockSet['module']));
		$criteria->add(new Criteria('classname', $blockSet['classname']));
		$blocks_handler->queryObjects($criteria);
		$block = $blocks_handler->getObject();

		if (is_object($block)) {
			$blockSet['description'] = $block->getVar('description', 'n');
		}

		$blocks_form = new JieqiThemeForm($jieqiLang['system']['edit_system_block'], 'blockedit', JIEQI_URL . '/admin/blockfiles.php?action=update&module=' . urlencode($_REQUEST['module']) . '&filename=' . urlencode($_REQUEST['filename']) . '&key=' . urlencode($_REQUEST['key']));
		$blockfile = $blockSet['filename'] . '.php';
		$blocks_form->addElement(new JieqiFormLabel($jieqiLang['system']['table_blocks_filename'], jieqi_htmlstr($blockfile)));

		if (isset($jieqiModules[$blockSet['module']])) {
			$blocks_form->addElement(new JieqiFormLabel($jieqiLang['system']['table_blocks_modname'], jieqi_htmlstr($jieqiModules[$blockSet['module']]['caption'])));
		}
		else {
			$blocks_form->addElement(new JieqiFormLabel($jieqiLang['system']['table_blocks_modname'], LANG_UNKNOWN));
		}

		$blocks_form->addElement(new JieqiFormText($jieqiLang['system']['table_blocks_blockname'], 'blockname', 30, 50, htmlspecialchars($blockSet['blockname'], ENT_QUOTES)), true);
	}

	$sideary = $blocks_handler->getSideary();
	$sideselect = new JieqiFormSelect($jieqiLang['system']['table_blocks_side'], 'side', htmlspecialchars($blockSet['side'], ENT_QUOTES));
	$sideselect->addOptionArray($sideary);
	$blocks_form->addElement($sideselect);
	$showradio = new JieqiFormRadio($jieqiLang['system']['table_blocks_publish'], 'publish', htmlspecialchars($blockSet['publish'], ENT_QUOTES));
	$showradio->addOption(0, $jieqiLang['system']['block_show_no']);
	$showradio->addOption(1, $jieqiLang['system']['block_show_logout']);
	$showradio->addOption(2, $jieqiLang['system']['block_show_login']);
	$showradio->addOption(3, $jieqiLang['system']['block_show_both']);
	$blocks_form->addElement($showradio);
	$blocks_form->addElement(new JieqiFormTextArea($jieqiLang['system']['table_blocks_title'], 'title', htmlspecialchars($blockSet['title'], ENT_QUOTES), 3, 60));

	if ($blockSet['custom'] == 1) {
		$blocks_form->addElement(new JieqiFormLabel($jieqiLang['system']['table_blocks_contenttype'], 'HTML'));
	}
	else if (isset($tmpary[$blockSet['contenttype']])) {
		$blocks_form->addElement(new JieqiFormLabel($jieqiLang['system']['table_blocks_contenttype'], $tmpary[$blockSet['contenttype']]));
	}
	else {
		$blocks_form->addElement(new JieqiFormLabel($jieqiLang['system']['table_blocks_contenttype'], LANG_UNKNOWN));
	}

	if ($blockSet['custom'] == 1) {
		$blocks_form->addElement(new JieqiFormTextArea($jieqiLang['system']['table_blocks_content'], 'content', htmlspecialchars($blockSet['content'], ENT_QUOTES), 10, 60));
	}
	else if (!empty($blockdesc)) {
		$blocks_form->addElement(new JieqiFormLabel($jieqiLang['system']['table_blocks_description'], $blockdesc));
	}

	if ($blockSet['hasvars']) {
		$blocks_form->addElement(new JieqiFormTextArea($jieqiLang['system']['table_blocks_blockvars'], 'blockvars', htmlspecialchars($blockSet['vars'], ENT_QUOTES), 3, 60));
		$blocks_form->addElement(new JieqiFormText($jieqiLang['system']['block_template_file'], 'blocktemplate', 30, 50, htmlspecialchars($blockSet['template'], ENT_QUOTES)), true);

		if ($blockSet['hasvars'] == 2) {
			$blocks_form->addElement(new JieqiFormHidden('cacheupdate', '1'));
		}
	}

	$blocks_form->addElement(new JieqiFormButton('&nbsp;', 'submit', $jieqiLang['system']['save_block'], 'submit'));
	$jieqiTpl->setCaching(0);
	$jieqiTpl->assign('jieqi_contents', '<br />' . $blocks_form->render(JIEQI_FORM_MAX) . '<br />');
	include_once JIEQI_ROOT_PATH . '/admin/footer.php';
	break;

case 'update':
	if (empty($_REQUEST['module']) || !preg_match('/^\\w+$/', $_REQUEST['module']) || empty($_REQUEST['filename']) || !preg_match('/^\\w+$/', $_REQUEST['filename']) || !isset($_REQUEST['key']) || !is_numeric($_REQUEST['key'])) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	unset($jieqiBlocks);
	jieqi_getconfigs($_REQUEST['module'], $_REQUEST['filename'], 'jieqiBlocks');

	if (!isset($jieqiBlocks)) {
		jieqi_printfail($jieqiLang['system']['block_config_notexists']);
	}

	if (!isset($jieqiBlocks[$_REQUEST['key']])) {
		jieqi_printfail($jieqiLang['system']['block_not_exists']);
	}

	if (isset($_POST['modname']) && !preg_match('/^[\\w]*$/', $_POST['modname'])) {
		jieqi_printfail($jieqiLang['system']['block_modname_error']);
	}

	if (isset($_POST['blocktemplate']) && !preg_match('/^[\\w\\.]*$/', $_POST['blocktemplate'])) {
		jieqi_printfail($jieqiLang['system']['block_template_errorformat']);
	}

	$blockSet = $jieqiBlocks[$_REQUEST['key']];
	$blockSet['blockname'] = $_POST['blockname'];
	$blockSet['side'] = $_POST['side'];
	$blockSet['publish'] = $_POST['publish'];
	$blockSet['title'] = $_POST['title'];

	if ($blockSet['hasvars']) {
		$blockSet['vars'] = $_POST['blockvars'];
		$blockSet['template'] = $_POST['blocktemplate'];
	}

	if (($blockSet['custom'] == 1) && isset($_POST['content'])) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
		$sql = 'UPDATE ' . jieqi_dbprefix('system_blocks') . ' SET blockname = \'' . jieqi_dbslashes($_POST['blockname']) . '\', side = ' . intval($_POST['side']) . ', title = \'' . jieqi_dbslashes($_POST['title']) . '\', content = \'' . jieqi_dbslashes($_POST['content']) . '\', publish = ' . intval($_POST['publish']) . ' WHERE bid = ' . intval($blockSet['bid']);
		$query->execute($sql);
		include_once JIEQI_ROOT_PATH . '/class/blocks.php';
		$blocks_handler = &JieqiBlocksHandler::getInstance('JieqiBlocksHandler');
		$blocks_handler->saveContent($blockSet['bid'], $blockSet['module'], JIEQI_CONTENT_HTML, $_POST['content']);
	}

	$jieqiBlocks[$_REQUEST['key']] = $blockSet;
	jieqi_setconfigs($_REQUEST['filename'], 'jieqiBlocks', $jieqiBlocks, $_REQUEST['module']);

	if ($_POST['cacheupdate'] == 1) {
		$modname = $blockSet['module'];
		$filename = $blockSet['filename'];

		if (preg_match('/^\\w+$/is', $filename)) {
			if ($modname == 'system') {
				include JIEQI_ROOT_PATH . '/blocks/' . $filename . '.php';
			}
			else {
				include $jieqiModules[$modname]['path'] . '/blocks/' . $filename . '.php';
			}
		}
		
		$classname = $blockSet['classname'];	
		
		include_once JIEQI_ROOT_PATH . '/lib/template/template.php';
		$jieqiTpl = &JieqiTpl::getInstance();
		$cblock = new $classname($blockSet);
		//$cblock->updateContent();
		unset($jieqiTpl);
		unset($cblock);
		unset($vars);
	}

	jieqi_jumppage(JIEQI_URL . '/admin/blockfiles.php?action=blocks&module=' . urlencode($_REQUEST['module']) . '&filename=' . urlencode($_REQUEST['filename']), LANG_DO_SUCCESS, $jieqiLang['system']['block_update_success']);
	break;

case 'updatelist':
	if (empty($_REQUEST['module']) || !preg_match('/^\\w+$/', $_REQUEST['module']) || empty($_REQUEST['filename']) || !preg_match('/^\\w+$/', $_REQUEST['filename'])) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	unset($jieqiBlocks);
	jieqi_getconfigs($_REQUEST['module'], $_REQUEST['filename'], 'jieqiBlocks');

	if (!isset($jieqiBlocks)) {
		jieqi_printfail($jieqiLang['system']['block_config_notexists']);
	}

	asort($_REQUEST['key']);
	$newBlocks = array();
	$kk = -1;

	foreach ($_REQUEST['key'] as $oldk => $newk) {
		$newk = intval($newk);

		if ($newk < 0) {
			jieqi_printfail($jieqiLang['system']['block_key_lowzero']);
		}
		else if ($kk == $newk) {
			jieqi_printfail(sprintf($jieqiLang['system']['block_key_notrepeat'], $newk));
		}

		$kk = $newk;
		$newBlocks[intval($newk)] = $jieqiBlocks[$oldk];
		if ((0 < $jieqiBlocks[$oldk]['hasvars']) && isset($_REQUEST['vars'][$oldk])) {
			$newBlocks[intval($newk)]['vars'] = $_REQUEST['vars'][$oldk];
		}
	}

	foreach ($newBlocks as $i => $value) {
		$newBlocks[$i]['side'] = intval($newBlocks[$i]['side']);
		$newBlocks[$i]['contenttype'] = intval($newBlocks[$i]['contenttype']);
		$newBlocks[$i]['showtype'] = intval($newBlocks[$i]['showtype']);
		$newBlocks[$i]['custom'] = intval($newBlocks[$i]['custom']);
		$newBlocks[$i]['publish'] = intval($newBlocks[$i]['publish']);
		$newBlocks[$i]['hasvars'] = intval($newBlocks[$i]['hasvars']);
	}

	jieqi_setconfigs($_REQUEST['filename'], 'jieqiBlocks', $newBlocks, $_REQUEST['module']);
	jieqi_jumppage(JIEQI_URL . '/admin/blockfiles.php?action=blocks&module=' . urlencode($_REQUEST['module']) . '&filename=' . urlencode($_REQUEST['filename']), LANG_DO_SUCCESS, $jieqiLang['system']['block_update_success']);
	break;

case 'files':
default:
	foreach ($jieqiBlockfiles as $k => $v) {
		$jieqiBlockfiles[$k]['modname'] = $jieqiModules[$v['module']]['caption'];
	}

	$blockfiles = jieqi_funtoarray('jieqi_htmlstr', $jieqiBlockfiles);
	$jieqiTpl->assign_by_ref('blockfiles', $blockfiles);
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = $jieqiModules['system']['path'] . '/templates/admin/blockfiles.html';
	include_once JIEQI_ROOT_PATH . '/admin/footer.php';
	break;
}

?>
