<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/29
 * Time: 下午2:16
 *
 * 通用函数
 *
 */

include_once '../../../global.php';
include_once 'appConfigs.php';
include_once 'applePayConf.php.php';

/**
 * 打印变量，调试函数
 *
 * @param $inputVar     变量
 * @param $inputVarName 变量名
 */
function print_var($inputVar,$inputVarName = '$inputVar')
{
	echo '<br><br>' . $inputVarName . ' = ';
	
	var_dump($inputVar);
	
	echo '<br><br>';
}

/**
 * 将数据转化为json
 *
 * @param  $var
 * @return string
 * @throws Exception
 */
function json_encode_ex($var)
{
	if ($var === null)
	{
		return 'null';
	}
	
	if ($var === true)
	{
		return 'true';
	}
	
	if ($var === false)
	{
		return 'false';
	}
	
	static $reps = array
	(
		array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"', ),
		array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"', ),
	);
	
	if (is_scalar($var))
	{
		return '"' . str_replace($reps[0], $reps[1], (string) $var) . '"';
	}
	
	if (!is_array($var))
	{
		throw new Exception('JSON encoder error!');
	}
	
	$isMap = false;
	$i     = 0;
	
	foreach (array_keys($var) as $k)
	{
		if (!is_int($k) || $i++ != $k)
		{
			$isMap = true;
			
			break;
		}
	}
	
	$s = array();
	
	if ($isMap)
	{
		foreach ($var as $k => $v)
		{
			$s[] = '"' . $k . '":' . call_user_func(__FUNCTION__, $v);
		}
		
		return '{' . implode(',', $s) . '}';
	}
	else
	{
		foreach ($var as $v)
		{
			$s[] = call_user_func(__FUNCTION__, $v);
		}
		
		return '[' . implode(',', $s) . ']';
	}
}

/**
 * 获取书籍的文章信息，不包含打赏信息
 *
 * @param $tmpBook       数据库中的article
 * @param $jieqiConfigs  网站中的配置文件
 * @return mixed         返回值
 */
function getArticleTextInfo($tmpBook,$jieqiConfigs = NULL)
{
	if($jieqiConfigs == NULL)
	{
		global $jieqiConfigs;
		
		jieqi_getconfigs('article','configs','jieqiConfigs');
	}
	
	$book = array();
	
	$book['articleid']     = isset($tmpBook['articleid']) ? $tmpBook['articleid'] : -1;//书ID
	
	$book['articlename']   = iconv('GBK','UTF-8',$tmpBook['articlename']);//书名
	
	$book['articlename']   = filterStr($book['articlename']);//书名
	
	$book['lastchapterid'] = isset($tmpBook['lastchapterid']) ? $tmpBook['lastchapterid'] : 1;//最新章节id
	
	$book['lastchapter']   = isset($tmpBook['lastchapter']) ? iconv('GBK','UTF-8',$tmpBook['lastchapter']) : '';//最新章节名称
	
	$book['lastchapter']   = filterStr($book['lastchapter']);//最新章节名称
	
	$book['lastsummary']   = !empty($tmpBook['lastsummary']) ? iconv('GBK','UTF-8',$tmpBook['lastsummary']) : '暂无最新章节简介';//最新章节简介
	
	$book['lastsummary']   = filterStr($book['lastsummary']);//最新章节简介
	
	$book['lastupdate']    = date('Y-m-d',trim($tmpBook['lastupdate']));//最新章节更新时间
	
	$book['authorid']      = isset($tmpBook['authorid']) ? $tmpBook['authorid'] : -1;//作者ID
	
	$book['authorid']      = isset($tmpBook['authorid']) ? $tmpBook['authorid'] : -1;//作者ID
	
	$book['author']        = iconv('GBK','UTF-8',$tmpBook['author']);//作者
	
	$book['author']        = filterStr($book['author']);//作者
	
	$book['intro']         = $tmpBook['intro'] ? iconv('GBK','UTF-8',$tmpBook['intro']) : '暂无简介';//简介
	
	$book['intro']         = filterStr($book['intro']);//简介
	
	$book['chaptersum']    = $tmpBook['chapters'] ? $tmpBook['chapters'] : 0;//简介
	
	//获取封面地址
	$tmpImgPath            = '/' . floor($book['articleid'] / 1000) . '/' . $book['articleid'] . '/' . $book['articleid'] . "s" . $jieqiConfigs['article']['imagetype'];
	
	$imgURL                = getImgURL($jieqiConfigs,$tmpImgPath);
	
	$book['coverURL']      = $imgURL;//封面路径
	
	$book['fullflag']      = $tmpBook['fullflag'] ? $tmpBook['fullflag'] : 0;//小说状态
	
	$book['wordsum']       = numnToThousands($tmpBook['size'] );
	
	$book['saleprice']     = $tmpBook['saleprice'] == 0 ? 5 : $tmpBook['saleprice'];//价格
	
	//道具
	$book['redrose']       = $tmpBook['redrose'] ? $tmpBook['redrose'] : 0;//红包总数
	
	$book['yellowrose']    = $tmpBook['yellowrose'] ? $tmpBook['yellowrose'] : 0;//美酒总数
	
	$book['bluerose']      = $tmpBook['bluerose'] ? $tmpBook['bluerose'] : 0;//香囊总数
	
	$book['whiterose']     = $tmpBook['whiterose'] ? $tmpBook['whiterose'] : 0;//钻石总数
	
	$book['blackrose']     = $tmpBook['blackrose'] ? $tmpBook['blackrose'] : 0;//超跑总数
	
	$book['greenrose']     = $tmpBook['greenrose'] ? $tmpBook['greenrose'] : 0;//皇冠总数
	
	$book['flower']        = $tmpBook['allflower'] ? $tmpBook['allflower'] : 0;//鲜花总数
	
	$book['propssum']      = $book['redrose'] + $book['yellowrose'] + $book['bluerose'] + $book['whiterose'] + $book['blackrose'] + $book['greenrose'] + $book['flower'];//道具总数
	
	$book['articlefrom']   = $tmpBook['thirdsourceid'];
	
	return $book;
}

/**
 * 获取第三方书籍来源名称
 * @param $sourceID
 * @return mixed
 */
function getThirdSourceName($sourceID)
{
	$shuMengQuery = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$shuMengSql   = 'SELECT * FROM ' . jieqi_dbprefix('shumeng_channels'). " WHERE 	id = " . $sourceID;
	
	$shuMengQuery->execute($shuMengSql);
	
	$result = jieqi_query_rowvars($shuMengQuery->getRow());
	
	if($result)
	{
		$name = iconv('GBK','UTF-8',$result['channelname']);
	}
	
	return $name;
}

/**
 *
 * 获取$articleArray中书籍的打赏记录
 *
 * @param $articleArray
 * @return array
 */
function getArticleObookInfo($articleArray)
{
	$obookRecordArray = array();
	
	//获取小说的打赏记录
	$obookQuery = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	foreach($articleArray as $item)
	{
		$obookSql = 'SELECT * FROM ' . jieqi_dbprefix('obook_obook'). " WHERE articleid = " . $item;
		
		$obookQuery->execute($obookSql);
		
		$obookRecordArray[$item] = jieqi_query_rowvars($obookQuery->getRow());
	}
	
	return $obookRecordArray;
}

/**
 * 根据$bookArray和$obookRecordArray返回要显示的书籍列表
 *
 * @param $bookArray   书籍信息列表，不包含书籍打赏信息
 * @param $obookRecordArray  书籍打赏信息列表
 * @return array
 */
function getArticleInfo(&$bookArray,$obookRecordArray)
{
	$articleList = array();
	
	foreach($bookArray as $key => $value)
	{
		$tmpBook = $value;
		
		$tmpBook['tipsum']     = $obookRecordArray[$key]['sumtip'] + $obookRecordArray[$key]['sumegold'] ? $obookRecordArray[$key]['sumtip'] + $obookRecordArray[$key]['sumegold'] : 0;//打赏小说币总数
		
		$tmpBook['hurrysum']   = $obookRecordArray[$key]['sumhurry'] ? $obookRecordArray[$key]['sumhurry'] : 0;//催更小说币总数
		
		$articleList[] = $tmpBook;
	}
	
	return $articleList;
}

/**
 * 根据$inputImgPath判断是否存在图片，存在返回图片的实际地址，不存在怎用默认封面；
 *
 * @param $jieqiConfigs
 * @param $inputImgPath
 * @return string
 */
