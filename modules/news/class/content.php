<?php
//Zend 5.2 PHP�����޸���:��Դ�� http://Www.ZhaoYuanMa.Com ��վ�����ṩ,QQ:7530782  
//�޸���������:0��
//�޸���������:6��
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
class jieqinewscontent extends jieqiobjectdata
{

    function jieqinewscontent( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "newsid", JIEQI_TYPE_INT, 0, "�������", 10 );
        $this->initvar( "newscontent", JIEQI_TYPE_TXTAREA, "", "��������", true );
    }

}

class jieqinewscontenthandler extends jieqiobjecthandler
{

    function jieqinewscontenthandler( $db = "" )
    {
        $this->jieqiobjecthandler( $db );
        $this->basename = "NewsContent";
        $this->autoid = "";
        $this->dbname = "news_content";
    }

    function jieqinewscontentexsit( $id = null )
    {
        $sql = "SELECT newsid FROM ".jieqi_dbprefix( $this->dbname ).( " WHERE newsid=".$id );
        if ( $Result = $this->execute( $sql ) )
        {
            return $this->db->getrowsnum( $Result );
        }
    }

    function jieqinewscontentbyid( $id = null )
    {
        $sql = "SELECT newscontent FROM ".jieqi_dbprefix( $this->dbname ).( " WHERE newsid=".$id );
        if ( ( $Result = $this->execute( $sql ) ) && ( $RS = $this->getrow( $Result ) ) )
        {
            return $RS['newscontent'];
        }
        return false;
    }

    function jieqinewscontentupdate( $id = null, $Value = null )
    {
        $sql = "UPDATE ".jieqi_dbprefix( $this->dbname )." SET newscontent='".jieqi_dbslashes( $Value ).( "' WHERE newsid=".$id );
        if ( $this->execute( $sql ) )
        {
            return true;
        }
        return false;
    }

    function jieqinewscontentdelete( $id = null )
    {
        $sql = "DELETE FROM ".jieqi_dbprefix( $this->dbname ).( " WHERE newsid=".$id );
        if ( $this->execute( $sql ) )
        {
            return true;
        }
        return false;
    }

}

?>
