<?php
//Zend 5.2 PHP�����޸���:��Դ�� http://Www.ZhaoYuanMa.Com ��վ�����ṩ,QQ:7530782  
//�޸���������:0��
//�޸���������:5��
//�޸���������:0��
//�Զ���������:0��

?>
<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

jieqi_includedb( );
class jieqiattachment extends jieqiobjectdata
{

    function jieqiattachment( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "attachid", JIEQI_TYPE_INT, 0, "�������", 10 );
        $this->initvar( "attachname", JIEQI_TYPE_TXTBOX, "", "��������", true, 20 );
        $this->initvar( "attachtype", JIEQI_TYPE_TXTBOX, "", "��������", true, 5 );
        $this->initvar( "attachpath", JIEQI_TYPE_TXTBOX, "", "����·��", true, 50 );
        $this->initvar( "attachsize", JIEQI_TYPE_INT, 0, "������С", true, 5 );
        $this->initvar( "attachdate", JIEQI_TYPE_TXTBOX, "", "�ϴ�����", true, 20 );
    }

}

class jieqiattachmenthandler extends jieqiobjecthandler
{

    function jieqiattachmenthandler( $b0e9 = "" )
    {
        $this->jieqiobjecthandler( $b0e9 );
        $this->basename = "attachment";
        $this->autoid = "attachid";
        $this->dbname = "news_attachment";
    }

    function jieqiattachmentpath( $attachid = null )
    {
        $sql = "SELECT attachpath FROM ".jieqi_dbprefix( $this->dbname )." ";
        $sql .= "WHERE attachid=".intval( $attachid );
        if ( $Result = $this->execute( $sql ) )
        {
            if ( $RS = $this->getrow( $Result ) )
            {
                return $RS['attachpath'];
            }
        }
        else
        {
            return false;
        }
    }

}

?>
