<?php
/**
 * ���ݱ���(jieqi_pay_balance - ֧������)
 *
 * ���ݱ���(jieqi_pay_balance - ֧������)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: balance.php 234 2008-11-28 01:53:06Z juny $
 */

jieqi_includedb();
//�����¼
class JieqiBalance extends JieqiObjectData
{
    function JieqiBalance()
    {
        $this->JieqiObject();
        $this->initVar('balid', JIEQI_TYPE_INT, 0, '���', false);
        $this->initVar('baltime', JIEQI_TYPE_INT, 0, '����ʱ��', false);
        $this->initVar('fromid', JIEQI_TYPE_INT, 0, '����Ա���', false);
        $this->initVar('fromname', JIEQI_TYPE_TXTBOX, '', '����Ա',false, 30);
        $this->initVar('toid', JIEQI_TYPE_INT, 0, '���������', false);
        $this->initVar('toname', JIEQI_TYPE_TXTBOX, '', '������',false, 30);
        $this->initVar('baltype', JIEQI_TYPE_TXTAREA, '', '���㷽ʽ', false);
        $this->initVar('ballog', JIEQI_TYPE_TXTAREA, '', '����˵��', false);
        $this->initVar('balegold', JIEQI_TYPE_INT, 0, '�����������', false);
        $this->initVar('moneytype', JIEQI_TYPE_INT, 0, '��������', false);
        $this->initVar('balmoney', JIEQI_TYPE_INT, 0, '������', false);
        $this->initVar('balflag', JIEQI_TYPE_INT, 0, '�����־', false);
    }
}


//�û�����
class JieqiBalanceHandler extends JieqiObjectHandler
{
	function JieqiBalanceHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='balance';
	    $this->autoid='balid';	
	    $this->dbname='pay_balance';
	}
}


?>