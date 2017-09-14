<?php
/**
 * ���ݱ���(jieqi_pay_paylog - ��ֵ��¼)
 *
 * ���ݱ���(jieqi_pay_paylog - ��ֵ��¼)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: paylog.php 234 2008-11-28 01:53:06Z juny $
 */

jieqi_includedb();
//֧����־
class JieqiPaylog extends JieqiObjectData
{
    function JieqiPaylog()
    {
        $this->JieqiObject();
        $this->initVar('payid', JIEQI_TYPE_INT, 0, '���', false);
        $this->initVar('siteid', JIEQI_TYPE_INT, 0, '��վ���', false, 6);
        $this->initVar('buytime', JIEQI_TYPE_INT, 0, '����ʱ��', false);
        $this->initVar('rettime', JIEQI_TYPE_INT, 0, '����ʱ��', false);
        $this->initVar('buyid', JIEQI_TYPE_INT, 0, '���������', false);
        $this->initVar('buyname', JIEQI_TYPE_TXTBOX, '', '������',false, 30);
        $this->initVar('buyinfo', JIEQI_TYPE_TXTAREA, '', '��������Ϣ', false);
        $this->initVar('moneytype', JIEQI_TYPE_INT, 0, '�������', false);
        $this->initVar('money', JIEQI_TYPE_INT, 0, '���', false);
        $this->initVar('egoldtype', JIEQI_TYPE_INT, 0, '�����������', false);
        $this->initVar('egold', JIEQI_TYPE_INT, 0, '�������', false);
        $this->initVar('paytype', JIEQI_TYPE_TXTBOX, '', '֧������', false);
        $this->initVar('retserialno', JIEQI_TYPE_TXTAREA, '', '������ˮ��', false);
        $this->initVar('retaccount', JIEQI_TYPE_TXTAREA, '', '�����˺�', false);
        $this->initVar('retinfo', JIEQI_TYPE_TXTAREA, '', '������Ϣ', false);
        $this->initVar('masterid', JIEQI_TYPE_INT, 0, '����Ա���', false);
        $this->initVar('mastername', JIEQI_TYPE_TXTBOX, '', '����Ա',false, 30);
        $this->initVar('masterinfo', JIEQI_TYPE_TXTAREA, '', '����Ա��Ϣ', false);
        $this->initVar('note', JIEQI_TYPE_TXTAREA, '', '��ע', false);
        $this->initVar('payflag', JIEQI_TYPE_INT, 0, '֧����־', false);
    }
}


//�û�����
class JieqiPaylogHandler extends JieqiObjectHandler
{
	function JieqiPaylogHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='paylog';
	    $this->autoid='payid';	
	    $this->dbname='pay_paylog';
	}
}


?>