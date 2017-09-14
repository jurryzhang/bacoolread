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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newsdel'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "content", JIEQI_MODULE_NAME );
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/content.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( $_POST['method'] == "del" )
{
    if ( $_POST['confirm'] == "Y" )
    {
        if ( !jieqinumericcheck( 1, 10, $_POST['id'] ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
        }
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $criteria = new criteriacompo( new criteria( "newsid", $_POST['id'] ) );
        if ( $_SESSION['jieqiUserGroup'] != 2 && $criteria->getvar( "newsposterid" ) != $_SESSION['jieqiUserId'] )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_del_failure'] );
        }
        if ( $topic_handler->delete( $criteria ) )
        {
            $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
            if ( !$content_handler->jieqinewscontentdelete( $_POST['id'] ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_del_failure'] );
            }
        }
        else
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_del_failure'] );
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
    else
    {
        jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php", LANG_DO_SUCCESS, "" );
    }
}
$news_form = new jieqithemeform( $jieqiLang[JIEQI_MODULE_NAME]['news_del'], "newsdel", $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newsdel.php" );
$option = new jieqiformradio( $jieqiLang[JIEQI_MODULE_NAME]['news_del_name'], "confirm", "N" );
$option->addoption( "Y", $jieqiLang[JIEQI_MODULE_NAME]['news_del_yes'] );
$option->addoption( "N", $jieqiLang[JIEQI_MODULE_NAME]['news_del_no'] );
$option->setdescription( $jieqiLang[JIEQI_MODULE_NAME]['news_del_cue'] );
$news_form->addelement( $option );
$news_form->addelement( new jieqiformhidden( "id", $_GET['id'] ) );
$news_form->addelement( new jieqiformhidden( "method", "del" ) );
$news_form->addelement( new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" ) );
$jieqiTpl->assign( "news_form_del", $news_form->render( JIEQI_FORM_MAX ) );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/newsdel.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
