<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/2/10
 * Time: 上午11:28
 *
 * 书盟
 *
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: 下午6:29
 * 'layer'     - 菜单深度，默认 0
 * 'caption'   - 菜单标题
 * 'command'   - 链接的网址
 * 'target'    - 点击链接是否打开新窗口(0-不新开；1-新开)
 * 'publish'   - 是否显示（0-不显示；1-显示）
 */

$jieqiAdminmenu['书盟'][] = array('layer' => 0, 'caption' => '专题列表', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/topicList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '热搜词设置', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/searchKeyWordsList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '频道轮播图', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/slideBannerList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '热推书专区', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/hotCommendList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '意见反馈', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/feedbackList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '常见问题', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/questionAndAnswerList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '版本控制', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/appVersionControl.php?action=show', 'target' => 0, 'publish' => 1);

?>