function getImgURL($jieqiConfigs,$inputImgPath)
{
	$imgPath = '';
	
	$temp = $jieqiConfigs['article']['imagedir'] . $inputImgPath;
	
	if(file_exists($jieqiConfigs['article']['imagedir'] . $inputImgPath))
	{
		$imgPath = $jieqiConfigs['article']['imageurl'] . $inputImgPath;
	}
	else
	{
		$imgPath = DEFAULT_ARTICLE_COVER;
	}
	
	return $imgPath;
}

/**
 *
 * 根据$sortID获取分类的第一本书
 *
 * @param $sortID
 * @param null $jieqiConfigs
 * @return array
 */
function getFirstBookFormSort($sortID,$jieqiConfigs = NULL)
{
	$article = array();
	
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " WHERE sortid = " . $sortID . "  AND display = 0" . " ORDER BY " . SORT_ORDER_BY . " LIMIT 1";
	
	$query->execute($sql);
	
	$tmpArticle = jieqi_query_rowvars($query->getRow());
	
	if($jieqiConfigs == NULL)
	{
		global $jieqiConfigs;
		
		jieqi_getconfigs('article','configs','jieqiConfigs');
	}
	
	$tmpImgPath = '/' . floor($tmpArticle['articleid'] / 1000) . '/' . $tmpArticle['articleid'] . '/' . $tmpArticle['articleid'] . "s" . $jieqiConfigs['article']['imagetype'];
	
	$article['articleid'] = $tmpArticle['articleid'] ? $tmpArticle['articleid'] : -1;
	
	$article['coverURL']  = getImgURL($jieqiConfigs,$tmpImgPath);
	
	return $article;
}

/**
 *
 * 获取书籍列表
 *
 * @param $query
 * @param $sql
 *
 * @return array 书籍列表
 */
function getArticleList(&$query,$sql)
{
	$result = $query->execute($sql);
	
	if($result)
	{
		$tmpArticleList  = array();
		
		$articleIDArray = array();//存储articleID，用来查找打上记录
		
		while ($row = $query->getRow())
		{
			$tmpBook = getArticleTextInfo(jieqi_query_rowvars($row));

			$tmpArticleList[$tmpBook['articleid']] = $tmpBook;

			$articleIDArray[] = $tmpBook['articleid'];
		}
		
		foreach($tmpArticleList as $key => $value)
		{
			$tmpArticleList[$key]['articlefrom'] = getThirdSourceName($value['articlefrom']);
		}
		
		$obookRecordArray = getArticleObookInfo($articleIDArray);
		
		$articleList = getArticleInfo($tmpArticleList,$obookRecordArray);
	}
	else
	{
		$articleList = -1;
	}
	
	return $articleList;
}

/**
 * 根据articleID数组来获得小说列表
 *
 * @param $articleIDArray
 * @return array|int
 */
function getArticleListFromIDArray($articleIDArray)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$message = '';
	
	foreach($articleIDArray as $item)
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " WHERE articleid = " . $item;
		
		$result = $query->execute($sql);
		
		if($result)
		{
			$book = jieqi_query_rowvars($query->getRow());
			
			if($book)
			{
				$tmpArticle = getArticleTextInfo($book);
			
				$tmpArticleList[$tmpArticle['articleid']] = $tmpArticle;
			}
		}
		else
		{
			$message = '获取小说列表失败';
		}
	}
	
	$obookRecordArray = getArticleObookInfo($articleIDArray);
	
	$articleList = getArticleInfo($tmpArticleList,$obookRecordArray);
	
	foreach($articleList as $key => $value)
	{
		$articleList[$key]['articlefrom'] = getThirdSourceName($value['articlefrom']);
	}
	
	if(!$message)
	{
		return $articleList;
	}
	else
	{
		return -1;
	}
}

/**
 *
 * 根据频道来获取该频道的轮播图
 *
 * @param $channelID
 * @return array|int
 */
function getSlideBannerArticleList($channelID)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$articleList = array();
	
	$errorMessage = '';
	
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_slidebanner') . " WHERE channel = " . $channelID;
	
	$res = $query->execute($sql);
	
	if($res)
	{
		$dbData          = jieqi_query_rowvars($query->getRow());
		
		$booksID         = explode('|',$dbData['booksID']);
		
		$tmpBannerCover  = explode('|',$dbData['booksCover']);
		
		$bannerCoverList = array();
		
		if(count($booksID) == count($tmpBannerCover))
		{
			for($i = 0;$i < count($booksID); $i++)
			{
				$bannerCoverList[$booksID[$i]] = $tmpBannerCover[$i];
			}
		}
		else
		{
			$errorMessage = '获取列表失败';
		}
		
		$articleList = getArticleListFromIDArray($booksID);
		
		foreach($articleList as $key => $value)
		{
			$articleList[$key]['slideBannerCover'] = $bannerCoverList[$value['articleid']];
		}
	}
	else
	{
		$errorMessage = '获取列表失败';
	}
	
	if(!$errorMessage)
	{
		return $articleList;
	}
	else
	{
		return -1;
	}
}

/**
 * 获取用户IP
 * @return string
 */
function getIP()
{
	if (isset ( $_SERVER ))
	{
		if (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] ))
		{
			$realip = $_SERVER ['HTTP_X_FORWARDED_FOR'];
		}
		elseif (isset ( $_SERVER ['HTTP_CLIENT_IP'] ))
		{
			$realip = $_SERVER ['HTTP_CLIENT_IP'];
		}
		else
		{
			$realip = $_SERVER ['REMOTE_ADDR'];
		}
	}
	else
	{
		if (getenv ( "HTTP_X_FORWARDED_FOR" ))
		{
			$realip = getenv ( "HTTP_X_FORWARDED_FOR" );
		}
		elseif (getenv ( "HTTP_CLIENT_IP" ))
		{
			$realip = getenv ( "HTTP_CLIENT_IP" );
		}
		else
		{
			$realip = getenv ( "REMOTE_ADDR" );
		}
	}
	
	if (strpos ( $realip, "," ) === false)
	{
	}
	else
	{
		$realip1 = explode ( ",", $realip );
		$realip = $realip1 [0];
	}
	
	return $realip;
}

/**
 *
 * 确认用户是否登录
 *
 * @param $userID
 * @param string $userName
 * @return int 1：成功；-1：查询失败；-2：没有该用户
 */
function checkLogin($userID , $userName = '')
{
	if(!$userID)
	{
		$result = -2;//没有该用户
	}
	
	jieqi_includedb();
	
	$query  = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$result = 0;
	
	if($userName == '')
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). " WHERE uid = '" . $userID . "'";
		
		$status = $query->execute($sql);
		
		if($status)
		{
			$userResult = jieqi_query_rowvars($query->getRow());
			
			if(!empty($userResult))
			{
				$userInfo['uid']        = $userResult['uid'] ;//用户名id
				
				$userInfo['uname']      = iconv("GBK","UTF-8",$userResult['uname']);//用户名
				
				$userInfo['name']       = iconv("GBK","UTF-8",$userResult['name']);//用户昵称
				
				$userInfo['phone']      = iconv("GBK","UTF-8",$userResult['mobile']);
				
				$userInfo['sex']        = $userResult['sex'];
				
				$userInfo['sign']       = iconv("GBK","UTF-8",$userResult['sign']);//签名
				
				$userInfo['email']      = $userResult['email'];//邮箱
				
				$userInfo['score']      = $userResult['score'];//积分
				
				$userInfo['egold']      = $userResult['egold'];//金币
				
				$userInfo['isvip']      = $userResult['isvip'];//是否是vip
				
				$userInfo['experience'] = $userResult['experience'];//经验值
				;//经验值
				
				$result = $userInfo;//确认成功
			}
			else
			{
				$result = -2;//没有该用户
			}
		}
		else
		{
			$result = -1;//查询失败
		}
	}
	else
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). " WHERE uid = '" . $userID . "' AND uname = '" . $userName . "'";
		
		$status = $query->execute($sql);
		
		if($status)
		{
			$userResult = jieqi_query_rowvars($query->getRow());
			
			if($userResult)
			{
				$userInfo['uid']        = $userResult['uid'] ;//用户名id
				
				$userInfo['uname']      = iconv("GBK","UTF-8",$userResult['uname']);//用户名
				
				$userInfo['name']       = iconv("GBK","UTF-8",$userResult['name']);//用户昵称
				
				$userInfo['sign']       = iconv("GBK","UTF-8",$userResult['sign']);//签名
				
				$userInfo['mobile']     = $userResult['mobile'];
				
				$userInfo['faceImg']    = $userResult['faceImg'];//经验值
				
				$userInfo['sex']        = $userResult['sex'];
				
				$userInfo['email']      = $userResult['email'];//邮箱
				
				$userInfo['score']      = $userResult['score'];//积分
				
				$userInfo['egold']      = $userResult['egold'];//金币
				
				$userInfo['isvip']      = $userResult['isvip'];//是否是vip
				
				$userInfo['experience'] = $userResult['experience'];//经验值
				
				$result = $userInfo;//确认成功
			}
			else
			{
				$result = -2;//没有该用户
			}
		}
		else
		{
			$result = -1;//查询失败
		}
	}
	
	return $result;
}

