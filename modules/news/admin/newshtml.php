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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newshtml'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "content", JIEQI_MODULE_NAME );
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/content.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/filesystem.php" );
if ( isset( $_POST['method'] ) && $_POST['method'] == "create" )
{
    if ( !$_POST['newstemplate'] )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_template_error'] );
    }
    $GLOBALS['_POST']['newstemplate'] = substr( $_POST['newstemplate'], 0, strpos( $_POST['newstemplate'], "." ) ).".html";
    if ( !file_exists( $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/".$_POST['newstemplate'] ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['file_not_found'] );
    }
    include_once( JIEQI_ROOT_PATH."/header.php" );
    $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
    $jieqiTpl->assign( "jieqi_themeurl", JIEQI_URL."/themes/".JIEQI_THEME_NAME."/" );
    $jieqiTpl->assign( "jieqi_userid", 0 );
    if ( $_POST['htmltype'] == 1 )
    {
        if ( !jieqinumericcheck( 1, 5, $_POST['news_pid'] ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
        }
        if ( !jieqinumericcheck( 0, 5, $_POST['news_cid'] ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['category_id_error'] );
        }
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $criteria = new criteriacompo( );
        if ( $_POST['news_pid'] )
        {
            $criteria->add( new criteria( "firstid", $_POST['news_pid'] ) );
        }
        if ( $_POST['news_cid'] )
        {
            $criteria->add( new criteria( "secondid", $_POST['news_cid'] ) );
        }
        if ( !( $result = $topic_handler->queryobjects( $criteria ) ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
        }
        $filecount = 0;
        while ( $v = $topic_handler->getobject( $result ) )
        {
            ob_start( );
            $category_handler = jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
            $jieqiTpl->assign( "id", $v->getvar( "newsid" ) );
            $jieqiTpl->assign( "title", $v->getvar( "newstitle" ) );
            $jieqiTpl->assign( "source", $v->getvar( "newssource" ) );
            $jieqiTpl->assign( "author", $v->getvar( "newsauthor" ) );
            $jieqiTpl->assign( "poster", $v->getvar( "newsposter" ) );
            $jieqiTpl->assign( "date", $v->getvar( "newsdate" ) );
            $jieqiTpl->assign( "body", stripslashes( html_entity_decode( $content_handler->jieqinewscontentbyid( $v->getvar( "newsid" ) ) ) ) );
            $jieqiTpl->assign( "url_gb2312", $jieqiModules[JIEQI_MODULE_NAME]['url']."/newshow.php?id=".$v->getvar( "newsid" )."&charset=gbk" );
            $jieqiTpl->assign( "url_big5", $jieqiModules[JIEQI_MODULE_NAME]['url']."/newshow.php?id=".$v->getvar( "newsid" )."&charset=big5" );
            $jieqiTpl->assign( "iconpath", $jieqiModules[JIEQI_MODULE_NAME]['url']."/images/" );
            $jieqiTpl->assign( "nav_list", $category_handler->jieqinavigationbar( $v->getvar( "firstid" ), $v->getvar( "secondid" ) ) );
            $jieqiTpl->assign( "stat_url", $jieqiModules[JIEQI_MODULE_NAME]['url']."/ajaxstatus.php" );
            $jieqiTpl->assign( "relt_url", $jieqiModules[JIEQI_MODULE_NAME]['url']."/ajaxrelate.php" );
            $jieqiTpl->assign( "relt_show", $jieqiConfigs[JIEQI_MODULE_NAME]['relatenewsenable'] );
            $jieqiTpl->setcaching( 0 );
            $jieqiTpl->assign( "jieqi_contents", $jieqiTpl->fetch( $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/".$_POST['newstemplate'] ) );
            include( JIEQI_ROOT_PATH."/footer.php" );
            $file_name = "../../../files/".JIEQI_MODULE_NAME."/".$v->getvar( "newshtmlpath" );
            $file_content = ob_get_contents( );
            if ( !jieqi_filewrite( $file_name, $file_content ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['create_html_failure'] );
            }
            ++$filecount;
            ob_end_clean( );
        }
        jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newshtml.php", LANG_DO_SUCCESS, sprintf( $jieqiLang[JIEQI_MODULE_NAME]['create_html_success'], $filecount ) );
    }
    else if ( $_POST['htmltype'] == 2 )
    {
        if ( !jieqinumericcheck( 1, 10, $_POST['newsidstart'] ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
        }
        if ( !jieqinumericcheck( 1, 10, $_POST['newsidend'] ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
        }
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $criteria = new criteriacompo( );
        $criteria->add( new criteria( "newsid", $_POST['newsidstart'], ">=" ) );
        $criteria->add( new criteria( "newsid", $_POST['newsidend'], "<=" ), "AND" );
        if ( !( $result = $topic_handler->queryobjects( $criteria ) ) )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
        }
        $filecount = 0;
        while ( $v = $topic_handler->getobject( $result ) )
        {
            ob_start( );
            $category_handler = jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
            $jieqiTpl->assign( "id", $v->getvar( "newsid" ) );
            $jieqiTpl->assign( "title", $v->getvar( "newstitle" ) );
            $jieqiTpl->assign( "source", $v->getvar( "newssource" ) );
            $jieqiTpl->assign( "author", $v->getvar( "newsauthor" ) );
            $jieqiTpl->assign( "poster", $v->getvar( "newsposter" ) );
            $jieqiTpl->assign( "date", $v->getvar( "newsdate" ) );
            $jieqiTpl->assign( "body", stripslashes( html_entity_decode( $content_handler->jieqinewscontentbyid( $v->getvar( "newsid" ) ) ) ) );
            $jieqiTpl->assign( "url_gb2312", $jieqiModules[JIEQI_MODULE_NAME]['url']."/newshow.php?id=".$v->getvar( "newsid" )."&charset=gbk" );
            $jieqiTpl->assign( "url_big5", $jieqiModules[JIEQI_MODULE_NAME]['url']."/newshow.php?id=".$v->getvar( "newsid" )."&charset=big5" );
            $jieqiTpl->assign( "iconpath", $jieqiModules[JIEQI_MODULE_NAME]['url']."/images/" );
            $jieqiTpl->assign( "nav_list", $category_handler->jieqinavigationbar( $v->getvar( "firstid" ), $v->getvar( "secondid" ) ) );
            $jieqiTpl->assign( "stat_url", $jieqiModules[JIEQI_MODULE_NAME]['url']."/ajaxstatus.php" );
            $jieqiTpl->assign( "relt_url", $jieqiModules[JIEQI_MODULE_NAME]['url']."/ajaxrelate.php" );
            $jieqiTpl->assign( "relt_show", $jieqiConfigs[JIEQI_MODULE_NAME]['relatenewsenable'] );
            $jieqiTpl->setcaching( 0 );
            $jieqiTpl->assign( "jieqi_contents", $jieqiTpl->fetch( $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/".$_POST['newstemplate'] ) );
            include( JIEQI_ROOT_PATH."/footer.php" );
            $file_content = ob_get_contents( );
            $file_name = "../../../files/".JIEQI_MODULE_NAME."/".$v->getvar( "newshtmlpath" );
            if ( !jieqi_filewrite( $file_name, $file_content ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['create_html_failure'] );
            }
            ++$filecount;
            ob_end_clean( );
        }
        jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newshtml.php", LANG_DO_SUCCESS, sprintf( $jieqiLang[JIEQI_MODULE_NAME]['create_html_success'], $filecount ) );
    }
}
$category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
$includejs = "<script src=\"".$jieqiModules[JIEQI_MODULE_NAME]['url']."/js/".JIEQI_CHAR_SET."/html.js\"></script>";
$news_form = new jieqithemeform( $jieqiLang[JIEQI_MODULE_NAME]['news_html'], "newshtml", $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newshtml.php" );
$html_type = new jieqiformradio( $jieqiLang[JIEQI_MODULE_NAME]['html_type'], "htmltype", "1" );
$html_type->setextra( "onClick='setElementsUseable()'" );
$html_type->addoption( "1", $jieqiLang[JIEQI_MODULE_NAME]['html_by_category'] );
$html_type->addoption( "2", $jieqiLang[JIEQI_MODULE_NAME]['html_by_id'] );
$news_form->addelement( $html_type );
$news_form->addelement( new jieqiformlabel( $jieqiLang[JIEQI_MODULE_NAME]['news_category'], $category_handler->jieqicategoryselectbox( ) ) );
$news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_id_start'], "newsidstart", 10, 10 ) );
$news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_id_end'], "newsidend", 10, 10 ) );
$news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_template'], "newstemplate", 20, 20, "newstohtml.html" ) );
$news_form->addelement( new jieqiformhidden( "method", "create" ) );
$on_submit = new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" );
$on_submit->setextra( "onclick=\"return checkFormsInput();\"" );
$news_form->addelement( $on_submit );
$jieqiTpl->assign( "news_html", $news_form->render( JIEQI_FORM_MAX ).$includejs );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/newshtml.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
