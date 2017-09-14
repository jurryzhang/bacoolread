<?php 


jieqi_includedb();
//用户类
class JieqiMreport extends JieqiObjectData
{
	//构建函数
	public function JieqiMreport()
	{
		$this->JieqiObjectData();
		$this->initVar('id', JIEQI_TYPE_INT, 0, '序号', false, 11);
		$this->initVar('data', JIEQI_TYPE_INT, 0, '日期', false, 11);
		$this->initVar('siteid', JIEQI_TYPE_INT, 0, '平台序号', true, 11);
		$this->initVar('obookname', JIEQI_TYPE_TXTBOX, 0, '电子书名', true, 250);
		$this->initVar('obookid', JIEQI_TYPE_INT, '', '电子书序号', false, 250);
		$this->initVar('articleid', JIEQI_TYPE_INT, '', '文章序号', false, 250);
		$this->initVar('author', JIEQI_TYPE_TXTAREA, '', '作者名', false, 250);
		$this->initVar('sumgold', JIEQI_TYPE_INT, 0, '销售', false, 11);
		$this->initVar('sumtip', JIEQI_TYPE_INT, 0, '打赏', false, 11);
		$this->initVar('sumgift', JIEQI_TYPE_INT, 0, '礼物', false, 11);
		$this->initVar('sumhurry', JIEQI_TYPE_INT, 0, '催更', false, 11);
		$this->initVar('sumemoney', JIEQI_TYPE_INT, 0, '收入', false, 11);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//内容句柄
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