/**
 *
 * 根据$bookCaseIDList和$articleList，在$articleList中添加bookcaseid字段
 *
 * @param $bookCaseIDList
 * @param $articleList
 * @return mixed
 */
function addBookCaseIDInArticleList($bookCaseIDList,$articleList)
{
	foreach($bookCaseIDList as $key => $value)
	{
		foreach($articleList as $articleKey => $articleValue)
		{
			if($articleValue['articleid'] == $value)
			{
				$articleList[$articleKey]['bookcaseid'] = $key;
			}
		}
	}
	
	return $articleList;
}

/**
 *
 * 查询书架中是否包含该小说
 *
 * @param $articleID
 * @return int：
 * -2 ： 查询失败，不能添加到书架；
 * -1 ： 请先登录
 * 0  ： 存在该书，不要重复添加
 * 1  ：可以添加
 *
 */
function checkAticleInBookCase($articleID)
{
	if(!isset($_COOKIE['user_id']) && !isset($_COOKIE['user_name']))
	{
		return -1;//请先登录
	}
	
	$userID   = $_COOKIE['user_id'];
	
	$userName = $_COOKIE['user_name'];
	
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql = 'SELECT COUNT(*) FROM ' . jieqi_dbprefix('article_bookcase') . " WHERE userid = '" . $userID . "' AND username = '" . $userName . "' AND  articleid = '" . $articleID ."'";
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$bookCase = jieqi_query_rowvars($query->getRow());
		
		if($bookCase['COUNT(*)'] == 0)
		{
			return 1;//可以添加
		}
		else
		{
			return 0;//存在该书，不要重复添加
		}
	}
	else
	{
		return -2;//查询失败，不能添加到书架
	}
}

/**
 *
 * 发送消息
 *
 * @param $content   消息内容
 * @param $articleID 接受消息的小说id
 * @param $fromID    发送消息的用户id
 * @param $fromName  发送消息的用户名
 */
function sendMessage($content,$articleID,$fromID,$fromName)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$time = time();
	
	$ip   = getIp();
	
	$size = strlen($content);
	
	$tmpLastInfo['time']  = $time;
	
	$tmpLastInfo['uid']   = $fromID;
	
	$tmpLastInfo['uname'] = $fromName;
	
	$lastInfo = serialize($tmpLastInfo);
	
	//先插入jieqi_article_reviews
	$sql = 'INSERT INTO `' . jieqi_dbprefix('article_reviews'). "` (`ownerid`,`title`,`posterid`,`poster`,`posttime`,`replier`,`replytime`,`lastinfo`) VALUES ('" . $articleID . "', '" . $content . "', '" . $fromID . "', '" . $fromName . "', '" . $time . "', '" . $fromName . "', '" . $time . "', '" . $lastInfo . "')";
	
	$result = $query->execute($sql);
	
	$topicid = mysql_insert_id();//用户名id
	
	if($result)
	{
		$isTopic = 1;
		
		$sql = 'INSERT INTO `' . jieqi_dbprefix('article_replies'). "` (`topicid`,`istopic`,`posterid`,`poster`,`posterip`,`ownerid`,`posttime`,`edittime`,`subject`,`posttext`,`size`) VALUES ('" . $topicid . "', '" . $isTopic . "', '" . $fromID . "', '" . $fromName . "', '" . $ip . "', '" . $articleID . "', '" . $time . "', '" . $time . "', '" . $content . "', '" . $content . "', '" . $size . "')";
		
		$result = $query->execute($sql);
		
		if(!$result)
		{
			$result = 1;
		}
		else
		{
			$result = -1;
		}
	}
	else
	{
		$result = -2;
	}
	
	return $result;
}

/**
 *
 * 根据用户名查找用户信息，与邮箱进行匹配
 * 匹配正确，则返回用户信息，
 * 不正确返回-1
 *
 * @param $userName   用户名
 * @return array|int
 */
function checkUserInfoWithUserName($userName,$email)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql   = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). " WHERE uname = '" . $userName . "'";
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$uerInfo = jieqi_query_rowvars($query->getRow());
		
		if($email == $uerInfo['email'])
		{
			return $uerInfo;
		}
		else
		{
			return -2;
		}
	}
	else
	{
		return -1;
	}
}

/**
 *
 * 获取数据库中的邮件配置
 *
 * @return array|int
 */
function getTmailConf()
{
	//获取发送邮件的配置
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_configs') . " WHERE cname LIKE '%mail%'";
	
	$res = $query->execute($sql);
	
	$tmpEmailConf = array();
	
	if($res)
	{
		while ($row = $query->getRow())
		{
			$tmp = jieqi_query_rowvars($row);
			
			$tmpEmailConf[$tmp['cname']] = $tmp['cvalue'];
		}
	}
	else
	{
		return -1;
	}
	
	$conf = array();
	
	$conf['host'] = $tmpEmailConf['mailserver'];//smtp服务器
	
	$conf['port'] = $tmpEmailConf['mailport'];//端口
	
	$conf['user'] = $tmpEmailConf['mailuser'];//发件人
	
	$conf['pwd']  = $tmpEmailConf['mailpassword'];//发件人密码
	
	$conf['auth'] = $tmpEmailConf['mailauth'] == '1' ? true :false;//验证
	
	$conf['from'] = $tmpEmailConf['mailfrom'];//发件人
	
	$conf['body'] = file_get_contents('emailBody.txt',true);
	
	$conf['type'] = 'text/html';
	
	return $conf;
}

/**
 * 对密码进行加密
 *
 * @param $pass
 * @return string
 */
function encryptPassword($pass)
{
	return md5($pass);
}

/**
 *
 * 根据索引，获得头像的地址
 *
 * @param $index
 * @return string
 */
function getFaceImgUrl($index)
{
	$imgUrl = DEFAULT_FACE_IMG_URL . '0' . $index . ".png";
	
	return $imgUrl;
}

/**
 *
 * 根据索引，获得性别名称
 *
 * @param $sexIndex
 * @return string
 */
function getSexName($sexIndex)
{
	$sexName = '保密';
	
	switch ($sexIndex)
	{
		case '0':
		{
			$sexName = '保密';
			
			break;
		}
		case '1':
		{
			$sexName = '男';
			
			break;
		}
		case '2':
		{
			$sexName = '女';
			
			break;
		}
	}
	
	return $sexName;
}

/**
 * 查询时间间隔，大于120秒，允许提交评论
 *
 * @param $nowTime
 * @param $posterID
 * @return int
 */
function queryReplyInterval($query,$nowTime,$posterID)
{
	$sql   = 'SELECT * FROM ' . jieqi_dbprefix('article_reviews'). " WHERE posterid = '" . $posterID . "' ORDER BY `posttime` DESC LIMIT 1" ;
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$info = jieqi_query_rowvars($row = $query->getRow());
		
		$replyTimeInterval = $nowTime - $info['posttime'];
		
		if($replyTimeInterval > 120)
		{
			$result = 1;
		}
		else
		{
			$result = -1;
		}
	}
	else
	{
		$result = -2;
	}
	
	return $result;
}

/**
 * 查询时间间隔函数备份，含有$articleID
 *
 * 查询时间间隔，大于120秒，允许提交评论
 *
 * @param $articleID
 * @param $nowTime
 * @param $posterID
 * @return int
 */
function backUP_ueryReplyInterval($query,$articleID,$nowTime,$posterID)
{
	$sql   = 'SELECT * FROM ' . jieqi_dbprefix('article_reviews'). " WHERE ownerid = '" . $articleID ."' AND posterid = '" . $posterID . "' ORDER BY `posttime` DESC" ;
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$info = jieqi_query_rowvars($row = $query->getRow());
		
		$replyTimeInterval = $nowTime - $info['posttime'];
		
		if($replyTimeInterval > 120)
		{
			$result = 1;
		}
		else
		{
			$result = -1;
		}
	}
	else
	{
		$result = -2;
	}

	return $result;
}

/**
 * 过滤字符串
 *
 * @param $inputStr
 * @return mixed
 */
