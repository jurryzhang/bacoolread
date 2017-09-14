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
if ( isset( $_POST['method'] ) && $_POST['method'] == "edit" )
{
    if ( !jieqinumericcheck( 0, 5, $_POST['categoryid'] ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
    }
    if ( !jieqichinesecheck( 1, 20, $_POST['categoryname'] ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_name_error'] );
    }
    $category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
    $category_edit = $category_handler->get( $_POST['categoryid'] );
    $category_edit->setvar( "categoryname", $_POST['categoryname'] );
    if ( !$category_handler->insert( $category_edit ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['update_name_failure'] );
    }
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/category.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['update_name_success'] );
}
if ( !jieqinumericcheck( 0, 5, $_GET['cid'] ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
}
$category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
if ( $criteria = $category_handler->get( $_GET['cid'] ) )
{
    $category_form = new jieqithemeform( $jieqiLang[JIEQI_MODULE_NAME]['category_edit'], "categoryedit", $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/categoryedit.php" );
    $category_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['category_name'], "categoryname", 30, 50, $criteria->getvar( "categoryname" ) ), true );
    $category_form->addelement( new jieqiformhidden( "categoryid", $_GET['cid'] ) );
    $category_form->addelement( new jieqiformhidden( "method", "edit" ) );
    $category_form->addelement( new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" ) );
    $jieqiTpl->assign( "category_form_edit", $category_form->render( JIEQI_FORM_MIN ) );
}
else
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
}
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/categoryedit.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
