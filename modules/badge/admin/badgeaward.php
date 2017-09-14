<?php
//zend52   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

define( "JIEQI_MODULE_NAME", "badge" );
require_once( "../../../global.php" );
jieqi_getconfigs( JIEQI_MODULE_NAME, "power" );
jieqi_checkpower( $jieqiPower['badge']['awardview'], $jieqiUsersStatus, $jieqiUsersGroup, false, true );
jieqi_getconfigs( JIEQI_MODULE_NAME, "type" );
jieqi_loadlang( "award", JIEQI_MODULE_NAME );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
if ( empty( $_REQUEST['page'] ) || !is_numeric( $_REQUEST['page'] ) )
{
    $GLOBALS['_REQUEST']['page'] = 1;
}
include_once( JIEQI_ROOT_PATH."/admin/header.php" );
include_once( $jieqiModules['badge']['path']."/include/badgefunction.php" );
if ( isset( $_REQUEST['userid'] ) && is_numeric( $_REQUEST['userid'] ) )
{
    $GLOBALS['_REQUEST']['keyword'] = $_REQUEST['userid'];
    $GLOBALS['_REQUEST']['keytype'] = "toid";
}
else if ( isset( $_REQUEST['badgeid'] ) && is_numeric( $_REQUEST['badgeid'] ) )
{
    $GLOBALS['_REQUEST']['keyword'] = $_REQUEST['badgeid'];
    $GLOBALS['_REQUEST']['keytype'] = "badgeid";
}
$awardrows = array( );
$jieqi_image_type = array( 1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp" );
jieqi_includedb( );
$award_query = jieqiqueryhandler::getinstance( "JieqiQueryHandler" );
if ( $_REQUEST['action'] == "delete" && is_numeric( $_REQUEST['awardid'] ) )
{
    $criteria = new criteriacompo( );
    $criteria->settables( jieqi_dbprefix( "badge_award" )." a LEFT JOIN ".jieqi_dbprefix( "badge_badge" )." b ON a.badgeid=b.badgeid" );
    $criteria->add( new criteria( "a.awardid", $_REQUEST['awardid'] ) );
    $criteria->setlimit( 1 );
    $award_query->queryobjects( $criteria );
    if ( $award = $award_query->getobject( ) )
    {
        $sql = "DELETE FROM ".jieqi_dbprefix( "badge_award WHERE awardid=".intval( $award->getvar( "awardid", "n" ) ) );
        $award_query->execute( $sql );
        $sql = "UPDATE ".jieqi_dbprefix( "badge_badge SET usenum=usenum-1 WHERE badgeid=".intval( $award->getvar( "badgeid", "n" ) ) );
        $award_query->execute( $sql );
        upuserbadge( intval( $award->getvar( "toid", "n" ) ) );
    }
}
$criteria = new criteriacompo( );
if ( !empty( $_REQUEST['keyword'] ) || !empty( $_REQUEST['keytype'] ) )
{
    switch ( $_REQUEST['keytype'] )
    {
    case "toid" :
        $criteria->add( new criteria( "a.toid", $_REQUEST['keyword'] ) );
        break;
    case "toname" :
        $criteria->add( new criteria( "a.toname", $_REQUEST['keyword'] ) );
        break;
    case "fromid" :
        $criteria->add( new criteria( "a.fromid", $_REQUEST['keyword'] ) );
        break;
    case "fromname" :
        $criteria->add( new criteria( "a.fromname", $_REQUEST['keyword'] ) );
        break;
    case "badgeid" :
        $criteria->add( new criteria( "a.badgeid", $_REQUEST['keyword'] ) );
    }
}
$criteria->settables( jieqi_dbprefix( "badge_award" )." a LEFT JOIN ".jieqi_dbprefix( "badge_badge" )." b ON a.badgeid=b.badgeid" );
$criteria->setsort( "a.awardid" );
$criteria->setorder( "DSC" );
$criteria->setlimit( $jieqiConfigs['badge']['awardpnum'] );
$criteria->setstart( ( $_REQUEST['page'] - 1 ) * $jieqiConfigs['badge']['awardpnum'] );
$award_query->queryobjects( $criteria );
while ( $badge = $award_query->getobject( ) )
{
    $tmpary['awardid'] = $badge->getvar( "awardid" );
    $tmpary['addtime'] = $badge->getvar( "addtime" );
    $tmpary['fromid'] = $badge->getvar( "fromid" );
    $tmpary['fromname'] = $badge->getvar( "fromname" );
    $tmpary['toid'] = $badge->getvar( "toid" );
    $tmpary['toname'] = $badge->getvar( "toname" );
    $tmpary['badgeid'] = $badge->getvar( "badgeid" );
    $tmpary['btypeid'] = $badge->getvar( "btypeid" );
    $tmpary['btypename'] = $jieqiType['badge'][$tmpary['btypeid']]['title'];
    $tmpary['caption'] = $badge->getvar( "caption" );
    $tmpary['linkid'] = $badge->getvar( "linkid", "n" );
    $tmpary['maxnum'] = $badge->getvar( "maxnum", "n" );
    $tmpary['usenum'] = $badge->getvar( "usenum", "n" );
    $tmpary['imgpostfix'] = $jieqi_image_type[$badge->getvar( "imagetype" )];
    $tmpary['url_image'] = getbadgeurl( $tmpary['btypeid'], $tmpary['linkid'], $badge->getvar( "imagetype" ) );
    $tmpary['uptime'] = $badge->getvar( "uptime", "n" );
    $awardrows[] = $tmpary;
}
$GLOBALS['_GET']['keyword'] = $_REQUEST['keyword'];
$GLOBALS['_GET']['keytype'] = $_REQUEST['keytype'];
include_once( JIEQI_ROOT_PATH."/lib/html/page.php" );
$jumppage = new jieqipage( $award_query->getcount( $criteria ), $jieqiConfigs['badge']['awardpnum'], $_REQUEST['page'] );
$jieqiTpl->assign( "url_jumppage", $jumppage->whole_bar( ) );
$jieqiTpl->assign( "keyword", $_REQUEST['keyword'] );
$jieqiTpl->assign( "keytype", $_REQUEST['keytype'] );
$jieqiTpl->assign_by_ref( "awardrows", $awardrows );
$jieqiTpl->assign( "page", $_REQUEST['page'] );
$jieqiTpl->setcaching( 0 );
$jieqiTset['jieqi_contents_template'] = $jieqiModules['badge']['path']."/templates/admin/awardlist.html";
include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
?>
