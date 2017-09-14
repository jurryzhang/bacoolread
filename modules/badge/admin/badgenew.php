<?php
//zend52   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

define( "JIEQI_MODULE_NAME", "badge" );
require_once( "../../../global.php" );
jieqi_getconfigs( JIEQI_MODULE_NAME, "type" );
if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] == 1 )
{
    jieqi_printfail( LANG_ERROR_PARAMETER );
}
$GLOBALS['_REQUEST']['btypeid'] = intval( $_REQUEST['btypeid'] );
$needpower = $jieqiPower['badge']['managesystem'];
switch ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] )
{
case "2" :
    $needpower = $jieqiPower['badge']['managecustom'];
    break;
case "3" :
    $needpower = $jieqiPower['badge']['managemodule'];
    break;
case "1" :
    $needpower = $jieqiPower['badge']['managesystem'];
}
jieqi_getconfigs( JIEQI_MODULE_NAME, "power" );
jieqi_checkpower( $jieqiPower['badge']['managebadge'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_loadlang( "badge", JIEQI_MODULE_NAME );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
if ( !isset( $_REQUEST['action'] ) )
{
    $GLOBALS['_REQUEST']['action'] = "badge";
}
switch ( $_REQUEST['action'] )
{
case "newbadge" :
    $errtext = "";
    $GLOBALS['_POST']['caption'] = trim( $_POST['caption'] );
    if ( strlen( $_POST['caption'] ) == 0 )
    {
        $errtext .= $jieqiLang['badge']['need_badge_caption']."<br />";
    }
    if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] == 3 && !is_numeric( $_POST['linkid'] ) )
    {
        $errtext .= $jieqiLang['badge']['need_badge_linkid']."<br />";
    }
    if ( empty( $_FILES['badgeimage']['name'] ) )
    {
        $errtext .= $jieqiLang['badge']['need_badge_badgeimage']."<br />";
    }
    $image_postfix = "";
    if ( !empty( $_FILES['badgeimage']['name'] ) )
    {
        $image_postfix = strrchr( trim( strtolower( $_FILES['badgeimage']['name'] ) ), "." );
        if ( preg_match( "/\\.(gif|jpg|jpeg|png|bmp)$/i", $_FILES['badgeimage']['name'] ) )
        {
            $typeary = explode( " ", trim( $jieqiConfigs['badge']['imagetype'] ) );
            foreach ( $typeary as $k => $v )
            {
                if ( substr( $v, 0, 1 ) != "." )
                {
                    $typeary[$k] = ".".$typeary[$k];
                }
            }
            if ( !in_array( $image_postfix, $typeary ) )
            {
                $errtext .= sprintf( $jieqiLang['badge']['image_type_error'], $jieqiConfigs['badge']['imagetype'] )."<br />";
            }
            if ( intval( $jieqiConfigs['badge']['maximagesize'] ) * 1024 < $_FILES['badgeimage']['size'] )
            {
                $errtext .= sprintf( $jieqiLang['badge']['upload_filesize_toolarge'], intval( $jieqiConfigs['badge']['maximagesize'] ) )."<br />";
            }
        }
        else
        {
            $errtext .= sprintf( $jieqiLang['badge']['badgeimage_not_image'], $_FILES['badgeimage']['name'] )."<br />";
        }
        if ( !empty( $errtext ) )
        {
            jieqi_delfile( $_FILES['badgeimage']['tmp_name'] );
        }
    }
    if ( empty( $errtext ) )
    {
        include_once( $jieqiModules['badge']['path']."/class/badge.php" );
        $badge_handler =& jieqibadgehandler::getinstance( "JieqiBadgeHandler" );
        if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] == 3 && is_numeric( $_POST['linkid'] ) )
        {
            $GLOBALS['_POST']['linkid'] = intval( $_POST['linkid'] );
            $criteria = new criteriacompo( new criteria( "btypeid", $_REQUEST['btypeid'], "=" ) );
            $criteria->add( new criteria( "linkid", $_POST['linkid'], "=" ) );
            $badge_handler->queryobjects( $criteria );
            if ( $badge_handler->getobject( ) )
            {
                jieqi_printfail( $jieqiLang['badge']['linkid_already_exists'] );
            }
        }
        else
        {
            $criteria = new criteriacompo( new criteria( "btypeid", $_REQUEST['btypeid'], "=" ) );
            $criteria->setsort( "linkid" );
            $criteria->setorder( "DESC" );
            $criteria->setlimit( 1 );
            $badge_handler->queryobjects( $criteria );
            if ( $badge = $badge_handler->getobject( ) )
            {
                $GLOBALS['_POST']['linkid'] = $badge->getvar( "linkid", "n" ) + 1;
            }
            else
            {
                $GLOBALS['_POST']['linkid'] = 1;
            }
        }
        $newBadge = $badge_handler->create( );
        $newBadge->setvar( "btypeid", $_REQUEST['btypeid'] );
        $newBadge->setvar( "caption", $_POST['caption'] );
        $newBadge->setvar( "description", $_POST['description'] );
        $newBadge->setvar( "linkid", $_POST['linkid'] );
        if ( isset( $_POST['maxnum'] ) )
        {
            $GLOBALS['_POST']['maxnum'] = intval( $_POST['maxnum'] );
        }
        else
        {
            $GLOBALS['_POST']['maxnum'] = 0;
        }
        $newBadge->setvar( "maxnum", $_POST['maxnum'] );
        $newBadge->setvar( "usenum", 0 );
        $imagetype = 0;
        if ( !empty( $image_postfix ) )
        {
            $jieqi_image_type = array( 1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp" );
            foreach ( $jieqi_image_type as $k => $v )
            {
                if ( !( $v == $image_postfix ) )
                {
                    continue;
                }
                $imagetype = $k;
                break;
            }
        }
        $newBadge->setvar( "imagetype", $imagetype );
        $newBadge->setvar( "uptime", JIEQI_NOW_TIME );
        if ( !$badge_handler->insert( $newBadge ) )
        {
            jieqi_printfail( $jieqiLang['badge']['badge_add_failure'] );
        }
        else
        {
            if ( !empty( $_FILES['badgeimage']['name'] ) )
            {
                $imagefile = jieqi_uploadpath( $jieqiConfigs['badge']['imagedir'], "badge" );
                if ( !file_exists( $retdir ) )
                {
                    jieqi_createdir( $imagefile );
                }
                $imagefile .= "/".$_REQUEST['btypeid'];
                if ( !file_exists( $retdir ) )
                {
                    jieqi_createdir( $imagefile );
                }
                $imagefile .= jieqi_getsubdir( $_POST['linkid'] );
                if ( !file_exists( $retdir ) )
                {
                    jieqi_createdir( $imagefile );
                }
                $imagefile .= "/".$_POST['linkid'].$image_postfix;
                jieqi_copyfile( $_FILES['badgeimage']['tmp_name'], $imagefile, 511, true );
            }
            jieqi_jumppage( $jieqiModules['badge']['url']."/admin/badgelist.php?btypeid=".$_REQUEST['btypeid'], LANG_DO_SUCCESS, $jieqiLang['badge']['badge_add_success'] );
        }
    }
    else
    {
        jieqi_printfail( $errtext );
    }
    break;
