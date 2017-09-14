<?php
jieqi_includedb();

class JieqiPaycard extends JieqiObjectData
{
	public function JieqiPaycard()
	{
		$this->JieqiObjectData();
		$this->initVar("cardid", JIEQI_TYPE_INT, 0, "���", false, 11);
		$this->initVar("batchno", JIEQI_TYPE_TXTBOX, "", "����", false, 30);
		$this->initVar("cardno", JIEQI_TYPE_TXTBOX, "", "����", true, 30);
		$this->initVar("cardpass", JIEQI_TYPE_TXTBOX, "", "����", false, 30);
		$this->initVar("cardtype", JIEQI_TYPE_INT, 0, "������", false, 1);
		$this->initVar("payemoney", JIEQI_TYPE_INT, 0, "��ֵ���������", false, 11);
		$this->initVar("emoneytype", JIEQI_TYPE_INT, 0, "�����������", false, 1);
		$this->initVar("ispay", JIEQI_TYPE_INT, 0, "�Ƿ���ʹ��", false, 1);
		$this->initVar("paytime", JIEQI_TYPE_INT, 0, "ʹ��ʱ��", false, 11);
		$this->initVar("payuid", JIEQI_TYPE_INT, 0, "ʹ����ID", false, 11);
		$this->initVar("payname", JIEQI_TYPE_TXTBOX, 0, "ʹ��������", false, 30);
		$this->initVar("note", JIEQI_TYPE_TXTBOX, "", "��ע", false, 255);
		$this->initVar("flag", JIEQI_TYPE_INT, 0, "��־", false, 1);
	}
}

class JieqiPaycardHandler extends JieqiObjectHandler
{
	public function JieqiPaycardHandler($db = "")
	{
		$this->JieqiObjectHandler($db);
		$this->basename = "paycard";
		$this->autoid = "cardid";
		$this->dbname = "pay_paycard";
	}
}



?>
