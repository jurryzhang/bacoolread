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
jieqi_checkpower( $jieqiPower[JIEQI_MODULE_NAME]['attachadd'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
jieqi_loadlang( "content", JIEQI_MODULE_NAME );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/attachment.php" );
if ( !empty( $_REQUEST['src'] ) )
{
    $imageurl = $_REQUEST['src'];
}
else
{
    $imageurl = "";
}
if ( $_POST['action'] == "upload" && !empty( $_FILES['imgfile']['name'] ) )
{
    $errtext = "";
    if ( preg_match( "/\\.(".str_replace( " ", "|", trim( $jieqiConfigs[JIEQI_MODULE_NAME]['imagetype'] ) ).")\$/is", $_FILES['imgfile']['name'], $matches ) )
    {
        if ( !preg_match( "/\\.(jpg|jpeg|gif|png|bmp)\$/is", $_FILES['imgfile']['name'] ) )
        {
            $errtext .= sprintf( $jieqiLang[JIEQI_MODULE_NAME]['deny_upimage_type'], "*.".$matches[1] )."<br />";
        }
        else if ( $jieqiConfigs[JIEQI_MODULE_NAME]['maximagesize'] < round( $_FILES['imgfile']['size'] / 1024, 0 ) )
        {
            $errtext .= sprintf( $jieqiLang[JIEQI_MODULE_NAME]['over_upimage_size'], $jieqiConfigs[JIEQI_MODULE_NAME]['maximagesize']."K" )."<br />";
        }
        else
        {
            $imagefile = jieqi_uploadpath( $jieqiConfigs[JIEQI_MODULE_NAME]['imagedir'], JIEQI_MODULE_NAME );
            if ( !file_exists( $imagefile ) )
            {
                @mkdir( $imagefile, 511 );
                @chmod( $imagefile, 511 );
            }
            $imagefile .= "/".date( "Ymd", JIEQI_NOW_TIME );
            if ( !file_exists( $imagefile ) )
            {
                @mkdir( $imagefile, 511 );
                @chmod( $imagefile, 511 );
            }
            $imagefile .= "/".uniqid( rand( ) ).$matches[0];
            jieqi_copyfile( $_FILES['imgfile']['tmp_name'], $imagefile, 511, true );
            $imageurl = JIEQI_URL.substr( $imagefile, strlen( JIEQI_ROOT_PATH ) );
            $attach_handler = jieqiattachmenthandler::getinstance( "JieqiAttachmentHandler" );
            $attachadd = $attach_handler->create( );
            $attachadd->setvar( "attachname", basename( $imageurl ) );
            $attachadd->setvar( "attachtype", substr( $imageurl, strrpos( $imageurl, "." ) + 1 ) );
            $attachadd->setvar( "attachpath", substr( $imageurl, strlen( JIEQI_URL ) ) );
            $attachadd->setvar( "attachsize", round( $_FILES['imgfile']['size'] / 1024, 0 ) );
            $attachadd->setvar( "attachdate", date( JIEQI_DATE_FORMAT ) );
            if ( !$attach_handler->insert( $attachadd ) )
            {
                jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['add_attach_failure'] );
            }
        }
    }
    else
    {
        $errtext .= sprintf( $jieqiLang[JIEQI_MODULE_NAME]['error_upimage_type'], $_FILES['imgfile']['name'], $jieqiConfigs[JIEQI_MODULE_NAME]['imagetype'] )."<br />";
    }
    if ( !empty( $errtext ) )
    {
        jieqi_delfile( $_FILES['imgfile']['tmp_name'] );
        jieqi_printfail( $errtext );
    }
}
include_once( JIEQI_ROOT_PATH."/lib/template/template.php" );
$jieqiTpl =& jieqitpl::getinstance( );
$jieqiTpl->setcaching( 0 );
$jieqiTpl->assign( array(
    "jieqi_themeurl" => JIEQI_URL."/templates/admin/",
    "jieqi_sitename" => JIEQI_SITE_NAME,
    "jieqi_email" => JIEQI_CONTACT_EMAIL,
    "meta_keywords" => JIEQI_META_KEYWORDS,
    "meta_description" => JIEQI_META_DESCRIPTION,
    "meta_author" => JIEQI_META_AUTHOR,
    "meta_copyright" => JIEQI_META_COPYRIGHT
) );
$jieqiTpl->assign( "imageurl", $imageurl );
$jieqiTpl->display( $jieqiModules[JIEQI_MODULE_NAME]['path']."/templates/admin/upimage.html" );
?>
