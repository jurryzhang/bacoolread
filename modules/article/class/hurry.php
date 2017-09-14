<?php 


jieqi_includedb();
//用户类
class JieqiHurry extends JieqiObjectData
{
	//构建函数
	function JieqiHurry()
	{
		$this->JieqiObjectData();
		$this->initVar('hurryid', JIEQI_TYPE_INT, 0, '催更序号', false, 11);
		$this->initVar('articleid', JIEQI_TYPE_INT, 0, '文章序号', true, 11);
		$this->initVar('vipid', JIEQI_TYPE_INT, 0, '电子书序号', true, 11);
		$this->initVar('articlename', JIEQI_TYPE_TXTBOX, '', '文章名称', false, 250);
		$this->initVar('uid', JIEQI_TYPE_INT, 0, '催更用户序号', false, 11);
		$this->initVar('authorid', JIEQI_TYPE_INT, 0, '催更用户序号', false, 11);
        $this->initVar('uname', JIEQI_TYPE_TXTBOX, '', '催更者', false, 30);
		$this->initVar('payegold', JIEQI_TYPE_INT, 0, '虚拟币数量', false, 11);
		$this->initVar('winegold', JIEQI_TYPE_INT, 0, '虚拟币数量2', false, 11);
		$this->initVar('minsize', JIEQI_TYPE_INT, 0, '催更字节数', false, 11);
		$this->initVar('overtime', JIEQI_TYPE_INT, 0, '催更结束时间', false, 11);
		$this->initVar('payflag', JIEQI_TYPE_INT, 0, '类型', false, 11);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//内容句柄
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