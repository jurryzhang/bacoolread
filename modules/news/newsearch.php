<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

define( "JIEQI_MODULE_NAME", "news" );
if ( !defined( "JIEQI_GLOBAL_INCLUDE" ) )
{
    include_once( "../../global.php" );
}
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "body", JIEQI_MODULE_NAME );
include_once( JIEQI_ROOT_PATH."/header.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/content.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( empty( $_GET['page'] ) || !is_numeric( $_GET['page'] ) )
{
    $GLOBALS['_GET']['page'] = 1;
}
jieqi_getconfigs( JIEQI_MODULE_NAME, "newslistblocks", "jieqiBlocks" );
$GLOBALS['_GET']['w'] = substr( trim( $_GET['w'] ), 0, 32 );
$category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
$news_handler =& jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
$criteria = new criteriacompo( );
if ( $_GET['w'] )
{
    $criteria->add( new criteria( "newstitle", "%".$_GET['w']."%", "LIKE" ) );
}
$criteria->add( new criteria( "newsstatus", 1 ) );
$criteria->setsort( "newsputtop DESC, newsid" );
$criteria->setorder( "DESC" );
$criteria->setlimit( $jieqiConfigs[JIEQI_MODULE_NAME]['newslistpnum'] );
$criteria->setstart( ( $_GET['page'] - 1 ) * $jieqiConfigs[JIEQI_MODULE_NAME]['newslistpnum'] );
if ( !$news_handler->queryobjects( $criteria ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
}
$news_array = array( );
$i = 0;
while ( $v = $news_handler->getobject( ) )
{
    $news_array[$i]['category'] = $category_handler->jieqicategorynamebyid( $v->getvar( "secondid" ) );
    $news_array[$i]['title'] = "<a href=\"newshow.php?id=".$v->getvar( "newsid" )."\" ";
    $news_array[$i]['title'] .= "target=\"_blank\" title=\"".$v->getvar( "newstitle" )."\">";
    $news_array[$i]['title'] .= jieqi_substr( $v->getvar( "newstitle" ), 0, $jieqiConfigs[JIEQI_MODULE_NAME]['newslistword'] );
    $news_array[$i]['title'] .= "</a>";
    if ( $v->getvar( "newsimage" ) )
    {
        $news_array[$i]['title'] .= "[ͼ]";
    }
    $news_array[$i]['date'] = $v->getvar( "newsdate" );
    $news_array[$i]['click'] = $v->getvar( "newsclick" );
    ++$i;
}
if ( !$i )
{
    jieqi_msgwin( LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_not_found'] );
}
$jieqiTpl->assign( "news_list", $news_array );
$jieqiTpl->assign( "iconpath", $jieqiModules[JIEQI_MODULE_NAME]['url']."/images/" );
include_once( JIEQI_ROOT_PATH."/lib/html/page.php" );
$jumppage = new jieqipage( $news_handler->getcount( $criteria ), $jieqiConfigs[JIEQI_MODULE_NAME]['newslistpnum'], $_GET['page'] );
$jieqiTpl->assign( "url_jumppage", $jumppage->whole_bar( ) );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/newsearch.html";
include_once( JIEQI_ROOT_PATH."/footer.php" );
?>
