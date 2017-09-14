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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newsedit'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "content", JIEQI_MODULE_NAME );
$jieqi_pagehead = "<script language=\"javascript\" type=\"text/javascript\" src=\"".JIEQI_URL."/lib/html/tinymce/tiny_mce.js\"></script>\r\n\t<script language=\"javascript\" type=\"text/javascript\">\r\n\ttinyMCE.dialog_image_url = \"".$jieqiModules['news']['url']."/admin/upimage.php\";\r\n\ttinyMCE.init({\r\n\tmode : \"exact\",\r\n\telements : \"news_body\",\r\n\ttheme : \"advanced\",\r\n\tlanguage :\"zh\",\r\n\tdialog_type : \"modal\",\r\n\tplugins : \"table,layer,searchreplace,preview,media,emotions\",\r\n\ttheme_advanced_buttons1 : \"newdocument,separator,bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,styleselect,formatselect,fontselect,fontsizeselect\",\r\n\ttheme_advanced_buttons2 : \"cut,copy,paste,separator,search,replace,separator,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,anchor,image,media,charmap,emotions,separator,forecolor,backcolor\",\r\n\ttheme_advanced_buttons3 : \"tablecontrols,separator,hr,removeformat,visualaid,separator,sub,sup,separator,cleanup,preview,code\",\r\n\ttheme_advanced_toolbar_location : \"top\",\r\n\ttheme_advanced_toolbar_align : \"left\",\r\n\ttheme_advanced_path_location : \"bottom\",\r\n\textended_valid_elements : \"hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]\",\r\n\ttheme_advanced_resize_horizontal : false,\r\n\ttheme_advanced_resizing : true,\r\n\tnonbreaking_force_tab : true,\r\n\tapply_source_formatting : true,\r\n\tremove_script_host : false,\r\n\trelative_urls : false \r\n\t});\r\n\t</script>";
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/content.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/filesystem.php" );
if ( isset( $_POST['method'] ) && $_POST['method'] == "edit" )
{
    $errtext = "";
    $GLOBALS['_POST']['news_id'] = intval( trim( $_POST['news_id'] ) );
    $GLOBALS['_POST']['news_pid'] = intval( trim( $_POST['news_pid'] ) );
    $GLOBALS['_POST']['news_cid'] = intval( trim( $_POST['news_cid'] ) );
    $GLOBALS['_POST']['news_title'] = trim( $_POST['news_title'] );
    $GLOBALS['_POST']['news_keyword'] = trim( $_POST['news_keyword'] );
    $GLOBALS['_POST']['news_source'] = trim( $_POST['news_source'] );
    $GLOBALS['_POST']['news_author'] = trim( $_POST['news_author'] ) ? trim( $_POST['news_author'] ) : $jieqiLang[JIEQI_MODULE_NAME]['news_author_default'];
    $GLOBALS['_POST']['news_summary'] = trim( $_POST['news_summary'] );
    $GLOBALS['_POST']['news_image'] = trim( $_POST['news_image'] );
    $GLOBALS['_POST']['news_body'] = trim( $_POST['news_body'] );
    if ( empty( $_POST['news_id'] ) )
    {
        $errtext .= $jieqiLang[JIEQI_MODULE_NAME]['need_news_id']."<br />";
    }
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
        $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
        $topicedit = $topic_handler->get( $_POST['news_id'] );
        if ( $_SESSION['jieqiUserGroup'] != 2 && $topicedit->getvar( "newsposterid" ) != $_SESSION['jieqiUserId'] )
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_update_failure'] );
        }
        $topicedit->setvar( "firstid", $_POST['news_pid'] );
        $topicedit->setvar( "secondid", $_POST['news_cid'] );
        $topicedit->setvar( "newstitle", $_POST['news_title'] );
        if ( $keywordstring )
        {
            $topicedit->setvar( "newskeyword", $keywordstring );
        }
        $topicedit->setvar( "newsauthor", $_POST['news_author'] );
        if ( $_POST['news_source'] )
        {
            $topicedit->setvar( "newssource", $_POST['news_source'] );
        }
        if ( $_POST['news_summary'] )
        {
            $topicedit->setvar( "newssummary", $_POST['news_summary'] );
        }
        if ( $_POST['news_image'] )
        {
            $topicedit->setvar( "newsimage", $_POST['news_image'] );
        }
        $topicedit->setvar( "newsputtop", 0 );
        if ( jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['newsneedaudit'], $jieqiUsersStatus, $jieqiUsersGroup, true ) && $_SESSION['jieqiUserGroup'] != 2 )
        {
            $topicedit->setvar( "newsstatus", 0 );
            jieqi_getcachevars( JIEQI_MODULE_NAME, "newsuplog" );
            if ( !is_array( $jieqiNewsuplog ) )
            {
                $jieqiNewsuplog = array( "t1" => 0, "t2" => 0 );
            }
            $jieqiNewsuplog['t1'] = JIEQI_NOW_TIME;
            jieqi_setcachevars( "newsuplog", "jieqiNewsuplog", $jieqiNewsuplog, JIEQI_MODULE_NAME );
        }
        $topicedit->setvar( "newsdate", date( JIEQI_DATE_FORMAT ) );
        $topicedit->setvar( "newsip", jieqi_userip( ) );
        if ( $topic_handler->insert( $topicedit ) )
        {
            $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
            if ( $content_handler->jieqinewscontentexsit( $_POST['news_id'] ) )
            {
                if ( !$content_handler->jieqinewscontentupdate( $_POST['news_id'], $_POST['news_body'] ) )
                {
                    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_update_failure'] );
                }
            }
            else
            {
                $contentadd = $content_handler->create( );
                $contentadd->setvar( "newsid", $_POST['news_id'] );
                $contentadd->setvar( "newscontent", $_POST['news_body'] );
                if ( !$content_handler->insert( $contentadd ) )
                {
                    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_update_failure'] );
                }
            }
        }
        else
        {
            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_update_failure'] );
        }
        jieqi_jumppage( $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newslist.php", LANG_DO_SUCCESS, $jieqiLang[JIEQI_MODULE_NAME]['news_update_success'] );
    }
    else
    {
        jieqi_printfail( $errtext );
    }
}
if ( !jieqinumericcheck( 1, 10, $_GET['id'] ) )
{
    jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
}
$topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
if ( $v = $topic_handler->get( $_GET['id'] ) )
{
    $category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
    $content_handler = jieqinewscontenthandler::getinstance( "JieqiNewsContentHandler" );
    $includejs = "<script src=\"".$jieqiModules[JIEQI_MODULE_NAME]['url']."/js/".JIEQI_CHAR_SET."/news.js\"></script>";
    $news_form = new jieqithemeform( $jieqiLang[JIEQI_MODULE_NAME]['news_edit'], "newsedit", $jieqiModules[JIEQI_MODULE_NAME]['url']."/admin/newsedit.php" );
    $news_form->setextra( "enctype=\"multipart/form-data\"" );
    $news_form->addelement( new jieqiformlabel( $jieqiLang[JIEQI_MODULE_NAME]['news_category'], $category_handler->jieqicategoryselectbox( ).$category_handler->jieqiselectboxdefault( $v->getvar( "firstid" ), $v->getvar( "secondid" ) ).$includejs ) );
    $news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_title'], "news_title", 50, 50, $v->getvar( "newstitle" ) ) );
    $keys_form = new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_keyword'], "news_keyword", 20, 50, $v->getvar( "newskeyword" ) );
    $keys_form->setextra( "onKeyUp='this.value=this.value.replace(/[\\uFF1B]/g,\";\");'" );
    $keys_form->setdescription( sprintf( $jieqiLang[JIEQI_MODULE_NAME]['news_keyword_des'], $jieqiConfigs[JIEQI_MODULE_NAME]['maxkeyword'] ) );
    $news_form->addelement( $keys_form );
    $news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_source'], "news_source", 20, 20, $v->getvar( "newssource" ) ) );
    $news_form->addelement( new jieqiformtext( $jieqiLang[JIEQI_MODULE_NAME]['news_author'], "news_author", 20, 20, $v->getvar( "newsauthor" ) ) );
    $news_summary = new jieqiformtextarea( $jieqiLang[JIEQI_MODULE_NAME]['news_summary'], "news_summary", $v->getvar( "newssummary" ), 3, 70 );
    $news_summary->setdescription( $jieqiLang[JIEQI_MODULE_NAME]['news_summary_des'] );
    $news_form->addelement( $news_summary );
    $news_image = new jieqiformselect( $jieqiLang[JIEQI_MODULE_NAME]['news_image'], "news_image", null );
    $news_image->addoption( "", $jieqiLang[JIEQI_MODULE_NAME]['image_select_default'] );
    $news_image->setextra( "onFocus='fetchImagesPath()'" );
    $news_form->addelement( $news_image );
    $news_body = new jieqiformtextarea( $jieqiLang[JIEQI_MODULE_NAME]['news_body'], "news_body", stripslashes( html_entity_decode( $content_handler->jieqinewscontentbyid( $v->getvar( "newsid" ) ) ) ), 28, 90 );
    $news_body->setextra( "mce_editable=\"true\"" );
    $news_form->addelement( $news_body );
    $news_form->addelement( new jieqiformhidden( "news_id", $_GET['id'] ) );
    $news_form->addelement( new jieqiformhidden( "method", "edit" ) );
    $on_submit = new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" );
    $on_submit->setextra( "onclick=\"return checkFormsInput();\"" );
    $news_form->addelement( $on_submit );
    $jieqiTpl->assign( "news_edit", $news_form->render( JIEQI_FORM_MAX ) );
    $jieqiTpl->setcaching( 0 );
    $jieqiTset['jieqi_contents_template'] = $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/newsedit.html";
}
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
