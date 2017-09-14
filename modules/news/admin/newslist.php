<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

define( "JIEQI_MODULE_NAME", "news" );
require_once( "../../../global.php" );
jieqi_getconfigs( JIEQI_MODULE_NAME, "power" );
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newslist'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "content", JIEQI_MODULE_NAME );
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/content.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( empty( $_GET['page'] ) || !is_numeric( $_GET['page'] ) )
{
    $GLOBALS['_GET']['page'] = 1;
}
if ( isset( $_POST['checkaction'] ) && $_POST['checkaction'] == 1 && is_array( $_POST['checkid'] ) && 0 < count( $_POST['checkid'] ) )
{
    foreach ( $GLOBALS['_POST']['checkid'] as $v )
    {
        if ( !jieqinumericcheck( 1, 10, $v ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
        }
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $criteria = new criteriacompo( new criteria( "newsid", $v ) );
        if ( $topic_handler->delete( $criteria ) )
        {
            $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
            if ( !$content_handler->jieqinewscontentdelete( $v ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_del_failure'] );
            }
        }
        else
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_del_failure'] );
        }
    }
    jieqi_getcachevars( JIEQI_MODULE_NAME, "newsuplog" );
    if ( !is_array( $jieqiNewsuplog ) )
    {
        $jieqiNewsuplog = array( "t1" => 0, "t2" => 0 );
    }
    $jieqiNewsuplog['t1'] = JIEQI_NOW_TIME;
    jieqi_setcachevars( "newsuplog", "jieqiNewsuplog", $jieqiNewsuplog, JIEQI_MODULE_NAME );
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_del_success'] );
}
$category_handler = jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
if ( !jieqinumericcheck( 0, 10, $_GET['pid'] ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
}
if ( !jieqinumericcheck( 0, 10, $_GET['cid'] ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
}
if ( !jieqinumericcheck( 0, 10, $_GET['audit'] ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['audit_id_error'] );
}
$topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
$criteria = new criteriacompo( );
if ( $_GET['pid'] )
{
    $criteria->add( new criteria( "firstid", $_GET['pid'] ) );
}
if ( $_GET['cid'] )
{
    $criteria->add( new criteria( "secondid", $_GET['cid'] ) );
}
if ( $_GET['audit'] )
{
    $GLOBALS['_SESSION']['status'] = $_GET['audit'];
}
switch ( $_SESSION['status'] )
{
case 1 :
    $criteria->add( new criteria( "newsstatus", 1 ) );
    break;
case 2 :
    $criteria->add( new criteria( "newsstatus", 0 ) );
    break;
default :
    $criteria->add( new criteria( "newsstatus", 0 ) );
}
if ( $_SESSION['jieqiUserName'] && $_SESSION['jieqiUserGroup'] != 2 )
{
    $criteria->add( new criteria( "newsposterid", $_SESSION['jieqiUserId'] ) );
}
$criteria->setsort( "newsdate" );
$criteria->setorder( "DESC" );
$criteria->setlimit( $jieqiConfigs[JIEQI_MODULE_NAME]['newsmanagepnum'] );
$criteria->setstart( ( $_GET['page'] - 1 ) * $jieqiConfigs[JIEQI_MODULE_NAME]['newsmanagepnum'] );
if ( !( $result = $topic_handler->queryobjects( $criteria ) ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
}
$news_array = array( );
$i = 0;
while ( $v = $topic_handler->getobject( $result ) )
{
    $news_array[$i]['id'] = $v->getvar( "newsid" );
    $news_array[$i]['title'] = $jieqiConfigs[JIEQI_MODULE_NAME]['htmlfilesenable'] ? "<a href=\"".JIEQI_URL."/files/".JIEQI_MODULE_NAME."/".$v->getvar( "newshtmlpath" )."\" " : "<a href=\"".$jieqiModules[JIEQI_MODULE_NAME]['url']."/newshow.php?id=".$v->getvar( "newsid" )."\" ";
    $news_array[$i]['title'] .= "target=\"_blank\" title=\"".$v->getvar( "newstitle" )."\">";
    $news_array[$i]['title'] .= jieqi_substr( $v->getvar( "newstitle" ), 0, $jieqiConfigs[JIEQI_MODULE_NAME]['newsmanageword'] );
    $news_array[$i]['title'] .= "</a>";
    $news_array[$i]['category'] .= $category_handler->jieqicategorynamebyid( $v->getvar( "secondid" ) );
    $news_array[$i]['date'] .= $v->getvar( "newsdate" );
    $news_array[$i]['click'] .= $v->getvar( "newsclick" );
    $news_array[$i]['status'] = $v->getvar( "newsstatus" ) == 1 ? $jieqiLang[JIEQI_MODULE_NAME]['news_status_unabled'] : $jieqiLang[JIEQI_MODULE_NAME]['news_status_enabled'];
    $news_array[$i]['audit'] = $v->getvar( "newsstatus" ) == 1 ? $jieqiLang[JIEQI_MODULE_NAME]['news_audit_enabled'] : $jieqiLang[JIEQI_MODULE_NAME]['news_audit_unabled'];
    $news_array[$i]['putop'] = $v->getvar( "newsputtop" ) == 1 ? $jieqiLang[JIEQI_MODULE_NAME]['news_putop_enabled'] : $jieqiLang[JIEQI_MODULE_NAME]['news_putop_unabled'];
    $news_array[$i]['urleditor'] = "newsedit.php?id=".$v->getvar( "newsid" );
    $news_array[$i]['urlislock'] = "newsaudit.php?id=".$v->getvar( "newsid" );
    $news_array[$i]['urlputtop'] = "newsputop.php?id=".$v->getvar( "newsid" );
    $news_array[$i]['urldelete'] = "newsdel.php?id=".$v->getvar( "newsid" );
    $news_array[$i]['checkbox'] = "<input type=\"checkbox\" id=\"checkid[]\" name=\"checkid[]\" value=\"".$v->getvar( "newsid" )."\" />";
    ++$i;
}
$jieqiTpl->assign( "page_head_name", $jieqiLang[JIEQI_MODULE_NAME]['news_list_manage'] );
$jieqiTpl->assign( "jump_menu_js", "<script src='".$jieqiModules[JIEQI_MODULE_NAME]['url']."/js/jumpmenu.js'></script>" );
$jieqiTpl->assign( "jump_menu_name", $category_handler->jieqicategoryjumpmenu( ) );
$jieqiTpl->assign( "form_url_action1", "newslist.php" );
$jieqiTpl->assign( "form_url_action2", "newsaudit.php" );
$jieqiTpl->assign( "news_list", $news_array );
include_once( JIEQI_ROOT_PATH."/lib/html/page.php" );
$jumppage = new jieqipage( $topic_handler->getcount( $criteria ), $jieqiConfigs[JIEQI_MODULE_NAME]['newsmanagepnum'], $_GET['page'] );
$jieqiTpl->assign( "url_jumppage", $jumppage->whole_bar( ) );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/newslist.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
