<?php
/**
 * 小说打包类
 *
 * 生成html、zip、txt、umd、jar等格式
 *
 * 调用模板：无
 *
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: package.php 339 2009-06-23 03:03:24Z juny $
 */

// 需要更新静态小说信息页面的打包类
include_once(JIEQI_ROOT_PATH . '/lib/xml/xml.php');
// 包含页头，在生成静态html时候用
include_once(JIEQI_ROOT_PATH . '/header.php');
// 载入相关处理函数
include_once($jieqiModules['article']['path'] . '/include/funarticle.php');
// 载入参数设置
jieqi_getconfigs('article', 'configs');
// 是否从数据库查询附件
if(!isset($jieqiConfigs['article']['packdbattach'])) $jieqiConfigs['article']['packdbattach'] = 0;
if(!$jieqiConfigs['article']['packdbattach'] && preg_match('/^(ftps?):\/\/([^:\/]+):([^:\/]*)@([0-9a-z\-\.]+)(:(\d+))?([0-9a-z_\-\/\.]*)/is', $jieqiConfigs['article']['attachdir'])) $jieqiConfigs['article']['packdbattach'] = 1;

// 载入数据库和查询类
jieqi_includedb();
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

// 定义小说模块动态地址和静态地址
if(!empty($jieqiConfigs['article']['dynamicurl'])) define('ARTICLE_DYNAMIC_URL', $jieqiConfigs['article']['dynamicurl']);
else define('ARTICLE_DYNAMIC_URL', $jieqiModules['article']['url']);

$article_dynamic_rooturl = ARTICLE_DYNAMIC_URL;
if(strpos($article_dynamic_rooturl, '/modules') > 0) $article_dynamic_rooturl = substr($article_dynamic_rooturl, 0, strpos($article_dynamic_rooturl, '/modules'));
define('ARTICLE_DYNAMIC_ROOTURL', $article_dynamic_rooturl);

if(!empty($jieqiConfigs['article']['staticurl'])) define('ARTICLE_STATIC_URL', $jieqiConfigs['article']['staticurl']);
else define('ARTICLE_STATIC_URL', $jieqiModules['article']['url']);

// 小说打包类
class JieqiPackage extends JieqiObject{
	var $id = 0;
	var $xml = NULL;
	var $metas = array();
	var $chapters = array();
	var $isload = false;
	var $nowid = 0;
	var $preid = 0;
	var $nextid = 0;

	// 构建函数
	function JieqiPackage($id = 0)
	{
		$this->JieqiObject();
		$this->id = intval($id);
		$this->isload = false;
	}

	// 设置序号
	function setId($id = 0){
		$this->id = intval($id);
	}

	// 取得序号
	function getId(){
		return $this->id;
	}

	// 取得文件保存目录
	function getDir($dirtype = 'txtdir', $idasdir = true, $automake = true){
		global $jieqiConfigs;
		$retdir = jieqi_uploadpath($jieqiConfigs['article'][$dirtype], 'article');
		if($automake && !file_exists($retdir)) jieqi_createdir($retdir);
		$retdir .= jieqi_getsubdir($this->id);
		if($automake && !file_exists($retdir)) jieqi_createdir($retdir);
		if($idasdir){
			$retdir .= '/' . $this->id;
			if($automake && !file_exists($retdir)) jieqi_createdir($retdir);
		}
		
		return $retdir;
	}

	// 初始化opf
	function initPackage($infoary = array(), $save = true){
		foreach($infoary as $k => $v){
			$this->metas[$k] = $v;
		}
		$this->chapters = array();
		if($save) $this->createOPF();
	}

	// 编辑opf
	function editPackage($infoary = array(), $save = true){
		if(!$this->isload) $this->loadOPF();
		$tmpstr = $this->metas['articlename'];
		foreach($infoary as $k => $v){
			$this->metas[$k] = $v;
		}
		if($save) $this->createOPF();
		// 生成目录页
		$this->makeIndex();
		// 标题不同，重新生成章节页
		if($tmpstr != $infoary['articlename']){
			for($i = 1; $i <= count($this->chapters); $i++){
				$this->makeHtml($i);
			}
		}
	}

	// 创建xml格式的小说信息文件
	function createOPF($save = true){
		$this->xml = new XML();
		$this->xml->encoding = 'ISO-8859-1';
		$this->xml->xmlDecl = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$package = $this->xml->createElement('package');
		$package->attributes['id'] = $this->id;
		$this->xml->appendChild($package);

		// 基本信息
		$articleinfo = $this->xml->createElement('articleinfo');
		$package->appendChild($articleinfo);
		$i = 0;
		foreach($this->metas as $key => $val){
			${'meta' . $i} = $this->xml->createElement($key);
			${'meta' . $i}->appendChild($this->xml->createTextNode($val));
			$articleinfo->appendChild(${'meta' . $i});
			$i++;
		}
		// 章节列表
		$chapters = $this->xml->createElement('chapters');
		$package->appendChild($chapters);

		$i = 0;
		foreach($this->chapters as $val){
			${'item' . $i} = $this->xml->createElement('item');
			${'item' . $i}->attributes = $val;
			$chapters->appendChild(${'item' . $i});
			$i++;
		}

		if($save) $this->saveOPF();
	}

	// 保存opf文件
	function saveOPF(){
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$opfdir = $this->getDir('opfdir');
		jieqi_writefile($opfdir . '/index' . $jieqi_file_postfix['opf'], $this->xml->toString());
	}
	
	
	// 载入opf文件
	function loadOPF(){
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$opfdir = $this->getDir('opfdir', true, false);
		if(!file_exists($opfdir . '/index' . $jieqi_file_postfix['opf'])) return false;
		else{
			if(!is_object($this->xml)){
				$this->xml = new XML();
			}
			$this->xml->load($opfdir . '/index' . $jieqi_file_postfix['opf']);
			$this->metas = array();
			$meta = $this->xml->firstChild->firstChild->firstChild;
			while($meta){
				$this->metas[$meta->nodeName] = $meta->firstChild->nodeValue;
				$meta = $meta->nextSibling;
			}
			unset($meta);
			//如果载入失败，尝试查询数据库并且重新生成
			if(!isset($this->metas['articleid'])){
				global $query;
				$this->metas = array();
				$sql = "SELECT * FROM " . jieqi_dbprefix('article_article') . " WHERE articleid = " . intval($this->id);
				$res = $query->execute($sql);
				$arow = $query->getRow($res);
				if(!is_array($arow)) return false;
				$this->initPackage($arow, false);

				$this->chapters = array();
				$sql = "SELECT * FROM " . jieqi_dbprefix('article_chapter') . " WHERE articleid = " . intval($this->id) . " ORDER BY chapterorder ASC";
				$res = $query->execute($sql);
				while($crow = $query->getRow($res)){
					$this->chapters[] = $crow;
				}
				$this->createOPF();
			}
			else{
				$chapter = $this->xml->firstChild->firstChild->nextSibling->firstChild;
				$this->chapters = array();
				$i = 0;
				while($chapter){
					$this->chapters[$i] = $chapter->attributes;
					$chapter = $chapter->nextSibling;
					$i++;
				}
				unset($chapter);
			}
			$this->isload = true;
			return true;
		}
	}

	// 显示一个章节
	function showChapter($cid){
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$i = 0;
		$num = count($this->chapters);
		while($i < $num){
			$tmpvar = intval($this->chapters[$i]['chapterid']);
			if($tmpvar == $cid){
				$this->makeHtml($i + 1, true, true);
				return true;
			}
			$i++;
		}
		return false;
	}

	// 生成一个章节的html
	function makeHtml($nowid, $dynamic = false, $show = false, $filter = false){
		global $jieqiModules;
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqi_file_postfix;
		if(!isset($jieqiSort['article'])) jieqi_getconfigs('article', 'sort');
		if($nowid <= 0) return false;
		$chaptercount = count($this->chapters);
		if($nowid > $chaptercount) return false;
		if(!empty($this->chapters[$nowid - 1]['isvip'])) return true; //vip章节不生成
		if($this->chapters[$nowid - 1]['chaptertype'] == 1) return true; //分卷不生成

		if(!in_array($jieqiConfigs['article']['htmlfile'], array('.html', '.htm', '.shtml'))) $jieqiConfigs['article']['htmlfile'] = '.html';

		$chapter = jieqi_htmlstr($this->chapters[$nowid - 1]['chaptername']);
		$void = $nowid - 2;
		$volume = '';
		while($void >= 0 && $this->chapters[$void]['chaptertype'] != 1) $void--;
		if($void >= 0) $volume = jieqi_htmlstr($this->chapters[$void]['chaptername']);
		$preid = $nowid - 2;
		while($preid >= 0 && $this->chapters[$preid]['chaptertype'] == 1) $preid--;
		$preid++;
		$nextid = $nowid;
		while($nextid < $chaptercount && $this->chapters[$nextid]['chaptertype'] == 1) $nextid++;
		if($nextid >= $chaptercount) $nextid = 0;
		else $nextid++;
		if(!is_object($jieqiTpl)){
			include_once(JIEQI_ROOT_PATH . '/lib/template/template.php');
			$jieqiTpl = &JieqiTpl::getInstance();
		}
		// 文件头变量赋值
		$jieqiTpl->assign('dynamic_url', ARTICLE_DYNAMIC_URL);
		$jieqiTpl->assign('static_url', ARTICLE_STATIC_URL);
		$jieqiTpl->assign('new_url', JIEQI_LOCAL_URL);
		$jieqiTpl->assign('article_title', jieqi_htmlstr($this->metas['articlename']));
		$jieqiTpl->assign('jieqi_title', $volume . ' ' . $chapter);
		$jieqiTpl->assign('chaptertitle', $volume . ' ' . $chapter);
		$jieqiTpl->assign('jieqi_volume', $volume);
		$jieqiTpl->assign('volumename', $volume);
		$jieqiTpl->assign('jieqi_chapter', $chapter);
		$jieqiTpl->assign('chaptername', $chapter);

		// 赋值小说属性
		include_once($jieqiModules['article']['path'] . '/class/article.php');
		include_once($jieqiModules['article']['path'] . '/include/funarticle.php');
		$article = new JieqiArticle();
		$article->setVars($this->metas);
		$articlevals = jieqi_article_vars($article);
		$jieqiTpl->assign_by_ref('articlevals', $articlevals);
		foreach($articlevals as $k => $v){
			$jieqiTpl->assign_by_ref($k, $articlevals[$k]);
		}
		//补充变量
		$jieqiTpl->assign('article_id', $this->id);
		$jieqiTpl->assign('chapter_id', $chapterid);
		$jieqiTpl->assign('articlesubdir', jieqi_getsubdir($this->id));

		$jieqiTpl->assign('chaptertime', $this->chapters[$nowid - 1]['lastupdate']);
		$jieqiTpl->assign('chaptersize', intval($this->chapters[$nowid - 1]['size']));
		$jieqiTpl->assign('chaptersize_c', ceil(intval($this->chapters[$nowid - 1]['size']) / 2));
		$chapterid = intval($this->chapters[$nowid - 1]['chapterid']);
		$jieqiTpl->assign('chapterid', $chapterid);
		$chapterisvip = intval($this->chapters[$nowid - 1]['isvip']);
		$jieqiTpl->assign('chapterisvip', $chapterisvip);

		//目录页
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
		$jieqiTpl->assign('index_page', $tmpurl);
		$jieqiTpl->assign('url_articleindex', $tmpurl);
		$jieqiTpl->assign('url_index', $tmpurl);
		//信息页
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		// 全文阅读
		$jieqiTpl->assign('url_fullpage', jieqi_geturl('article', 'article', $this->id, 'full', $this->metas['articlecode']));
		// 打包下载
		$jieqiTpl->assign('url_download', jieqi_geturl('article', 'down', $this->id, 'txt'));
		// 自己页面
		$tmpurl = jieqi_geturl('article', 'chapter', $chapterid, $this->id, $chapterisvip, $this->metas['articlecode']);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		$jieqiTpl->assign('url_articlechapter', $tmpurl);
		//书库首页
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');

		if(empty($jieqiConfigs['article']['usetxtjs'])){
			// 内容赋值
			$chaptertype = $this->chapters[$nowid - 1]['chaptertype'] == 1 ? 1 : 0;
			$tmpvar = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($this->chapters[$nowid - 1]['chapterid']), 'isvip' => intval($this->chapters[$nowid - 1]['isvip']), 'chaptertype' => $chaptertype, 'display' => $chapterdisplay, 'getformat' => 'url'));