function filterStr($inputStr)
{
	$inputStr = trim($inputStr);
	
	$result   = str_replace("\n",'',$inputStr);
	
	$result   = str_replace("\r",'',$result);
	
	$result   = str_replace("&nbsp;",' ',$result);
	
	$result   = str_replace("<br />",'',$result);
	
	$result   = str_replace("&quot;",'""',$result);
	
	return $result;
}

/**
 * 根据用户id，获取用户头像
 *
 * @param $userID  用户id
 * @return string  用户头像地址
 */
function getUserFaceImg($userID)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql   = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). " WHERE uid = '" . $userID . "'";
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$info   = jieqi_query_rowvars($row = $query->getRow());
		
		$result = $info['faceImg'] ? $info['faceImg'] : DEFAULT_FACE_IMG;
	}
	else
	{
		$result = DEFAULT_FACE_IMG;
	}
	
	return $result;
}

/**
 * 计算待购买VIP章节的价格
 *
 * @param $id           0：购买当前章；1：购买30章；2：购买100章；3：购买200章
 * @param $num          购买数量
 * @param $chapterList  vip章节list
 */
function computeVipChapterPrice($id,$num,$chapterList,$userOChapterList)
{
	$realBuyNum = $num;//实际购买数量
	
	//如果购买数量小于待购买VIP章节的数量
	if($num <= count($chapterList))
	{
		$realBuyNum = $num;
	}
	else//如果购买数量大于待购买VIP章节的数量
	{
		if($id == 3)
		{
			if(count($chapterList) == 1)
			{
				$result['show']     = 0;
				
				$result['buynum']   = $num;
				
				$result['price']    = 0;
				
				$result['authorid'] = 0;
				
				return $result;
			}
			else
			{
				$realBuyNum = count($chapterList);
			}
		}
		else
		{
			$result['show']     = 0;
			
			$result['buynum']   = $num;
			
			$result['price']    = 0;
			
			$result['authorid'] = 0;
			
			return $result;
		}
	}
	
	$totalPrice = 0;
	
	for($i = 0; $i < $realBuyNum; $i++)
	{
		if(!$userOChapterList[$chapterList[$i]['chapterid']])
		{
			$totalPrice += intval($chapterList[$i]['saleprice']);
			
			$buyList[$chapterList[$i]['chapterid']]  = $chapterList[$i]['chapter'];
			
			$chapterSaleList[$chapterList[$i]['chapterid']]  = $chapterList[$i]['saleprice'];
		}
	}
	
	$result['show']                = 1;
	 
	$result['buynum']              = $realBuyNum;
	
	$result['totalprice']          = $totalPrice;
	
	$result['authorid']            = $chapterList[0]['authorid'];
	
	$result['buychapterlist']      = $buyList ? $buyList : array_map();
	
	$result['buychapterpricelist'] = $chapterSaleList ? $chapterSaleList : array_map();
	
	
	return $result;
}

/**
 * 根据vip章节id获取章节内容
 *
 * @param $oChapterID  vip章节id
 * @return int|string  成功则返回内容；否则返回-1
 */
function getVipChapterContent($oChapterID)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql   = 'SELECT * FROM ' . jieqi_dbprefix('obook_ocontent'). " WHERE ochapterid = '" . $oChapterID . "'";
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$oChapter          = jieqi_query_rowvars($row = $query->getRow());
		
		$content           = trim(iconv('GBK','UTF-8',$oChapter['ocontent']));
		
		$content           = str_replace("<br />","\r\n",$content);
		
		$content           = str_replace("&nbsp;",' ',$content);
		
		$size              = mb_strlen($content,'UTF-8');
		
		$result['content'] = $content;
		
		$result['size']    = $size;
	}
	else
	{
		$result = -1;
	}
	
	return $result;
}

/**
 * 查看用户购买该书的章节信息
 *
 * @param $articleID  小说id
 * @return int|array  章节id => 章节价格
 */
function getUserOChapter($articleID)
{
	//获取用户信息
	$userID   = $_COOKIE['user_id'];
	
	jieqi_includedb();
	
	$query    = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql      = 'SELECT * FROM ' . jieqi_dbprefix('obook_obuyinfo'). " WHERE articleid = '" . $articleID . "' AND userid = '" . $userID . "' ORDER BY `ochapterid` ASC";
	
	$status   = $query->execute($sql);
	
	if($status)
	{
		while ($row = $query->getRow())
		{
			$tmp = jieqi_query_rowvars($row);
			
			$tmpOchapterList[$tmp['ochapterid']] = $tmp['buyprice'];
		}
		
		$result = $tmpOchapterList;
	}
	else
	{
		$result = -1;
	}
	
	return $result;
}

/**
 * 根据用户该书待支付章节和用户已买章节，计算用户已经购买章节的价格
 * 并且修改待支付的$oChapterPriceList和$oChapterList
 *
 * @param $userOChapterList    用户已购买的章节
 * @param $oChapterPriceList   待支付章节价格列表
 * @param $oChapterList        待支付章节列表
 * @return int
 */
function computerUserPurchasedPrice($userOChapterList,&$oChapterPriceList,&$oChapterList)
{
	$purchasedPrice = 0;
	
	foreach($userOChapterList as $key => $value)
	{
		if(!empty($oChapterPriceList[$key]))
		{
			$purchasedPrice += $oChapterPriceList[$key];
			
			unset($oChapterPriceList[$key]);
			
			unset($oChapterList[$key]);
		}
	}
	
	return $purchasedPrice;
}


function cacheFile($inputArray,$inputArrayName,$fileName)
{
	$newLine      = "\r\n";
	
	$startContent = "<?php " . $newLine . $newLine;
	
	$midContent   = '';
	
	$endContent   = "?>";
	
	$fileType     = ".php";
	
	foreach($inputArray as $key => $value)
	{
		$midContent .= $inputArrayName . '[\'' . $key . '\'] = ' . var_export($value,true) . ";\r\n\r\n";
	}
	
	$content  = $startContent . $midContent . $endContent;
	
	$uersID   = $_COOKIE['user_id'];
	
	$filePath = CACHE_FILE_PATH . $uersID . $fileName . $fileType;
	
	file_put_contents($filePath,$content);
}

/**
 * 将数字装换为万
 *
 * @param $num
 * @return float|int|string
 */
function numnToThousands($num)
{
	//将字数转化为万
	$integer = ($num / 2) / 10000;//整数
	
	if($integer >= 1.0)
	{
		$decimal = ($num / 2) % 10000;//小数
		
		$result  = number_format(floatval($integer . '.' . $decimal),2) . '万';//小说字数
	}
	else
	{
		$result  = ceil($num / 2);//小说字数
	}
	
	return $result;
}

/**
 * 根据$articleID和$chapterID，获取用户的免费章节
 *
 * @param $articleID
 * @param $chapterID
 * @return string
 */
function getArticleFreeContent($articleID,$chapterID)
{
	$content = '';
	
	global $jieqiConfigs;
	
	jieqi_getconfigs('article','configs','jieqiConfigs');
	
	//获取内容路径
	$filePath = $jieqiConfigs['article']['txtdir'] . '/' . floor($articleID / 1000) . '/' . $articleID . '/' . $chapterID . ".txt";
	
	if(file_exists($filePath))
	{
		$content = file_get_contents($filePath);
		
		$encode  = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5','UTF-16','UTF-32'));
		
		if($encode != 'UTF-8')
		{
			$content = iconv($encode,'UTF-8',$content);
		}
		
		$size = mb_strlen($content,'UTF-8');
		
		$result['content'] = $content;
		
		$result['size']    = $size;
	}
	else
	{
		jieqi_includedb();
		
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
		
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('obook_ocontent'). "  WHERE ochapterid = '" . $chapterID . "'";
		
		$flag = $query->execute($sql);
		
		if($flag)
		{
			$tmp               = jieqi_query_rowvars($query->getRow());
			
			$content           = $tmp['ocontent'];
			
			$content           = iconv('GBK','UTF-8',$content);
			
			$result['content'] = filterStr($content);
			
			$size              = strlen($result['content']);
			
			$result['size']    = $size;
		}
	}
		
	return $result;
}

/**
 * 确认短信验证
 *
 * @param $phoneNum  手机号
 */
function checkVerfiCode($phoneNum,$code)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_verifycode'). "  WHERE phone = '" . $phoneNum . "' AND verifyCode = '" . $code . "'";
	
	$result = $query->execute($sql);
	
	if($result)
	{
		$tmp      = jieqi_query_rowvars($query->getRow());
		
		$time     = time();
		
		$sendTime = trim($tmp['sendTime']);
		
		if($time - $sendTime > 120)
		{
			$status = -1;
		}
		else//验证成功
		{
			$status = 1;
		}
		
		$sql = 'DELETE FROM ' . jieqi_dbprefix('app_verifycode'). " WHERE phone = '" . $phoneNum . "'";
			
		$query->execute($sql);
		
	}
	else
	{
		$status = -2;
	}
	
	return $status;
}


