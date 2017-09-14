<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

define( "JIEQI_MODULE_NAME", "news" );
require_once( "../../global.php" );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "body", JIEQI_MODULE_NAME );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/content.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( !jieqinumericcheck( 1, 10, $_GET['id'] ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
}
$GLOBALS['_GET']['id'] = intval( $_GET['id'] );
$topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
if ( $criteria = $topic_handler->get( $_GET['id'] ) )
{
    include_once( JIEQI_ROOT_PATH."/header.php" );
    if (!$criteria->getvar("newsstatus"))
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_not_audit'] );
    }
    $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
    $jieqiTpl->assign( "id", $criteria->getvar( "newsid" ) );
    $jieqiTpl->assign( "title", $criteria->getvar( "newstitle" ) );
    $jieqiTpl->assign( "source", $criteria->getvar( "newssource" ) );
    $jieqiTpl->assign( "author", $criteria->getvar( "newsauthor" ) );
    $jieqiTpl->assign( "poster", $criteria->getvar( "newsposter" ) );
    $jieqiTpl->assign( "date", $criteria->getvar( "newsdate" ) );
    $jieqiTpl->assign( "body", stripslashes($content_handler->jieqinewscontentbyid( $criteria->getvar("newsid"))));
    $category_handler = jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
    $jieqiTpl->assign( "iconpath", $jieqiModules[JIEQI_MODULE_NAME]['url']."/images/" );
    $jieqiTpl->assign( "nav_list", $category_handler->jieqinavigationbar( $criteria->getvar( "firstid" ), $criteria->getvar( "secondid" )));
    $jieqiTpl->assign( "stat_url", $jieqiModules[JIEQI_MODULE_NAME]['url']."/ajaxstatus.php" );
    $jieqiTpl->assign( "relt_url", $jieqiModules[JIEQI_MODULE_NAME]['url']."/ajaxrelate.php" );
    $jieqiTpl->assign( "relt_show", $jieqiConfigs[JIEQI_MODULE_NAME]['relatenewsenable'] );
    $jieqiTpl->assign( "udpid", $_GET['pid'] );
    $criterias = new criteriacompo( new criteria( "secondid", $criteria->getvar( "secondid" ), "=" ) );
    $criterias->add( new criteria( "newsid", $_GET['id'], "<" ) );
    $criterias->setsort( "newsid" );
    $criterias->setorder( "DESC" );
    $topic_handler->queryobjects( $criterias );
    if ( 0 < $topic_handler->db->getaffectedrows( ) )
    {
        $n = $topic_handler->getobject( );
        $criterias = new criteriacompo( new criteria( "newsid", $n->getvar( "newsid" ), "=" ) );
        $topic_handler->queryobjects( $criterias );
        $n = $topic_handler->getobject( );
        $jieqiTpl->assign( "uptitle", $n->getvar( "newstitle" ) );
        $jieqiTpl->assign( "upnewsid", $n->getvar( "newsid" ) );
    }
    else
    {
        $jieqiTpl->assign( "uptitle", "" );
        $jieqiTpl->assign( "upnewsid", "" );
    }
    $criterias = new criteriacompo( new criteria( "secondid", $criteria->getvar( "secondid" ), "=" ) );
    $criterias->add( new criteria( "newsid", $_GET['id'], ">" ) );
    $criterias->setsort( "newsid" );
    $criterias->setorder( "ASC" );
    $topic_handler->queryobjects( $criterias );
    if ( 0 < $topic_handler->db->getaffectedrows( ) )
    {
        $n = $topic_handler->getobject( );
        $criterias = new criteriacompo( new criteria( "newsid", $n->getvar( "newsid" ), "=" ) );
        $topic_handler->queryobjects( $criterias );
        $n = $topic_handler->getobject( );
        $jieqiTpl->assign( "downtitle", $n->getvar( "newstitle" ) );
        $jieqiTpl->assign( "downnewsid", $n->getvar( "newsid" ) );
    }
    else
    {
        $jieqiTpl->assign( "downtitle", "" );
        $jieqiTpl->assign( "downnewsid", "" );
    }
    $jieqiTpl->setcaching( 0 );
    $jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/newsshow.html";
    include_once( JIEQI_ROOT_PATH."/footer.php" );
}
else
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_not_exist'] );
}
?>
