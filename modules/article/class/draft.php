<?php
jieqi_includedb();
class JieqiDraft extends JieqiObjectData
{
	function JieqiDraft()
	{
		$this->JieqiObjectData();
		$this->initVar('draftid', JIEQI_TYPE_INT, 0, '序号', false, 11);
		$this->initVar('articleid', JIEQI_TYPE_INT, 0, '小说序号', true, 11);
		$this->initVar('articlename', JIEQI_TYPE_TXTBOX, '', '小说名称', false, 250);
		$this->initVar('posterid', JIEQI_TYPE_INT, 0, '发表者序号', false, 11);
		$this->initVar('poster', JIEQI_TYPE_TXTBOX, '', '发表者', false, 30);
		$this->initVar('postdate', JIEQI_TYPE_INT, 0, '发表日期', false, 11);
		$this->initVar('lastupdate', JIEQI_TYPE_INT, 0, '最后更新', false, 11);
		$this->initVar('pubdate', JIEQI_TYPE_INT, 0, '定时发表时间', false, 11);
		$this->initVar('saleprice', JIEQI_TYPE_INT, 0, '销售价格', false, 11);
		$this->initVar('chaptername', JIEQI_TYPE_TXTBOX, '', '章节标题', true, 250);
		$this->initVar('chaptercontent', JIEQI_TYPE_TXTAREA, '', '章节内容', true, NULL);
		$this->initVar('size', JIEQI_TYPE_INT, 0, '字节数', false, 11);
		$this->initVar('note', JIEQI_TYPE_TXTAREA, '', '备注', false, NULL);
		$this->initVar('drafttype', JIEQI_TYPE_INT, 0, '类型', false, 1);
	}
}

class JieqiDraftHandler extends JieqiObjectHandler
{
	function JieqiDraftHandler($db = '')
	{
		$this->JieqiObjectHandler($db);
		$this->basename = 'draft';
		$this->autoid = 'draftid';
		$this->dbname = 'article_draft';
	}
}



?>
