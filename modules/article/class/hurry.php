<?php 


jieqi_includedb();
//�û���
class JieqiHurry extends JieqiObjectData
{
	//��������
	function JieqiHurry()
	{
		$this->JieqiObjectData();
		$this->initVar('hurryid', JIEQI_TYPE_INT, 0, '�߸����', false, 11);
		$this->initVar('articleid', JIEQI_TYPE_INT, 0, '�������', true, 11);
		$this->initVar('vipid', JIEQI_TYPE_INT, 0, '���������', true, 11);
		$this->initVar('articlename', JIEQI_TYPE_TXTBOX, '', '��������', false, 250);
		$this->initVar('uid', JIEQI_TYPE_INT, 0, '�߸��û����', false, 11);
		$this->initVar('authorid', JIEQI_TYPE_INT, 0, '�߸��û����', false, 11);
        $this->initVar('uname', JIEQI_TYPE_TXTBOX, '', '�߸���', false, 30);
		$this->initVar('payegold', JIEQI_TYPE_INT, 0, '���������', false, 11);
		$this->initVar('winegold', JIEQI_TYPE_INT, 0, '���������2', false, 11);
		$this->initVar('minsize', JIEQI_TYPE_INT, 0, '�߸��ֽ���', false, 11);
		$this->initVar('overtime', JIEQI_TYPE_INT, 0, '�߸�����ʱ��', false, 11);
		$this->initVar('payflag', JIEQI_TYPE_INT, 0, '����', false, 11);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//���ݾ��
class JieqiHurryHandler extends JieqiObjectHandler
{
	function JieqiHurryHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='hurry';
	    $this->autoid='hurryid';	
	    $this->dbname='article_hurry';
	}
}

?>