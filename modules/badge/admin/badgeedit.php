<?php
//zend52   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

define( "JIEQI_MODULE_NAME", "badge" );
require_once( "../../../global.php" );
jieqi_getconfigs( JIEQI_MODULE_NAME, "type" );
if ( !isset( $_REQUEST['btypeid'], $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']], $_REQUEST['linkid'] ) || !is_numeric( $_REQUEST['linkid'] ) )
{
    jieqi_printfail( LANG_ERROR_PARAMETER );
}
$GLOBALS['_REQUEST']['btypeid'] = intval( $_REQUEST['btypeid'] );
$GLOBALS['_REQUEST']['linkid'] = intval( $_REQUEST['linkid'] );
$needpower = $jieqiPower['badge']['managesystem'];
$badge_sysflag = 0;
switch ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] )
{
case "2" :
    $badge_sysflag = 2;
    $needpower = $jieqiPower['badge']['managecustom'];
    break;
case "3" :
    $badge_sysflag = 3;
    $needpower = $jieqiPower['badge']['managemodule'];
    break;
case "1" :
    $badge_sysflag = 1;
    $needpower = $jieqiPower['badge']['managesystem'];
}
jieqi_getconfigs( JIEQI_MODULE_NAME, "power" );
jieqi_checkpower( $jieqiPower['badge']['managebadge'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_loadlang( "badge", JIEQI_MODULE_NAME );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
if ( $_REQUEST['btypeid'] == 1 )
{
    if ( !isset( $jieqiGroups[$_REQUEST['linkid']] ) )
    {
        jieqi_printfail( $jieqiLang['badge']['badge_not_exists'] );
    }
    else
    {
        $badge_name = $jieqiGroups[$_REQUEST['linkid']];
    }
    $badge_maxnum = 0;
    $badge_linkid = 0;
}
else if ( $_REQUEST['btypeid'] == 2 )
{
    jieqi_getconfigs( "system", "honors" );
    if ( !isset( $jieqiHonors[$_REQUEST['linkid']] ) )
    {
        jieqi_printfail( $jieqiLang['badge']['badge_not_exists'] );
    }
    else
    {
        $badge_name = isset( $jieqiHonors[$_REQUEST['linkid']]['caption'] ) ? $jieqiHonors[$_REQUEST['linkid']]['caption'] : $jieqiHonors[$_REQUEST['linkid']]['name']['0'];
    }
    $badge_maxnum = 0;
    $badge_linkid = 0;
}

else if ( $_REQUEST['btypeid'] == 3 )
{
    jieqi_getconfigs( "system", "vips" );
    if ( !isset( $jieqiVips[$_REQUEST['linkid']] ) )
    {
        jieqi_printfail( $jieqiLang['badge']['badge_not_exists'] );
    }
    else
    {
        $badge_name = isset( $jieqiVips[$_REQUEST['linkid']]['caption'] ) ? $jieqiVips[$_REQUEST['linkid']]['caption'] : $jieqiVips[$_REQUEST['linkid']]['name']['0'];
    }
    $badge_maxnum = 0;
    $badge_linkid = 0;
}
else
{
    include_once( $jieqiModules['badge']['path']."/class/badge.php" );
    $badge_handler =& jieqibadgehandler::getinstance( "JieqiBadgeHandler" );
    if ( is_numeric( $_REQUEST['badgeid'] ) )
    {
        $badge = $badge_handler->get( intval( $_REQUEST['badgeid'] ) );
    }
    else
    {
        $criteria = new criteriacompo( new criteria( "btypeid", $_REQUEST['btypeid'] ) );
        $criteria->add( new criteria( "linkid", $_REQUEST['linkid'] ) );
        $badge_handler->queryobjects( $criteria );
        $badge = $badge_handler->getobject( );
    }
    if ( is_object( $badge ) )
    {
        $badge_name = $badge->getvar( "caption", "n" );
        $badge_maxnum = $badge->getvar( "maxnum", "n" );
        $badge_linkid = $badge->getvar( "linkid", "n" );
    }
    else
    {
        jieqi_printfail( $jieqiLang['badge']['badge_not_exists'] );
    }
}
if ( !isset( $badge_handler ) )
{
    include_once( $jieqiModules['badge']['path']."/class/badge.php" );
    $badge_handler =& jieqibadgehandler::getinstance( "JieqiBadgeHandler" );
}
include_once( $jieqiModules['badge']['path']."/include/badgefunction.php" );
if ( !isset( $_REQUEST['action'] ) )
{
    $GLOBALS['_REQUEST']['action'] = "badge";
}
switch ( $_REQUEST['action'] )
{
case "editbadge" :
    $errtext = "";
    if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] != 1 )
    {
        $GLOBALS['_POST']['caption'] = trim( $_POST['caption'] );
        if ( strlen( $_POST['caption'] ) == 0 )
        {
            $errtext .= $jieqiLang['badge']['need_badge_caption']."<br />";
        }
    }
    if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] == 3 && !is_numeric( $_REQUEST['linkid'] ) )
    {
        $errtext .= $jieqiLang['badge']['need_badge_linkid']."<br />";
    }
    $image_postfix = "";
    if ( !empty( $_FILES['badgeimage']['name'] ) )
    {
        if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] == 1 )
        {
            $allow_imagetype = $jieqiConfigs['badge']['sysimgtype'];
        }
        else
        {
            $allow_imagetype = $jieqiConfigs['badge']['imagetype'];
        }
        $image_postfix = strrchr( trim( strtolower( $_FILES['badgeimage']['name'] ) ), "." );
        if ( preg_match( "/\\.(gif|jpg|jpeg|png|bmp)$/i", $_FILES['badgeimage']['name'] ) )
        {
            $typeary = explode( " ", trim( $allow_imagetype ) );
            foreach ( $typeary as $k => $v )
            {
                if ( substr( $v, 0, 1 ) != "." )
                {
                    $typeary[$k] = ".".$typeary[$k];
                }
            }
            if ( !in_array( $image_postfix, $typeary ) )
            {
                $errtext .= sprintf( $jieqiLang['badge']['image_type_error'], $allow_imagetype )."<br />";
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
        if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] != 1 )
        {
            $badge->setvar( "caption", $_POST['caption'] );
            if ( isset( $_POST['maxnum'] ) )
            {
                $GLOBALS['_POST']['maxnum'] = intval( $_POST['maxnum'] );
            }
            else
            {
                $GLOBALS['_POST']['maxnum'] = 0;
            }
            $badge->setvar( "maxnum", $_POST['maxnum'] );
            $badge->setvar( "uptime", JIEQI_NOW_TIME );
            if ( !empty( $_FILES['badgeimage']['name'] ) )
            {
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
                $badge->setvar( "imagetype", $imagetype );
            }
            if ( !$badge_handler->insert( $badge ) )
            {
                jieqi_printfail( $jieqiLang['badge']['badge_edit_failure'] );
            }
            $old_imagetype = $badge->getvar( "imagetype", "n" );
        }
        else
        {
            $old_imagetype = $jieqiConfigs['badge']['sysimgtype'];
        }
        if ( !empty( $_FILES['badgeimage']['name'] ) )
        {
            $old_imagepath = getbadgepath( $_REQUEST['btypeid'], $_REQUEST['linkid'], $old_imagetype );
            if ( is_file( $old_imagepath ) )
            {
                jieqi_delfile( $old_imagepath );
            }
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
            $imagefile .= jieqi_getsubdir( $_REQUEST['linkid'] );
            if ( !file_exists( $retdir ) )
            {
                jieqi_createdir( $imagefile );
            }
            $imagefile .= "/".$_REQUEST['linkid'].$image_postfix;
            jieqi_copyfile( $_FILES['badgeimage']['tmp_name'], $imagefile, 511, true );
        }
        jieqi_jumppage( $jieqiModules['badge']['url']."/admin/badgelist.php?btypeid=".$_REQUEST['btypeid']."&page=".$_REQUEST['page'], LANG_DO_SUCCESS, $jieqiLang['badge']['badge_edit_success'] );
    }
    else
    {
        jieqi_printfail( $errtext );
    }
    break;
