<?php 
/**
 * 数据表类(jieqi_article_author - 作者实名表)
 *
 * 数据表类(jieqi_article_author - 作者实名表)
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: bookcase.php 230 2008-11-27 08:46:07Z juny $
 */

jieqi_includedb();
//用户类
class JieqiAuthor extends JieqiObjectData
{
	//构建函数
	function JieqiAuthor()
	{
		$this->JieqiObjectData();
		$this->initVar('id', JIEQI_TYPE_INT, 0, '作者序号', false, 11);
		$this->initVar('uid', JIEQI_TYPE_INT, 0, '用户ID', false, 11);
		$this->initVar('realname', JIEQI_TYPE_TXTBOX, '', '真实姓名', false, 250);
		$this->initVar('telephone', JIEQI_TYPE_TXTBOX, '', '电话', false, 250);
		$this->initVar('mobilephone', JIEQI_TYPE_TXTBOX, '', '手机', false, 250);
		$this->initVar('idcardtype', JIEQI_TYPE_INT, 0, '证件类型', false, 250);
		$this->initVar('idcard', JIEQI_TYPE_TXTBOX, '', '证件号码', false, 250);
		$this->initVar('address', JIEQI_TYPE_TXTBOX, '', '联系地址', false, 250);
		$this->initVar('zipcode', JIEQI_TYPE_TXTBOX, '', '邮编', false, 250);
		$this->initVar('banktype', JIEQI_TYPE_TXTBOX, '', '银行名称', false, 250);
		$this->initVar('bankname', JIEQI_TYPE_TXTBOX, '', '银行所在地', false, 250);
		$this->initVar('bankcard', JIEQI_TYPE_TXTBOX, '', '卡号', false, 250);
		$this->initVar('bankuser', JIEQI_TYPE_TXTBOX, '', '持卡人姓名', false, 250);
		$this->initVar('flag', JIEQI_TYPE_INT, 0, '标志', false, 1);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//内容句柄
class JieqiAuthorHandler extends JieqiObjectHandler
{
	function JieqiAuthorHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='author';
	    $this->autoid='id';	
	    $this->dbname='article_author';
	}
}

?>