//生成随机字符串

/*
 * 生成随机字符串
 *
 * burn添加，2016-12-22
 *
 * 微信支付
 */
function weixinPayGetRandChar($length)
{
	$str    = null;
	$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
	$max    = strlen($strPol) - 1;
	
	for($i = 0;$i < $length;$i++)
	{
		$str .= $strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	}
	
	return $str;
}

/**
 * 输出xml字符
 *
 * burn添加，2016-12-22
 *
 * 微信支付
 *
 **/
function weixinPayToXml($inputArray)
{
	if(!is_array($inputArray) || count($inputArray) <= 0)
	{
		$errorMessage = "数据组异常";
	}
	
	$xml = "<xml>";
	
	foreach ($inputArray as $key => $val)
	{
		$xmLStr = "<" . $key . ">" . $val . "</" . $key . ">";
		
		$xml .= $xmLStr;
	}
	
	$xml .= "</xml>";
	
	return $xml;
}

/**
 * 获取毫秒级别的时间戳 *
 *
 * burn添加，2016-12-22
 *
 * 微信支付
 *
 */
function weixinPayGetMillisecond()
{
	//获取毫秒的时间戳
	$time  = explode ( " ", microtime () );
	$time  = $time[1] . ($time[0] * 1000);
	$time2 = explode( ".", $time );
	$time  = $time2[0];
	
	return $time;
}

/**
 * 以post方式提交xml到对应的接口url
 *
 * @param string $xml  需要post的xml数据
 * @param string $url  url
 * @param int $second  url执行超时时间，默认30s
 * @throws WxPayException
 *
 *  *
 * burn添加，2016-12-22
 *
 * 微信支付
 */
function weixinPayPostXmlCurl($xml, $url, $second = 30)
{
	$ch = curl_init();
	
	//设置超时
	curl_setopt($ch,CURLOPT_TIMEOUT, $second);
	
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
	//设置header
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	
	//要求结果为字符串且输出到屏幕上
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	//post提交方式
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
	
	//运行curl
	$data = curl_exec($ch);
	
	//返回结果
	if($data)
	{
		curl_close($ch);
		
		return $data;
	}
	else
	{
		$error = curl_errno($ch);
		curl_close($ch);
		
		$errorMessage = "curl出错，错误码:$error";
		
		return $errorMessage;
	}
}

/**
 *
 * 上报数据， 上报的时候将屏蔽所有异常流程
 * @param string $usrl
 * @param int $startTimeStamp
 * @param array $data *
 *
 * burn添加，2016-12-22
 *
 * 微信支付
 */
function weixinPayReportCostTime($url, $startTimeStamp, $data)
{
	//上报逻辑
	$endTimeStamp = weixinPayGetMillisecond();
	
	include_once "../../../lib/OpenSDK/WxpayAPI/lib/WxPay.Data.php";
	
	$objInput = new WxPayReport();
	$objInput->SetInterface_url($url);
	$objInput->SetExecute_time_($endTimeStamp - $startTimeStamp);
	
	//返回状态码
	if(array_key_exists("return_code", $data))
	{
		$objInput->SetReturn_code($data["return_code"]);
	}
	
	//返回信息
	if(array_key_exists("return_msg", $data))
	{
		$objInput->SetReturn_msg($data["return_msg"]);
	}
	
	//业务结果
	if(array_key_exists("result_code", $data))
	{
		$objInput->SetResult_code($data["result_code"]);
	}
	
	//错误代码
	if(array_key_exists("err_code", $data))
	{
		$objInput->SetErr_code($data["err_code"]);
	}
	
	//错误代码描述
	if(array_key_exists("err_code_des", $data))
	{
		$objInput->SetErr_code_des($data["err_code_des"]);
	}
	//商户订单号
	if(array_key_exists("out_trade_no", $data))
	{
		$objInput->SetOut_trade_no($data["out_trade_no"]);
	}
	
	//设备号
	if(array_key_exists("device_info", $data))
	{
		$objInput->SetDevice_info($data["device_info"]);
	}
	
	try
	{
		report($objInput);
	}
	catch (WxPayException $e)
	{
		//不做任何处理
	}
}

/**
 * 将xml转为array
 * @param string $xml
 * @throws WxPayException
 *
 *  *
 * burn添加，2016-12-22
 *
 * 微信支付
 *
 */
function weixinPayFromXml($xml)
{
	if(!$xml)
	{
		$errorMessage = "xml数据异常！";
	}
	
	//将XML转为array
	//禁止引用外部xml实体
	libxml_disable_entity_loader(true);
	
//	return json_decode(json_encode_ex(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
	
	$xmlObj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

	return xmlToArray($xmlObj);
}

/**
 *
 * 检测签名
 *
 *  *
 * burn添加，2016-12-22
 *
 * 微信支付
 *
 */
function weixinPayCheckSign($inputArray,$key)
{
	//fix异常
	if(!array_key_exists('sign', $inputArray))
	{
		$errorMessage = "签名信息错误";
	}
	
	//签名步骤一：按字典序排序参数
	ksort($inputArray);
	
	//生成签名
	$sign = toUrlParams($inputArray);
	
	$keyStr = "&key=" . $key; //key
	
	$sign .= $keyStr;
	
	$sign  = strtoupper(md5($sign));
	
	if($inputArray['sign'] == $sign)
	{
		return true;
	}
	
	$errorMessage = "签名错误！";
}

/**
 * 格式化参数格式化成url参数
 *
 *  *
 * burn添加，2016-12-22
 *
 * 微信支付
 *
 */
function weixinPayToUrlParams($inputAarry)
{
	$buff = "";
	
	foreach ($inputAarry as $k => $v)
	{
		if($k != "sign" && $v != "" && !is_array($v))
		{
			$buff .= $k . "=" . $v . "&";
		}
	}
	
	$buff = trim($buff, "&");
	
	return $buff;
}

/**
 *
 * 测速上报，该方法内部封装在report中，使用时请注意异常流程
 * WxPayReport中interface_url、return_code、result_code、user_ip、execute_time_必填
 * appid、mchid、spbill_create_ip、nonce_str不需要填入
 * @param WxPayReport $inputObj
 * @param int $timeOut
 * @throws WxPayException
 * @return 成功时返回，其他抛异常
 *
 *  *
 * burn添加，2016-12-22
 *
 * 微信支付
 */
function weixinPayReport($inputObj, $timeOut = 1)
{
	$url = "https://api.mch.weixin.qq.com/payitil/report";
	
	//检测必填参数
	if(!$inputObj->IsInterface_urlSet())
	{
		throw new WxPayException("接口URL，缺少必填参数interface_url！");
	}
	
	if(!$inputObj->IsReturn_codeSet())
	{
		throw new WxPayException("返回状态码，缺少必填参数return_code！");
	}
	
	if(!$inputObj->IsResult_codeSet())
	{
		throw new WxPayException("业务结果，缺少必填参数result_code！");
	}
	
	if(!$inputObj->IsUser_ipSet())
	{
		throw new WxPayException("访问接口IP，缺少必填参数user_ip！");
	}
	
	if(!$inputObj->IsExecute_time_Set())
	{
		throw new WxPayException("接口耗时，缺少必填参数execute_time_！");
	}
	
	$inputObj->SetAppid(WxPayConfig::APPID);//公众账号ID
	$inputObj->SetMch_id(WxPayConfig::MCHID);//商户号
	$inputObj->SetUser_ip($_SERVER['REMOTE_ADDR']);//终端ip
	$inputObj->SetTime(date("YmdHis"));//商户上报时间
	$inputObj->SetNonce_str(self::getNonceStr());//随机字符串
	
	$inputObj->SetSign();//签名
	$xml = $inputObj->ToXml();
	
	$startTimeStamp = weixinPayGetMillisecond();//请求开始时间
	$response = weixinPayPostXmlCurl($xml, $url, false, $timeOut);
	return $response;
}

