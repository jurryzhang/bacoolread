<?php
/**
 * ���ݱ���(jieqi_pay_transfer - ת�˼�¼)
 *
 * ���ݱ���(jieqi_pay_transfer - ת�˼�¼)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: transfer.php 300 2008-12-26 04:36:06Z juny $
 */

jieqi_includedb();
//ת�ʼ�¼
class JieqiTransfer extends JieqiObjectData
{
    function JieqiTransfer()
    {
        $this->JieqiObject();
        $this->initVar('transid', JIEQI_TYPE_INT, 0, '���', false, 11);
        $this->initVar('transtime', JIEQI_TYPE_INT, 0, '����ʱ��', false, 11);
        $this->initVar('fromid', JIEQI_TYPE_INT, 0, 'ת�������', false, 11);
        $this->initVar('fromname', JIEQI_TYPE_TXTBOX, '', 'ת����',false, 30);
        $this->initVar('toid', JIEQI_TYPE_INT, 0, 'ת�������', false, 11);
        $this->initVar('toname', JIEQI_TYPE_TXTBOX, '', 'ת����',false, 30);
        $this->initVar('translog', JIEQI_TYPE_TXTAREA, '', 'ת��˵��', false, NULL);
        $this->initVar('transegold', JIEQI_TYPE_INT, 0, 'ת�����', false, 11);
        $this->initVar('receiveegold', JIEQI_TYPE_INT, 0, '�յ����', false, 11);
        $this->initVar('mastertime', JIEQI_TYPE_INT, 0, '����ʱ��', false, 11);
        $this->initVar('masterid', JIEQI_TYPE_INT, 0, '����Ա���', false, 11);
        $this->initVar('mastername', JIEQI_TYPE_TXTBOX, '', '����Ա',false, 30);
        $this->initVar('masterlog', JIEQI_TYPE_TXTAREA, '', '����˵��', false, NULL);
        $this->initVar('transtype', JIEQI_TYPE_INT, 0, 'ת�ʷ�ʽ', false, 1); //(1-���������ת����2-�ӿ�������ת����3-�ӻ���ת��)
        $this->initVar('errflag', JIEQI_TYPE_INT, 0, '�����־', false, 1);
        $this->initVar('transflag', JIEQI_TYPE_INT, 0, 'ת��״̬', false, 1);//(0-׼��ת�ʣ� 1-�Ѿ�ת���� 2-�Ѿ�ת�룬 3-�ֹ�ȷ�ϣ� 4-�ֹ��˿�)
    }
}


//�û�����
class JieqiTransferHandler extends JieqiObjectHandler
{
	function JieqiTransferHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='transfer';
	    $this->autoid='transid';	
	    $this->dbname='pay_transfer';
	}
}


?>