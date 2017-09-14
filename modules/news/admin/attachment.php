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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['manageattach'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "attachment", JIEQI_MODULE_NAME );
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/attachment.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( empty( $_GET['page'] ) || !is_numeric( $_GET['page'] ) )
{
    $GLOBALS['_GET']['page'] = 1;
}
if ( isset( $_POST['checkaction'] ) && $_POST['checkaction'] == 1 && is_array( $_POST['checkid'] ) && 0 < count( $_POST['checkid'] ) )
{
    $attach_handler = jieqiattachmenthandler::getinstance( "JieqiAttachmentHandler" );
    foreach ( $GLOBALS['_POST']['checkid'] as $v )
    {
        if ( !jieqinumericcheck( 1, 10, $v ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['attach_id_error'] );
        }
        $p = JIEQI_ROOT_PATH.$attach_handler->jieqiattachmentpath( $v );
        if ( file_exists( $p ) )
        {
            jieqi_delfile( $p );
        }
        $criteria = new criteriacompo( new criteria( "attachid", $v ) );
        if ( !$attach_handler->delete( $criteria ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['attach_del_failure'] );
        }
    }
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/attachment.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['attach_del_success'] );
}
$attach_handler = jieqiattachmenthandler::getinstance( "JieqiAttachmentHandler" );
$criteria = new criteriacompo( );
$criteria->setsort( "attachid" );
$criteria->setorder( "DESC" );
$criteria->setlimit( $jieqiConfigs[JIEQI_MODULE_NAME]['attachmanagepnum'] );
$criteria->setstart( ( $_GET['page'] - 1 ) * $jieqiConfigs[JIEQI_MODULE_NAME]['attachmanagepnum'] );
if ( !( $result = $attach_handler->queryobjects( $criteria ) ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['attach_query_error'] );
}
$attach_array = array( );
$i = 0;
while ( $v = $attach_handler->getobject( ) )
{
    $attach_array[$i]['id'] = $v->getvar( "attachid" );
    $attach_array[$i]['name'] = "<a href='".JIEQI_URL.$v->getvar( "attachpath" )."' target='_blank'>".$v->getvar( "attachname" )."</a>";
    $attach_array[$i]['type'] = $v->getvar( "attachtype" );
    $attach_array[$i]['size'] = $v->getvar( "attachsize" )."K";
    $attach_array[$i]['date'] = $v->getvar( "attachdate" );
    $attach_array[$i]['checkbox'] = "<input type=\"checkbox\" id=\"checkid[]\" name=\"checkid[]\" value=\"".$v->getvar( "attachid" )."\" />";
    ++$i;
}
$jieqiTpl->assign( "page_head_name", $jieqiLang[JIEQI_MODULE_NAME]['attach_manage'] );
$jieqiTpl->assign( "form_url_action", "attachment.php" );
$jieqiTpl->assign( "attach_list", $attach_array );
include_once( JIEQI_ROOT_PATH."/lib/html/page.php" );
$jumppage = new jieqipage( $attach_handler->getcount( $criteria ), $jieqiConfigs[JIEQI_MODULE_NAME]['attachmanagepnum'], $_GET['page'] );
$jieqiTpl->assign( "url_jumppage", $jumppage->whole_bar( ) );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/attachment.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