case "badge" :
    include_once( JIEQI_ROOT_PATH."/admin/header.php" );
    include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
    $badge_form = new jieqithemeform( $jieqiLang['badge']['badge_new']." (".$jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['title'].")", "newbadge", $jieqiModules['badge']['url']."/admin/badgenew.php" );
    $badge_form->setextra( "enctype=\"multipart/form-data\"" );
    $badge_form->addelement( new jieqiformtext( $jieqiLang['badge']['table_badge_caption'], "caption", 30, 100, htmlspecialchars( strval( $_REQUEST['caption'] ), ENT_QUOTES ) ), true );
    if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] == 3 )
    {
        $linkid = new jieqiformtext( $jieqiLang['badge']['table_badge_linkid'], "linkid", 30, 11, htmlspecialchars( strval( $_REQUEST['linkid'] ), ENT_QUOTES ) );
        $linkid->setdescription( $jieqiLang['badge']['badge_linkid_desc'] );
        $badge_form->addelement( $linkid );
    }
    $maxnum = new jieqiformtext( $jieqiLang['badge']['badge_maxnum'], "maxnum", 30, 11, intval( $jieqiConfigs['badge']['defaultmaxnum'] ) );
    $maxnum->setdescription( $jieqiLang['badge']['badge_maxnum_desc'] );
    $badge_form->addelement( $maxnum );
    $badgeimage = new jieqiformfile( $jieqiLang['badge']['badge_image'], "badgeimage", 30 );
    $badgeimage->setdescription( sprintf( $jieqiLang['badge']['badge_image_type'], $jieqiConfigs['badge']['imagetype'] ) );
    $badge_form->addelement( $badgeimage );
    $badge_form->addelement( new jieqiformhidden( "action", "newbadge" ) );
    $badge_form->addelement( new jieqiformhidden( "btypeid", $_REQUEST['btypeid'] ) );
    $badge_form->addelement( new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" ) );
    $jieqiTpl->assign( "jieqi_contents", $badge_form->render( JIEQI_FORM_MIDDLE ) );
    include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
}
?>
