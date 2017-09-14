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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['managecategory'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_loadlang( "category", JIEQI_MODULE_NAME );
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( isset( $_POST['action'] ) && $_POST['action'] == "tax" && is_array( $_POST['tax'] ) && is_array( $_POST['cid'] ) )
{
    $category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
    $i = 0;
    for ( ; $i < count( $_POST['tax'] ); ++$i )
    {
        if ( !jieqinumericcheck( 0, 5, $_POST['cid'][$i] ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
        }
        if ( !jieqinumericcheck( 0, 5, $_POST['tax'][$i] ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_order_error'] );
        }
        $taxis_update = $category_handler->get( $_POST['cid'][$i] );
        $taxis_update->setvar( "categoryorder", $_POST['tax'][$i] );
        if ( !$category_handler->insert( $taxis_update ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['update_order_failure'] );
        }
    }
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/category.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['update_order_success'] );
}
if ( !jieqinumericcheck( 0, 5, $_GET['cid'] ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
}
$GLOBALS['_GET']['cid'] = $_GET['cid'] ? $_GET['cid'] : 0;
$category_form = new jieqithemeform( $jieqiLang[JIEQI_MODULE_NAME]['category_tax'], "categorytax", $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/categorytaxis.php" );
$category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
$criteria = new criteriacompo( new criteria( "parentid", $_GET['cid'] ) );
$criteria->setsort( "categoryorder" );
if ( !( $result = $category_handler->queryobjects( $criteria ) ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_query_error'] );
}
$i = 0;
if ( $category_count = $category_handler->db->getrowsnum( $result ) )
{
    while ( $category_data = $category_handler->getrow( $result ) )
    {
        $categorytype[$i] = new jieqiformselect( $category_data['categoryname'], "tax[".$i."]", $category_data['categoryorder'] );
        $j = 0;
        for ( ; $j < $category_count; ++$j )
        {
            $categorytype[$i]->addoption( $j, $j );
        }
        $category_form->addelement( $categorytype[$i], true );
        $category_form->addelement( new jieqiformhidden( "cid[".$i."]", $category_data['categoryid'] ) );
        ++$i;
    }
    $category_form->addelement( new jieqiformhidden( "action", "tax" ) );
    $category_form->addelement( new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" ) );
}
else
{
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/category.php", LANG_DO_FAILURE, $jieqiLang[JIEQI_MODULE_NAME]['category_no_child'] );
}
$jieqiTpl->assign( "category_form_tax", $category_form->render( JIEQI_FORM_MIN ) );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/categorytaxis.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