case "badge" :
    include_once( JIEQI_ROOT_PATH."/admin/header.php" );
    include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
    $badge_form = new jieqithemeform( $jieqiLang['badge']['badge_edit']." (".$jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['title'].")", "editbadge", $jieqiModules['badge']['url']."/admin/badgeedit.php" );
    $badge_form->setextra( "enctype=\"multipart/form-data\"" );
    if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] == 1 )
    {
        $badge_image = getbadgeurl( $_REQUEST['btypeid'], $_REQUEST['linkid'], $jieqiConfigs['badge']['sysimgtype'] );
        $badge_form->addelement( new jieqiformlabel( $jieqiLang['badge']['table_badge_caption'], jieqi_htmlstr( $badge_name ) ) );
    }
    else
    {
        $badge_image = getbadgeurl( $_REQUEST['btypeid'], $_REQUEST['linkid'], $badge->getvar( "imagetype" ) );
        $badge_form->addelement( new jieqiformtext( $jieqiLang['badge']['table_badge_caption'], "caption", 30, 100, htmlspecialchars( $badge_name, ENT_QUOTES ) ), true );
    }
    if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] != 1 )
    {
        $maxnum = new jieqiformtext( $jieqiLang['badge']['badge_maxnum'], "maxnum", 30, 11, $badge_maxnum );
        $maxnum->setdescription( $jieqiLang['badge']['badge_maxnum_desc'] );
        $badge_form->addelement( $maxnum );
    }
    $badgeimage = new jieqiformfile( $jieqiLang['badge']['badge_image'], "badgeimage", 30 );
    if ( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] == 1 )
    {
        $badgeimage->setdescription( sprintf( $jieqiLang['badge']['badge_image_type'], $jieqiConfigs['badge']['sysimgtype'] ) );
    }
    else
    {
        $badgeimage->setdescription( sprintf( $jieqiLang['badge']['badge_image_type'], $jieqiConfigs['badge']['imagetype'] ) );
    }
    $badgeimage->setintro( "<img src=\"".$badge_image."\" border=\"0\">" );
    $badge_form->addelement( $badgeimage );
    $badge_form->addelement( new jieqiformhidden( "action", "editbadge" ) );
    $badge_form->addelement( new jieqiformhidden( "btypeid", $_REQUEST['btypeid'] ) );
    $badge_form->addelement( new jieqiformhidden( "linkid", $_REQUEST['linkid'] ) );
    $badge_form->addelement( new jieqiformhidden( "page", $_REQUEST['page'] ) );
    $badge_form->addelement( new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" ) );
    $jieqiTpl->assign( "jieqi_contents", $badge_form->render( JIEQI_FORM_MIDDLE ) );
    include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
}
?>
