<?php
/**
 * app�����̨
 *
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: ����6:29
 * 'layer'     - �˵���ȣ�Ĭ�� 0
 * 'caption'   - �˵�����
 * 'command'   - ���ӵ���ַ
 * 'target'    - ��������Ƿ���´���(0-���¿���1-�¿�)
 * 'publish'   - �Ƿ���ʾ��0-����ʾ��1-��ʾ��
*/

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => 'ר���б�', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/topicList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '���Ѵ�����', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/searchKeyWordsList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => 'Ƶ���ֲ�ͼ', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/slideBannerList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '������ר��', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/hotCommendList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '�������', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/feedbackList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '��������', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/questionAndAnswerList.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['app'][] = array('layer' => 0, 'caption' => '�汾����', 'command'=>$GLOBALS['jieqiModules']['app']['url'].'/admin/appVersionControl.php?action=show', 'target' => 0, 'publish' => 1);

?>