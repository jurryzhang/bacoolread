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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newsaddback'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "content", JIEQI_MODULE_NAME );
$jieqi_pagehead = "<script language=\"javascript\" type=\"text/javascript\" src=\"".JIEQI_URL."/lib/html/tinymce/tiny_mce.js\"></script>\r\n\t<script language=\"javascript\" type=\"text/javascript\">\r\n\ttinyMCE.dialog_image_url = \"".$jieqiModules['news']['url']."/admin/upimage.php\";\r\n\ttinyMCE.init({\r\n\tdialog_image_url : \"".$jieqiModules['news']['url']."/admin/upimage.php\",\r\n\tmode : \"exact\",\r\n\telements : \"news_body\",\r\n\ttheme : \"advanced\",\r\n\tlanguage :\"zh\",\r\n\tdialog_type : \"modal\",\r\n\tplugins : \"table,layer,searchreplace,preview,media,emotions\",\r\n\ttheme_advanced_buttons1 : \"newdocument,separator,bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,styleselect,formatselect,fontselect,fontsizeselect\",\r\n\ttheme_advanced_buttons2 : \"cut,copy,paste,separator,search,replace,separator,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,anchor,image,media,charmap,emotions,separator,forecolor,backcolor\",\r\n\ttheme_advanced_buttons3 : \"tablecontrols,separator,hr,removeformat,visualaid,separator,sub,sup,separator,cleanup,preview,code\",\r\n\ttheme_advanced_toolbar_location : \"top\",\r\n\ttheme_advanced_toolbar_align : \"left\",\r\n\ttheme_advanced_path_location : \"bottom\",\r\n\textended_valid_elements : \"hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]\",\r\n\ttheme_advanced_resize_horizontal : false,\r\n\ttheme_advanced_resizing : true,\r\n\tnonbreaking_force_tab : true,\r\n\tapply_source_formatting : true,\r\n\tremove_script_host : false,\r\n\trelative_urls : false \r\n\t});\r\n\t</script>";
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/content.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/filesystem.php" );
if ( isset( $_POST['method'] ) && $_POST['method'] == "add" )
{
    $errtext = "";
    $GLOBALS['_POST']['news_pid'] = intval( trim( $_POST['news_pid'] ) );
    $GLOBALS['_POST']['news_cid'] = intval( trim( $_POST['news_cid'] ) );
    $GLOBALS['_POST']['news_title'] = trim( $_POST['news_title'] );
    $GLOBALS['_POST']['news_keyword'] = trim( $_POST['news_keyword'] );
    $GLOBALS['_POST']['news_source'] = trim( $_POST['news_source'] );
    $GLOBALS['_POST']['news_author'] = trim( $_POST['news_author'] ) ? trim( $_POST['news_author'] ) : $jieqiLang[JIEQI_MODULE_NAME]['news_author_default'];
    $GLOBALS['_POST']['news_summary'] = trim( $_POST['news_summary'] );
    $GLOBALS['_POST']['news_image'] = trim( $_POST['news_image'] );
    $GLOBALS['_POST']['news_body'] = trim( $_POST['news_body'] );
    if ( empty( $_POST['news_pid'] ) )
    {
        $errtext .= $jieqiLang[JIEQI_MODULE_NAME]['need_news_cid']."<br />";
    }
    if ( empty( $_POST['news_cid'] ) )
    {
        $errtext .= $jieqiLang[JIEQI_MODULE_NAME]['need_news_cid']."<br />";
    }
    if ( empty( $_POST['news_title'] ) )
    {
        $errtext .= $jieqiLang[JIEQI_MODULE_NAME]['need_news_title']."<br />";
    }
    if ( empty( $_POST['news_body'] ) )
    {
        $errtext .= $jieqiLang[JIEQI_MODULE_NAME]['need_news_body']."<br />";
    }
    if ( $_POST['news_keyword'] )
    {
        $keywordcount = 0;
        $keywordstring = "";
        $keywordarray = array( );
        $keywordarray = explode( ";", $_POST['news_keyword'] );
        if ( is_array( $keywordarray ) && 0 < count( $keywordarray ) )
        {
            foreach ( $keywordarray as $v )
            {
                if ( 0 < strlen( trim( $v ) ) )
                {
                    $keywordstring .= $v.";";
                    ++$keywordcount;
                }
            }
            if ( $jieqiConfigs[JIEQI_MODULE_NAME]['maxkeyword'] < $keywordcount )
            {
                $errtext .= $jieqiLang[JIEQI_MODULE_NAME]['keyword_over_flow']."<br />";
            }
        }
    }
    if ( empty( $errtext ) )
    {
        $news_path = $jieqiConfigs[JIEQI_MODULE_NAME]['htmlfilespath']."/";
        $news_path .= $_POST['news_pid']."/";
        $news_path .= $_POST['news_cid']."/";
        $news_path .= date( "Ymdhis" ).rand( 1000, 9999 );
        $news_path .= $jieqiConfigs[JIEQI_MODULE_NAME]['htmlextendname'];
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $topicadd = $topic_handler->create( );
        $topicadd->setvar( "firstid", $_POST['news_pid'] );
        $topicadd->setvar( "secondid", $_POST['news_cid'] );
        $topicadd->setvar( "newstitle", $_POST['news_title'] );
        if ( $keywordstring )
        {
            $topicadd->setvar( "newskeyword", $keywordstring );
        }
        $topicadd->setvar( "newsauthorid", 0 );
        $topicadd->setvar( "newsauthor", $_POST['news_author'] );
        $topicadd->setvar( "newsposterid", $_SESSION['jieqiUserId'] );
        $topicadd->setvar( "newsposter", $_SESSION['jieqiUserName'] );
        if ( $_POST['news_source'] )
        {
            $topicadd->setvar( "newssource", $_POST['news_source'] );
        }
        if ( $_POST['news_summary'] )
        {
            $topicadd->setvar( "newssummary", $_POST['news_summary'] );
        }
        if ( $_POST['news_image'] )
        {
            $topicadd->setvar( "newsimage", $_POST['news_image'] );
        }
        if ( !jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newsneedaudit'], $jieqiUsersStatus, $jieqiUsersGroup, true ) && $_SESSION['jieqiUserName'] && $_SESSION['jieqiUserGroup'] == 2 )
        {
            $topicadd->setvar( "newsstatus", 1 );
            jieqi_getcachevars( JIEQI_MODULE_NAME, "newsuplog" );
            if ( !is_array( $jieqiNewsuplog ) )
            {
                $jieqiNewsuplog = array( "t1" => 0, "t2" => 0 );
            }
            $jieqiNewsuplog['t1'] = JIEQI_NOW_TIME;
            jieqi_setcachevars( "newsuplog", "jieqiNewsuplog", $jieqiNewsuplog, JIEQI_MODULE_NAME );
        }
        $topicadd->setvar( "newsdate", date( JIEQI_DATE_FORMAT ) );
        $topicadd->setvar( "newshtmlpath", $news_path );
        $topicadd->setvar( "newsip", jieqi_userip( ) );
        if ( $topic_handler->insert( $topicadd ) )
        {
            $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
            $contentadd = $content_handler->create( );
            $contentadd->setvar( "newsid", $topic_handler->db->getinsertid( ) );
            $contentadd->setvar( "newscontent", $_POST['news_body'] );
            if ( !$content_handler->insert( $contentadd ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_add_failure'] );
            }
        }
        else
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_add_failure'] );
        }
        jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newsadd.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_add_success'] );
    }
    else
    {
        jieqi_printfail( $errtext );
    }
}
$category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
$includejs = "<script src=\"".$jieqiModules[JIEQI_MODULE_NAME]['url']."/js/".JIEQI_CHAR_SET."/news.js\"></script>";
$news_form = new jieqithemeform( $jieqiLang[JIEQI_MODULE_NAME]['news_add'], "newsadd", $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newsadd.php" );
$news_form->setextra( "enctype=\"multipart/form-data\"" );
$news_form->addelement( new jieqiformlabel( $jieqiLang[JIEQI_MODULE_NAME]['news_category'], $category_handler->jieqicategoryselectbox( ).$includejs ) );
$news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_title'], "news_title", 50, 50 ) );
$keys_form = new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_keyword'], "news_keyword", 20, 50 );
$keys_form->setextra( "onKeyUp='this.value=this.value.replace(/[\\uFF1B]/g,\";\");'" );
$keys_form->setdescription( sprintf( $jieqiLang[JIEQI_MODULE_NAME]['news_keyword_des'], $jieqiConfigs[JIEQI_MODULE_NAME]['maxkeyword'] ) );
$news_form->addelement( $keys_form );
$news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_source'], "news_source", 20, 20 ) );
$news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_author'], "news_author", 20, 20 ) );
$news_summary = new jieqiformtextarea( $jieqiLang[JIEQI_MODULE_NAME]['news_summary'], "news_summary", "", 5, 70 );
$news_summary->setdescription( $jieqiLang[JIEQI_MODULE_NAME]['news_summary_des'] );
$news_form->addelement( $news_summary );
$news_image = new jieqiformselect( $jieqiLang[JIEQI_MODULE_NAME]['news_image'], "news_image", null );
$news_image->addoption( "", $jieqiLang[JIEQI_MODULE_NAME]['image_select_default'] );
$news_image->setextra( "onFocus='fetchImagesPath()'" );
$news_form->addelement( $news_image );
$news_body = new jieqiformtextarea( $jieqiLang[JIEQI_MODULE_NAME]['news_body'], "news_body", "", 28, 90 );
$news_body->setextra( "mce_editable=\"true\"" );
$news_form->addelement( $news_body );
$news_form->addelement( new jieqiformhidden( "method", "add" ) );
$on_submit = new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" );
$on_submit->setextra( "onclick=\"return checkFormsInput();\"" );
$news_form->addelement( $on_submit );
$jieqiTpl->assign( "news_add", $news_form->render( JIEQI_FORM_MAX ) );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/newsadd.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