function checkUserAutoBuyInfo($acticleID)
{
	$userID   = $_COOKIE['user_id'];
	
	$userName = $_COOKIE['user_name'];
	
	$userInfo = checkLogin($userID,$userName);
	
	switch ($userInfo)
	{
		case -1:
		{
			$status = USER_QUERY_ERROR;
			
			break;
		}
		case -2:
		{
			$status = USER_LOGIN_ERROR;
			
			break;
		}
		default:
		{
			jieqi_includedb();
		
			$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
		
			$sql = 'SELECT * FROM ' . jieqi_dbprefix('obook_obuy'). "  WHERE userid = '" . $userInfo['uid'] . "' AND articleid  = '" . $acticleID . "'";
		
			$result = $query->execute($sql);
			
			$status = 0;
			
			if($result)
			{
				$tmp = jieqi_query_rowvars($query->getRow());
		
				if($tmp['autobuy'] == '1')
				{
					$status = 1;//是自动购买
				}
				else
				{
					$status = 0;//不是自动购买
				}
			}
			
			break;
		}
	}
	
	return $status;
}

/**
 * 给用户充值
 *
 * @param $query
 * @param $userID 用户id
 * @param $egold  充值金额
 * @return mixed  数据库操作状态
 */
function rechargeForUser($query,$userID,$egold)
{
	$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold + " . $egold . " WHERE uid = '" . $userID . "'";
	
	$status = $query->execute($sql);
	
	return $status;
}

/**
 *
 * 扣钱
 *
 * @param $query
 * @param $userID 用户id
 * @param $egold  充值金额
 * @return mixed  数据库操作状态
 */
function deductFromUser($query,$userID,$egold)
{
	$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - " . $egold . " WHERE uid = '" . $userID . "'";
	
	$status = $query->execute($sql);
	
	return $status;
}

/**
 * 扣钱失败，删除用户的付费记录
 *
 * @param $query
 * @param $idList  记录id
 */
function delSaleRecord($query,$idList)
{
	foreach($idList as $id)
	{
		$sql = 'DELETE FROM `' . jieqi_dbprefix('obook_osale'). "` WHERE osaleid = " . $id;
		
		$query->execute($sql);
	}
}

/**
 * 扣钱失败，删除用户的购买记录
 *
 * @param $query
 * @param $idList  记录id
 */
function delUserBuyRecord($query,$idList)
{
	foreach($idList as $id)
	{
		$sql = 'DELETE FROM `' . jieqi_dbprefix('obook_obuyinfo'). "` WHERE obuyinfoid = " . $id;
		
		$query->execute($sql);
	}
}

/**
 * 获取付费小说信息
 *
 * @param $query
 * @param $articleID
 * @return array
 */
function getOBookInfo($query,$articleID)
{
	$sql = 'SELECT * FROM `' . jieqi_dbprefix('obook_obook'). "` WHERE articleid = " . $articleID;
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$result = jieqi_query_rowvars($query->getRow());
		
		return $result;
	}
}

/**
 * 自动购买付费章节
 *
 * @param $articleID
 * @param $articleName
 * @param $chapterID
 * @param $chapterName
 * @param $oChapterPrice
 * @param $authorID
 * @return int|mixed
 */
function autoBuyOChapter($articleID,$articleName,$chapterID,$chapterName,$oChapterPrice,$authorID)
{
	$userID   = $_COOKIE['user_id'];
	
	$userName = $_COOKIE['user_name'];
	
	$userInfo = checkLogin($userID,$userName);
	
	switch ($userInfo)
	{
		case -1:
		{
			$status = 0;
			
			break;
		}
		case -2:
		{
			$status = 0;
			
			break;
		}
		default:
		{
			if($userInfo['egold'] < $oChapterPrice)
			{
				$status = -1;//账户余额不足
			}
			else
			{
				jieqi_includedb();
				
				$query       = JieqiQueryHandler::getInstance('JieqiQueryHandler');
				
				$oBookInfo   = getOBookInfo($query,$articleID);
				
				if($oBookInfo)
				{
					$payEglod    = $oChapterPrice;
					
					$userBalance = $userInfo['egold'] - $oChapterPrice;//用户余额
					
					if($userBalance < 0)
					{
						$status = -1;
					}
					else
					{
						//先给作者打钱
						$status      = rechargeForUser($query,$authorID,$payEglod);
						
						if($status)
						{
							$oBookName   = $oBookInfo['obookname'];
							
							$oBookID     = $oBookInfo['obookid'];
							
							$oChapterID  = $chapterID;
							
							$userID      = $userInfo['uid'];
							
							$userName    = $userInfo['uname'];
							
							//再扣用户的钱
							$status = deductFromUser($query,$userID,$payEglod);
							
							//扣钱成功，添加用户的详细购买信息
							if($status)
							{
								$saleNum      = 1;
								
								$payNote      = getIp();
								 
								$time         = time();
								
								$salePrice    = $oChapterPrice;
								
								$oChapterName = $chapterName;
								
								$sql = 'INSERT INTO `' . jieqi_dbprefix('obook_osale'). "` (`buytime`,`accountid`,`account`,`articleid`,`obookid`,`ochapterid`,`obookname`,`chaptername`,`saleprice`,`salenum`,`sumprice`,`paynote`) VALUES ('" . $time . "', '" . $userID . "', '" . $userName . "', '" . $articleID . "', '" . $oBookID . "', '" . $oChapterID . "', '" . $oBookName . "', '" . $oChapterName . "', '" . $salePrice . "', '" . $saleNum . "', '" . $salePrice . "', '" . $payNote . "')";
								
								$status = $query->execute($sql);
								
								//添加用户购买信息成功
								if($status)
								{
									$oSaleID = mysql_insert_id();
									
									//修改或添加用户的购买记录
									$sql = 'SELECT * FROM `' . jieqi_dbprefix('obook_obuy'). "` WHERE userid = '" . $userID ."' AND articleid = '" . $articleID . "'";
									
									$status = $query->execute($sql);
									
									if($status)
									{
										$tmp        = jieqi_query_rowvars($query->getRow());
										
										$chapterNum = 1;
										
										$salePrice  = $salePrice;
										
										if($tmp)
										{
											$oBuyID = $tmp['obuyid'];
											
											$sql = 'UPDATE `' . jieqi_dbprefix('obook_obuy'). "` SET `osaleid` = " . $oSaleID . " , `lastbuy` = '" . $time . "' , `ochapterid` = '" . $oChapterID . "' , `chaptername` = '" . $oChapterName . "' , `chapternum` = chapternum + '" . $chapterNum . "' , `buynum` = '" . $saleNum . "' , `buypay` = '" . $salePrice . "' WHERE obuyid = '" . $oBuyID . "'";
											
											$status = $query->execute($sql);
										}
										else
										{
											$sql = 'INSERT INTO `' . jieqi_dbprefix('obook_obuy'). "` (`osaleid`,`buytime`,`lastbuy`,`userid`,`username`,`articleid`,`obookid`,`ochapterid`,`obookname`,`chaptername`,`chapternum`,`buynum`,`buypay`) VALUES ('" . $oSaleID . "', '" . $time . "', '" . $time . "', '" . $userID . "', '" . $userName . "', '" . $articleID . "', '" . $oBookID . "', '" . $chapterID . "', '" . $oBookName . "', '" . $oChapterName . "', chapternum + '" . $chapterNum . "', '" . $saleNum . "', '" . $saleNum . "')";
											
											$status = $query->execute($sql);
										}
										
										if($status)
										{
											$buyPrice = $oChapterPrice;
											
											$osaleID  = $oSaleID;
											
											$sql = 'INSERT INTO `' . jieqi_dbprefix('obook_obuyinfo'). "` (`osaleid`,`buytime`,`userid`,`username`,`articleid`,`obookid`,`ochapterid`,`obookname`,`chaptername`,`buyprice`,`buynum`,`buypay`) VALUES ('" . $osaleID . "', '" . $time . "', '" . $userID . "', '" . $userName . "', '" . $articleID . "', '" . $oBookID . "', '" . $oChapterID . "', '" . $oBookName . "', '" . $oChapterName . "', '" . $buyPrice . "', '" . $saleNum . "', '" . $buyPrice . "')";
											
											$status = $query->execute($sql);
											
											if($status)
											{
												//更新jieqi_obook_obook中的数据
												$sql = 'UPDATE `' . jieqi_dbprefix('obook_obook'). "` SET `sumegold` = sumegold+saleprice" . " , `allsale` = allsale+1" . " , `allsale` = allsale+1" . " , `monthsale` = monthsale+1" . " , `weeksale` = weeksale+1" . " , `daysale` = daysale+1" . " , `totalsale` = totalsale+1" . " , `lastsale` = " . $time .' WHERE obookid = ' . $oBookID;
												
												$query->execute($sql);
												
												//更新jieqi_obook_ochapter中的数据
												$sql = 'UPDATE `' . jieqi_dbprefix('obook_ochapter'). "` SET `sumegold` = sumegold+saleprice" . " , `allsale` = allsale+1" . " , `allsale` = allsale+1" . " , `monthsale` = monthsale+1" . " , `weeksale` = weeksale+1" . " , `daysale` = daysale+1" . " , `totalsale` = totalsale+1" . " , `lastsale` = " . $time . ' WHERE ochapterid = ' . $oChapterID;
												
												$query->execute($sql);
												
												$status = 1;
											}
											else
											{
												$status = 0;
												
												//给用户恢复扣除的钱
												rechargeForUser($query,$userID,$payEglod);
												
												//需要扣掉作者收到的钱
												deductFromUser($query,$authorID,$payEglod);
												
												//删除用户的付费记录
												delSaleRecord($query,array($osaleID));
											}
										}
										else
										{
											$status = 0;
											
											//给用户恢复扣除的钱
											rechargeForUser($query,$userID,$payEglod);
											
											//需要扣掉作者收到的钱
											deductFromUser($query,$authorID,$payEglod);
											
											//删除用户的付费记录
											delSaleRecord($query,array($oSaleID));
										}
									}
									else
									{
										$status = 0;
										
										//给用户恢复扣除的钱
										rechargeForUser($query,$userID,$payEglod);
										
										//需要扣掉作者收到的钱
										deductFromUser($query,$authorID,$payEglod);
										
										//删除用户的付费记录
										delSaleRecord($query,array($oSaleID));
									}
								}
								else
								{
									$status = 0;
									
									//给用户恢复扣除的钱
									rechargeForUser($query,$userID,$payEglod);
									
									//需要扣掉作者收到的钱
									deductFromUser($query,$authorID,$payEglod);
								}
							}
							else
							{
								$status = 0;
								
								//需要扣掉作者收到的钱
								deductFromUser($query,$authorID,$payEglod);
							}
						}
						else
						{
							$status = 0;
						}
					}
				}
				else
				{
					$status = 0;
				}
			}
			
			break;
		}
	}
	
	return $status;
}

