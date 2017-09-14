<?php
jieqi_includedb();
class JieqiObook extends JieqiObjectData
{
	public function JieqiObook()
	{
		$this->JieqiObjectData();
		$this->initVar('obookid', JIEQI_TYPE_INT, 0, '序号', false, 11);
		$this->initVar('siteid', JIEQI_TYPE_INT, 0, '网站序号', false, 6);
		$this->initVar('postdate', JIEQI_TYPE_INT, 0, '加入日期', false, 11);
		$this->initVar('lastupdate', JIEQI_TYPE_INT, 0, '更新日期', false, 11);
		$this->initVar('obookname', JIEQI_TYPE_TXTBOX, '', '电子书名', true, 100);
		$this->initVar('keywords', JIEQI_TYPE_TXTBOX, '', '关键字', false, 250);
		$this->initVar('articleid', JIEQI_TYPE_INT, 0, '相关小说序号', false, 11);
		$this->initVar('initial', JIEQI_TYPE_TXTBOX, '', '书名首字母', false, 1);
		$this->initVar('sortid', JIEQI_TYPE_INT, 0, '分类序号', false, 6);
		$this->initVar('intro', JIEQI_TYPE_TXTAREA, '', '内容简介', false, NULL);
		$this->initVar('notice', JIEQI_TYPE_TXTAREA, '', '本书公告', false, NULL);
		$this->initVar('setting', JIEQI_TYPE_TXTAREA, '', '小说参数', false, NULL);
		$this->initVar('lastvolumeid', JIEQI_TYPE_INT, 0, '最新分卷序号', false, 11);
		$this->initVar('lastvolume', JIEQI_TYPE_TXTBOX, '', '最新分卷', false, 255);
		$this->initVar('lastchapterid', JIEQI_TYPE_INT, 0, '最新章节序号', false, 11);
		$this->initVar('lastchapter', JIEQI_TYPE_TXTBOX, '', '最新章节', false, 255);
		$this->initVar('chapters', JIEQI_TYPE_INT, 0, '章节数', false, 6);
		$this->initVar('authorid', JIEQI_TYPE_INT, 0, '作者序号', false, 11);
		$this->initVar('author', JIEQI_TYPE_TXTBOX, '', '作者', false, 50);
		$this->initVar('aintro', JIEQI_TYPE_TXTAREA, '', '作者简介', false, NULL);
		$this->initVar('agentid', JIEQI_TYPE_INT, 0, '所有人序号', false, 11);
		$this->initVar('agent', JIEQI_TYPE_TXTBOX, '', '所有人', false, 50);
		$this->initVar('posterid', JIEQI_TYPE_INT, 0, '发表者序号', false, 11);
		$this->initVar('poster', JIEQI_TYPE_TXTBOX, '', '发表者', false, 50);
		$this->initVar('publishid', JIEQI_TYPE_INT, 0, '出版者序号', false, 11);
		$this->initVar('tbookinfo', JIEQI_TYPE_TXTAREA, '', '实体书信息', false, NULL);
		$this->initVar('toptime', JIEQI_TYPE_INT, 0, '置顶时间', false, 11);
		$this->initVar('goodnum', JIEQI_TYPE_INT, 0, '收藏量', false, 11);
		$this->initVar('badnum', JIEQI_TYPE_INT, 0, '投诉量', false, 11);
		$this->initVar('fullflag', JIEQI_TYPE_INT, 0, '书籍发全标志', false, 1);
		$this->initVar('imgflag', JIEQI_TYPE_INT, 0, '图片标志', false, 1);
		$this->initVar('saleprice', JIEQI_TYPE_INT, 0, '销售价格', false, 11);
		$this->initVar('vipprice', JIEQI_TYPE_INT, 0, '优惠价格', false, 11);
		$this->initVar('sumegold', JIEQI_TYPE_INT, 0, '金币总销售额', false, 11);
		$this->initVar('sumesilver', JIEQI_TYPE_INT, 0, '银币总销售额', false, 11);
		$this->initVar('sumtip', JIEQI_TYPE_INT, 0, '打赏总额', false, 11);
		$this->initVar('sumhurry', JIEQI_TYPE_INT, 0, '催更总额', false, 11);
		$this->initVar('sumbesp', JIEQI_TYPE_INT, 0, '包月收入总额', false, 11);
		$this->initVar('sumaward', JIEQI_TYPE_INT, 0, '奖金总额', false, 11);
		$this->initVar('sumagent', JIEQI_TYPE_INT, 0, '代理销售总额', false, 11);
		$this->initVar('sumgift', JIEQI_TYPE_INT, 0, '礼品收入总额', false, 11);
		$this->initVar('sumother', JIEQI_TYPE_INT, 0, '其它收入总额', false, 11);
		$this->initVar('sumemoney', JIEQI_TYPE_INT, 0, '虚拟币收入总额', false, 11);
		$this->initVar('summoney', JIEQI_TYPE_INT, 0, '作者总提成金额', false, 11);
		$this->initVar('paidmoney', JIEQI_TYPE_INT, 0, '已付提成金额', false, 11);
		$this->initVar('paidemoney', JIEQI_TYPE_INT, 0, '已付提成虚拟币', false, 11);
		$this->initVar('paytime', JIEQI_TYPE_INT, 0, '支付时间', false, 11);
		$this->initVar('normalsale', JIEQI_TYPE_INT, 0, '普通价格销售量', false, 11);
		$this->initVar('vipsale', JIEQI_TYPE_INT, 0, 'VIP价格销售量', false, 11);
		$this->initVar('freesale', JIEQI_TYPE_INT, 0, '免费阅读销售量', false, 11);
		$this->initVar('bespsale', JIEQI_TYPE_INT, 0, '包月阅读销售量', false, 11);
		$this->initVar('totalsale', JIEQI_TYPE_INT, 0, '代理销售量', false, 11);
		$this->initVar('daysale', JIEQI_TYPE_INT, 0, '本日销售量', false, 11);
		$this->initVar('weeksale', JIEQI_TYPE_INT, 0, '本周销售量', false, 11);
		$this->initVar('monthsale', JIEQI_TYPE_INT, 0, '本月销售量', false, 11);
		$this->initVar('allsale', JIEQI_TYPE_INT, 0, '总销售量', false, 11);
		$this->initVar('lastsale', JIEQI_TYPE_INT, 0, '最后销售时间', false, 11);
		$this->initVar('canvip', JIEQI_TYPE_INT, 0, '是否允许VIP阅读', false, 1);
		$this->initVar('canfree', JIEQI_TYPE_INT, 0, '是否允许免费阅读', false, 1);
		$this->initVar('canbesp', JIEQI_TYPE_INT, 0, '是否允许包月阅读', false, 1);
		$this->initVar('hasebook', JIEQI_TYPE_INT, 0, '是否有电子书', false, 1);
		$this->initVar('hastbook', JIEQI_TYPE_INT, 0, '是否有实体书', false, 1);
		$this->initVar('state', JIEQI_TYPE_INT, 0, '共享状态', false, 1);
		$this->initVar('flag', JIEQI_TYPE_INT, 0, '标志', false, 1);
		$this->initVar('display', JIEQI_TYPE_INT, 0, '是否显示', false, 1);
	}
}

class JieqiObookHandler extends JieqiObjectHandler
{
	public function JieqiObookHandler($db = '')
	{
		$this->JieqiObjectHandler($db);
		$this->basename = 'obook';
		$this->autoid = 'obookid';
		$this->dbname = 'obook_obook';
	}
}



?>
