<?php
function column($input, $column_key, $index_key = null) {
	if (function_exists('array_column')) return array_column($input, $column_key, $index_key);
	if (!is_array($input)) return array();
	foreach ($input as $key => $val) {
		if (!is_null($index_key)) $key = isset($val[$index_key]) ? $val[$index_key] : null;
		if (!is_null($column_key)) $val = isset($val[$column_key]) ? $val[$column_key] : null;
		if (!is_null($key)) $output[$key] = $val; 
	}
	return $output;
}
function splitword($string, $minwords, $maxwords) {
	$wordnum = strlenPlus($string);
	if ($minwords > 0 && $wordnum <= $minwords) return false;
	if ($maxwords <= 0 || strlenPlus($string) <= $maxwords) return $string;
	preg_match_all('/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/', $string, $match);
	return array_map('implode', array_chunk($match[0], $maxwords));
}
function strlenPlus($string) {
	if(function_exists('iconv_strlen')) return iconv_strlen($string, 'gbk');
	if(function_exists('mb_strlen')) return mb_strlen($string, 'gbk');
	preg_match_all('/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/', $string, $match);
	return count($match[0]);
}
function replacePlus($find, $replace, $string) {
	$find = is_array($find) ? $find : array($find);
	$replace = is_array($replace) ? array_unshift($replace, false) : array_pad(array(false), count($find) + 1, $replace);
	$string = iconv('GBK', 'UTF-8//IGNORE', $string);
	foreach ($find as $row) {
		$key = iconv('GBK', 'UTF-8//IGNORE', $row);
		$val = iconv('GBK', 'UTF-8//IGNORE', next($replace));
		if (strpos($string, $key) === false) continue;
		$string = str_replace($key, $val, $string);
	}
	return iconv('UTF-8', 'GBK//IGNORE', $string);
}
function clearContent($string) {
	$string = str_replace("\t", ' ', $string);
	$string = str_replace("\r", "\n", $string);
	$string = replacePlus('\\', '', $string);
	$string = replacePlus('　', ' ', $string);
	$string = replacePlus('；', ";\r", $string);
	while(stripos($string, '&amp;') !== false) {
		$string = str_ireplace('&amp;', '&', $string);
	}
	$string = str_ireplace(array('&#38;', '&amp', 'amp;'), '&', $string);
	$string = preg_replace(array('/&(apos|#39);/i', '/&(quot|#34);/i', '/&(nbsp|#160);/i', '/&(lt|#60);/i', '/&(gt|#62);/i'), array("'", '"', ' ', '<', '>'), $string);
	$string = html_entity_decode($string, ENT_QUOTES, 'GB2312');
	$string = str_ireplace(array('&apos', 'apos;', 'apos', '&quot', 'quot;', 'quot', '&nbsp', 'nbsp;', 'nbsp', '&lt', 'lt;', '&gt', 'gt;'), array("'", "'", "'", '"', '"', '"', ' ', ' ', ' ', '<', '<', '>', '>'), $string);
	$string = preg_replace('/&#?[a-zA-Z0-9]+;/', '', $string);
	$string = str_replace(";\r", '；', $string);
	$string = str_replace("\r", '', $string);
	$string = preg_replace('/<br[\s\/]*>/i', "\n", $string);
	$string = preg_replace('/<\/?p>/i', "\n", $string);
	$string = preg_replace('/<!--.*?-->|<\?|\?>|<%|%>|<@|@>/', '', $string);
	$string = preg_replace('/<(script|style).*\/\1>/is', '', $string);
	$string = preg_replace('/<\/?(?:html|head|meta|link|base|basefont|body|bgsound|title|style|script|noscript|object|form|select|option|iframe|frame|frameset|applet|button|code|event|id|input|ilayer|layer|name|xml|userprofile|table|tbody|thead|tfoot|th|tr|td|i|b|u|strong|img|p|br|div|em|ul|ol|li|dl|dd|dt|a|font|span|embed|hr|blockquote|h1|h2|h3|h4|h5|h6|sub|sup|strike)[^><]*>/i', '', $string);
	$string = strip_tags($string);
	while(strpos($string, '  ')) {
		$string = str_replace('  ', ' ', $string);
	}
	$line = explode("\n", trim($string));
	$string = '';
	foreach($line as $row) {
		$row = trim($row);
		if(strlen($row) > 1) $string .= "\n$row";
	}
	return rtrim($string);
}
function readList($content) {
	global $jieqiConfigs;
	$list = array();
	$content = clearContent($content);
	$content = preg_replace('/\n(?:(?:VIP|最新|防采集|网友上传)\s*(?:卷|分卷|章节)|正文|作品相关)\s*/i', "\n", $content);
	$content = replacePlus($jieqiConfigs['article']['banwords'], '***', $content);
	if (preg_match_all('/\n.{0,20}(第(?:一|二|三|四|五|六|七|八|九|十|百|千|万|两|廿|卅|卌|零|〇|１|２|３|４|５|６|７|８|９|０|[0-9])+(?:章|节|回).{0,50})\n/', $content, $match, PREG_OFFSET_CAPTURE) || preg_match_all('/\n((?:d|第|弟|递|滴|低|地|底|帝|的)*(?:一|二|三|四|五|六|七|八|九|十|百|千|万|两|廿|卅|卌|零|〇|１|２|３|４|５|６|７|８|９|０|[0-9])+(?:部|卷|集|篇|册|章|节|回)*.{0,20})\n/', $content, $match, PREG_OFFSET_CAPTURE)) {
		if ($match[0][0][1] > 1000) {
			array_unshift($match[0], array('作品相关', -8));
			array_unshift($match[1], array('作品相关', -8));
		}
		$c = 0;
		foreach ($match[1] as $key => $val) {
			$start = $match[0][$key][1] + strlen($match[0][$key][0]);
			$end = isset($match[0][$key + 1]) ? $match[0][$key + 1][1] : strlen($content);
			$chapter = splitword(substr($content, $start, $end - $start), $jieqiConfigs['article']['minwords'], $jieqiConfigs['article']['maxwords']);
			if (is_array($chapter)) {
				foreach ($chapter as $k => $v) {
					$list[$c] = array('name' => trim($val[0])." (".($k+1).")", 'size' => strlen($v), 'content' => "    ".str_replace("\n", "\r\n\r\n    ", $v));
					$c++;
				}
			} else {
				if (empty($chapter)) continue;
				$list[$c] = array('name' => trim($val[0]), 'size' => $end - $start, 'content' => "    ".str_replace("\n", "\r\n\r\n    ", $chapter));
				$c++;
			}
		}
	} else {
		$chapter = splitword($content, 0, $jieqiConfigs['article']['splitwords']);
		if (!empty($chapter)) {
			$chapter = is_array($chapter) ? $chapter : array($chapter);
			foreach ($chapter as $key => $val) {
				$list[] = array('name' => "第 ".($key+1)." 章节", 'size' => strlen($val), 'content' => "    ".str_replace("\n", "\r\n\r\n    ", $val));
			}
		}
	}
	return $list;
}
?>