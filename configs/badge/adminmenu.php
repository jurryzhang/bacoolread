<?php
/**
 * ��̨���¹���������
 *
 * ��̨���¹���������
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    badge
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

$jieqiAdminmenu['badge'][] = array('layer' => 0, 'caption' => '��������', 'command'=>JIEQI_URL.'/admin/configs.php?mod=badge', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['badge'][] = array('layer' => 0, 'caption' => 'Ȩ������', 'command'=>JIEQI_URL.'/admin/power.php?mod=badge', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['badge'][] = array('layer' => 0, 'caption' => '���¹���', 'command'=>$GLOBALS['jieqiModules']['badge']['url'].'/admin/badgelist.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['badge'][] = array('layer' => 0, 'caption' => '�����¼', 'command'=>$GLOBALS['jieqiModules']['badge']['url'].'/admin/badgeaward.php', 'target' => 0, 'publish' => 1);
?>