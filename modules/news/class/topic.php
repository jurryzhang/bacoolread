<?php
//Zend 5.2 PHP�����޸���:��Դ�� http://Www.ZhaoYuanMa.Com ��վ�����ṩ,QQ:7530782  
//�޸���������:0��
//�޸���������:6��
//�޸���������:0��
//�Զ���������:96��

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
class jieqinewstopic extends jieqiobjectdata
{

    function jieqinewstopic( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "newsid", JIEQI_TYPE_INT, 0, "�������", 10 );
        $this->initvar( "firstid", JIEQI_TYPE_INT, 0, "һ�����", true, 5 );
        $this->initvar( "secondid", JIEQI_TYPE_INT, 0, "�������", true, 5 );
        $this->initvar( "newstitle", JIEQI_TYPE_TXTBOX, "", "���ű���", true, 50 );
        $this->initvar( "newskeyword", JIEQI_TYPE_TXTBOX, "", "�ؼ���", 50 );
        $this->initvar( "newssummary", JIEQI_TYPE_TXTAREA, "", "����ժҪ", 255 );
        $this->initvar( "newssource", JIEQI_TYPE_TXTBOX, "", "������Դ", 20 );
        $this->initvar( "newsimage", JIEQI_TYPE_TXTBOX, "", "����ͼƬ", 50 );
        $this->initvar( "newsputtop", JIEQI_TYPE_INT, 0, "�����ö�", true, 3 );
        $this->initvar( "newsclick", JIEQI_TYPE_INT, 0, "���ŵ��", true, 9 );
        $this->initvar( "newsstatus", JIEQI_TYPE_INT, 0, "����״̬", true, 3 );
        $this->initvar( "newsdate", JIEQI_TYPE_TXTBOX, "", "��������", true, 20 );
        $this->initvar( "newshtmlpath", JIEQI_TYPE_TXTBOX, "", "��̬·��", true, 50 );
        $this->initvar( "newsauthorid", JIEQI_TYPE_INT, 0, "�������", true, 10 );
        $this->initvar( "newsauthor", JIEQI_TYPE_TXTBOX, "", "��������", true, 20 );
        $this->initvar( "newsposterid", JIEQI_TYPE_INT, 0, "�����ߺ�", true, 10 );
        $this->initvar( "newsposter", JIEQI_TYPE_TXTBOX, "", "������", true, 20 );
        $this->initvar( "newsip", JIEQI_TYPE_TXTBOX, "", "���ߵ�IP", true, 20 );
    }

}

class jieqinewstopichandler extends jieqiobjecthandler
{

    function jieqinewstopichandler( $db = "" )
    {
        $this->jieqiobjecthandler( $db );
        $this->basename = "NewsTopic";
        $this->autoid = "newsid";
        $this->dbname = "news_topic";
    }

    function jieqinewsidbysecondid( $secondid = null )
    {
        $zym_fbfnptlkcfwpqxhs = array();
        $sql = "SELECT newsid FROM ".jieqi_dbprefix( $this->dbname )." WHERE secondid = ".intval( $secondid );
        if ( $Result = $this->execute( $sql ) )
        {
            while ( $RS = $this->getrow( $Result ) )
            {
                $zym_fbfnptlkcfwpqxhs[] = $RS['newsid'];
            }
            return $zym_fbfnptlkcfwpqxhs;
        }
    }

    function jieqifirstidbynewsid( $newsid = null )
    {
        $sql = "SELECT firstid FROM ".jieqi_dbprefix( $this->dbname )." WHERE newsid = ".intval( $newsid );
        if ( ( $Result = $this->execute( $sql ) ) && ( $RS = $this->getrow( $Result ) ) )
        {
            return $RS['firstid'];
        }
    }

}

?>
