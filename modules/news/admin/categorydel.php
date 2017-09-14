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
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/content.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( $_POST['method'] == "del" )
{
    if ( $_POST['confirm'] == "Y" )
    {
        if ( !jieqinumericcheck( 0, 5, $_POST['categoryid'] ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
        }
        $category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
        if ( $category_handler->jieqicategorychildcount( $criteria = new criteriacompo( new criteria( "parentid", $_POST['categoryid'] ) ) ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_has_child'] );
        }
        $criteria = new criteriacompo( new criteria( "categoryid", $_POST['categoryid'] ) );
        if ( !$category_handler->delete( $criteria ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['delete_category_failure'] );
        }
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $newsidarray = $topic_handler->jieqinewsidbysecondid( $_POST['categoryid'] );
        if ( is_array( $newsidarray ) && 0 < count( $newsidarray ) )
        {
            $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
            foreach ( $newsidarray as $v )
            {
                if ( !$content_handler->jieqinewscontentdelete( $v ) )
                {
                    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['delete_category_failure'] );
                }
            }
        }
        $criteria = new criteriacompo( new criteria( "secondid", $_POST['categoryid'] ) );
        if ( !$topic_handler->delete( $criteria ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['delete_category_failure'] );
        }
        jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/category.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['delete_category_success'] );
    }
    else
    {
        jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/category.php", LANG_DO_SUCCESS, "" );
    }
}
$category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
if ( $v = $category_handler->get( $_GET['cid'] ) )
{
    $category_form = new jieqithemeform( $jieqiLang[JIEQI_MODULE_NAME]['category_del'], "categorydel", $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/categorydel.php" );
    $option = new jieqiformradio( $jieqiLang[JIEQI_MODULE_NAME]['category_name'].": ".$v->getvar( "categoryname" ), "confirm", "N" );
    $option->addoption( "Y", $jieqiLang[JIEQI_MODULE_NAME]['category_del_yes'] );
    $option->addoption( "N", $jieqiLang[JIEQI_MODULE_NAME]['category_del_no'] );
    $option->setdescription( $jieqiLang[JIEQI_MODULE_NAME]['category_del_cue'] );
    $category_form->addelement( $option );
    $category_form->addelement( new jieqiformhidden( "categoryid", $_GET['cid'] ) );
    $category_form->addelement( new jieqiformhidden( "method", "del" ) );
    $category_form->addelement( new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" ) );
    $jieqiTpl->assign( "category_form_del", $category_form->render( JIEQI_FORM_MAX ) );
}
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/categorydel.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
