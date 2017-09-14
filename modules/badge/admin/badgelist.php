<?php
//zend52   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

define( "JIEQI_MODULE_NAME", "badge" );
require_once( "../../../global.php" );
jieqi_getconfigs( JIEQI_MODULE_NAME, "type" );
if ( empty( $_REQUEST['btypeid'] ) || !is_numeric( $_REQUEST['btypeid'] ) )
{
    $GLOBALS['_REQUEST']['btypeid'] = 1;
}
if ( !isset( $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']] ) )
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
jieqi_checkpower( $jieqiPower['article']['managebadge'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_loadlang( "manage", JIEQI_MODULE_NAME );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) )
{
    $GLOBALS['_REQUEST']['page'] = 1;
}
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( $jieqiModules['badge']['path']."/include/badgefunction.php" );
$badgerows = array( );
$jieqi_image_type = array( 1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp" );
if ( $_REQUEST['btypeid'] == 1 )
{
    foreach ( $jieqiGroups as $k => $v )
    {
        $tmpary['badgeid'] = 0;
        $tmpary['btypeid'] = $_REQUEST['btypeid'];
        $tmpary['caption'] = $v;
        $tmpary['description'] = "";
        $tmpary['linkid'] = $k;
        $tmpary['maxnum'] = 0;
        $tmpary['usenum'] = 0;
        $tmpary['imgpostfix'] = $jieqiConfigs['badge']['sysimgtype'];
        $tmpary['url_image'] = getbadgeurl( $_REQUEST['btypeid'], $k, $jieqiConfigs['badge']['sysimgtype'], true );
        $imagefile = getbadgepath( $_REQUEST['btypeid'], $k, $jieqiConfigs['badge']['sysimgtype'] );
        if ( is_file( $imagefile ) )
        {
            $tmpary['uptime'] = filemtime( $imagefile );
        }
        else
        {
            $tmpary['uptime'] = 0;
        }
        $badgerows[] = $tmpary;
    }
}
else if ( $_REQUEST['btypeid'] == 2 )
{
    jieqi_getconfigs( "system", "honors" );
    foreach ( $jieqiHonors as $k => $v )
    {
        $tmpary['badgeid'] = 0;
        $tmpary['btypeid'] = $_REQUEST['btypeid'];
        $tmpary['modname'] = "system";
        if ( isset( $v['caption'] ) )
        {
            $tmpary['caption'] = $v['caption'];
        }
        else
        {
            $tmpary['caption'] = $v['name']['0'];
        }
        $tmpary['description'] = "";
        $tmpary['linkid'] = $k;
        $tmpary['maxnum'] = 0;
        $tmpary['usenum'] = 0;
        $tmpary['imgpostfix'] = $jieqiConfigs['badge']['sysimgtype'];
        $tmpary['url_image'] = getbadgeurl( $_REQUEST['btypeid'], $k, $jieqiConfigs['badge']['sysimgtype'], true );
        $imagefile = getbadgepath( $_REQUEST['btypeid'], $k, $jieqiConfigs['badge']['sysimgtype'] );
        if ( is_file( $imagefile ) )
        {
            $tmpary['uptime'] = filemtime( $imagefile );
        }
        else
        {
            $tmpary['uptime'] = 0;
        }
        $badgerows[] = $tmpary;
    }
}
else if ( $_REQUEST['btypeid'] == 3 )
{
    jieqi_getconfigs( "system", "vips" );
	foreach ( $jieqiVips as $k => $v )
   {
        $tmpary['badgeid'] = 0;
        $tmpary['btypeid'] = $_REQUEST['btypeid'];
         if ( isset( $v['caption'] ) )
        {
            $tmpary['caption'] = $v['caption'];
        }
        else
        {
            $tmpary['caption'] = $v['minegold'];
        }
        $tmpary['description'] = "";
        $tmpary['linkid'] = $k;
        $tmpary['maxnum'] = 0;
        $tmpary['usenum'] = 0;
        $tmpary['imgpostfix'] = $jieqiConfigs['badge']['sysimgtype'];
        $tmpary['url_image'] = getbadgeurl( $_REQUEST['btypeid'], $k, $jieqiConfigs['badge']['sysimgtype'], true );
        $imagefile = getbadgepath( $_REQUEST['btypeid'], $k, $jieqiConfigs['badge']['sysimgtype'] );
        if ( is_file( $imagefile ) )
        {
            $tmpary['uptime'] = filemtime( $imagefile );
        }
        else
        {
            $tmpary['uptime'] = 0;
        }
        $badgerows[] = $tmpary;
    }
}
else
{
    include_once( $jieqiModules['badge']['path']."/class/badge.php" );
    $badge_handler =& jieqibadgehandler::getinstance( "JieqiBadgeHandler" );
    if ( $_REQUEST['action'] == "delete" && is_numeric( $_REQUEST['badgeid'] ) )
    {
        $badge = $badge_handler->get( $_REQUEST['badgeid'] );
        if ( is_object( $badge ) )
        {
            $badge_handler->delete( $_REQUEST['badgeid'] );
            $jieqi_image_type = array( 1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp" );
            $imagefile = getbadgepath( $badge->getvar( "btypeid", "n" ), $badge->getvar( "linkid", "n" ), $badge->getvar( "imagetype", "n" ) );
            if ( is_file( $imagefile ) )
            {
                jieqi_delfile( $imagefile );
            }
            include_once( $jieqiModules['badge']['path']."/class/award.php" );
            $award_handler =& jieqiawardhandler::getinstance( "JieqiAwardHandler" );
            $criteria = new criteria( "badgeid", $_REQUEST['badgeid'] );
            $award_handler->queryobjects( $criteria );
            $toids = array( );
            while ( $award = $award_handler->getobject( ) )
            {
                $toids[] = intval( $award->getvar( "toid" ) );
            }
            $award_handler->delete( $criteria );
            foreach ( $toids as $toid )
            {
                upuserbadge( $toid );
            }
        }
    }
    $criteria = new criteriacompo( new criteria( "btypeid", $_REQUEST['btypeid'], "=" ) );
    $criteria->setsort( "badgeid" );
    $criteria->setorder( "ASC" );
    $criteria->setlimit( $jieqiConfigs['badge']['pagenum'] );
    $criteria->setstart( ( $_REQUEST['page'] - 1 ) * $jieqiConfigs['badge']['pagenum'] );
    $badge_handler->queryobjects( $criteria );
    while ( $badge = $badge_handler->getobject( ) )
    {
        $tmpary['badgeid'] = $badge->getvar( "badgeid", "n" );
        $tmpary['btypeid'] = $_REQUEST['btypeid'];
        $tmpary['caption'] = $badge->getvar( "caption", "n" );
        $tmpary['description'] = $badge->getvar( "description" );
        $tmpary['linkid'] = $badge->getvar( "linkid", "n" );
        $tmpary['maxnum'] = $badge->getvar( "maxnum", "n" );
        $tmpary['usenum'] = $badge->getvar( "usenum", "n" );
        $tmpary['imgpostfix'] = $jieqi_image_type[$badge->getvar( "imagetype" )];
        $tmpary['url_image'] = getbadgeurl( $_REQUEST['btypeid'], $tmpary['linkid'], $badge->getvar( "imagetype" ) );
        $tmpary['uptime'] = $badge->getvar( "uptime", "n" );
        $badgerows[] = $tmpary;
    }
    include_once( JIEQI_ROOT_PATH."/lib/html/page.php" );
    $jumppage = new jieqipage( $badge_handler->getcount( $criteria ), $jieqiConfigs['badge']['pagenum'], $_REQUEST['page'] );
    $jieqiTpl->assign( "url_jumppage", $jumppage->whole_bar( ) );
}
$jieqiTpl->assign_by_ref( "badgerows", $badgerows );
$jieqiTpl->assign( "page", $_REQUEST['page'] );
$jieqiTpl->assign( "badgetitle", $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['title'] );
$jieqiTpl->assign( "btypeid", $_REQUEST['btypeid'] );
$jieqiTpl->assign( "sysflag", $jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['sysflag'] );
$btyperows = array( );
foreach ( $jieqiType['badge'] as $v )
{
    $btyperows[] = $v;
}
$jieqiTpl->assign_by_ref( "btyperows", $btyperows );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules['badge']['path']."/templates/admin/badgelist.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
