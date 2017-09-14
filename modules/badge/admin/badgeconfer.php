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
$GLOBALS['_REQUEST']['badgeid'] = intval( $_REQUEST['badgeid'] );
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
jieqi_loadlang( "confer", JIEQI_MODULE_NAME );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
include_once( $jieqiModules['badge']['path']."/class/badge.php" );
$badge_handler =& jieqibadgehandler::getinstance( "JieqiBadgeHandler" );
if ( 0 < $_REQUEST['badgeid'] )
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
    $badge_id = $badge->getvar( "badgeid", "n" );
    $badge_name = $badge->getvar( "caption", "n" );
    $badge_maxnum = $badge->getvar( "maxnum", "n" );
    $badge_usenum = $badge->getvar( "usenum", "n" );
    $badge_linkid = $badge->getvar( "linkid", "n" );
    if ( 0 < $badge_maxnum && $badge_maxnum <= $badge_usenum )
    {
        jieqi_printfail( sprintf( $jieqiLang['badge']['badge_all_usage'], $badge_maxnum ) );
    }
}
else
{
    jieqi_printfail( $jieqiLang['badge']['badge_not_exists'] );
}
if ( !isset( $_REQUEST['action'] ) )
{
    $GLOBALS['_REQUEST']['action'] = "default";
}
switch ( $_REQUEST['action'] )
{
case "confer" :
    $errtext = "";
    if ( strlen( $_POST['username'] ) == 0 && strlen( $_POST['userid'] ) == 0 )
    {
        $errtext .= $jieqiLang['badge']['need_userid_name']."<br />";
    }
    if ( empty( $errtext ) )
    {
        include_once( JIEQI_ROOT_PATH."/class/users.php" );
        $users_handler =& jieqiusershandler::getinstance( "JieqiUsersHandler" );
        $isuser = false;
        if ( is_numeric( $_POST['userid'] ) )
        {
            $user = $users_handler->get( $_POST['userid'] );
            if ( is_object( $user ) )
            {
                $isuser = true;
            }
        }
        if ( !$isuser )
        {
            if ( 0 < strlen( $_POST['username'] ) )
            {
                $user = $users_handler->getbyname( $_POST['username'], 3 );
                if ( is_object( $user ) )
                {
                    $isuser = true;
                }
            }
            if ( !$isuser )
            {
                jieqi_printfail( $jieqiLang['badge']['confer_user_notexists'] );
            }
        }
        $confer_userid = $user->getvar( "uid", "n" );
        $confer_username = $user->getvar( "uname", "n" );
        include_once( $jieqiModules['badge']['path']."/class/award.php" );
        $award_handler =& jieqiawardhandler::getinstance( "JieqiAwardHandler" );
        $criteria = new criteriacompo( new criteria( "toid", $confer_userid ) );
        $criteria->add( new criteria( "badgeid", $badge_id ) );
        $award_handler->queryobjects( $criteria );
        $award = $award_handler->getobject( );
        if ( is_object( $award ) )
        {
            jieqi_printfail( $jieqiLang['badge']['award_already_exists'] );
        }
        $newAward = $award_handler->create( );
        $newAward->setvar( "addtime", JIEQI_NOW_TIME );
        $newAward->setvar( "fromid", $_SESSION['jieqiUserId'] );
        $newAward->setvar( "fromname", $_SESSION['jieqiUserName'] );
        $newAward->setvar( "toid", $confer_userid );
        $newAward->setvar( "toname", $confer_username );
        $newAward->setvar( "badgeid", $badge_id );
        if ( !$award_handler->insert( $newAward ) )
        {
            jieqi_printfail( $jieqiLang['badge']['award_add_failure'] );
        }
        else
        {
            $badge->setvar( "usenum", $badge->getvar( "usenum", "n" ) + 1 );
            $badge_handler->insert( $badge );
            include_once( $jieqiModules['badge']['path']."/include/badgefunction.php" );
            upuserbadge( $confer_userid );
            jieqi_jumppage( $jieqiModules['badge']['url']."/admin/badgeaward.php?userid=".$confer_userid, LANG_DO_SUCCESS, $jieqiLang['badge']['award_add_success'] );
        }
    }
    else
    {
        jieqi_printfail( $errtext );
    }
    break;
case "default" :
    include_once( JIEQI_ROOT_PATH."/admin/header.php" );
    include_once( JIEQI_ROOT_PATH."/lib/html/formloader.php" );
    $confer_form = new jieqithemeform( $jieqiLang['badge']['badge_confer']." (".$jieqiType[JIEQI_MODULE_NAME][$_REQUEST['btypeid']]['title'].")", "confer", $jieqiModules['badge']['url']."/admin/badgeconfer.php" );
    $confer_form->addelement( new jieqiformlabel( $jieqiLang['badge']['badge_caption'], $badge_name ) );
    $confer_form->addelement( new jieqiformtext( $jieqiLang['badge']['confer_username'], "username", 30, 30 ) );
    $confer_form->addelement( new jieqiformtext( $jieqiLang['badge']['confer_userid'], "userid", 30, 11 ) );
    $confer_form->addelement( new jieqiformlabel( "", $jieqiLang['badge']['confer_user_note'] ) );
    $confer_form->addelement( new jieqiformhidden( "action", "confer" ) );
    $confer_form->addelement( new jieqiformhidden( "btypeid", $_REQUEST['btypeid'] ) );
    $confer_form->addelement( new jieqiformhidden( "linkid", $_REQUEST['linkid'] ) );
    $confer_form->addelement( new jieqiformhidden( "badgeid", $badge_id ) );
    $confer_form->addelement( new jieqiformbutton( "&nbsp;", "submit", LANG_SUBMIT, "submit" ) );
    $jieqiTpl->assign( "jieqi_contents", $confer_form->render( JIEQI_FORM_MIDDLE ) );
    include_once( JIEQI_ROOT_PATH."/admin/footer.php" );
}
?>
