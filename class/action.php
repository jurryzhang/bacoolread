<?php
jieqi_includedb();
class JieqiAction extends JieqiObjectData
{
	public function JieqiAction()
	{
		$this->JieqiObject();
		$this->initVar("actionid", JIEQI_TYPE_INT, 0, "���", false, 10);
		$this->initVar("modname", JIEQI_TYPE_TXTBOX, "", "ģ������", true, 50);
		$this->initVar("acttype", JIEQI_TYPE_TXTBOX, "", "��������", true, 50);
		$this->initVar("acttitle", JIEQI_TYPE_TXTBOX, "", "��������", true, 50);
		$this->initVar("minscore", JIEQI_TYPE_INT, 0, "���ٻ������ϲ���ִ�б�����", false, 11);
		$this->initVar("islog", JIEQI_TYPE_INT, 0, "�Ƿ��¼��־", false, 1);
		$this->initVar("isreview", JIEQI_TYPE_INT, 0, "�Ƿ�����", false, 1);
		$this->initVar("isvip", JIEQI_TYPE_INT, 0, "�Ƿ�VIP����", false, 1);
		$this->initVar("ispay", JIEQI_TYPE_INT, 0, "�Ƿ�������", false, 1);
		$this->initVar("ismessage", JIEQI_TYPE_INT, 0, "�Ƿ�վ����֪ͨ", false, 1);
		$this->initVar("paytitle", JIEQI_TYPE_TXTBOX, "", "��������", true, 50);
		$this->initVar("paybase", JIEQI_TYPE_INT, 0, "���ѻ���ֵ", false, 11);
		$this->initVar("paymin", JIEQI_TYPE_INT, 0, "��С����ֵ", false, 11);
		$this->initVar("paymax", JIEQI_TYPE_INT, 0, "�������ֵ", false, 11);
		$this->initVar("earnscore", JIEQI_TYPE_INT, 0, "��ö��ٸ��˻���", false, 11);
		$this->initVar("earncredit", JIEQI_TYPE_INT, 0, "��ö��ٹ���ֵ", false, 11);
		$this->initVar("earnvipvote", JIEQI_TYPE_INT, 0, "��ö�����Ʊ", false, 11);
		$this->initVar("lenmin", JIEQI_TYPE_INT, 0, "ע���û�����С�ֽ�", false, 11);
		$this->initVar("lenmax", JIEQI_TYPE_INT, 0, "ע���û�������ֽ�", false, 11);
		$this->initVar("description", JIEQI_TYPE_TXTAREA, "", "����", false, NULL);
		$this->initVar("actiontype", JIEQI_TYPE_INT, 1, "�Ƿ�����ɾ��", false, 1);
	}
}

class JieqiActionHandler extends JieqiObjectHandler
{
	public function JieqiActionHandler($db = "")
	{
		$this->JieqiObjectHandler($db);
		$this->basename = "action";
		$this->autoid = "actionid";
		$this->dbname = "system_action";
	}
}

?>
