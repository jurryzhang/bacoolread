<?php 


jieqi_includedb();
//�û���
class JieqiMreport extends JieqiObjectData
{
	//��������
	public function JieqiMreport()
	{
		$this->JieqiObjectData();
		$this->initVar('id', JIEQI_TYPE_INT, 0, '���', false, 11);
		$this->initVar('data', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('siteid', JIEQI_TYPE_INT, 0, 'ƽ̨���', true, 11);
		$this->initVar('obookname', JIEQI_TYPE_TXTBOX, 0, '��������', true, 250);
		$this->initVar('obookid', JIEQI_TYPE_INT, '', '���������', false, 250);
		$this->initVar('articleid', JIEQI_TYPE_INT, '', '�������', false, 250);
		$this->initVar('author', JIEQI_TYPE_TXTAREA, '', '������', false, 250);
		$this->initVar('sumgold', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('sumtip', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('sumgift', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('sumhurry', JIEQI_TYPE_INT, 0, '�߸�', false, 11);
		$this->initVar('sumemoney', JIEQI_TYPE_INT, 0, '����', false, 11);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//���ݾ��
class JieqiMreportHandler extends JieqiObjectHandler
{
	function JieqiMreportHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='mreport';
	    $this->autoid='id';	
	    $this->dbname='obook_mreport';
	}
}

?>