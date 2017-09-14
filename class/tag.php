<?php
/**
 * 数据表类(jieqi_system_vips - 用户组表)
 *
 * 数据表类(jieqi_system_vips - 用户组表)
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: groups.php 312 2008-12-29 05:30:54Z juny $
 */

jieqi_includedb();
//用户组
class JieqiTag extends JieqiObjectData
{
    function JieqiTag()
    {
        $this->JieqiObject();
        $this->initVar('tagid', JIEQI_TYPE_INT, 0, '序号', false, 5);
        $this->initVar('tagname', JIEQI_TYPE_TXTBOX, '', '关键字',true, 255);
        $this->initVar('addtime', JIEQI_TYPE_INT, 0, '时间', false, 11);
		$this->initVar('tagsort', JIEQI_TYPE_INT, 0, '分类', false, 11);
		$this->initVar('userid', JIEQI_TYPE_INT, 0, '用户id', false, 11);
		$this->initVar('username', JIEQI_TYPE_TXTBOX, '', '用户名',true, 255);
		$this->initVar('linknum', JIEQI_TYPE_INT, 0, '次数', false, 11);
        $this->initVar('display', JIEQI_TYPE_INT, 0, '类型', false, 1);
    }
}

//用户组句柄
class JieqiTagHandler extends JieqiObjectHandler
{
	function JieqiTagHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='tag';
	    $this->autoid='tagid';	
	    $this->dbname='system_tag';
	}
}

?>