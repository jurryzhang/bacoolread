<?php
/**
 * ��̨С˵���ص�������
 *
 * ��̨С˵���ص�������
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: adminmenu.php 187 2008-11-24 09:30:03Z juny $
 */

/**
'layer'     - �˵���ȣ�Ĭ�� 0
'caption'   - �˵�����
'command'   - ���ӵ���ַ
'target'    - ��������Ƿ���´���(0-���¿���1-�¿�)
'publish'   - �Ƿ���ʾ��0-����ʾ��1-��ʾ��
*/

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '��������', 'command'=>JIEQI_URL.'/admin/configs.php?mod=article', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'Ȩ�޹���', 'command'=>JIEQI_URL.'/admin/power.php?mod=article', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '������������', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/action.php?mod=article', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'Ȩ������', 'command'=>JIEQI_URL.'/admin/right.php?mod=article', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '���ɱ�ǩ����', 'command'=>JIEQI_URL.'/admin/tag.php?action=do', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'С˵����', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/article.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '��ѡ����', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/tbook.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '������½�', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/draftaudit.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '�½ڸ��¼�¼', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/chapter.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '������API����', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/api.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'ȫ���ݸ��б�', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/draftlist.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '���¹���', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/articlebaoyue.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '��������', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/reviews.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '���߹���', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/author.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'С˵��Ȩ', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/articleper.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '�߸���¼', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/articlehurry.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '����߸�', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/hurrydo.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'ǩԼ�����¼', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/articleup.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '��ƪ�ɼ�', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/collect.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '�����ɼ�', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/batchcollect.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '�ɼ�����', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/collectset.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '��������', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/reviews.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '�����������', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/applylist.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '������ƽ̨�ӿ�', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/articleapi.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => '�����ؼ���', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/searchcache.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'С˵ɾ����־', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/articlelog.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'С˵��������', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/batchrepack.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'С˵��������', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/batchclean.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['article'][] = array('layer' => 0, 'caption' => 'С˵�����滻', 'command'=>$GLOBALS['jieqiModules']['article']['url'].'/admin/batchreplace.php', 'target' => 0, 'publish' => 1);

?>