/**
 * object(SimpleXMLElement) 对象转换为数组
 * convert simplexml object to array sets
 * $array_tags 表示需要转为数组的 xml 标签。例：array('item', '')
 * 出错返回False
 *
 * @param object $simplexml_obj
 * @param array $array_tags
 * @param int $strip_white 是否清除左右空格
 * @return mixed
 */
function xmlToArray($simpleXmlElement)
{
	$simpleXmlElement=(array)$simpleXmlElement;
	
    foreach($simpleXmlElement as $k => $v)
    {
	    if($v instanceof SimpleXMLElement ||is_array($v))
	    {
		    $simpleXmlElement[$k] = xmlToArray($v);
	    }
    }
    return $simpleXmlElement;
}

/**
 * 将数组排序之后生成string
 *
 * @param $params
 * @return string
 */
function getSignContent($params)
{
	ksort($params);
	
	$stringToBeSigned = "";
	$i = 0;
	
	foreach ($params as $k => $v)
	{
		if (false ===  empty($v) && "@" != substr($v, 0, 1))
		{
			// 转换成目标字符集
			$v = characet($v, 'utf-8');
			
			if ($i == 0)
			{
				$stringToBeSigned .= "$k" . "=" . "$v";
			}
			else
			{
				$stringToBeSigned .= "&" . "$k" . "=" . "$v";
			}
			
			$i++;
		}
	}
	
	unset ($k, $v);
	
	return $stringToBeSigned;
}


function characet($data, $targetCharset)
{
	if (!empty($data))
	{
		$fileType = 'utf-8';
		if (strcasecmp($fileType, $targetCharset) != 0)
		{
			$data = mb_convert_encoding($data, $targetCharset, $fileType);
			//              $data = iconv($fileType, $targetCharset.'//IGNORE', $data);
		}
	}
	
	return $data;
}

/**
 * 生成签名
 *
 * @param $data     待签名数据
 * @param $priKey   私钥
 * @return string   签名内容
 */
function generateSign($data,$priKey)
{
	$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
		wordwrap($priKey, 64, "\n", true) .
		"\n-----END RSA PRIVATE KEY-----";
	
	($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
	
	$flag = openssl_sign($data, $sign, $res);
	
	$sign = base64_encode($sign);
	
	return $sign;
}

/**
 * 将数据value进行Url化
 *
 * @param $inputArray
 * @return string
 */
function getSignUrlContentFromArray($inputArray)
{
	$buff = '';
	
	foreach ($inputArray as $k => $v)
	{
		if($v != "")
		{
			$buff .= $k . "=" . urlencode($v);
		}
		
		if($k != 'sign')
		{
			$buff .= "&";
		}
	}
	
	return $buff;
}

/**
 * 支付宝支付签名生成过程，切记不要用官方demo
 * 对数组进行签名，
 *
 * @param $inputArray
 */
function getSign($inputArray,$privateKay)
{
	//1、将数据排序之后，生成待签名的字符串
	$signContent = getSignContent($inputArray);
	
	//2、根据生成的待签名字符串和私钥值进行签名
	$sign = generateSign($signContent,$privateKay);
	
	//3、将签名放入到数据的sign字段中
	$inputArray['sign'] = $sign;
	
	$result = getSignUrlContentFromArray($inputArray);
	
	return $result;
}

/**
 * 检查书籍的销售信息，包括打赏数据等
 *
 * @param $articleID
 * @return int
 */
function checkOBookInfo($articleID)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql = 'SELECT COUNT(*) FROM ' . jieqi_dbprefix('obook_obook') . " WHERE articleid = " . $articleID;
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$tmp = jieqi_query_rowvars($query->getRow());
		
		if($tmp["COUNT(*)"] != 0)
		{
			return 1;
		}
		else
		{
			$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article') . " WHERE articleid = " . $articleID;
			
			$status = $query->execute($sql);
			
			if($status)
			{
				$tmp = jieqi_query_rowvars($query->getRow());
				
				$siteID        = $tmp['siteid'];
				
				$sourceID      = $tmp['sourceid'];
				
				$postDate      = $tmp['postdate'];
				
				$lastUpdate    = $tmp['lastupdate'];
				
				$obookName     = $tmp['articlename'];
				
				$keyWords      = $tmp['keywords'];
				
				$articleID     = $articleID;
				
				$initial       = $tmp['initial'];
				
				$intro         = $tmp['intro'];
				
				$notice        = $tmp['notice'];
				
				$setting       = $tmp['setting'];
				
				$lastVolumeID  = $tmp['lastvolumeid'];
				
				$lastVolume    = $tmp['lastvolume'];
				
				$lastChapterID = $tmp['lastchapterid'];
				
				$lastChapter   = $tmp['lastchapter'];
				
				$lastSummary   = $tmp['lastsummary'];
				
				$chapters      = $tmp['chapters'];
				
				$size          = $tmp['size'];
				
				$authorid      = $tmp['authorid'];
				
				$author        = $tmp['author'];
				
				$agentid       = $tmp['agentid'];
				
				$agent         = $tmp['agent'];
				
				$posterID      = $tmp['posterid'];
				
				$poster        = $tmp['poster'];
				
				$sql = 'INSERT INTO `' . jieqi_dbprefix('obook_obook'). "` (`siteid`,`sourceid`,`postdate`,`lastupdate`,`obookname`,`keywords`,`articleid`,`initial`,`intro`,`notice`,`setting`,`lastvolumeid`,`lastvolume`,`lastchapterid`,`lastchapter`,`lastsummary`,`chapters`,`size`,`authorid`,`author`,`agentid`,`agent`,`posterid`,`poster`) VALUES ('" . $siteID . "', '" . $sourceID . "', '" . $postDate . "', '" . $lastUpdate . "', '" . $obookName . "', '" . $keyWords .  "', '" . $articleID . "', '" . $initial . "', '" . $intro  . "', '" . $notice  . "', '" . $setting  . "', '" . $lastVolumeID  . "', '" . $lastVolume  . "', '" . $lastChapterID  . "', '" . $lastChapter  . "', '" . $lastSummary  . "', '" . $chapters  . "', '" . $size  . "', '" . $authorid  . "', '" . $author  . "', '" . $agentid  . "', '" . $agent  . "', '" . $posterID . "', '" . $poster  . "')";
				
				$result = $query->execute($sql);
				
				if($result)
				{
					return 1;
				}
				else
				{
					return -1;
				}
			}
			else
			{
				return -1;
			}
		}
	}
	else
	{
		return -1;
	}
}


