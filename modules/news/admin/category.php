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
if ( isset( $_POST['checkaction'] ) && $_POST['checkaction'] == 1 && is_array( $_POST['checkid'] ) && 0 < count( $_POST['checkid'] ) )
{
    foreach ( $GLOBALS['_POST']['checkid'] as $v )
    {
        if ( !jieqinumericcheck( 0, 5, $v ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
        }
        $category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
        if ( $category_handler->jieqicategorychildcount( $criteria = new criteriacompo( new criteria( "parentid", $v ) ) ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_has_child'] );
        }
        $criteria = new criteriacompo( );
        $criteria->add( new criteria( "categoryid", $v ) );
        if ( !$category_handler->delete( $criteria ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['delete_category_failure'] );
        }
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $newsidarray = $topic_handler->jieqinewsidbysecondid( $v );
        if ( is_array( $newsidarray ) && 0 < count( $newsidarray ) )
        {
            $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
            foreach ( $newsidarray as $m )
            {
                if ( !$content_handler->jieqinewscontentdelete( $m ) )
                {
                    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['delete_category_failure'] );
                }
            }
        }
        $criteria = new criteriacompo( new criteria( "secondid", $v ) );
        if ( !$topic_handler->delete( $criteria ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['delete_category_failure'] );
        }
    }
    jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/category.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['delete_category_success'] );
}
$category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
$criteria = new criteriacompo( new criteria( "parentid", 0 ) );
$criteria->setsort( "categoryorder" );
if ( !( $result = $category_handler->queryobjects( $criteria ) ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_query_error'] );
}
$category_array = array( );
$i = 0;
while ( $category_data = $category_handler->getrow( $result ) )
{
    $category_array[$i]['cid'] = $category_data['categoryid'];
    $category_array[$i]['pid'] = $category_data['parentid'];
    $category_array[$i]['cname'] = $category_data['categoryname'];
    $category_array[$i]['corder'] = $category_data['categoryorder'];
    $category_array[$i]['addurl'] = "categoryadd.php?cid=".$category_data['categoryid'];
    $category_array[$i]['delurl'] = "categorydel.php?cid=".$category_data['categoryid'];
    $category_array[$i]['taxurl'] = "categorytaxis.php?cid=".$category_data['categoryid'];
    $category_array[$i]['editurl'] = "categoryedit.php?cid=".$category_data['categoryid'];
    $category_array[$i]['checkbox'] = "<input type=\"checkbox\" id=\"checkid[]\" name=\"checkid[]\" value=\"".$category_data['categoryid']."\" />";
    ++$i;
    $criteria2 = new criteriacompo( new criteria( "parentid", $category_data['categoryid'] ) );
    $criteria2->setsort( "categoryorder" );
    if ( !( $result2 = $category_handler->queryobjects( $criteria2 ) ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_query_error'] );
    }
    while ( $category_data2 = $category_handler->getrow( $result2 ) )
    {
        $category_array[$i]['cid'] = $category_data2['categoryid'];
        $category_array[$i]['pid'] = $category_data2['parentid'];
        $category_array[$i]['cname'] = $category_data2['categoryname'];
        $category_array[$i]['corder'] = $category_data2['categoryorder'];
        $category_array[$i]['delurl'] = "categorydel.php?cid=".$category_data2['categoryid'];
        $category_array[$i]['editurl'] = "categoryedit.php?cid=".$category_data2['categoryid'];
        $category_array[$i]['checkbox'] = "<input type=\"checkbox\" id=\"checkid[]\" name=\"checkid[]\" value=\"".$category_data2['categoryid']."\" />";
        ++$i;
    }
}
$jieqiTpl->assign( "jieqi_news_url", $jieqiModules[JIEQI_MODULE_NAME]['url']."/" );
$jieqiTpl->assign( "form_url_action", "category.php" );
$jieqiTpl->assign( "category_add_root_url", "categoryadd.php" );
$jieqiTpl->assign( "category_tax_root_url", "categorytaxis.php" );
$jieqiTpl->assign( "category_list", $category_array );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/category.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
