<?php
jieqi_includedb();
class JieqiAction extends JieqiObjectData
{
	public function JieqiAction()
	{
		$this->JieqiObject();
		$this->initVar("actionid", JIEQI_TYPE_INT, 0, "序号", false, 10);
		$this->initVar("modname", JIEQI_TYPE_TXTBOX, "", "模块名称", true, 50);
		$this->initVar("acttype", JIEQI_TYPE_TXTBOX, "", "动作类型", true, 50);
		$this->initVar("acttitle", JIEQI_TYPE_TXTBOX, "", "动作名称", true, 50);
		$this->initVar("minscore", JIEQI_TYPE_INT, 0, "多少积分以上才能执行本动作", false, 11);
		$this->initVar("islog", JIEQI_TYPE_INT, 0, "是否记录日志", false, 1);
		$this->initVar("isreview", JIEQI_TYPE_INT, 0, "是否发书评", false, 1);
		$this->initVar("isvip", JIEQI_TYPE_INT, 0, "是否VIP动作", false, 1);
		$this->initVar("ispay", JIEQI_TYPE_INT, 0, "是否有消费", false, 1);
		$this->initVar("ismessage", JIEQI_TYPE_INT, 0, "是否发站内信通知", false, 1);
		$this->initVar("paytitle", JIEQI_TYPE_TXTBOX, "", "消费名称", true, 50);
		$this->initVar("paybase", JIEQI_TYPE_INT, 0, "消费基数值", false, 11);
		$this->initVar("paymin", JIEQI_TYPE_INT, 0, "最小消费值", false, 11);
		$this->initVar("paymax", JIEQI_TYPE_INT, 0, "最大消费值", false, 11);
		$this->initVar("earnscore", JIEQI_TYPE_INT, 0, "获得多少个人积分", false, 11);
		$this->initVar("earncredit", JIEQI_TYPE_INT, 0, "获得多少贡献值", false, 11);
		$this->initVar("earnvipvote", JIEQI_TYPE_INT, 0, "获得多少月票", false, 11);
		$this->initVar("lenmin", JIEQI_TYPE_INT, 0, "注册用户名最小字节", false, 11);
		$this->initVar("lenmax", JIEQI_TYPE_INT, 0, "注册用户名最大字节", false, 11);
		$this->initVar("description", JIEQI_TYPE_TXTAREA, "", "描述", false, NULL);
		$this->initVar("actiontype", JIEQI_TYPE_INT, 1, "是否允许删除", false, 1);
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
