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
header( "Content-Type:text/html;charset=".JIEQI_CHAR_SET );
jieqi_loadlang( "body", JIEQI_MODULE_NAME );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
include_once( JIEQI_ROOT_PATH."/header.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( isset( $_GET['method'] ) && $_GET['method'] == "fetch" )
{
    if ( !jieqinumericcheck( 1, 10, $_GET['id'] ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
    }
    $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
    if ( $criteria = $topic_handler->get( $_GET['id'] ) )
    {
        if ( !$_COOKIE["jieqiFirstClick".JIEQI_MODULE_NAME.$_GET['id']] )
        {
            $criteria->setvar( "newsclick", $criteria->getvar( "newsclick" ) + 1 );
            if ( !$topic_handler->insert( $criteria ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
            }
            @setcookie( "jieqiFirstClick".JIEQI_MODULE_NAME.$_GET['id'], @time( ), time( ) + $jieqiConfigs[JIEQI_MODULE_NAME]['minclicktime'], "/", @strval( @ini_get( "session.cookie_domain" ) ), 0 );
        }
        $topbar_str = "";
        $top = $criteria->getvar( "newsputtop" ) ? $jieqiLang[JIEQI_MODULE_NAME]['news_putop_enabled'] : $jieqiLang[JIEQI_MODULE_NAME]['news_putop_unabled'];
        $topbar_str .= "<a href=\"".$jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newsputop.php?id=".$criteria->getvar( "newsid" )."\" target=\"_blank\">".$jieqiLang[JIEQI_MODULE_NAME]['news_putop']."(".$top.")</a>&nbsp;&nbsp;";
        $topbar_str .= "<a href=\"#\">".$jieqiLang[JIEQI_MODULE_NAME]['news_click']."(".$criteria->getvar( "newsclick" ).")</a>&nbsp;&nbsp;";
        echo $topbar_str;
    }
}
?>
