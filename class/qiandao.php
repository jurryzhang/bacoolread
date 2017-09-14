<?php 


jieqi_includedb();
//用户类
class JieqiQiandao extends JieqiObjectData
{
	//构建函数
	function JieqiQiandao()
	{
		$this->JieqiObjectData();
		$this->initVar('id', JIEQI_TYPE_INT, 0, '序号', false, 11);
		$this->initVar('totalsign', JIEQI_TYPE_INT, 0, '签到次数', true, 11);
		$this->initVar('dates', JIEQI_TYPE_TXTBOX, '', '签到日期', false, 550);
		$this->initVar('time', JIEQI_TYPE_INT, 0, '最后一次签到时间', false, 11);
		$this->initVar('uid', JIEQI_TYPE_INT, 0, '用户ID', false, 11);
        $this->initVar('uname', JIEQI_TYPE_TXTBOX, '', '用户名', false, 30);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//内容句柄
class JieqiQiandaoHandler extends JieqiObjectHandler
{
	function JieqiQiandaoHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='qiandao';
	    $this->autoid='id';	
	    $this->dbname='system_qiandao';
	}
}

?>