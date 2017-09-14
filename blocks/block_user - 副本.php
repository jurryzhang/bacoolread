<?php 
/**
 * 用户状态显示区块
 *
 * 显示当前登录用户的基本信息和导航等
 * 
 * 调用模板：/templates/blocks/block_userstatus.html
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: block_userstatus.php 332 2009-02-23 09:15:08Z juny $
 */

class BlockSystemUsers extends JieqiBlock
{
	var $module='system';
	var $template='block_users.html';
	var $cachetime = -1;

	function BlockSystemUsers(){
		$this->JieqiBlock($vars);
		$this->blockvars['cacheid'] = intval($_SESSION['jieqiUserId']);
	}

	function setContent(){
		global $jieqiTpl;
		global $jieqiGroups;
		global $jieqiConfigs;
		global $jieqi_image_type;
		global $jieqiModules;
		global $jieqiUsersStatus;
		global $jieqiUsersGroup;

		if (!empty($_SESSION['jieqiUserId'])){
			if($jieqiUsersStatus == JIEQI_GROUP_GUEST){
				$jieqiTpl->assign('jieqi_newmessage', 0);
				$jieqiTpl->assign('jieqi_userid', 0);
				$jieqiTpl->assign('jieqi_username', '');
				$jieqiTpl->assign('jieqi_useruname', '');
				$jieqiTpl->assign('jieqi_group', JIEQI_GROUP_GUEST);
				$jieqiTpl->assign('jieqi_groupname', $jieqiGroups[JIEQI_GROUP_GUEST]);
				$jieqiTpl->assign('jieqi_score', 0);
				$jieqiTpl->assign('jieqi_experience', 0);
				$jieqiTpl->assign('jieqi_honor', '');
				$jieqiTpl->assign('jieqi_vip', 0);
				$jieqiTpl->assign('jieqi_egold', 0);
				$jieqiTpl->assign('jieqi_avatar', 0);
			}else{
				$jieqiTpl->assign('jieqi_userid', $_SESSION['jieqiUserId']);
				$jieqiTpl->assign('jieqi_username', jieqi_htmlstr($_SESSION['jieqiUserName']));
				$jieqiTpl->assign('jieqi_useruname', jieqi_htmlstr($_SESSION['jieqiUserUname']));
				$jieqiTpl->assign('jieqi_group', $_SESSION['jieqiUserGroup']);
				$jieqiTpl->assign('jieqi_groupname', $jieqiGroups[$_SESSION['jieqiUserGroup']]);
				$jieqiTpl->assign('jieqi_score', $_SESSION['jieqiUserScore']);
				$jieqiTpl->assign('jieqi_experience', $_SESSION['jieqiUserExperience']);
				$jieqiTpl->assign('jieqi_honor', $_SESSION['jieqiUserHonor']);
				$jieqiTpl->assign('jieqi_vip', $_SESSION['jieqiUserVip']);
				$jieqiTpl->assign('jieqi_egold', $_SESSION['jieqiUserEgold']);
				$jieqiTpl->assign('jieqi_avatar', $_SESSION['jieqiUserAvatar']);
jieqi_getconfigs('system', 'honors');
jieqi_getconfigs('system', 'vips');
include_once(JIEQI_ROOT_PATH.'/class/users.php');
$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
$jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);	
$jieqiTpl->assign('uid', $jieqiUsers->getVar('uid'));
$jieqiTpl->assign('uname', $jieqiUsers->getVar('uname'));
$jieqiTpl->assign('name', $jieqiUsers->getVar('name'));
$jieqiTpl->assign('group', $jieqiUsers->getGroup());
$jieqiTpl->assign('sex', $jieqiUsers->getSex());
$jieqiTpl->assign('email', $jieqiUsers->getVar('email'));
$jieqiTpl->assign('qq', $jieqiUsers->getVar('qq'));
$jieqiTpl->assign('icq', $jieqiUsers->getVar('icq'));
$jieqiTpl->assign('msn', $jieqiUsers->getVar('msn'));
$jieqiTpl->assign('url', $jieqiUsers->getVar('url'));
$jieqiTpl->assign('regdate', date(JIEQI_DATE_FORMAT, $jieqiUsers->getVar('regdate')));
$jieqiTpl->assign('experience', $jieqiUsers->getVar('experience'));
$jieqiTpl->assign('score', $jieqiUsers->getVar('score'));
$jieqiTpl->assign('monthscore', $jieqiUsers->getVar('monthscore'));
$jieqiTpl->assign('weekscore', $jieqiUsers->getVar('weekscore'));
$jieqiTpl->assign('dayscore', $jieqiUsers->getVar('dayscore'));
$jieqiTpl->assign('credit', $jieqiUsers->getVar('credit'));
$jieqiTpl->assign('isvip', $jieqiUsers->getVar('isvip'));
$jieqiTpl->assign('expenses', $jieqiUsers->getVar('expenses'));
$jieqiTpl->assign('viptype', $jieqiUsers->getViptype());			
$jieqiTpl->assign('juanname', JIEQI_NAME_JUAN);
$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
$jieqiTpl->assign('juan', $jieqiUsers->getVar('juan'));
$honorid=jieqi_gethonorid($jieqiUsers->getVar('score'), $jieqiHonors);
$h=$jieqiHonors[$honorid]['name'][intval($jieqiUsers->getVar('workid','n'))];
$jieqiTpl->assign('honor', $jieqiHonors[$honorid]['name'][intval($jieqiUsers->getVar('workid','n'))]);
$jieqiTpl->assign('honorup', $jieqiHonors[$honorid]['maxscore']);
$vipid=jieqi_getvipid($jieqiUsers->getVar('expenses'), $jieqiVips);
$jieqiTpl->assign('vip', $jieqiVips[$vipid]['caption']);
$jieqiTpl->assign('maxgold', $jieqiVips[$vipid]['maxgold']);

$userset = unserialize($jieqiUsers->getVar('setting', 'n'));
$jieqiTpl->assign('vipvotemoney', intval($userset['gift']['vipvote']));
$jieqiTpl->assign('overtime', $jieqiUsers->getVar('overtime'));
$jieqiTpl->assign('time', JIEQI_NOW_TIME);
				
				if(isset($_SESSION['jieqiNewMessage']) && $_SESSION['jieqiNewMessage']>0) $jieqiTpl->assign('jieqi_newmessage', $_SESSION['jieqiNewMessage']);
				else $jieqiTpl->assign('jieqi_newmessage', 0);
			}
			$jieqiTpl->assign('jieqi_userstatus', $jieqiUsersStatus);

			//显示徽章
if(!empty($jieqiModules['badge']['publish']) && is_file($jieqiModules['badge']['path'].'/include/badgefunction.php')){
	include_once($jieqiModules['badge']['path'].'/include/badgefunction.php');
	//等级徽章
	$jieqiTpl->assign('jieqi_group_imageurl', getbadgeurl(1, $jieqiUsers->getVar('groupid'), 0, true));
	//头衔徽章
	$jieqiTpl->assign('jieqi_honor_imageurl', getbadgeurl(2, $honorid, 0, true));
	//VIP徽章
	$jieqiTpl->assign('jieqi_vip_imageurl', getbadgeurl(3, $vipid, 0, true));
	//自定义徽章
	$jieqi_jieqi_badgerows=array();
	$badgeary=unserialize($jieqiUsers->getVar('badges', 'n'));
	if(is_array($badgeary) && count($badgeary)>0){
		$award_query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
		$criteria=new CriteriaCompo();
		$criteria->setTables(jieqi_dbprefix('badge_award').' a LEFT JOIN '.jieqi_dbprefix('badge_badge').' b ON a.badgeid=b.badgeid');
		$criteria->add(new Criteria('a.toid', $_SESSION['jieqiUserId']));
		$criteria->setSort('b.btypeid ASC, a.awardid');
		$criteria->setOrder('ASC');
		$award_query->queryObjects($criteria);
		$k=0;
		while($award = $award_query->getObject()){
			$jieqi_badgerows[$k]['imageurl']=getbadgeurl($award->getVar('btypeid','n'), $award->getVar('linkid','n'), $award->getVar('imagetype','n'));
			$jieqi_badgerows[$k]['caption']=jieqi_htmlstr($award->getVar('caption'));
			$k++;
		}
	}
	$jieqiTpl->assign_by_ref('jieqi_badgerows', $jieqi_badgerows);
	$jieqiTpl->assign('jieqi_use_badge', 1);
}else{
	$jieqiTpl->assign('jieqi_use_badge', 0);
}
		}else{
			return false;
		}
	}

}


?>