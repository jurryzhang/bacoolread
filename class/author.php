<?php 
/**
 * ���ݱ���(jieqi_article_author - ����ʵ����)
 *
 * ���ݱ���(jieqi_article_author - ����ʵ����)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: bookcase.php 230 2008-11-27 08:46:07Z juny $
 */

jieqi_includedb();
//�û���
class JieqiAuthor extends JieqiObjectData
{
	//��������
	function JieqiAuthor()
	{
		$this->JieqiObjectData();
		$this->initVar('id', JIEQI_TYPE_INT, 0, '�������', false, 11);
		$this->initVar('uid', JIEQI_TYPE_INT, 0, '�û�ID', false, 11);
		$this->initVar('realname', JIEQI_TYPE_TXTBOX, '', '��ʵ����', false, 250);
		$this->initVar('telephone', JIEQI_TYPE_TXTBOX, '', '�绰', false, 250);
		$this->initVar('mobilephone', JIEQI_TYPE_TXTBOX, '', '�ֻ�', false, 250);
		$this->initVar('idcardtype', JIEQI_TYPE_INT, 0, '֤������', false, 250);
		$this->initVar('idcard', JIEQI_TYPE_TXTBOX, '', '֤������', false, 250);
		$this->initVar('address', JIEQI_TYPE_TXTBOX, '', '��ϵ��ַ', false, 250);
		$this->initVar('zipcode', JIEQI_TYPE_TXTBOX, '', '�ʱ�', false, 250);
		$this->initVar('banktype', JIEQI_TYPE_TXTBOX, '', '��������', false, 250);
		$this->initVar('bankname', JIEQI_TYPE_TXTBOX, '', '�������ڵ�', false, 250);
		$this->initVar('bankcard', JIEQI_TYPE_TXTBOX, '', '����', false, 250);
		$this->initVar('bankuser', JIEQI_TYPE_TXTBOX, '', '�ֿ�������', false, 250);
		$this->initVar('flag', JIEQI_TYPE_INT, 0, '��־', false, 1);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//���ݾ��
class JieqiAuthorHandler extends JieqiObjectHandler
{
	function JieqiAuthorHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='author';
	    $this->autoid='id';	
	    $this->dbname='article_author';
	}
}

?>