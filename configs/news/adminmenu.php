<?php 
/**
 * ��̨����ϵͳ��������
 *
 * ��̨����ϵͳ��������
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    news
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

$jieqiAdminmenu['news'][0] = array('layer' => 0, 'caption' => '��������', 'command'=>JIEQI_URL.'/admin/configs.php?mod=news', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['news'][1] = array('layer' => 0, 'caption' => 'Ȩ�޹���', 'command'=>JIEQI_URL.'/admin/power.php?mod=news', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['news'][2] = array('layer' => 0, 'caption' => '��Ŀ����', 'command'=>$GLOBALS['jieqiModules']['news']['url'].'/admin/category.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['news'][3] = array('layer' => 0, 'caption' => '���ŷ���', 'command'=>$GLOBALS['jieqiModules']['news']['url'].'/admin/newsadd.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['news'][4] = array('layer' => 0, 'caption' => '��������', 'command'=>$GLOBALS['jieqiModules']['news']['url'].'/admin/newslist.php?audit=2', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['news'][5] = array('layer' => 0, 'caption' => '��������', 'command'=>$GLOBALS['jieqiModules']['news']['url'].'/admin/newslist.php?audit=1', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['news'][6] = array('layer' => 0, 'caption' => '��������', 'command'=>$GLOBALS['jieqiModules']['news']['url'].'/admin/attachment.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['news'][7] = array('layer' => 0, 'caption' => '���ž�̬��', 'command'=>$GLOBALS['jieqiModules']['news']['url'].'/admin/newshtml.php', 'target' => 0, 'publish' => 1);
?>