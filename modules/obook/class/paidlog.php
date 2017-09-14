<?php
jieqi_includedb();

class JieqiPaidlog extends JieqiObjectData
{
	public function JieqiPaidlog()
	{
		$this->JieqiObjectData();
		$this->initVar('paidid', JIEQI_TYPE_INT, 0, '序号', false, 11);
		$this->initVar('paytime', JIEQI_TYPE_INT, 0, '网站序号', false, 11);
		$this->initVar('userid', JIEQI_TYPE_INT, 0, '购买日期', false, 11);
		$this->initVar('username', JIEQI_TYPE_TXTBOX, '', '用户名称', false, 30);
		$this->initVar('masterid', JIEQI_TYPE_INT, 0, '小说序号', false, 11);
		$this->initVar('master', JIEQI_TYPE_TXTBOX, '', '用户名称', false, 30);
		$this->initVar('obookid', JIEQI_TYPE_INT, 0, '电子书序号', false, 11);
		$this->initVar('obookname', JIEQI_TYPE_TXTBOX, '', '用户名称', false, 100);
		$this->initVar('articleid', JIEQI_TYPE_INT, 0, '章节序号', false, 11);
		$this->initVar('sumegold', JIEQI_TYPE_INT, 0, '最后阅读', false, 11);
		$this->initVar('sumesilver', JIEQI_TYPE_INT, 0, '阅读次数', false, 11);
		$this->initVar('sumemoney', JIEQI_TYPE_TXTBOX, '', '校验码', false, 11);
		$this->initVar('paidemoney', JIEQI_TYPE_INT, 0, '单价', false, 11);
		$this->initVar('payemoney', JIEQI_TYPE_INT, 0, '购买数量', false, 11);
		$this->initVar('remainemoney', JIEQI_TYPE_INT, 0, '总价', false, 11);
		$this->initVar('summoney', JIEQI_TYPE_INT, 0, '状态', false, 1);
		$this->initVar('paymoney', JIEQI_TYPE_INT, 0, '标志', false, 11);
		$this->initVar('remainmoney', JIEQI_TYPE_INT, 0, '标志', false, 11);
		$this->initVar('paidcurrency', JIEQI_TYPE_INT, 0, '标志', false, 1);
		$this->initVar('paidtype', JIEQI_TYPE_INT, 0, '标志', false, 1);
		$this->initVar('paidflag', JIEQI_TYPE_INT, 0, '标志', false, 1);
		$this->initVar('payinfo', JIEQI_TYPE_TXTAREA, '', '内容简介', false, NULL);
		$this->initVar('paynote', JIEQI_TYPE_TXTAREA, '', '内容简介', false, NULL);
	}
}

class JieqiPaidlogHandler extends JieqiObjectHandler
{
	public function JieqiPaidlogHandler($db = '')
	{
		$this->JieqiObjectHandler($db);
		$this->basename = 'paidlog';
		$this->autoid = 'paidid';
		$this->dbname = 'obook_paidlog';
	}
}
?>
