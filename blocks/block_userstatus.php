<?php

class BlockSystemUserstatus extends JieqiBlock
{
	public $module = 'system';
	public $template = 'block_userstatus.html';
	public $cachetime = -1;

	public function BlockSystemUserstatus()
	{
		$this->JieqiBlock($vars);
		$this->blockvars['cacheid'] = intval($_SESSION['jieqiUserId']);
	}

	public function setContent()
	{
		global $jieqiTpl;
		global $jieqiGroups;
		global $jieqiConfigs;
		global $jieqi_image_type;
		global $jieqiModules;
		global $jieqiUsersStatus;
		global $jieqiUsersGroup;

		if (!empty($_SESSION['jieqiUserId'])) {
			if ($jieqiUsersStatus == JIEQI_GROUP_GUEST) {
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
			}
			else {
				include_once(JIEQI_ROOT_PATH.'/class/users.php');
                $users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
                $jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);
				jieqi_getconfigs('system', 'honors');
                jieqi_getconfigs('system', 'vips');
				$jieqiTpl->assign('jieqi_userid', $jieqiUsers->getVar('uid'));
				$jieqiTpl->assign('jieqi_username', $jieqiUsers->getVar('name'));
				$jieqiTpl->assign('jieqi_useruname', $jieqiUsers->getVar('uname'));
				$jieqiTpl->assign('jieqi_group', $jieqiUsers->getGroup());
				$jieqiTpl->assign('jieqi_groupname', $jieqiGroups[$_SESSION['jieqiUserGroup']]);
				$jieqiTpl->assign('jieqi_score', $jieqiUsers->getVar('score'));
				$jieqiTpl->assign('jieqi_experience', $jieqiUsers->getVar('experience'));
				$honorid=jieqi_gethonorid($jieqiUsers->getVar('score'), $jieqiHonors);
				$h=$jieqiHonors[$honorid]['name'][intval($jieqiUsers->getVar('workid','n'))];
                $jieqiTpl->assign('jieqi_honor', $jieqiHonors[$honorid]['name'][intval($jieqiUsers->getVar('workid','n'))]);
//				$jieqiTpl->assign('jieqi_honor', $_SESSION['jieqiUserHonor']);
//				$jieqiTpl->assign('jieqi_vip', $_SESSION['jieqiUserVip']);
                $vipid=jieqi_getvipid($jieqiUsers->getVar('expenses'), $jieqiVips);
                $jieqiTpl->assign('jieqi_vip', $jieqiVips[$vipid]['caption']);
				$jieqiTpl->assign('jieqi_egoldname', JIEQI_EGOLD_NAME);
				$jieqiTpl->assign('jieqi_juanname', JIEQI_NAME_JUAN);
				$jieqiTpl->assign('jieqi_egold', $jieqiUsers->getVar('egold'));
				$jieqiTpl->assign('jieqi_juan', $jieqiUsers->getVar('juan'));
				$jieqiTpl->assign('vipvotemoney', $_SESSION['jieqiUserVipMoney']);
				$jieqiTpl->assign('overtime', $jieqiUsers->getVar('overtime'));
				$jieqiTpl->assign('jieqi_avatar', $_SESSION['jieqiUserAvatar']);
				$jieqiTpl->assign('time', JIEQI_NOW_TIME);
				if (isset($_SESSION['jieqiNewMessage']) && (0 < $_SESSION['jieqiNewMessage'])) {
					$jieqiTpl->assign('jieqi_newmessage', $_SESSION['jieqiNewMessage']);
				}
				else {
					$jieqiTpl->assign('jieqi_newmessage', 0);
				}
			}

			$jieqiTpl->assign('jieqi_userstatus', $jieqiUsersStatus);
			if (!empty($jieqiModules['badge']['publish']) && is_file($jieqiModules['badge']['path'] . '/include/badgefunction.php')) {
				include_once $jieqiModules['badge']['path'] . '/include/badgefunction.php';
				$jieqiTpl->assign('jieqi_group_imageurl', getbadgeurl(1, $_SESSION['jieqiUserGroup'], 0, true));
				$jieqiTpl->assign('jieqi_honor_imageurl', getbadgeurl(2, $_SESSION['jieqiUserHonorid'], 0, true));
                $jieqiTpl->assign('jieqi_vip_imageurl', getbadgeurl(3, $_SESSION['jieqiUserVipid'], 0, true));
				if (!empty($_SESSION['jieqiUserBadges'])) {
					$badgeary = unserialize($_SESSION['jieqiUserBadges']);
				}
				else {
					$badgeary = array();
				}

				$jieqi_jieqi_badgerows = array();

				if (is_array($badgeary)) {
					$k = 0;

					foreach ($badgeary as $badge) {
						$jieqi_badgerows[$k]['imageurl'] = getbadgeurl($badge['btypeid'], $badge['linkid'], $badge['imagetype']);
						$jieqi_badgerows[$k]['caption'] = jieqi_htmlstr($badge['caption']);
						$k++;
					}
				}

				$jieqiTpl->assign_by_ref('jieqi_badgerows', $jieqi_badgerows);
				$jieqiTpl->assign('jieqi_use_badge', 1);
			}
			else {
				$jieqiTpl->assign('jieqi_use_badge', 0);
			}
		}
		else {
			return false;
		}
	}
}


?>
