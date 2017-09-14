<?php
/**
 * ���ݱ���(jieqi_system_vips - �û����)
 *
 * ���ݱ���(jieqi_system_vips - �û����)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: groups.php 312 2008-12-29 05:30:54Z juny $
 */

jieqi_includedb();
//�û���
class JieqiTag extends JieqiObjectData
{
    function JieqiTag()
    {
        $this->JieqiObject();
        $this->initVar('tagid', JIEQI_TYPE_INT, 0, '���', false, 5);
        $this->initVar('tagname', JIEQI_TYPE_TXTBOX, '', '�ؼ���',true, 255);
        $this->initVar('addtime', JIEQI_TYPE_INT, 0, 'ʱ��', false, 11);
		$this->initVar('tagsort', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('userid', JIEQI_TYPE_INT, 0, '�û�id', false, 11);
		$this->initVar('username', JIEQI_TYPE_TXTBOX, '', '�û���',true, 255);
		$this->initVar('linknum', JIEQI_TYPE_INT, 0, '����', false, 11);
        $this->initVar('display', JIEQI_TYPE_INT, 0, '����', false, 1);
    }
}

//�û�����
class JieqiTagHandler extends JieqiObjectHandler
{
	function JieqiTagHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='tag';
	    $this->autoid='tagid';	
	    $this->dbname='system_tag';
	}
}

?>