			// 网址改成可以点击的
			$tmpvar = jieqi_htmlclickable(jieqi_htmlstr($tmpvar));
			// 加入文字水印
			if(!empty($jieqiConfigs['article']['textwatermark']) && JIEQI_MODULE_VTYPE != '' && JIEQI_MODULE_VTYPE != 'Free'){
				$contentary = preg_split('/<br\s*\/?>\s*<br\s*\/?>/is', $tmpvar);
				$tmpvar = '';
				foreach($contentary as $v){
					if(empty($tmpvar)) $tmpvar .= $v;
					else{
						srand((double)microtime() * 1000000);
						$randstr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$randlen = rand(10, 20);
						$randtext = '';
						$l = strlen($randstr) - 1;
						for($i = 0; $i < $randlen; $i++){
							$num = rand(0, $l);
							$randtext .= $randstr[$num];
						}
						$textwatermark = str_replace('<{$randtext}>', $randtext, $jieqiConfigs['article']['textwatermark']);
						$tmpvar .= '<br />
' . $textwatermark . '<br />' . $v;
					}
				}
			}
			$attachurl = jieqi_geturl('article', 'attach', $this->id, $chapterid);
			if(!$jieqiConfigs['article']['packdbattach']){
				// 检查附件(检查文件是否存在)
				$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;

				if(is_dir($attachdir)){
					$attachimage = '';
					$attachfile = '';
					$files = array();
					$handle = @opendir($attachdir);
					while($handle !== false && ($file = @readdir($handle)) !== false){
						if($file != '.' && $file != '..'){
							$files[] = $file;
						}
					}
					@closedir($handle);
					sort($files);
					$image_code = $jieqiConfigs['article']['pageimagecode'];

					if(empty($image_code) || !preg_match('/\<img/is', $image_code)) $image_code = '<div class="divimage"><img src="<{$imageurl}>" border="0" class="imagecontent"></div>';
					foreach($files as $file){
						if(is_file($attachdir . '/' . $file)){
							$url = $attachurl . '/' . $file;
							if(preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $file)){
								$attachimage .= str_replace('<{$imageurl}>', $url, $image_code);
							}
							else{
								$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil(filesize($attachdir . '/' . $file) / 1024) . 'K)<br /><br />';
							}
						}
					}
					if(!empty($attachimage) || !empty($attachfile)){
						if(!empty($tmpvar)) $tmpvar .= '<br /><br />';
						$tmpvar .= $attachimage . $attachfile;
					}
				}
			}
			else{
				// 检查附件-从数据库判断是不是有附件
				global $query;
				$sql = "SELECT attachment FROM " . jieqi_dbprefix('article_chapter') . " WHERE chapterid=" . intval($chapterid);
				$res = $query->execute($sql);
				$row = $query->getRow($res);
				$attachary = array();
				if(!empty($row['attachment'])){
					$attachary = unserialize($row['attachment']);
				}
				if(is_array($attachary) && count($attachary) > 0){
					$attachimage = '';
					$attachfile = '';
					$image_code = $jieqiConfigs['article']['pageimagecode'];
					if(empty($image_code) || !preg_match('/\<img/is', $image_code)) $image_code = '<div class="divimage"><img src="<{$imageurl}>" border="0" class="imagecontent"></div>';
					foreach($attachary as $attachvar){
						$url = $attachurl . '/' . $attachvar['attachid'] . '.' . $attachvar['postfix'];
						if($attachvar['class'] == 'image'){
							$attachimage .= str_replace('<{$imageurl}>', $url, $image_code);
						}
						else{
							$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
						}
					}
					if(!empty($attachimage) || !empty($attachfile)){
						if(!empty($tmpvar)) $tmpvar .= '<br /><br />';
						$tmpvar .= $attachimage . $attachfile;
					}
				}
			}
		}
		else{
			// 使用js调用
			$url_txtjs = jieqi_uploadurl($jieqiConfigs['article']['txtjsdir'], $jieqiConfigs['article']['txtjsurl'], 'article', $article_static_url) . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid . $jieqi_file_postfix['js'];
			$tmpvar = '<script type="text/javascript" src="' . $url_txtjs . '"></script>';
		}

		$jieqiTpl->assign('jieqi_content', $tmpvar);
		//上一页
		if($preid > 0){
			$tmpcid = intval($this->chapters[$preid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$preid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', $tmpcid);
			$jieqiTpl->assign('previous_chaptername', jieqi_htmlstr($this->chapters[$preid - 1]['chaptername']));
			$jieqiTpl->assign('previous_isvip', $tmpisvip);
			$jieqiTpl->assign('first_page', 0);
		}
		else{
			$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', 0);
			$jieqiTpl->assign('previous_chaptername', '');
			$jieqiTpl->assign('previous_isvip', 0);
			$jieqiTpl->assign('first_page', 1);
		}
		$jieqiTpl->assign('preview_page', $tmpurl); //过期
		$jieqiTpl->assign('url_preview', $tmpurl); //过期
		$jieqiTpl->assign('url_previous', $tmpurl);
		//下一页
		if($nextid > 0){
			$tmpcid = intval($this->chapters[$nextid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$nextid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', $tmpcid);
			$jieqiTpl->assign('next_chaptername', jieqi_htmlstr($this->chapters[$nextid - 1]['chaptername']));
			$jieqiTpl->assign('next_isvip', $tmpisvip);
			$jieqiTpl->assign('last_page', 0);
		}
		else{
			$tmpurl = ARTICLE_STATIC_URL . '/lastchapter.php?aid=' . $this->id . '&dynamic=' . intval($show) . '&acode=' . urlencode($this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', 0);
			$jieqiTpl->assign('next_chaptername', '');
			$jieqiTpl->assign('next_isvip', 0);
			$jieqiTpl->assign('last_page', 1);
		}
		$jieqiTpl->assign('next_page', $tmpurl); //过期
		$jieqiTpl->assign('url_next', $tmpurl);

		$jieqiTpl->setCaching(0);

		if($show){
			$jieqiTpl->display($GLOBALS['jieqiModules']['article']['path'] . '/templates/style.html');
		}
		else{
			$htmldir = $this->getDir('htmldir');
			$jieqiTpl->assign('jieqi_charset', JIEQI_SYSTEM_CHARSET);
			jieqi_writefile($htmldir . '/' . $chapterid . $jieqiConfigs['article']['htmlfile'], $jieqiTpl->fetch($GLOBALS['jieqiModules']['article']['path'] . '/templates/style.html'));
		}
	}

	// 生成一个章节的txtjs
	function makeTxtjs($nowid, $filter = false){
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqi_file_postfix;
		if($nowid <= 0) return false;
		$chaptercount = count($this->chapters);
		if($nowid > $chaptercount) return false;
		if(!empty($this->chapters[$nowid - 1]['isvip'])) return true; //vip章节不生成
		if($this->chapters[$nowid - 1]['chaptertype'] == 1) return true; //分卷不生成

		$chapterid = intval($this->chapters[$nowid - 1]['chapterid']);

		// 内容赋值
		$chaptertype = $this->chapters[$nowid - 1]['chaptertype'] == 1 ? 1 : 0;

		$tmpvar = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($this->chapters[$nowid - 1]['chapterid']), 'isvip' => intval($this->chapters[$nowid - 1]['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($this->chapters[$nowid - 1]['display']), 'getformat' => 'url'));

		// 文字过滤(保存内容时候已经过滤了)
		/*
		if($filter){
			if(!isset($jieqiConfigs['system'])) jieqi_getconfigs('system', 'configs');
			if(isset($jieqiConfigs['system']['postreplacewords']) && !empty($jieqiConfigs['system']['postreplacewords'])){
				if(!isset($checker) || !is_a($checker, 'JieqiChecker')){
					include_once(JIEQI_ROOT_PATH.'/include/checker.php');
					$checker = new JieqiChecker();
				}
				$checker->replace_words($tmpvar, $jieqiConfigs['system']['postreplacewords']);
			}
		}
		*/

		// 网址改成可以点击的
		$tmpvar = jieqi_htmlclickable(jieqi_htmlstr($tmpvar));
		// 加入文字水印
		if(!empty($jieqiConfigs['article']['textwatermark']) && JIEQI_MODULE_VTYPE != '' && JIEQI_MODULE_VTYPE != 'Free'){
			$contentary = preg_split('/<br\s*\/?>\s*<br\s*\/?>/is', $tmpvar);
			$tmpvar = '';
			foreach($contentary as $v){
				if(empty($tmpvar)) $tmpvar .= $v;
				else{
					srand((double)microtime() * 1000000);
					$randstr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$randlen = rand(10, 20);
					$randtext = '';
					$l = strlen($randstr) - 1;
					for($i = 0; $i < $randlen; $i++){
						$num = rand(0, $l);
						$randtext .= $randstr[$num];
					}
					$textwatermark = str_replace('<{$randtext}>', $randtext, $jieqiConfigs['article']['textwatermark']);
					$tmpvar .= '<br />
' . $textwatermark . '<br />' . $v;
				}
			}
		}
		// 附件处理
		$attachurl = jieqi_geturl('article', 'attach', $this->id, $chapterid);
		if(!$jieqiConfigs['article']['packdbattach']){
			// 检查附件(检查文件是否存在)
			$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;

			if(is_dir($attachdir)){
				$attachimage = '';
				$attachfile = '';
				$files = array();
				$handle = @opendir($attachdir);
				while($handle !== false && ($file = @readdir($handle)) !== false){
					if($file != '.' && $file != '..'){
						$files[] = $file;
					}
				}
				@closedir($handle);
				sort($files);
				$image_code = $jieqiConfigs['article']['pageimagecode'];

				if(empty($image_code) || !preg_match('/\<img/is', $image_code)) $image_code = '<div class="divimage"><img src="<{$imageurl}>" border="0" class="imagecontent"></div>';
				foreach($files as $file){
					if(is_file($attachdir . '/' . $file)){
						$url = $attachurl . '/' . $file;
						if(preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $file)){
							$attachimage .= str_replace('<{$imageurl}>', $url, $image_code);
						}
						else{
							$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil(filesize($attachdir . '/' . $file) / 1024) . 'K)<br /><br />';
						}
					}
				}
				if(!empty($attachimage) || !empty($attachfile)){
					if(!empty($tmpvar)) $tmpvar .= '<br /><br />';
					$tmpvar .= $attachimage . $attachfile;
				}
			}
		}
		else{
			// 检查附件-从数据库判断是不是有附件
			global $query;
			$sql = "SELECT attachment FROM " . jieqi_dbprefix('article_chapter') . " WHERE chapterid=" . intval($chapterid);
			$res = $query->execute($sql);
			$row = $query->db->fetchArray($res);
			$attachary = array();
			if(!empty($row['attachment'])){
				$attachary = unserialize($row['attachment']);
			}
			if(is_array($attachary) && count($attachary) > 0){
				$attachimage = '';
				$attachfile = '';
				$image_code = $jieqiConfigs['article']['pageimagecode'];
				if(empty($image_code) || !preg_match('/\<img/is', $image_code)) $image_code = '<div class="divimage"><img src="<{$imageurl}>" border="0" class="imagecontent"></div>';
				foreach($attachary as $attachvar){
					$url = $attachurl . '/' . $attachvar['attachid'] . '.' . $attachvar['postfix'];
					if($attachvar['class'] == 'image'){
						$attachimage .= str_replace('<{$imageurl}>', $url, $image_code);
					}
					else{
						$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
					}
				}
				if(!empty($attachimage) || !empty($attachfile)){
					if(!empty($tmpvar)) $tmpvar .= '<br /><br />';
					$tmpvar .= $attachimage . $attachfile;
				}
			}
		}

		$tmpvar = 'document.write(\'' . addslashes(str_replace(array("\r", "\n"), '', $tmpvar)) . '\');';
		$txtjsdir = $this->getDir('txtjsdir');
		jieqi_writefile($txtjsdir . '/' . $chapterid . $jieqi_file_postfix['js'], $tmpvar);
	}

	// 显示html目录
	function showIndex(){
		$this->makeIndex(true, true);
	}
	
	// 生成html目录
	function makeIndex($dynamic = false, $show = false){
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqi_file_postfix;
		global $jieqiOption;
		global $jieqiModules;
		global $article_handler;
		global $jieqiPset;
		global $jieqiTset;

		// 载入参数设置
		if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs');
		if(!isset($jieqiSort['article'])) jieqi_getconfigs('article', 'sort');
		if(!isset($jieqiOption['article'])) jieqi_getconfigs('article', 'option', 'jieqiOption');

		if(!in_array($jieqiConfigs['article']['htmlfile'], array('.html', '.htm', '.shtml'))) $jieqiConfigs['article']['htmlfile'] = '.html';
		// 载入模板
		if(!is_object($jieqiTpl)){
			include_once(JIEQI_ROOT_PATH . '/lib/template/template.php');
			$jieqiTpl = &JieqiTpl::getInstance();
		}
		if(!$this->isload) $this->loadOPF();

		$jieqi_page_template = $jieqiModules['article']['path'] . '/templates/index.html';
		$jieqiTpl->include_compiled_inc($jieqi_page_template, NULL, true);

		$this->preid = 0; //前一章
		$this->nextid = 0; //下一章
		// 章节列表
		$chapterrows = jieqi_funtoarray('jieqi_htmlstr', $this->chapters);
		//章节倒序
		if(!empty($_REQUEST['desc'])) $chapterrows = array_reverse($chapterrows);
		$firstchapterid = 0;
		$firstchapter = '';
		//兼容旧版赋值
		if(!empty($jieqiConfigs['article']['indexcols'])){
			$rown = 0;
			$coln = 0;
			$cols = intval($jieqiConfigs['article']['indexcols']);
			if($cols < 1) $cols = 4;
		}

		$preid = 0;
		$nextid = 0;
		$volumeorder = 0; //分卷的排序
		$chaptervorder = 0; //章节在分卷中的排序
		$chaptercorder = 0; //章节去掉分卷后的排序
		foreach($chapterrows as $k => $v){
			if($firstchapterid == 0 && $chapterrows[$k]['chaptertype'] == 0){
				$firstchapterid = $chapterrows[$k]['chapterid'];
				$firstchapter = $chapterrows[$k]['chaptername'];
			}
			//分卷序号和章节在分卷中的序号
			if($chapterrows[$k]['chaptertype'] > 0){
				$chaptervorder = 0;
				$chapterrows[$k]['volumeorder'] = ++$volumeorder;
				$chapterrows[$k]['chaptervorder'] = $chaptervorder;
				$chapterrows[$k]['chaptercorder'] = 0;
			}
			else{
				$chapterrows[$k]['volumeorder'] = $volumeorder;
				$chapterrows[$k]['chaptervorder'] = ++$chaptervorder;
				$chapterrows[$k]['chaptercorder'] = ++$chaptercorder;
			}
			$chapterrows[$k]['size_c'] = jieqi_sizeformat($chapterrows[$k]['size'], 'c');

			$chapterrows[$k]['url_chapter'] = jieqi_geturl('article', 'chapter', $chapterrows[$k]['chapterid'], $chapterrows[$k]['articleid'], $chapterrows[$k]['isvip'], $this->metas['articlecode']);

			//判断第一章和最后一章
			if($chapterrows[$k]['chaptertype'] == 0){
				if($nextid == 0) $nextid = $k + 1;
				$preid = $k + 1;
			}
			//判断当前nowid的上一章和下一章(增加修改删除章节时候重新生成上一章和下一章用)
			if($chapterrows[$k]['chaptertype'] == 0){
				$j = $k + 1;
				if($j < $this->nowid) $this->preid = $j;
				elseif($j > $this->nowid && $this->nextid == 0) $this->nextid = $j;
			}
			//兼容旧版赋值
			if(!empty($jieqiConfigs['article']['indexcols'])){
				//分卷
				if($chapterrows[$k]['chaptertype'] > 0){
					if($coln > 0) $rown++;
					$coln = 0;
					$indexrows[$rown]['isvip'] = $chapterrows[$k]['isvip'];
					$indexrows[$rown]['ctype'] = 'volume';
					$indexrows[$rown]['vurl'] = '';
					$indexrows[$rown]['vname'] = $chapterrows[$k]['chaptername'];
					$indexrows[$rown]['vid'] = $chapterrows[$k]['chapterid'];
					$rown++;
				}
				else{
					$coln++;
					$indexrows[$rown]['ctype'] = 'chapter';
					$indexrows[$rown]['isvip' . $coln] = $chapterrows[$k]['isvip'];
					$indexrows[$rown]['cname' . $coln] = $chapterrows[$k]['chaptername'];
					$indexrows[$rown]['cid' . $coln] = $chapterrows[$k]['chapterid'];
					$indexrows[$rown]['time' . $coln] = $chapterrows[$k]['postdate'];
					$indexrows[$rown]['size' . $coln] = $chapterrows[$k]['size'];
					$indexrows[$rown]['size_c' . $coln] = $chapterrows[$k]['size_c'];
					$indexrows[$rown]['curl' . $coln] = $chapterrows[$k]['url_chapter'];
					$indexrows[$rown]['price' . $coln] = $chapterrows[$k]['saleprice'];

					if($coln == $cols){
						$rown++;
						$coln = 0;
					}
				}
			}
		}
		//使用分页的情况，后台参数设置。（只有章节计算到分页行数里面，分卷不算）
		if($show){
			if(!isset($jieqiTset['jieqi_page_rows']) && isset($jieqiConfigs['article']['indexprows'])) $jieqiTset['jieqi_page_rows'] = $jieqiConfigs['article']['indexprows'];
			if(isset($jieqiTset['jieqi_page_rows'])) $jieqiTset['jieqi_page_rows'] = intval($jieqiTset['jieqi_page_rows']);
			if(!empty($jieqiTset['jieqi_page_rows'])){
				if(empty($_REQUEST['page']) || intval($_REQUEST['page']) < 1) $_REQUEST['page'] = 1;
				else $_REQUEST['page'] = intval($_REQUEST['page']);
				$maxpage = ceil($chaptercorder / $jieqiTset['jieqi_page_rows']);
				if($_REQUEST['page'] > $maxpage) $_REQUEST['page'] = $maxpage;
				
				$jieqiPset = jieqi_get_pageset(); //分页参数
				$jieqiPset['count'] = $chaptercorder;
				include_once(JIEQI_ROOT_PATH . '/lib/html/page.php');
				$jumppage = new JieqiPage($jieqiPset);
				$jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());

				$pend = $_REQUEST['page'] * $jieqiTset['jieqi_page_rows'];
				$pstart = $pend - $jieqiTset['jieqi_page_rows'];
				foreach($chapterrows as $k => $v){
					if($chapterrows[$k]['chaptertype'] > 0 || $chapterrows[$k]['chaptercorder'] <= $pstart || $chapterrows[$k]['chaptercorder'] > $pend) unset($chapterrows[$k]);
				}
			}
		}
		
		$jieqiTpl->assign_by_ref('chapterrows', $chapterrows);

		//兼容旧版赋值
		if(!empty($jieqiConfigs['article']['indexcols'])){
			$jieqiTpl->assign_by_ref('indexrows', $indexrows);
		}

		//上一页
		if($preid > 0){
			$tmpcid = intval($this->chapters[$preid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$preid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', $tmpcid);
			$jieqiTpl->assign('first_page', 0);
		}
		else{
			$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
			$jieqiTpl->assign('previous_chapterid', 0);
			$jieqiTpl->assign('first_page', 1);
		}
		$jieqiTpl->assign('preview_page', $tmpurl); //过期
		$jieqiTpl->assign('url_preview', $tmpurl); //过期
		$jieqiTpl->assign('url_previous', $tmpurl);
		//下一页
		if($nextid > 0){
			$tmpcid = intval($this->chapters[$nextid - 1]['chapterid']);
			$tmpisvip = intval($this->chapters[$nextid - 1]['isvip']);
			$tmpurl = jieqi_geturl('article', 'chapter', $tmpcid, $this->id, $tmpisvip, $this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', $tmpcid);
			$jieqiTpl->assign('last_page', 0);
		}
		else{
			$tmpurl = ARTICLE_STATIC_URL . '/lastchapter.php?aid=' . $this->id . '&dynamic=' . intval($show) . '&acode=' . urlencode($this->metas['articlecode']);
			$jieqiTpl->assign('next_chapterid', 0);
			$jieqiTpl->assign('last_page', 1);
		}
		$jieqiTpl->assign('next_page', $tmpurl); //过期
		$jieqiTpl->assign('url_next', $tmpurl);

		// 赋值小说属性
		include_once($jieqiModules['article']['path'] . '/class/article.php');
		include_once($jieqiModules['article']['path'] . '/include/funarticle.php');
		$article = new JieqiArticle();
		$article->setVars($this->metas);
		$articlevals = jieqi_article_vars($article);
		if($firstchapterid > 0){
			$articlevals['firstchapterid'] = $firstchapterid;
			$articlevals['firstchapter'] = $firstchapter;
			$articlevals['url_firstchapter'] = jieqi_geturl('article', 'chapter', $firstchapterid, $articlevals['articleid'], $this->metas['articlecode']);
		}
		else{
			$articlevals['firstchapterid'] = 0;
			$articlevals['firstchapter'] = '';
			$articlevals['url_firstchapter'] = '';
		}
		$jieqiTpl->assign_by_ref('articlevals', $articlevals);
		foreach($articlevals as $k => $v){
			$jieqiTpl->assign_by_ref($k, $articlevals[$k]);
		}

		// 小说序号及名称
		$jieqiTpl->assign('dynamic_url', ARTICLE_DYNAMIC_URL);
		$jieqiTpl->assign('static_url', ARTICLE_STATIC_URL);
		$jieqiTpl->assign('new_url', JIEQI_LOCAL_URL); //淘汰
		$jieqiTpl->assign('copy_info', JIEQI_META_COPYRIGHT);
		$jieqiTpl->assign('article_title', $articlevals['articlename']);
		$jieqiTpl->assign('chapterid', 0);

		$jieqiTpl->assign('article_id', $this->id);
		$jieqiTpl->assign('chapter_id', '0');
		$jieqiTpl->assign('articlesubdir', jieqi_getsubdir($this->id));

		//目录页
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
		$jieqiTpl->assign('index_page', $tmpurl);
		$jieqiTpl->assign('url_articleindex', $tmpurl);
		$jieqiTpl->assign('url_index', $tmpurl);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		//信息页
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		// 全文阅读
		$jieqiTpl->assign('url_fullpage', jieqi_geturl('article', 'article', $this->id, 'full', $this->metas['articlecode']));
		// 打包下载
		$jieqiTpl->assign('url_download', jieqi_geturl('article', 'down', $this->id, 'txt'));
		//书库首页
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');

		$jieqiTpl->setCaching(0);
		if(!empty($jieqiTset['jieqi_page_template'])){
			$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqi_page_template));
			if($jieqiTset['jieqi_page_template'][0] != '/' && $jieqiTset['jieqi_page_template'][1] != ':'){
				if(strpos($jieqiTset['jieqi_page_template'], '/') === false) $jieqi_page_template = JIEQI_ROOT_PATH . '/themes/' . JIEQI_THEME_NAME . '/' . $jieqiTset['jieqi_page_template'];
				else $jieqi_page_template = JIEQI_ROOT_PATH . '/' . $jieqiTset['jieqi_page_template'];
			}
			else
				$jieqi_page_template = $jieqiTset['jieqi_page_template'];
		}
		if($show){
			$jieqiTpl->display($jieqi_page_template);
		}
		else{
			$htmldir = $this->getDir('htmldir');
			$jieqiTpl->assign('jieqi_charset', JIEQI_SYSTEM_CHARSET);
			jieqi_writefile($htmldir . '/index' . $jieqiConfigs['article']['htmlfile'], $jieqiTpl->fetch($jieqi_page_template));
		}
	}

	// 显示分卷阅读
	function showVolume($vid){
		$this->makefulltext(false, true, $vid);
	}

	// 生成全文阅读
	function makefulltext($dynamic = false, $show = false, $vid = 0){
		if(JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') return true;
		global $jieqiModules;
		global $jieqiConfigs;
		global $jieqiSort;
		global $jieqiTpl;
		global $jieqi_file_postfix;
		if(!isset($jieqiSort['article'])) jieqi_getconfigs('article', 'sort');
		if(!in_array($jieqiConfigs['article']['htmlfile'], array('.html', '.htm', '.shtml'))) $jieqiConfigs['article']['htmlfile'] = '.html';
		if(!is_object($jieqiTpl)){
			include_once(JIEQI_ROOT_PATH . '/lib/template/template.php');
			$jieqiTpl = &JieqiTpl::getInstance();
		}
		if(!$this->isload) $this->loadOPF();

		// 赋值小说属性
		include_once($jieqiModules['article']['path'] . '/class/article.php');
		include_once($jieqiModules['article']['path'] . '/include/funarticle.php');
		$article = new JieqiArticle();
		$article->setVars($this->metas);
		$articlevals = jieqi_article_vars($article);
		$jieqiTpl->assign_by_ref('articlevals', $articlevals);
		foreach($articlevals as $k => $v){
			$jieqiTpl->assign_by_ref($k, $articlevals[$k]);
		}

		// 生成index.html
		$articlename = jieqi_htmlstr($this->metas['articlename']);
		$jieqiTpl->assign('dynamic_url', ARTICLE_DYNAMIC_URL);
		$jieqiTpl->assign('static_url', ARTICLE_STATIC_URL);
		$jieqiTpl->assign('article_title', $articlename);
		$jieqiTpl->assign('book_title', '<a name="articletitle">' . $articlename . '</a>');
		$jieqiTpl->assign('copy_info', JIEQI_META_COPYRIGHT);
		$jieqiTpl->assign('new_url', JIEQI_LOCAL_URL);

		//目录页
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'index', $this->metas['articlecode']);
		$jieqiTpl->assign('index_page', $tmpurl);
		$jieqiTpl->assign('url_articleindex', $tmpurl);
		$jieqiTpl->assign('url_index', $tmpurl);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		//信息页
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		// 全文阅读
		$tmpurl = jieqi_geturl('article', 'article', $this->id, 'full', $this->metas['articlecode']);
		$jieqiTpl->assign('url_fullpage', $tmpurl);
		$jieqiTpl->assign('url_thispage', $tmpurl);
		// 打包下载
		$jieqiTpl->assign('url_download', jieqi_geturl('article', 'down', $this->id, 'txt'));
		//书库首页
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');


		$chapterrows = array();
		$chapters = array();

		$idx = 0;
		$n = 0;
		$vname = '';
		if($vid > 0) $cstart = false;
		else $cstart = true;
		foreach($this->chapters as $k => $chapter){
			// 分卷
			$chapterid = intval($this->chapters[$k]['chapterid']);

			if($vid > 0){
				if($chapterid == $vid) $cstart = true;
				elseif($cstart == true && $chapter['chaptertype'] == 1) $cstart = false;
				if(!$cstart) continue;
			}

			if($chapter['chaptertype'] == 1){
				$chapterrows[$idx] = jieqi_funtoarray('jieqi_htmlstr', $chapter);
				$idx++;
				if($chapter['chaptername'] != $vname) $vname = $chapter['chaptername'];
			}
			else{
				$chapterrows[$idx] = jieqi_funtoarray('jieqi_htmlstr', $chapter);
				$chapterrows[$idx]['url_chapter'] = '#' . $chapter['chapterid'];
				$idx++;

				if(!empty($vname)) $tmpvar = $vname . ' ';
				else $tmpvar = '';
				$chapters[$n]['title'] = '<a name="' . $chapterid . '">' . $tmpvar . $chapter['chaptername'] . '</a>';
				$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
				$tmpvar = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));

				if(strlen($tmpvar) > 0){
					$chapters[$n]['content'] = jieqi_htmlclickable(jieqi_htmlstr($tmpvar));
				}
				else{
					$chapters[$n]['content'] = '';
				}
				$attachurl = jieqi_geturl('article', 'attach', $this->id, $chapterid);
				if(!$jieqiConfigs['article']['packdbattach']){
					// 检查附件(从文件)
					$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;

					if(is_dir($attachdir)){
						$attachimage = '';
						$attachfile = '';
						$files = array();
						$handle = @opendir($attachdir);
						while($handle !== false && ($file = @readdir($handle)) !== false){
							if($file != '.' && $file != '..'){
								$files[] = $file;
							}
						}
						@closedir($handle);
						sort($files);
						foreach($files as $file){
							if(is_file($attachdir . '/' . $file)){
								$url = $attachurl . '/' . $file;
								if(preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $file)){
									$attachimage .= '<div class="divimage" id="' . $file . '" title="' . $url . '"><a style="cursor: pointer;" onclick="imgclickshow(\'' . $file . '\', \'' . $url . '\')">' . $url . '</a>(' . ceil(filesize($attachdir . '/' . $file) / 1024) . 'K)</div>';
								}
								else{
									$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil(filesize($attachdir . '/' . $file) / 1024) . 'K)<br /><br />';
								}
							}
						}
						if(!empty($attachimage) || !empty($attachfile)){
							if(!empty($chapters[$n]['content'])) $chapters[$n]['content'] .= '<br /><br />';
							$chapters[$n]['content'] .= $attachimage . $attachfile;
						}
					}
				}
				else{
					// 检查附件，从数据库
					global $query;
					$sql = "SELECT attachment FROM " . jieqi_dbprefix('article_chapter') . " WHERE chapterid=" . intval($chapterid);
					$res = $query->execute($sql);
					$row = $query->db->fetchArray($res);
					$attachary = array();
					if(!empty($row['attachment'])){
						$attachary = unserialize($row['attachment']);
					}

					if(is_array($attachary) && count($attachary) > 0){
						$attachimage = '';
						$attachfile = '';

						foreach($attachary as $attachvar){
							$url = $attachurl . '/' . $attachvar['attachid'] . '.' . $attachvar['postfix'];
							if($attachvar['class'] == 'image'){
								$attachimage .= '<strong>image:</strong><a href="' . $url . '" target="_blank">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
							}
							else{
								$attachfile .= '<strong>file:</strong><a href="' . $url . '">' . $url . '</a>(' . ceil($attachvar['size'] / 1024) . 'K)<br /><br />';
							}
						}

						if(!empty($attachimage) || !empty($attachfile)){
							if(!empty($chapters[$n]['content'])) $chapters[$n]['content'] .= '<br /><br />';
							$chapters[$n]['content'] .= $attachimage . $attachfile;
						}
					}
				}

				$n++;
			}
		}
		$jieqiTpl->assign_by_ref('chapterrows', $chapterrows);
		$jieqiTpl->assign_by_ref('chapters', $chapters);
		$jieqiTpl->assign('articlesubdir', jieqi_getsubdir($this->id));
		$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $this->id, 'info', $this->metas['articlecode']));
		$jieqiTpl->assign('url_bookroom', ARTICLE_DYNAMIC_URL . '/');
		$jieqiTpl->setCaching(0);
		if($show){
			$jieqiTpl->display($GLOBALS['jieqiModules']['article']['path'] . '/templates/fulltext.html');
		}
		else{
			$htmldir = $this->getDir('fulldir', false);
			$jieqiTpl->assign('jieqi_charset', JIEQI_SYSTEM_CHARSET);
			jieqi_writefile($htmldir . '/' . $this->id . $jieqiConfigs['article']['htmlfile'], $jieqiTpl->fetch($GLOBALS['jieqiModules']['article']['path'] . '/templates/fulltext.html'));
		}
	}

	// 生成txt全文
	function maketxtfull(){
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		if((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && (empty($GLOBALS['jieqi_license_modules']['waparticle'])) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') return true;
		$txtfulldir = $this->getDir('txtfulldir', false);
		$br = "\r\n";
		$data = '';
		if(!empty($jieqiConfigs['article']['txtarticlehead'])) $data .= $jieqiConfigs['article']['txtarticlehead'] . $br . $br;
		$data .= '<' . $this->metas['articlename'] . '>' . $br;
		$volume = '';
		foreach($this->chapters as $k => $chapter){
			if($chapter['chaptertype'] == 1){
				$volume = $chapter['chaptername'];
			}
			else{
				$data .= $br . $br . $volume . ' ' . $chapter['chaptername'] . $br . $br;
				$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
				$data .= jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
			}
		}
		if(!empty($jieqiConfigs['article']['txtarticlefoot'])) $data .= $br . $jieqiConfigs['article']['txtarticlefoot'];
		jieqi_writefile($txtfulldir . '/' . $this->id . $jieqi_file_postfix['txt'], $data);
	}

	// 生成压缩文件
	function makezip(){
		if(JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') return true;
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		global $jieqiModules;
		if(@function_exists('gzcompress') && $jieqiConfigs['article']['makehtml'] > 0){
			$dir = $this->getDir('htmldir', true, false);

			// 逐个加文件，因为里面有内容需要替换
			$filelist = array();
			if(file_exists($dir)){
				$handle = opendir($dir);
				while($handle !== false && ($files = readdir($handle)) !== false){
					if(($files != ".") && ($files != "..") && (!is_dir($dir . '/' . $files))) $filelist[] = $dir . '/' . $files;
				}
				closedir($handle);
			}

			if(count($filelist) > 0){
				include_once(JIEQI_ROOT_PATH . '/lib/compress/zip.php');
				$zip = new JieqiZip();
				$zipfilename = $this->getDir('zipdir', false) . '/' . $this->id . $jieqi_file_postfix['zip'];
				if(!$zip->zipstart($zipfilename)) return false;
				foreach($filelist as $filename){
					if(is_file($filename)){
						$content = jieqi_readfile($filename);
						// 把css和js替换成本地的
						//$content = preg_replace("/href=(\"|')([^'\"]*)page.css(\"|')/i", 'href="page.css"', $content, 1);
						$zip->zipadd(basename($filename), $content);
					}
				}
				// 加入css和js
				//$content = '';
				//if(is_file($jieqiModules['article']['path'] . '/css/page.css')) $content = jieqi_readfile($jieqiModules['article']['path'] . '/css/page.css');
				//elseif(is_file(JIEQI_ROOT_PATH . '/configs/article/page.css'))	$content = jieqi_readfile(JIEQI_ROOT_PATH . '/configs/article/page.css');
				//$zip->zipadd('page.css', $content);


				// $zip->setComment("Powered by JIEQI CMS\r\nhttp://www.jieqi.com");
				if($zip->zipend()) @chmod($zipfilename, 0777);
			}
			return true;
		}
		else{
			return false;
		}
	}

	// 分卷生成umd
	function makeumd_volume($vk = 0){
		if((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && (empty($GLOBALS['jieqi_license_modules']['waparticle'])) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') return true;
		if(!function_exists('gzcompress') || !function_exists('iconv')) return false;

		global $jieqiConfigs;
		global $jieqi_file_postfix;
		if(!isset($jieqiSort['article'])) jieqi_getconfigs('article', 'sort');
		include_once(JIEQI_ROOT_PATH . '/lib/compress/umd.php');
		$umddir = $this->getDir('umddir', true);
		// $txtdir=$this->getDir('txtdir', true, false);


		$vk = intval($vk);
		// $vk = 128; //每卷几K
		$vd = 1; // 每卷程序占用几K
		$vc = 0.58; // 压缩比例
		$vinfo = array();
		if(empty($vk) || $vk < $vd){
			$umd = new JieqiUmd();
			$umd->setcharset(strtoupper(JIEQI_SYSTEM_CHARSET));

			if(!empty($jieqiSort['article'][$this->metas['sortid']]['caption'])) $sort = $jieqiSort['article'][$this->metas['sortid']]['caption'];
			else $sort = '';

			$umd->setinfo(array('id' => $this->id, 'title' => $this->metas['articlename'], 'author' => $this->metas['author'], 'sort' => $sort, 'publisher' => JIEQI_SITE_NAME, 'corver' => '')); // 设置小说信息


			$volume = '';
			$fromvolume = '';
			$fromchapter = '';
			$fromchapterid = 0;
			$tovolume = '';
			$tochapter = '';
			$tochapterid = 0;
			$chapters = 0;
			$volumes = 0;
			$firstflag = true;

			foreach($this->chapters as $k => $chapter){
				if($chapter['chaptertype'] == 1){
					$volume = $chapter['chaptername'];
					if($firstflag) $fromvolume = $volume;
					$tovolume = $volume;
					$volumes++;
				}
				else{
					$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
					$filedata = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
					$umd->addchapter($volume . ' ' . $chapter['chaptername'], '<' . $volume . ' ' . $chapter['chaptername'] . '>' . "\n" . $filedata);
					if($fromchapter == '') $fromchapter = $chapter['chaptername'];
					$tochapter = $chapter['chaptername'];
					$tmpcid = intval($chapter['chapterid']);
					if($fromchapterid == 0) $fromchapterid = $tmpcid;
					$tochapterid = $tmpcid;
					$chapters++;
				}
				$firstflag = false;
			}
			$umd->makeumd($umddir . '/' . $this->id . $jieqi_file_postfix['umd']);
			unset($umd);

			$vinfo['chapters'] = $chapters;
			$vinfo['volumes'] = $volumes;
			$vinfo['fromvolume'] = $fromvolume;
			$vinfo['fromchapter'] = $fromchapter;
			$vinfo['fromchapterid'] = $fromchapterid;
			$vinfo['tovolume'] = $tovolume;
			$vinfo['tochapter'] = $tochapter;
			$vinfo['tochapterid'] = $tochapterid;
			$vinfo['maketime'] = JIEQI_NOW_TIME;
			$vinfo['filesize'] = filesize($umddir . '/' . $this->id . $jieqi_file_postfix['umd']);
			include_once(JIEQI_ROOT_PATH . '/lib/xml/xmlarray.php');
			$xmlarray = new XMLArray();
			$xmldata = $xmlarray->array2xml($vinfo);
			jieqi_writefile($umddir . '/' . $this->id . '.xml', $xmldata);
		}
		elseif($vk > $vd){
			$vid = 1; // 第几卷
			$vnew = true; // 是否需要新增卷
			$vsize = 0;
			$volume = '';
			foreach($this->chapters as $k => $chapter){
				if($chapter['chaptertype'] == 1){
					$volume = $chapter['chaptername'];
					$vinfo[$vid]['volumes']++;
				}
				else{
					$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
					$filedata = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
					$vcdata = '<' . $volume . ' ' . $chapter['chaptername'] . '>' . "\n";
					$filelen = strlen($filedata) + strlen($vcdata);
					if($vsize > 0 && (($vsize + $filelen) / 1024 * $vc) > ($vk - $vd)){
						$umd->makeumd($umddir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['umd']);
						unset($umd);
						$vinfo[$vid]['maketime'] = JIEQI_NOW_TIME;
						$vinfo[$vid]['filesize'] = filesize($umddir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['umd']);
						$vid++;
						$vsize = 0;
						$vnew = true;
					}
					if($vnew){
						$umd = new JieqiUmd();
						$umd->setcharset(strtoupper(JIEQI_SYSTEM_CHARSET));
						if(!empty($jieqiSort['article'][$this->metas['sortid']]['caption'])) $sort = $jieqiSort['article'][$this->metas['sortid']]['caption'];
						else $sort = '';
						$umd->setinfo(array('id' => $this->id, 'title' => $this->metas['articlename'] . '_' . $vk . '_' . $vid, 'author' => $this->metas['author'], 'sort' => $sort, 'publisher' => JIEQI_SITE_NAME, 'corver' => '')); // 设置小说信息


						$vnew = false;
						$vinfo[$vid]['chapters'] = 0;
						$vinfo[$vid]['volumes'] = 0;
						$vinfo[$vid]['fromvolume'] = $volume;
						$vinfo[$vid]['fromchapter'] = $chapter['chaptername'];
						$vinfo[$vid]['fromchapterid'] = intval($chapter['chapterid']);
					}
					$umd->addchapter($volume . ' ' . $chapter['chaptername'], $vcdata . $filedata);
					$vsize = $vsize + $filelen;
					$vinfo[$vid]['chapters']++;
					$vinfo[$vid]['tovolume'] = $volume;
					$vinfo[$vid]['tochapter'] = $chapter['chaptername'];
					$vinfo[$vid]['tochapterid'] = intval($chapter['chapterid']);
				}
			}
			if(!$vnew){
				$umd->makeumd($umddir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['umd']);
				$vinfo[$vid]['tovolume'] = $volume;
				$vinfo[$vid]['tochapter'] = $chapter['chaptername'];
				$vinfo[$vid]['tochapterid'] = intval($chapter['chapterid']);
				$vinfo[$vid]['maketime'] = JIEQI_NOW_TIME;
				$vinfo[$vid]['filesize'] = filesize($umddir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['umd']);
				unset($umd);
			}
			include_once(JIEQI_ROOT_PATH . '/lib/xml/xmlarray.php');
			$xmlarray = new XMLArray();
			$xmldata = $xmlarray->array2xml($vinfo);
			jieqi_writefile($umddir . '/' . $this->id . '_' . $vk . '.xml', $xmldata);
		}
		else{
			return false;
		}
	}

	// 生成umd
	function makeumd(){
		global $jieqiConfigs;
		if((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && (empty($GLOBALS['jieqi_license_modules']['waparticle'])) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') return true;
		if(!function_exists('gzcompress') || !function_exists('iconv')) return false;

		$jieqiConfigs['article']['makeumd'] = intval($jieqiConfigs['article']['makeumd']);
		if(empty($jieqiConfigs['article']['makeumd'])) $jieqiConfigs['article']['makeumd'] = 1;
		// 全本umd
		if(($jieqiConfigs['article']['makeumd'] & 1) > 0) $this->makeumd_volume();
		// 64K umd
		if(($jieqiConfigs['article']['makeumd'] & 2) > 0) $this->makeumd_volume(64);
		// 128K umd
		if(($jieqiConfigs['article']['makeumd'] & 4) > 0) $this->makeumd_volume(128);
		// 256K umd
		if(($jieqiConfigs['article']['makeumd'] & 8) > 0) $this->makeumd_volume(256);
		// 512K umd
		if(($jieqiConfigs['article']['makeumd'] & 16) > 0) $this->makeumd_volume(512);
		// 1024K umd
		if(($jieqiConfigs['article']['makeumd'] & 32) > 0) $this->makeumd_volume(1024);
	}

	// 分卷生成jar($vk 每卷几K)
	function makejar_volume($vk = 0){
		if((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && (empty($GLOBALS['jieqi_license_modules']['waparticle'])) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') return true;
		if(!function_exists('gzcompress') || !function_exists('iconv')) return false;
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		include_once(JIEQI_ROOT_PATH . '/lib/compress/jar.php');
		$jardir = $this->getDir('jardir', true, true);
		// $txtdir=$this->getDir('txtdir', true, false);


		$vk = intval($vk);
		$vd = intval(JIEQI_JAR_DEFAULT_SIZE); // 每卷程序占用几K
		$vc = floatval(JIEQI_JAR_COMPRESS_RATE); // 压缩比例
		$vinfo = array();
		if(empty($vk) || $vk < $vd){
			$jar = new JieqiJar();
			$jar->setcharset(strtoupper(JIEQI_SYSTEM_CHARSET));
			$jar->setinfo(array('id' => $this->id, 'title' => $this->metas['articlename'], 'author' => $this->metas['author'], 'publisher' => JIEQI_SITE_NAME, 'corver' => '')); // 设置小说信息


			$volume = '';
			$fromvolume = '';
			$fromchapter = '';
			$fromchapterid = 0;
			$tovolume = '';
			$tochapter = '';
			$tochapterid = 0;
			$chapters = 0;
			$volumes = 0;
			$firstflag = true;

			foreach($this->chapters as $k => $chapter){
				if($chapter['chaptertype'] == 1){
					$volume = $chapter['chaptername'];
					if($firstflag) $fromvolume = $volume;
					$tovolume = $volume;
					$volumes++;
				}
				else{
					$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
					$filedata = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
					$jar->addchapter($volume . ' ' . $chapter['chaptername'], '<' . $volume . ' ' . $chapter['chaptername'] . '>' . "\r\n" . $filedata);
					if($fromchapter == '') $fromchapter = $chapter['chaptername'];
					$tochapter = $chapter['chaptername'];
					$tmpcid = intval($chapter['chapterid']);
					if($fromchapterid == 0) $fromchapterid = $tmpcid;
					$tochapterid = $tmpcid;
					$chapters++;
				}
				$firstflag = false;
			}
			$jar->makejar($jardir . '/' . $this->id . $jieqi_file_postfix['jar']);
			unset($jar);

			$vinfo['chapters'] = $chapters;
			$vinfo['volumes'] = $volumes;
			$vinfo['fromvolume'] = $fromvolume;
			$vinfo['fromchapter'] = $fromchapter;
			$vinfo['fromchapterid'] = $fromchapterid;
			$vinfo['tovolume'] = $tovolume;
			$vinfo['tochapter'] = $tochapter;
			$vinfo['tochapterid'] = $tochapterid;
			$vinfo['maketime'] = JIEQI_NOW_TIME;
			$vinfo['filesize'] = filesize($jardir . '/' . $this->id . $jieqi_file_postfix['jar']);
			$vinfo['jadsize'] = filesize($jardir . '/' . $this->id . $jieqi_file_postfix['jad']);
			include_once(JIEQI_ROOT_PATH . '/lib/xml/xmlarray.php');
			$xmlarray = new XMLArray();
			$xmldata = $xmlarray->array2xml($vinfo);
			jieqi_writefile($jardir . '/' . $this->id . '.xml', $xmldata);
		}
		elseif($vk > $vd){
			$vid = 1; // 第几卷
			$vnew = true; // 是否需要新增卷
			$vsize = 0;
			$volume = '';
			foreach($this->chapters as $k => $chapter){
				if($chapter['chaptertype'] == 1){
					$volume = $chapter['chaptername'];
					$vinfo[$vid]['volumes']++;
				}
				else{
					$chaptertype = $chapter['chaptertype'] == 1 ? 1 : 0;
					$filedata = jieqi_get_achapterc(array('articleid' => $this->id, 'articlecode' => $this->metas['articlecode'], 'chapterid' => intval($chapter['chapterid']), 'isvip' => intval($chapter['isvip']), 'chaptertype' => $chaptertype, 'display' => intval($chapter['display']), 'getformat' => 'url'));
					$vcdata = '<' . $volume . ' ' . $chapter['chaptername'] . '>' . "\r\n";
					$filelen = strlen($filedata) + strlen($vcdata);
					if($vsize > 0 && (($vsize + $filelen) / 1024 * $vc) > ($vk - $vd)){
						$jar->makejar($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jar']);
						unset($jar);
						$vinfo[$vid]['maketime'] = JIEQI_NOW_TIME;
						$vinfo[$vid]['filesize'] = filesize($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jar']);
						$vinfo[$vid]['jadsize'] = filesize($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jad']);
						$vid++;
						$vsize = 0;
						$vnew = true;
					}
					if($vnew){
						$jar = new JieqiJar();
						$jar->setcharset(strtoupper(JIEQI_SYSTEM_CHARSET));
						$jar->setinfo(array('id' => $this->id, 'title' => $this->metas['articlename'] . '_' . $vk . '_' . $vid, 'author' => $this->metas['author'], 'publisher' => JIEQI_SITE_NAME, 'corver' => '')); // 设置小说信息
						$vnew = false;
						$vinfo[$vid]['chapters'] = 0;
						$vinfo[$vid]['volumes'] = 0;
						$vinfo[$vid]['fromvolume'] = $volume;
						$vinfo[$vid]['fromchapter'] = $chapter['chaptername'];
						$vinfo[$vid]['fromchapterid'] = intval($chapter['chapterid']);
					}
					$jar->addchapter($volume . ' ' . $chapter['chaptername'], $vcdata . $filedata);
					$vsize = $vsize + $filelen;
					$vinfo[$vid]['chapters']++;
					$vinfo[$vid]['tovolume'] = $volume;
					$vinfo[$vid]['tochapter'] = $chapter['chaptername'];
					$vinfo[$vid]['tochapterid'] = intval($chapter['chapterid']);
				}
			}
			if(!$vnew){
				$jar->makejar($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jar']);
				$vinfo[$vid]['tovolume'] = $volume;
				$vinfo[$vid]['tochapter'] = $chapter['chaptername'];
				$vinfo[$vid]['tochapterid'] = intval($chapter['chapterid']);
				$vinfo[$vid]['maketime'] = JIEQI_NOW_TIME;
				$vinfo[$vid]['filesize'] = filesize($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jar']);
				$vinfo[$vid]['jadsize'] = filesize($jardir . '/' . $this->id . '_' . $vk . '_' . $vid . $jieqi_file_postfix['jad']);
				unset($jar);
			}
			include_once(JIEQI_ROOT_PATH . '/lib/xml/xmlarray.php');
			$xmlarray = new XMLArray();
			$xmldata = $xmlarray->array2xml($vinfo);
			jieqi_writefile($jardir . '/' . $this->id . '_' . $vk . '.xml', $xmldata);
		}
		else{
			return false;
		}
	}

	// 生成jar
	function makejar(){
		global $jieqiConfigs;
		if((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && (empty($GLOBALS['jieqi_license_modules']['waparticle'])) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') return true;
		if(!function_exists('gzcompress') || !function_exists('iconv')) return false;
		$jieqiConfigs['article']['makejar'] = intval($jieqiConfigs['article']['makejar']);
		if(empty($jieqiConfigs['article']['makejar'])) $jieqiConfigs['article']['makejar'] = 1;
		// 全本jar
		if(($jieqiConfigs['article']['makejar'] & 1) > 0) $this->makejar_volume();
		// 64K jar
		if(($jieqiConfigs['article']['makejar'] & 2) > 0) $this->makejar_volume(64);
		// 128K jar
		if(($jieqiConfigs['article']['makejar'] & 4) > 0) $this->makejar_volume(128);
		// 256K jar
		if(($jieqiConfigs['article']['makejar'] & 8) > 0) $this->makejar_volume(256);
		// 512K jar
		if(($jieqiConfigs['article']['makejar'] & 16) > 0) $this->makejar_volume(512);
		// 1024K jar
		if(($jieqiConfigs['article']['makejar'] & 32) > 0) $this->makejar_volume(1024);
	}

	// 生成打包文件（异步）
	function makepack(){
		if((JIEQI_MODULE_VTYPE == '' || JIEQI_MODULE_VTYPE == 'Free') && (empty($GLOBALS['jieqi_license_modules']['waparticle'])) || $GLOBALS['jieqi_license_modules']['waparticle'] == 'Free') return true;
		global $jieqiConfigs;
		global $jieqiModules;
		$article_static_url = (empty($jieqiConfigs['article']['staticurl'])) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl'];
		$url = $article_static_url . '/makepack.php?key=' . urlencode(md5(JIEQI_DB_USER . JIEQI_DB_PASS . JIEQI_DB_NAME)) . '&id=' . intval($this->id);
		$url = trim($url);
		if(strtolower(substr($url, 0, 7)) != 'http://') $url = 'http://' . $_SERVER['HTTP_HOST'] . $url;
		$tmpurl = $url;

		// 生成zip文件
		if($jieqiConfigs['article']['makezip']){
			$url .= '&packflag[]=makezip';
		}
		// 生成全文阅读
		if($jieqiConfigs['article']['makefull']){
			$url .= '&packflag[]=makefull';
		}
		// 生成txt全文
		if($jieqiConfigs['article']['maketxtfull']){
			$url .= '&packflag[]=maketxtfull';
		}
		// 生成umd
		if($jieqiConfigs['article']['makeumd']){
			$url .= '&packflag[]=makeumd';
		}
		// 生成jar
		if($jieqiConfigs['article']['makejar']){
			$url .= '&packflag[]=makejar';
		}
		if($url == $tmpurl) return true;
		else return jieqi_socket_url($url);
	}

	// 生成打包文件(同步)
	function makepack_dist(){
		global $jieqiConfigs;
		// 生成zip文件
		if($jieqiConfigs['article']['makezip']){
			$this->makezip();
		}
		// 生成全文阅读
		if($jieqiConfigs['article']['makefull']){
			$this->makefulltext();
		}
		// 生成txt全文
		if($jieqiConfigs['article']['maketxtfull']){
			$this->maketxtfull();
		}
		// 生成umd
		if($jieqiConfigs['article']['makeumd']){
			$this->makeumd();
		}
		// 生成jar
		if($jieqiConfigs['article']['makejar']){
			$this->makejar();
		}
	}

	// 增加章节
	function addChapter($chapter, &$content, $article = null){
		global $jieqiConfigs;
		global $jieqi_file_postfix;

		$chapterid = intval($chapter->getVar('chapterid', 'n'));
		$chaptertype = intval($chapter->getVar('chaptertype', 'n'));
		$chapterorder = intval($chapter->getVar('chapterorder', 'n'));
		$isvip = intval($chapter->getVar('isvip', 'n'));

		// $txtdir=$this->getDir('txtdir');
		// jieqi_writefile($txtdir.'/'.$chapterid.$jieqi_file_postfix['txt'],
		// $content);
		jieqi_save_achapterc($this->id, $chapterid, $content, $isvip, $chaptertype);
		if(!$this->isload) $this->loadOPF();
		$articlename = jieqi_htmlstr($this->metas['articlename']);

		if(is_object($article)) $this->metas = $article->getVars('n');

		$chaptercount = count($this->chapters);
		// 处理新章节的位置
		if($chapterorder > 0){
			if($chapterorder > $chaptercount) $chapterorder = $chaptercount + 1;
			else{
				while($chapterorder <= $chaptercount && $this->chapters[$chapterorder - 1]['chaptertype'] != 1) $chapterorder++;
			}
		}
		else{
			$chapterorder = $chaptercount + 1;
		}

		if($chapterorder > $chaptercount){
			// 追加章节
			$this->chapters[] = $chapter->getVars('n');
		}
		else{
			// 插入章节
			for($i = $chaptercount; $i >= $chapterorder; $i--){
				$this->chapters[$i] = $this->chapters[$i - 1];
			}
			$this->chapters[$chapterorder - 1] = $chapter->getVars('n');
		}
		$this->createOPF();
		$this->nowid = $chapterorder;
		// 生成html
		if($jieqiConfigs['article']['makehtml']){
			// 生成html目录
			$this->makeIndex();
			// 如果是章节而不是分卷则生成相应章节的html
			if(!$chaptertype){
				if($this->preid > 0) $this->makeHtml($this->preid);
				if($this->nextid > 0) $this->makeHtml($this->nextid);
				$this->makeHtml($this->nowid);
			}
		}
		if(!$chaptertype && !$isvip){
			if($jieqiConfigs['article']['maketxtjs']) $this->makeTxtjs($this->nowid, true);
			$this->makepack();
		}
	}

	// 编辑章节
	function editChapter($chapter, &$content){
		global $jieqiConfigs;
		global $jieqi_file_postfix;

		$chapterid = intval($chapter->getVar('chapterid', 'n'));
		$chaptertype = intval($chapter->getVar('chaptertype', 'n'));
		$chapterorder = intval($chapter->getVar('chapterorder', 'n'));
		$isvip = intval($chapter->getVar('isvip', 'n'));

		// $txtdir=$this->getDir('txtdir');
		// jieqi_writefile($txtdir.'/'.$chapterid.$jieqi_file_postfix['txt'],
		// $content);
		jieqi_edit_achapterc($this->id, $chapterid, $content, $isvip, $chaptertype);
		$this->loadOPF();

		$articlename = jieqi_htmlstr($this->metas['articlename']);
		$this->chapters[$chapterorder - 1] = $chapter->getVars('n');
		$this->createOPF();

		// 生成html
		$this->nowid = $chapterorder;
		if($jieqiConfigs['article']['makehtml']){
			// 生成html目录
			$this->makeIndex();
			// 如果是章节而不是分卷则生成相应章节的html
			if(!$chaptertype && !$isvip){
				$this->makeHtml($this->nowid);
			}
		}
		if(!$chaptertype && !$isvip){
			if($jieqiConfigs['article']['maketxtjs']) $this->makeTxtjs($this->nowid, true);
			$this->makepack();
		}
	}

	// 设置章节VIP状态
	function setChapter($chapter){
		global $jieqiConfigs;
		global $jieqi_file_postfix;

		$chapterid = intval($chapter->getVar('chapterid', 'n'));
		$chaptertype = intval($chapter->getVar('chaptertype', 'n'));
		$chapterorder = intval($chapter->getVar('chapterorder', 'n'));
		$isvip = intval($chapter->getVar('isvip', 'n'));

		$this->loadOPF();

		$articlename = jieqi_htmlstr($this->metas['articlename']);
		$this->chapters[$chapterorder - 1] = $chapter->getVars('n');
		$this->createOPF();

		// 生成html
		$this->nowid = $chapterorder;
		if($jieqiConfigs['article']['makehtml']){
			// 生成html目录
			$this->makeIndex();
			// 如果是章节而不是分卷则生成相应章节的html
			if(!$chaptertype){
				if($this->preid > 0) $this->makeHtml($this->preid);
				if($this->nextid > 0) $this->makeHtml($this->nextid);
				$this->makeHtml($this->nowid);
			}
		}
		if(!$chaptertype && !$isvip){
			if($jieqiConfigs['article']['maketxtjs']) $this->makeTxtjs($this->nowid, true);
			$this->makepack();
		}
	}

	// 删除章节
	function delChapter($chapter){
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		$chapterorder = intval($chapter->getVar('chapterorder', 'n'));
		$chapterid = intval($chapter->getVar('chapterid', 'n'));
		$isvip = intval($chapter->getVar('isvip', 'n'));
		$chaptertype = intval($chapter->getVar('chaptertype', 'n'));

		$txtjsdir = $this->getDir('txtjsdir', true, false);
		// 删除文件
		jieqi_delete_achapterc($this->id, $chapterid, $isvip, $chaptertype);
		if($isvip == 0 && file_exists($txtjsdir . '/' . $chapterid . $jieqi_file_postfix['js'])) jieqi_delfile($txtjsdir . '/' . $chapterid . $jieqi_file_postfix['js']);
		// 删除附件
		$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id . '/' . $chapterid;
		if(is_dir($attachdir)) jieqi_delfolder($attachdir);
		$this->loadOPF();
		$chaptercount = count($this->chapters);
		for($i = $chapterorder; $i < $chaptercount; $i++){
			$this->chapters[$i - 1] = $this->chapters[$i];
		}
		array_pop($this->chapters);
		$this->createOPF();
		// 生成html
		if($jieqiConfigs['article']['makehtml']){
			// 生成html目录
			if($chapterorder >= $chaptercount) $chapterorder = $chaptercount - 1;
			$this->nowid = $chapterorder;
			$this->makeIndex();
			$htmldir = $this->getDir('htmldir', true, false);
			if(file_exists($htmldir . '/' . $chapterid . $jieqiConfigs['article']['htmlfile'])) jieqi_delfile($htmldir . '/' . $chapterid . $jieqiConfigs['article']['htmlfile']);
			if($this->preid > 0) $this->makeHtml($this->preid);
			if($this->chapters[$chapterorder - 1]['chaptertype'] != 1) $this->makeHtml($chapterorder);
			else{
				if($this->nextid > 0) $this->makeHtml($this->nextid);
			}
		}
		$this->makepack();
	}

	// 章节排序
	function sortChapter($fromid, $toid){
		global $jieqiConfigs;
		$this->loadOPF();
		$chaptercount = count($this->chapters);
		if($fromid < 1 || $fromid > $chaptercount || $toid < 0 || $toid > $chaptercount) return false;
		if($fromid == $toid || $fromid == $toid + 1) return true;
		if($this->chapters[$fromid - 1]['chaptertype'] == 1) $type = 0;
		else $type = 1;
		if($fromid < $toid){
			$tmpvar = $this->chapters[$fromid - 1];
			for($i = $fromid; $i < $toid; $i++){
				$this->chapters[$i - 1] = $this->chapters[$i];
			}
			$this->chapters[$toid - 1] = $tmpvar;
		}
		else{
			$tmpvar = $this->chapters[$fromid - 1];
			for($i = $fromid - 1; $i > $toid; $i--){
				$this->chapters[$i] = $this->chapters[$i - 1];
			}
			$this->chapters[$toid] = $tmpvar;
		}
		$this->createOPF();
		// 生成html
		if($jieqiConfigs['article']['makehtml']){
			// 生成html目录
			$this->makeIndex();
			// 章节调换顺序需要重新生成html
			if($type){
				if($fromid > $toid) $toid++;
				$chgarray = array();
				if($this->chapters[$fromid - 1]['chaptertype'] != 1){
					$this->makeHtml($fromid);
					$chgarray[] = $fromid;
				}
				if($this->chapters[$toid - 1]['chaptertype'] != 1){
					$this->makeHtml($toid);
					$chgarray[] = $toid;
				}
				$preid = 0;
				$nextid = 0;
				for($i = 1; $i <= $chaptercount; $i++){
					if($this->chapters[$i - 1]['chaptertype'] != 1){
						if($i < $fromid) $preid = $i;
						elseif($i > $fromid && $nextid == 0){
							$nextid = $i;
							$i = $chaptercount + 1;
						}
					}
				}
				if($preid > 0){
					if(!in_array($preid, $chgarray)){
						$this->makeHtml($preid);
						$chgarray[] = $preid;
					}
				}
				if($nextid > 0){
					if(!in_array($nextid, $chgarray)){
						$this->makeHtml($nextid);
						$chgarray[] = $nextid;
					}
				}
				$preid = 0;
				$nextid = 0;
				for($i = 1; $i <= $chaptercount; $i++){
					if($this->chapters[$i - 1]['chaptertype'] != 1){
						if($i < $toid) $preid = $i;
						elseif($i > $toid && $nextid == 0){
							$nextid = $i;
							$i = $chaptercount + 1;
						}
					}
				}
				if($preid > 0){
					if(!in_array($preid, $chgarray)){
						$this->makeHtml($preid);
						$chgarray[] = $preid;
					}
				}
				if($nextid > 0){
					if(!in_array($nextid, $chgarray)){
						$this->makeHtml($nextid);
						$chgarray[] = $nextid;
					}
				}
			}
			$this->makepack();
		}
	}

	// 删除
	function delete(){
		global $jieqiConfigs;
		global $jieqi_file_postfix;
		// jieqi_delfolder($this->getDir('txtdir', true, false));
		jieqi_delete_achapterc($this->id, -1);

		$deldir = $this->getDir('opfdir', true, false);
		if(is_dir($deldir)) jieqi_delfolder($deldir);
		if(is_dir('.' . $deldir)) jieqi_delfolder('.' . $deldir);

		if($jieqiConfigs['article']['makehtml']){
			$deldir = $this->getDir('htmldir', true, false);
			if(is_dir($deldir)) jieqi_delfolder($deldir);
			if(is_dir('.' . $deldir)) jieqi_delfolder('.' . $deldir);
		}
		if($jieqiConfigs['article']['makefull']){
			$delfile = $this->getDir('fulldir', false, false) . '/' . $this->id . $jieqiConfigs['article']['htmlfile'];
			if(is_file($delfile)) jieqi_delfile($delfile);
			if(is_file('.' . $delfile)) jieqi_delfile('.' . $delfile);
		}
		if($jieqiConfigs['article']['maketxtjs']) jieqi_delfolder($this->getDir('txtjsdir', true, false));
		if($jieqiConfigs['article']['makezip']) jieqi_delfile($this->getDir('zipdir', false, false) . '/' . $this->id . $jieqi_file_postfix['zip']);
		if($jieqiConfigs['article']['maketxtfull']) jieqi_delfile($this->getDir('txtfulldir', false, false) . '/' . $this->id . $jieqi_file_postfix['txt']);
		if($jieqiConfigs['article']['makeumd']) jieqi_delfolder($this->getDir('umddir', true, false));
		if($jieqiConfigs['article']['makejar']){
			jieqi_delfolder($this->getDir('jardir', true, false));
			jieqi_delfolder($this->getDir('jardir', true, false));
		}
		// 删除附件
		$attachdir = jieqi_uploadpath($jieqiConfigs['article']['attachdir'], 'article') . jieqi_getsubdir($this->id) . '/' . $this->id;
		if(is_dir($attachdir)) jieqi_delfolder($attachdir);
	}

	// 重新打包
	function repack(){
		if(!$this->isload) $this->loadOPF();
		$this->createOPF();
	}
}

function jieqi_socket_url($url){
	if(!function_exists('fsockopen')) return false;
	$method = "GET";
	$url_array = parse_url($url);
	$port = isset($url_array['port']) ? $url_array['port'] : 80;
	$fp = fsockopen($url_array['host'], $port, $errno, $errstr, 30);
	if(!$fp) return false;
	$getPath = $url_array['path'];
	if(!empty($url_array['query'])) $getPath .= "?" . $url_array['query'];
	$header = $method . " " . $getPath;
	$header .= " HTTP/1.1\r\n";
	$header .= "Host: " . $url_array['host'] . "\r\n"; // HTTP 1.1 Host域不能省略
	/*
	 * //以下头信息域可以省略 $header .= "User-Agent: Mozilla/5.0 (Windows; U; Windows NT
	 * 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13 \r\n"; $header
	 * .= "Accept:
	 * text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,q=0.5
	 * \r\n"; $header .= "Accept-Language: en-us,en;q=0.5 "; $header .=
	 * "Accept-Encoding: gzip,deflate\r\n";
	 */
	$header .= "Connection:Close\r\n\r\n";
	fwrite($fp, $header);
	if(!feof($fp)) fgets($fp, 8);
	// while(!feof($fp)) echo fgets($fp, 128);
	fclose($fp);
	return true;
}

// 保存章节内容 $chaptertype:0-章节 1-分卷，$isvip：0-免费 1-收费 2-登录阅读
function jieqi_save_achapterc($articleid, $chapterid, $content, $isvip = 0, $chaptertype = 0){
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	global $ocontent_handler;
	if($isvip == 0){
		if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
		$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;
		jieqi_checkdir($txtdir, true);
		return jieqi_writefile($txtdir . '/' . $chapterid . $jieqi_file_postfix['txt'], $content);
	}
	else{
		if(!is_a($ocontent_handler, 'JieqiOcontentHandler')){
			include_once($jieqiModules['obook']['path'] . '/class/ocontent.php');
			$ocontent_handler = &JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
		}
		$cobj = $ocontent_handler->create();
		$cobj->setVar('ochapterid', $chapterid);
		$cobj->setVar('ocontent', $content);
		return $ocontent_handler->insert($cobj);
	}
}

// 编辑章节内容 $chaptertype:0-章节 1-分卷，$isvip：0-免费 1-收费 2-登录阅读
function jieqi_edit_achapterc($articleid, $chapterid, $content, $isvip = 0, $chaptertype = 0){
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	global $ocontent_handler;
	if($isvip == 0){
		if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
		$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;
		jieqi_checkdir($txtdir, true);
		return jieqi_writefile($txtdir . '/' . $chapterid . $jieqi_file_postfix['txt'], $content);
	}
	else{
		if(!is_a($ocontent_handler, 'JieqiOcontentHandler')){
			include_once($jieqiModules['obook']['path'] . '/class/ocontent.php');
			$ocontent_handler = &JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
		}
		$cobj = $ocontent_handler->get($chapterid, 'ochapterid');
		if(is_object($cobj)){
			$cobj->setVar('ocontent', $content);
		}
		else{
			$cobj = $ocontent_handler->create();
			$cobj->setVar('ochapterid', $chapterid);
			$cobj->setVar('ocontent', $content);
		}
		return $ocontent_handler->insert($cobj);
	}
}

// 删除章节内容
function jieqi_delete_achapterc($articleid, $chapterid = 0, $isvip = 0, $chaptertype = 0){
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	global $query;
	global $ocontent_handler;
	$articleid = intval($articleid);
	$chapterid = intval($chapterid);
	if($chapterid < 0){
		//删除所有章节
		if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
		$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;
		@jieqi_delfolder($txtdir);
		//可能有vip的情况
		$sql = "SELECT * FROM " . jieqi_dbprefix('obook_ochapter') . " WHERE articleid = {$articleid} LIMIT 0, 1";
		$res = $query->execute($sql);
		$obook = $query->getRow($res);
		if(is_array($obook)){
			if($obook['sumemoney'] == 0 && $obook['sumegold'] == 0){
				$sql = "DELETE FROM " . jieqi_dbprefix('obook_obook') . " WHERE obookid = " . intval($obook['obookid']);
				$sql = "DELETE FROM " . jieqi_dbprefix('obook_ochapter') . " WHERE obookid = " . intval($obook['obookid']);
			}
			else{
				$sql = "SELECT ochapterid FROM " . jieqi_dbprefix('obook_ochapter') . " WHERE obookid = " . intval($obook['obookid']) . " AND sumegold = 0";
				$res = $query->execute($sql);
				$cids = array();
				while($row = $query->getRow($res)){
					$cids[] = intval($row['ochapterid']);
				}
				$delcnum = count($cids);
				if(!empty($cids)){
					$cidstr = implode(',', $cids);
					$sql = "DELETE FROM  " . jieqi_dbprefix('obook_ochapter') . " WHERE ochapterid IN (" . $cidstr . ")";
					$query->execute($sql);
					$sql = "DELETE FROM  " . jieqi_dbprefix('obook_ocontent') . " WHERE ochapterid IN (" . $cidstr . ")";
					$query->execute($sql);
				}
				$sql = "UPDATE  " . jieqi_dbprefix('obook_ochapter') . " SET display = 2 WHERE obookid = " . intval($obook['obookid']);
				$query->execute($sql);
				$sql = "UPDATE  " . jieqi_dbprefix('obook_obook') . " SET display = 2, chapters = chapters - " . $delcnum . " WHERE obookid = " . intval($obook['obookid']);
				$query->execute($sql);
			}
		}
		return true;
	}
	else{
		//删除一个章节
		if($isvip == 0){
			if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
			$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;
			return @jieqi_delfile($txtdir . '/' . $chapterid . $jieqi_file_postfix['txt']);
		}
		else{
			//如果未销售直接删除章节信息和章节内容，否则保留
			include_once($jieqiModules['obook']['path'] . '/class/ochapter.php');
			$ochapter_handler = &JieqiOchapterHandler::getInstance('JieqiOchapterHandler');
			$ochapter = $ochapter_handler->get($chapterid, 'chapterid');
			if(is_object($ochapter)){
				if(intval($ochapter->getVar('sumegold', 'n')) == 0){
					$ochapter_handler->delete($chapterid, 'chapterid');
					if(!is_a($ocontent_handler, 'JieqiOcontentHandler')){
						include_once($jieqiModules['obook']['path'] . '/class/ocontent.php');
						$ocontent_handler = &JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
					}
					return $ocontent_handler->delete($chapterid, 'ochapterid');
					$sql = "UPDATE  " . jieqi_dbprefix('obook_obook') . " SET chapters = chapters - 1 WHERE articleid = " . intval($articleid);
					$query->execute($sql);
				}
				else{
					$ochapter->setVar('display', '2');
					return $ochapter_handler->insert($ochapter);
				}
			}
			return true;
		}
	}
}

// 获取章节内容 (getformat 获取章节内容是文本还是阅读网址 txt-文本 url-网址)
function jieqi_get_achapterc($chapterinfo){
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $jieqi_file_postfix;
	global $ocontent_handler;

	if(!is_array($chapterinfo) || !isset($chapterinfo['articleid']) || !is_numeric($chapterinfo['articleid']) || !isset($chapterinfo['chapterid']) || !is_numeric($chapterinfo['chapterid'])) return false;
	if(!isset($chapterinfo['isvip'])) $chapterinfo['isvip'] = 0;
	if(!isset($chapterinfo['chaptertype'])) $chapterinfo['chaptertype'] = 0;
	if(!isset($chapterinfo['display'])) $chapterinfo['display'] = 0;
	if(!isset($chapterinfo['getformat'])) $chapterinfo['getformat'] = 'txt';

	if($chapterinfo['display'] != 0){
		jieqi_loadlang('article', JIEQI_MODULE_NAME);
		return $jieqiLang['article']['chapter_is_hide'];
	}
	if($chapterinfo['isvip'] == 0){
		if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
		$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($chapterinfo['articleid']) . '/' . $chapterinfo['articleid'];
		return jieqi_readfile($txtdir . '/' . $chapterinfo['chapterid'] . $jieqi_file_postfix['txt']);
	}
	else{
		if($chapterinfo['getformat'] == 'url'){
			$url = jieqi_geturl('article', 'chapter', $chapterinfo['chapterid'], $chapterinfo['articleid'], $chapterinfo['isvip'], $chapterinfo['articlecode']);
			if(strpos($url, JIEQI_LOCAL_URL) !== 0) $url = JIEQI_LOCAL_URL . $url;
			return $url;
		}
		else{
			if(!is_a($ocontent_handler, 'JieqiOcontentHandler')){
				include_once($jieqiModules['obook']['path'] . '/class/ocontent.php');
				$ocontent_handler = &JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
			}
			$content = $ocontent_handler->get($chapterinfo['chapterid'], 'ochapterid');
			if(is_object($content)) return $content->getVar('ocontent', 'n');
			else return '';
		}
	}
}

// 获取章节属性
function jieqi_info_achapterc($articleid, $chapterid, $isvip = 0, $chaptertype = 0){
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	if(!isset($jieqiConfigs['article'])) jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
	$txtdir = jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article') . jieqi_getsubdir($articleid) . '/' . $articleid;
	$txtfile = $txtdir . '/' . $chapterid . $jieqi_file_postfix['txt'];
	if(is_file($txtfile)){
		$ret = array();
		$ret['time'] = filemtime($txtfile);
		$ret['size'] = filesize($txtfile);
		// $ret['intro'] = htmlspecialchars(str_replace(array("\r","\n"),'
		// ',jieqi_substr(jieqi_readfile($txtfile), 0, 200, '...')),
		// ENT_QUOTES);
		return $ret;
	}
	else{
		return false;
	}
}

// 章节内容从vip转换成免费，或者从免费到vip。$action = free-vip到免费 vip-免费到vip
function jieqi_convert_achapterc($articleid, $chapterid, $action){
	switch($action){
		case 'free':
			$content = jieqi_get_achapterc(array('articleid' => $articleid, 'articlecode' => '', 'chapterid' => $chapterid, 'isvip' => 1, 'chaptertype' => 0, 'display' => 0, 'getformat' => 'txt'));
			return jieqi_save_achapterc($articleid, $chapterid, $content, 0);
			break;
		case 'vip':
			$content = jieqi_get_achapterc(array('articleid' => $articleid, 'articlecode' => '', 'chapterid' => $chapterid, 'isvip' => 0, 'chaptertype' => 0, 'display' => 0, 'getformat' => 'txt'));
			jieqi_delete_achapterc($articleid, $chapterid, 0);
			return jieqi_edit_achapterc($articleid, $chapterid, $content, 1);
			break;
		default:
			return false;
			break;
	}
}

?>