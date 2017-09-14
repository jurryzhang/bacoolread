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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newsputop'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "content", JIEQI_MODULE_NAME );
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( !jieqinumericcheck( 1, 10, $_REQUEST['id'] ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
}
$topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
if ( $criteria = $topic_handler->get( $_REQUEST['id'] ) )
{
    if ( $_SESSION['jieqiUserGroup'] != 2 && $criteria->getvar( "newsposterid" ) != $_SESSION['jieqiUserId'] )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
    }
    $msg = "";
    if ( $criteria->getvar("newsputtop") == 1)
    {
		mysql_query("UPDATE `jieqi_news_topic` SET `newsputtop` = '0' WHERE `newsid` = {$_REQUEST['id']};");
		if($criteria->getvar("newsstatus") == 0){
        $msg = jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php?audit=2", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_putop_no']);
		}else{
		$msg = jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php?audit=1", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_putop_no']);
		}
    }
    else
    {
		mysql_query("UPDATE `jieqi_news_topic` SET `newsputtop` = '1' WHERE `newsid` = {$_REQUEST['id']};");
		if($criteria->getvar("newsstatus") == 0){
        $msg = jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php?audit=2", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_putop_yes']);
		}else{
		$msg = jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php?audit=1", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_putop_yes']);
		}
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
    jieqi_msgwin( LANG_DO_SUCCESS, $msg );
}
?>
