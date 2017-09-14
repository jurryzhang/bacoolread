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
if ( isset( $_POST['method'] ) && $_POST['method'] == "add" )
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
    if ( $_POST['categoryid'] )
    {
        $criteria = new criteriacompo( new criteria( "categoryid", $_POST['categoryid'] ) );
        if ( $category_handler->getcount( $criteria ) == 0 )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
        }
    }
    $newCategory = $category_handler->create( );
    if ( $_POST['categoryid'] )
    {
        $newCategory->setvar( "parentid", $_POST['categoryid'] );
    }
    $newCategory->setvar( "categoryname", $_POST['categoryname'] );
    if ( !$category_handler->insert( $newCategory ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_add_failure'] );
    }
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/category.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['category_add_success'] );
}
$category_form = new jieqithemeform( $jieqiLang[JIEQI_MODULE_NAME]['category_add'], "addcategory", $jieqiModules['news']['url']."/admin/categoryadd.php" );
$category_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['category_name'], "categoryname", 30, 50 ), true );
$category_form->addelement( new jieqiformhidden( "categoryid", $_GET['cid'] ) );
$category_form->addelement( new jieqiformhidden( "method", "add" ) );
$category_form->addelement( new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" ) );
$jieqiTpl->assign( "category_form_add", $category_form->render( JIEQI_FORM_MIN ) );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/categoryadd.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
