<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/29
 * Time: 下午5:18
 *
 * app接口设置
 *
 */

//
define("URL_PREFIX",'http://www.mianfeidushu.com/modules/app/');

//默认的起始页
define('DEFAULT_START_PAGE_NUM',0);

//默认的一页的个数
define('DEFAULT_PAGE_SIZE',30);

//默认书籍封面
define('DEFAULT_ARTICLE_COVER','http://www.mianfeidushu.com/modules/article/images/nocover.jpg');

//头像路径
define('DEFAULT_FACE_IMG_URL','http://img.mianfeidushu.com/facePic/');

//默认头像
define('DEFAULT_FACE_IMG','http://img.mianfeidushu.com/facePic/01.png');

//书籍列表排序
define('ARTICLE_SORT_ORDER_BY','`postdate` DESC');

//专题列表排序
define('TOPIC_SORT_ORDER_BY','`id` ASC');

//分类列表排序
define('SORT_ORDER_BY','`lastupdate` DESC');

//最新
define('SORT_ORDER_BY_NEW','`lastupdate` DESC');

//最热
define('SORT_ORDER_BY_HOT','`allvisit` DESC');

/**
 * 排行榜
 */
//推荐排行榜查找规则
define('RANKING_LIST_ORDER_BY_0','`allvote` DESC');

//推荐排行榜名称
define('RANKING_LIST_TITLE_0','推荐排行榜');

//点击排行榜查找规则
define('RANKING_LIST_ORDER_BY_1','`allvisit` DESC');

//点击排行榜名称
define('RANKING_LIST_TITLE_1','点击排行榜');

//订阅排行版查找规则
define('RANKING_LIST_ORDER_BY_2','`allflower` DESC');

//订阅排行榜名称
define('RANKING_LIST_TITLE_2','热销排行榜');

//最新入库排行版查找规则
define('RANKING_LIST_ORDER_BY_3','`postdate` DESC');

//最新入库排行榜名称
define('RANKING_LIST_TITLE_3','最新入库');

//虚拟货币名称
define('VIRLUAL_MONEY','小说币');

//缓存问价路径
define('CACHE_FILE_PATH',"C:/virtualhost/bacoolread/modules/app/cache/");

//默认昵称
define('DEFAULT_NICKNAME',"书友");

//游客默认昵称
define('DEFAULT_VISITOR_NICKNAME',"游客");

//默认密码111111的md5加密
define('DEFAULT_PASSWORD',"96e79218965eb72c92a549dd5a330112");

//新闻的的分类ID
define('DEFAULT_NEWS_CATEGORY_ID','10');

/**
 * 错误信息提示
 */
//查询失败
define("USER_QUERY_ERROR",-1);

define("USER_QUERY_ERROR_MSG",'查询失败');

//该用户不存在，确认登陆之后，再进行查询
define('USER_LOGIN_ERROR',-2);

define('USER_LOGIN_ERROR_MSG',"该用户没有登录，确认登陆之后，再进行查询");

//账户余额不足，请充值！
define('USER_LACK_BALANCE_ERROR',-3);

define('USER_LACK_BALANCE_ERROR_MSG','账户余额不足，请充值！');


