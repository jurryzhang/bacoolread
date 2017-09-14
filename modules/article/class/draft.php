<?php
jieqi_includedb();
class JieqiDraft extends JieqiObjectData
{
	function JieqiDraft()
	{
		$this->JieqiObjectData();
		$this->initVar('draftid', JIEQI_TYPE_INT, 0, '���', false, 11);
		$this->initVar('articleid', JIEQI_TYPE_INT, 0, 'С˵���', true, 11);
		$this->initVar('articlename', JIEQI_TYPE_TXTBOX, '', 'С˵����', false, 250);
		$this->initVar('posterid', JIEQI_TYPE_INT, 0, '���������', false, 11);
		$this->initVar('poster', JIEQI_TYPE_TXTBOX, '', '������', false, 30);
		$this->initVar('postdate', JIEQI_TYPE_INT, 0, '��������', false, 11);
		$this->initVar('lastupdate', JIEQI_TYPE_INT, 0, '������', false, 11);
		$this->initVar('pubdate', JIEQI_TYPE_INT, 0, '��ʱ����ʱ��', false, 11);
		$this->initVar('saleprice', JIEQI_TYPE_INT, 0, '���ۼ۸�', false, 11);
		$this->initVar('chaptername', JIEQI_TYPE_TXTBOX, '', '�½ڱ���', true, 250);
		$this->initVar('chaptercontent', JIEQI_TYPE_TXTAREA, '', '�½�����', true, NULL);
		$this->initVar('size', JIEQI_TYPE_INT, 0, '�ֽ���', false, 11);
		$this->initVar('note', JIEQI_TYPE_TXTAREA, '', '��ע', false, NULL);
		$this->initVar('drafttype', JIEQI_TYPE_INT, 0, '����', false, 1);
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