function getThirdPartyLoginType($loginID)
{
	switch ($loginID)
	{
		case 0:
		{
			$loginType['login_type'] = 'weixinlogin';
			
			$loginType['login_msg']  = '微信';
			
			break;
		}
		case 1:
		{
			$loginType['login_type'] = 'qqlogin';
			
			$loginType['login_msg']  = 'qq';
			
			break;
		}
		case 2:
		{
			$loginType['login_type'] = 'weibologin';
			
			$loginType['login_msg']  = '微博';
			
			break;
		}
		case 3:
		{
			$loginType['login_type'] = 'visitorlogin';
			
			$loginType['login_msg']  = '游客登录';
			
			break;
		}
	}
	
	return $loginType;
}

/** php 发送流文件
 * @param  String  $url  接收的路径
 * @param  String  $file 要发送的文件
 * @return boolean
 */
function sendStreamFile($url, $file)
{
	if(file_exists($file))
	{
		$opts = array(
			'http' => array(
				'method' => 'POST',
				'header' => 'content-type:application/x-www-form-urlencoded',
				'content' => file_get_contents($file)
			)
		);
		
		$context  = stream_context_create($opts);
		$response = file_get_contents($url, false, $context);
		$ret      = json_decode($response, true);
		
		return $ret['success'];
	}
	else
	{
		return false;
	}
}

//fname为要下载的文件名
//$fpath为下载文件所在文件夹，默认是downlod
function download($fname,$fpath)
{
	//避免中文文件名出现检测不到文件名的情况，进行转码utf-8->gbk
	$filename = $fname;

	$path     = $fpath.$filename;
	
	if(!file_exists($path))
	{
		//检测文件是否存在
		echo "文件不存在！";
		die();
	}
	
	$fp       = fopen($path,'r');//只读方式打开
	
	$filesize = filesize($path);//文件大小
	
	//返回的文件(流形式)
	header("Content-type: application/octet-stream");
	//按照字节大小返回
	header("Accept-Ranges: bytes");
	//返回文件大小
	header("Accept-Length: $filesize");
	//这里客户端的弹出对话框，对应的文件名
	header("Content-Disposition: attachment; filename=".$filename);
	//================重点====================
	ob_clean();
	flush();
	//=================重点===================
	//设置分流
	$buffer = 1024;
	//来个文件字节计数器
	$count  = 0;
	
//	while(!feof($fp)&&($filesize - $count>0))
//	{
//		$data   = fread($fp,$buffer);
//		$count += $data;//计数
//
//		echo $data;//传数据给浏览器端
//	}
	
	while(!feof($fp))
	{
		$data   = fread($fp,$buffer);
		
		echo $data;//传数据给浏览器端
	}
	
	fclose($fp);
}


/**
 * 21000 App Store不能读取你提供的JSON对象
 * 21002 receipt-data域的数据有问题
 * 21003 receipt无法通过验证
 * 21004 提供的shared secret不匹配你账号中的shared secret
 * 21005 receipt服务器当前不可用
 * 21006 receipt合法，但是订阅已过期。服务器接收到这个状态码时，receipt数据仍然会解码并一起发送
 * 21007 receipt是Sandbox receipt，但却发送至生产系统的验证服务
 * 21008 receipt是生产receipt，但却发送至Sandbox环境的验证服务
 */
function appStoreAcurl($receipt_data, $sandbox = 0)
{
	//小票信息
	$POSTFIELDS = array("receipt-data" => $receipt_data);
	
	$POSTFIELDS = json_encode_ex($POSTFIELDS);
	
	//正式购买地址 沙盒购买地址
	$url_buy     = "https://buy.itunes.apple.com/verifyReceipt";
	
	$url_sandbox = "https://sandbox.itunes.apple.com/verifyReceipt";
	
	$url         = $sandbox ? $url_sandbox : $url_buy;
	
	//简单的curl
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
	$result = curl_exec($ch);
	$errno  = curl_errno($ch);
	curl_close($ch);
	
	if ($errno != 0)
	{
		//curl请求有错误
		return array(
			'errNo' => 1,
			'errMsg' => '请求超时，请稍后重试'
		);
	}
	else
	{
		$data = json_decode($result, true);
	
		if (!is_array($data))
		{
			return array(
				'errNo' => 2,
				'errMsg' => '苹果返回数据有误，请稍后重试');
		}
		
		//判断购买时候成功
		if (!isset($data['status']) || $data['status'] != 0)
		{
			return array(
				'errNo' => 3,
				'errMsg' => '购买失败');
		}
		
		//返回产品的信息
		$order['data']  = $data;
		$order['errNo'] = 0;
		
		return $order;
	}
	
//	return $result;
}

//去苹果服务器二次验证代码
function getReceiptData($receipt, $isSandbox = false,$money)
{
	if ($isSandbox)
	{
		$endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';//沙箱地址
	}
	else
	{
		$endpoint = 'https://buy.itunes.apple.com/verifyReceipt';//真实运营地址
	}
	
	$postData = json_encode_ex(
		array('receipt-data' => $receipt)
	);
	
	$ch = curl_init($endpoint);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  //这两行一定要加，不加会报SSL 错误
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$response = curl_exec($ch);
	$errno    = curl_errno($ch);
	//$errmsg   = curl_error($ch);
	curl_close($ch);
	
	if ($errno != 0)
	{
		//curl请求有错误
		return array(
			'errNo' => 1,
			'errMsg' => '请求超时，请稍后重试'
		);
	}
	else
	{
		$data = json_decode($response, true);
		
		$flag = checkApplePayReceiptData($data,$money);
		
		if($flag)
		{
			if (!is_array($data))
			{
				return array(
					'errNo' => 2,
					'errMsg' => '苹果返回数据有误，请稍后重试');
			}
			
			//判断购买时候成功
			if (!isset($data['status']) || $data['status'] != 0)
			{
				return array(
					'errNo' => 3,
					'errMsg' => '购买失败');
			}
			
			
			//返回产品的信息
			$order['data']  = $data['receipt']['in_app'][0];
			
			$order['errNo'] = 0;
		}
		else
		{
			return array(
				'errNo' => 3,
				'errMsg' => '购买失败');
		}
		
		return $order;
	}
}

//去苹果服务器二次验证代码--侧事故
function testGetReceiptData($receipt, $isSandbox = false,$money)
{
	if ($isSandbox)
	{
		$endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';//沙箱地址
	}
	else
	{
		$endpoint = 'https://buy.itunes.apple.com/verifyReceipt';//真实运营地址
	}
	
	$postData = json_encode_ex(
		array('receipt-data' => $receipt)
	);
	
	$ch = curl_init($endpoint);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  //这两行一定要加，不加会报SSL 错误
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$response = curl_exec($ch);
	$errno    = curl_errno($ch);
	//$errmsg   = curl_error($ch);
	curl_close($ch);
	
	if ($errno != 0)
	{
		//curl请求有错误
		return array(
			'errNo' => 1,
			'errMsg' => '请求超时，请稍后重试'
		);
	}
	else
	{
		$data = json_decode($response, true);
		
		$flag = checkApplePayReceiptData($data,$money);
		
		if($flag)
		{
			if (!is_array($data))
			{
				return array(
					'errNo' => 2,
					'errMsg' => '苹果返回数据有误，请稍后重试');
			}
			
			//判断购买时候成功
			if (!isset($data['status']) || $data['status'] != 0)
			{
				return array(
					'errNo' => 3,
					'errMsg' => '购买失败');
			}
			
			
			//返回产品的信息
			$order['data']  = $data['receipt']['in_app'][0];
			
			$order['errNo'] = 0;
		}
		else
		{
			return array(
				'errNo' => 3,
				'errMsg' => '购买失败');
		}
		
		return $order;
	}
}

/**
 * 验证苹果支付的返回数据
 * @param $data
 *
 */

/**
 * 验证苹果支付的返回数据
 *
 * @param $data
 * @param $money
 */
function checkApplePayReceiptData($data,$money)
{
	include_once 'applePayConf.php';
	
	$result = 0;
	
	if(isset($data['receipt']) && is_array($data['receipt']) && $data['receipt'])
	{
		if($data['receipt']['bundle_id'] == $applePay['bundle_id'])
		{
			if(isset($data['receipt']['in_app']) && is_array($data['receipt']['in_app']) && $data['receipt']['in_app'])
			{
				if($applePay['product_id'][$data['receipt']['in_app'][0]['product_id']] == $money)
				{
					$result = 1;
				}
				else
				{
					$result = 0;
				}
			}
			else
			{
				$result = 0;
			}
		}
		else
		{
			$result = 0;
		}
	}
	else
	{
		$result = 0;
	}

	return $result;
}