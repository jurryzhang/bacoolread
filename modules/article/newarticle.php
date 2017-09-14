<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['article']['newarticle'], $jieqiUsersStatus, $jieqiUsersGroup, false);
jieqi_loadlang('article', JIEQI_MODULE_NAME);

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'article';
}

jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs', 'jieqiConfigs');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'option', 'jieqiOption');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'sort', 'jieqiSort');
jieqi_getconfigs('article', 'action', 'jieqiAction');
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

switch ($_REQUEST['action']) {
case 'newarticle':
	$_POST['articlename'] = trim($_POST['articlename']);

	if (isset($_POST['backupname'])) {
		$_POST['backupname'] = trim($_POST['backupname']);
	}

	$_POST['author'] = trim($_POST['author']);
	$_POST['agent'] = trim($_POST['agent']);
	$_POST['sortid'] = isset($_POST['sortid']) ? intval($_POST['sortid']) : 0;
	$_POST['typeid'] = isset($_POST['typeid']) ? intval($_POST['typeid']) : 0;

	if (!isset($jieqiSort['article'][$_POST['sortid']]['types'][$_POST['typeid']])) {
		$_POST['typeid'] = 0;
	}

	if (!isset($jieqiSort['article'][$_POST['sortid']])) {
		$_POST['sortid'] = 0;
	}

	$errtext = '';
	include_once JIEQI_ROOT_PATH . '/lib/text/textfunction.php';

	if (strlen($_POST['articlename']) == 0) {
		$errtext .= $jieqiLang['article']['need_article_title'] . '<br />';
	}
	else if (!jieqi_safestring($_POST['articlename'])) {
		$errtext .= $jieqiLang['article']['limit_article_title'] . '<br />';
	}

	jieqi_getconfigs('article', 'deny', 'jieqiDeny');

	if (!isset($jieqiConfigs['system'])) {
		jieqi_getconfigs('system', 'configs', 'jieqiConfigs');
	}

	if (!isset($jieqiDeny['article'])) {
		$jieqiDeny['article'] = $jieqiConfigs['system']['postdenywords'];
	}

	include_once JIEQI_ROOT_PATH . '/include/checker.php';
	$checker = new JieqiChecker();
	if (!empty($jieqiDeny['article']) || !empty($jieqiConfigs['system']['postdenywords'])) {
		if (!empty($jieqiDeny['article'])) {
			$matchwords = $checker->deny_words($_POST['articlename'], $jieqiDeny['article'], true, true);

			if (is_array($matchwords)) {
				$errtext .= sprintf($jieqiLang['article']['article_deny_articlename'], implode(' ', jieqi_funtoarray('htmlspecialchars', $matchwords))) . '<br />';
			}
		}

		if (!empty($jieqiConfigs['system']['postdenywords'])) {
			if (!empty($_POST['intro'])) {
				$matchwords = $checker->deny_words($_POST['intro'], $jieqiConfigs['system']['postdenywords'], true);

				if (is_array($matchwords)) {
					$errtext .= sprintf($jieqiLang['article']['article_deny_intro'], implode(' ', jieqi_funtoarray('htmlspecialchars', $matchwords))) . '<br />';
				}
			}

			if (!empty($_POST['notice'])) {
				$matchwords = $checker->deny_words($_POST['notice'], $jieqiConfigs['system']['postdenywords'], true);

				if (is_array($matchwords)) {
					$errtext .= sprintf($jieqiLang['article']['article_deny_notice'], implode(' ', jieqi_funtoarray('htmlspecialchars', $matchwords))) . '<br />';
				}
			}

			if (!empty($_POST['keywords'])) {
				$matchwords = $checker->deny_words($_POST['keywords'], $jieqiConfigs['system']['postdenywords'], true);

				if (is_array($matchwords)) {
					$errtext .= sprintf($jieqiLang['article']['article_deny_keywords'], implode(' ', jieqi_funtoarray('htmlspecialchars', $matchwords))) . '<br />';
				}
			}
		}
	}

	$typeary = explode(' ', trim($jieqiConfigs['article']['imagetype']));

	foreach ($typeary as $k => $v) {
		if (substr($v, 0, 1) != '.') {
			$typeary[$k] = '.' . $typeary[$k];
		}
	}

	if (!empty($_FILES['articlespic']['name'])) {
		$simage_postfix = strrchr(trim(strtolower($_FILES['articlespic']['name'])), '.');

		if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['articlespic']['name'])) {
			if (!in_array($simage_postfix, $typeary)) {
				$errtext .= sprintf($jieqiLang['article']['simage_type_error'], $jieqiConfigs['article']['imagetype']) . '<br />';
			}
		}
		else {
			$errtext .= sprintf($jieqiLang['article']['simage_not_image'], $_FILES['articlespic']['name']) . '<br />';
		}

		if (!empty($errtext)) {
			jieqi_delfile($_FILES['articlespic']['tmp_name']);
		}
	}

	if (!empty($_FILES['articlelpic']['name'])) {
		$limage_postfix = strrchr(trim(strtolower($_FILES['articlelpic']['name'])), '.');

		if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['articlelpic']['name'])) {
			if (!in_array($limage_postfix, $typeary)) {
				$errtext .= sprintf($jieqiLang['article']['limage_type_error'], $jieqiConfigs['article']['imagetype']) . '<br />';
			}
		}
		else {
			$errtext .= sprintf($jieqiLang['article']['limage_not_image'], $_FILES['articlelpic']['name']) . '<br />';
		}

		if (!empty($errtext)) {
			jieqi_delfile($_FILES['articlelpic']['tmp_name']);
		}
	}
	
	if (!empty($_FILES['articlelapic']['name'])) {
		$alimage_postfix = strrchr(trim(strtolower($_FILES['articlelapic']['name'])), '.');

		if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['articlelapic']['name'])) {
			if (!in_array($alimage_postfix, $typeary)) {
				$errtext .= sprintf($jieqiLang['article']['limage_type_error'], $jieqiConfigs['article']['imagetype']) . '<br />';
			}
		}
		else {
			$errtext .= sprintf($jieqiLang['article']['limage_not_image'], $_FILES['articlelpic']['name']) . '<br />';
		}

		if (!empty($errtext)) {
			jieqi_delfile($_FILES['articlelapic']['tmp_name']);
		}
	}

	$allowtrans = jieqi_checkpower($jieqiPower['article']['transarticle'], $jieqiUsersStatus, $jieqiUsersGroup, true);
	if (!empty($_POST['articleid']) && $allowtrans) {
		include_once $jieqiModules['article']['path'] . '/class/article.php';
		$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
		$article_handler->execute('SELECT MAX(articleid) AS mid FROM ' . jieqi_dbprefix('article_article'));
		$tmprow = $article_handler->getRow();

		if (isset($tmprow['mid'])) {
			$max_articleid = intval($tmprow['mid']);
		}
		else {
			$max_articleid = 0;
		}

		$_POST['articleid'] = intval($_POST['articleid']);
		if (($_POST['articleid'] <= 0) || ($max_articleid < $_POST['articleid'])) {
			$errtext .= sprintf($jieqiLang['article']['customid_number_limit'], $max_articleid);
		}
		else if (is_object($tmparticle)) {
			$errtext .= sprintf($jieqiLang['article']['customid_is_exists'], $_POST['articleid']);
		}
	}
	else {
		$_POST['articleid'] = 0;
	}

	if (empty($errtext)) {
		include_once $jieqiModules['article']['path'] . '/class/article.php';
		$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');

		if ($jieqiConfigs['article']['samearticlename'] != 1) {
			if (0 < $article_handler->getCount(new Criteria('articlename', $_POST['articlename'], '='))) {
				jieqi_printfail(sprintf($jieqiLang['article']['articletitle_has_exists'], jieqi_htmlstr($_POST['articlename'])));
			}
		}

		$customacode = false;
		$updatecode = false;
		if ($ismanager && !empty($_POST['articlecode'])) {
			$customacode = true;
		}
		else {
			$_POST['articlecode'] = jieqi_getpinyin($_POST['articlename']);
		}

		if (!preg_match('/^[a-z]/i', $_POST['articlecode'])) {
			$_POST['articlecode'] = 'i' . $_POST['articlecode'];
		}

		if (0 < $article_handler->getCount(new Criteria('articlecode', $_POST['articlecode'], '='))) {
			if ($customacode) {
				jieqi_printfail(sprintf($jieqiLang['article']['articlecode_has_exists'], jieqi_htmlstr($_POST['articlecode'])));
			}
			else {
				$updatecode = true;
			}
		}

		if (!empty($jieqiConfigs['system']['postreplacewords'])) {
			if (!empty($_POST['intro'])) {
				$checker->replace_words($_POST['intro'], $jieqiConfigs['system']['postreplacewords']);
			}

			if (!empty($_POST['notice'])) {
				$checker->replace_words($_POST['notice'], $jieqiConfigs['system']['postreplacewords']);
			}

			if (!empty($_POST['keywords'])) {
				$checker->replace_words($_POST['keywords'], $jieqiConfigs['system']['postreplacewords']);
			}
		}

		include_once JIEQI_ROOT_PATH . '/class/users.php';
		$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
		$article = $article_handler->create();
		if ($allowtrans && !empty($_POST['articleid'])) {
			$article->setVar('articleid', $_POST['articleid']);
		}

		$article->setVar('siteid', JIEQI_SITE_ID);
		$article->setVar('postdate', JIEQI_NOW_TIME);
		$article->setVar('lastupdate', JIEQI_NOW_TIME);
		$article->setVar('articlename', $_POST['articlename']);

		if (!$updatecode) {
			$article->setVar('articlecode', $_POST['articlecode']);
		}

		if (isset($_POST['backupname'])) {
			$article->setVar('backupname', $_POST['backupname']);
		}

		if (2 <= floatval(JIEQI_VERSION)) {
			include_once JIEQI_ROOT_PATH . '/include/funtag.php';
			$tagary = jieqi_tag_clean($_POST['keywords']);
			$_POST['keywords'] = implode(' ', $tagary);
		}

		$article->setVar('keywords', trim($_POST['keywords']));
		$article->setVar('initial', jieqi_getinitial($_POST['articlename']));
		$agentobj = false;

		if (!empty($_POST['agent'])) {
			$agentobj = $users_handler->getByname($_POST['agent'], 3);
		}

		if (is_object($agentobj)) {
			$article->setVar('agentid', $agentobj->getVar('uid'));
			$article->setVar('agent', $agentobj->getVar('uname', 'n'));
		}
		else {
			$article->setVar('agentid', 0);
			$article->setVar('agent', '');
		}

		if ($allowtrans) {
			if (empty($_POST['author']) || (!empty($_SESSION['jieqiUserId']) && ($_POST['author'] == $_SESSION['jieqiUserName']))) {
				if (!empty($_SESSION['jieqiUserId'])) {
					$article->setVar('authorid', $_SESSION['jieqiUserId']);
					$article->setVar('author', $_SESSION['jieqiUserName']);
				}
				else {
					$article->setVar('authorid', 0);
					$article->setVar('author', '');
				}
			}
			else if ($_POST['authorflag']) {
				$authorobj = $users_handler->getByname($_POST['author'], 3);

				if (is_object($authorobj)) {
					$article->setVar('authorid', $authorobj->getVar('uid'));
				}
				else {
					$article->setVar('authorid', 0);
				}
			}
			else {
				$article->setVar('authorid', 0);
			}
		}
		else {
			if (!empty($_SESSION['jieqiUserId'])) {
				$article->setVar('authorid', $_SESSION['jieqiUserId']);
				$article->setVar('author', $_SESSION['jieqiUserName']);
			}
			else {
				$article->setVar('authorid', 0);
				$article->setVar('author', '');
			}

			$article->setVar('permission', intval($jieqiOption['article']['permission']['items'][$jieqiOption['article']['permission']['default']]));
		}

		if (isset($jieqiOption['article']['firstflag']['items'][$_POST['firstflag']])) {
			$article->setVar('firstflag', $_POST['firstflag']);
		}

		if (isset($jieqiOption['article']['permission']['items'][$_POST['permission']])) {
			$article->setVar('permission', $_POST['permission']);
		}

		if (isset($jieqiOption['article']['isshort']['items'][$_POST['isshort']])) {
			$article->setVar('isshort', $_POST['isshort']);
		}

		if (isset($jieqiOption['article']['inmatch']['items'][$_POST['inmatch']])) {
			$article->setVar('inmatch', $_POST['inmatch']);
		}

		$rgroup = 0;
		if (isset($jieqiSort['article'][$_POST['sortid']]['group']) && (0 <= $jieqiSort['article'][$_POST['sortid']]['group'])) {
			$rgroup = intval($jieqiSort['article'][$_POST['sortid']]['group']);
		}
		else if (isset($_POST['rgroup'])) {
			$rgroup = intval($_POST['rgroup']);
		}

		if (isset($jieqiOption['article']['rgroup']['items'][$rgroup])) {
			$article->setVar('rgroup', $rgroup);
		}

		$_POST['progress'] = intval($_POST['progress']);

		if (isset($jieqiOption['article']['progress']['items'][$_POST['progress']])) {
			$article->setVar('progress', $_POST['progress']);
			$tmpvar = -1;

			foreach ($jieqiOption['article']['progress']['items'] as $k => $v) {
				if ($tmpvar < $k) {
					$tmpvar = $k;
				}
			}

			if (!isset($_POST['fullflag'])) {
				$_POST['fullflag'] = $_POST['progress'] == $tmpvar ? 1 : 0;
			}
		}

		$article->setVar('fullflag', intval($_POST['fullflag']));

		if (!empty($_SESSION['jieqiUserId'])) {
			$article->setVar('posterid', $_SESSION['jieqiUserId']);
			$article->setVar('poster', $_SESSION['jieqiUserName']);
		}
		else {
			$article->setVar('posterid', 0);
			$article->setVar('poster', '');
		}

		$article->setVar('lastchapterid', 0);
		$article->setVar('lastchapter', '');
		$article->setVar('lastvolumeid', 0);
		$article->setVar('lastvolume', '');
		$article->setVar('chapters', 0);
		$article->setVar('size', 0);
		$article->setVar('sortid', $_POST['sortid']);
		$article->setVar('typeid', $_POST['typeid']);
		$article->setVar('intro', $_POST['intro']);
		$article->setVar('notice', $_POST['notice']);
		$article->setVar('setting', '');
		$article->setVar('articletype', 0);
		$imgflag = 0;
		$imgtary = array(1 => '.gif', 2 => '.jpg', 3 => '.jpeg', 4 => '.png', 5 => '.bmp');

		if (!empty($_FILES['articlespic']['name'])) {
			$imgflag = $imgflag | 1;
			$tmpvar = intval(array_search($simage_postfix, $imgtary));

			if (0 < $tmpvar) {
				$imgflag = $imgflag | ($tmpvar * 4);
			}
		}

		if (!empty($_FILES['articlelpic']['name'])) {
			$imgflag = $imgflag | 2;
			$tmpvar = intval(array_search($limage_postfix, $imgtary));

			if (0 < $tmpvar) {
				$imgflag = $imgflag | ($tmpvar * 32);
			}
		}
		if (!empty($_FILES['articlelapic']['name'])) {
			$imgflag = $imgflag | 2;
			$tmpvar = intval(array_search($alimage_postfix, $imgtary));

			if (0 < $tmpvar) {
				$imgflag = $imgflag | ($tmpvar * 32);
			}
		}

		$article->setVar('imgflag', $imgflag);

		if (jieqi_checkpower($jieqiPower['article']['needcheck'], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
			$article->setVar('display', 0);
		}
		else {
			$article->setVar('display', 1);
		}

		if (!$article_handler->insert($article)) {
			jieqi_printfail($jieqiLang['article']['article_add_failure']);
		}
		else {
			$id = $article->getVar('articleid');

			if ($updatecode) {
				$_POST .= 'articlecode';
				$article_handler->updatefields(array('articlecode' => $_POST['articlecode']), new Criteria('articleid', $id, '='));
			}

			if (2 <= floatval(JIEQI_VERSION)) {
				jieqi_tag_save($tagary, $id, array('tag' => jieqi_dbprefix('article_tag'), 'taglink' => jieqi_dbprefix('article_taglink')));
			}

			include_once $jieqiModules['article']['path'] . '/class/package.php';
			$package = new JieqiPackage($id);
			$package->initPackage($article->getVars('n'), true);
			include_once $jieqiModules['article']['path'] . '/include/funarticle.php';

			if (!empty($_FILES['articlespic']['name'])) {
				jieqi_article_coverdo($_FILES['articlespic'], 's');
				jieqi_copyfile($_FILES['articlespic']['tmp_name'], $package->getDir('imagedir') . '/' . $id . 's' . $simage_postfix, 511, true);
			}

			if (!empty($_FILES['articlelpic']['name'])) {
				jieqi_article_coverdo($_FILES['articlelpic'], 'l');
				jieqi_copyfile($_FILES['articlelpic']['tmp_name'], $package->getDir('imagedir') . '/' . $id . 'l' . $limage_postfix, 511, true);
			}
			if (!empty($_FILES['articlelapic']['name'])) {
				jieqi_article_coverdo($_FILES['articlelapic'], 'l');
				jieqi_copyfile($_FILES['articlelapic']['tmp_name'], $package->getDir('imagedir') . '/' . $id . 'a' . $alimage_postfix, 511, true);
			}

			include_once $jieqiModules['article']['path'] . '/include/funaction.php';
			$actions = array('actname' => 'articleadd', 'actnum' => 1);
			jieqi_article_actiondo($actions, $article);
			include_once $jieqiModules['article']['path'] . '/include/actarticle.php';
			jieqi_article_updateinfo($article, 'articlenew');
			jieqi_jumppage($article_static_url . '/articlemanage.php?id=' . $id, LANG_DO_SUCCESS, $jieqiLang['article']['article_add_success']);
		}
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case 'article':
default:
	include_once JIEQI_ROOT_PATH . '/header.php';
	$jieqiTpl->assign('article_static_url', $article_static_url);
	$jieqiTpl->assign('article_dynamic_url', $article_dynamic_url);
	$jieqiTpl->assign('url_newarticle', $article_static_url . '/newarticle.php?do=submit');
	jieqi_getconfigs(JIEQI_MODULE_NAME, 'sort', 'jieqiSort');
	$jieqiTpl->assign('sortrows', jieqi_funtoarray('jieqi_htmlstr', $jieqiSort['article']));

	foreach ($jieqiOption['article'] as $k => $v) {
		$jieqiTpl->assign_by_ref($k, $jieqiOption['article'][$k]);
	}

	if (jieqi_checkpower($jieqiPower['article']['transarticle'], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
		$jieqiTpl->assign('allowtrans', 1);
	}
	else {
		$jieqiTpl->assign('allowtrans', 0);
	}

	$jieqiTpl->assign('authorarea', 1);
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/newarticle.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}

?>
