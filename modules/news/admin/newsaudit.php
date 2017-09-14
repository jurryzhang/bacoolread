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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newsaudit'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "content", JIEQI_MODULE_NAME );
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( isset( $_POST['checkaction'] ) && $_POST['checkaction'] == 2 && is_array( $_POST['checkid'] ) && 0 < count( $_POST['checkid'] ) )
{
    foreach ( $GLOBALS['_POST']['checkid'] as $id )
    {
        if ( !jieqinumericcheck( 1, 10, $id ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
        }
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $criteria = $topic_handler->get( $id );
        if ( $_SESSION['jieqiUserGroup'] != 2 && $criteria->getvar( "newsposterid" ) != $_SESSION['jieqiUserId'] )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
        }
        if ( !$criteria->getvar( "newsstatus" ) )
        {
            $criteria->setvar( "newsstatus", 1 );
            if ( !$topic_handler->insert( $criteria ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
            }
        }
    }
    jieqi_getcachevars( JIEQI_MODULE_NAME, "newsuplog" );
    if ( !is_array( $jieqiNewsuplog ) )
    {
        $jieqiNewsuplog = array( "t1" => 0, "t2" => 0 );
    }
    $jieqiNewsuplog['t1'] = JIEQI_NOW_TIME;
    jieqi_setcachevars( "newsuplog", "jieqiNewsuplog", $jieqiNewsuplog, JIEQI_MODULE_NAME );
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_audit_yes'] );
}
else if ( isset( $_POST['checkaction'] ) && $_POST['checkaction'] == 3 && is_array( $_POST['checkid'] ) && 0 < count( $_POST['checkid'] ) )
{
    foreach ( $GLOBALS['_POST']['checkid'] as $id )
    {
        if ( !jieqinumericcheck( 1, 10, $id ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
        }
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $criteria = $topic_handler->get( $id );
        if ( $_SESSION['jieqiUserGroup'] != 2 && $criteria->getvar( "newsposterid" ) != $_SESSION['jieqiUserId'] )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
        }
        if ( $criteria->getvar( "newsstatus" ) )
        {
            $criteria->setvar( "newsstatus", 0 );
            $p = "../".$criteria->getvar( "newshtmlpath" );
            if ( file_exists( $p ) )
            {
                jieqi_delfile( $p );
            }
            if ( !$topic_handler->insert( $criteria ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
            }
        }
    }
    jieqi_getcachevars( JIEQI_MODULE_NAME, "newsuplog" );
    if ( !is_array( $jieqiNewsuplog ) )
    {
        $jieqiNewsuplog = array( "t1" => 0, "t2" => 0 );
    }
    $jieqiNewsuplog['t1'] = JIEQI_NOW_TIME;
    jieqi_setcachevars( "newsuplog", "jieqiNewsuplog", $jieqiNewsuplog, JIEQI_MODULE_NAME );
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_audit_no'] );
}
else if ( !isset( $_POST['checkaction'] ) )
{
    if ( !jieqinumericcheck( 1, 10, $_GET['id'] ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
    }
    $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
    $criteria = $topic_handler->get( $_GET['id'] );
    if ( $_SESSION['jieqiUserGroup'] != 2 && $criteria->getvar( "newsposterid" ) != $_SESSION['jieqiUserId'] )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
    }
    $msg = "";
    if ( $criteria->getvar( "newsstatus" ) )
    {
        $criteria->setvar( "newsstatus", 0 );
        $msg = $jieqiLang[JIEQI_MODULE_NAME]['news_audit_no'];
        $p = "../".$criteria->getvar( "newshtmlpath" );
        if ( file_exists( $p ) )
        {
            jieqi_delfile( $p );
        }
    }
    else
    {
        $criteria->setvar( "newsstatus", 1 );
        $msg = $jieqiLang[JIEQI_MODULE_NAME]['news_audit_yes'];
    }
    if ( !$topic_handler->insert( $criteria ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
    }
    jieqi_getcachevars( JIEQI_MODULE_NAME, "newsuplog" );
    if ( !is_array( $jieqiNewsuplog ) )
    {
        $jieqiNewsuplog = array( "t1" => 0, "t2" => 0 );
    }
    $jieqiNewsuplog['t1'] = JIEQI_NOW_TIME;
    jieqi_setcachevars( "newsuplog", "jieqiNewsuplog", $jieqiNewsuplog, JIEQI_MODULE_NAME );
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php", LANG_DO_SUCCESS, $msg );
}
else
{
    header( "Location: ".$jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php" );
}
?>
