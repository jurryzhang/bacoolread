<?php
//Zend 5.2 PHP程序修复由:找源码 http://Www.ZhaoYuanMa.Com 网站在线提供,QQ:7530782  
//修复混淆函数:0个
//修复混淆变量:6个
//修复混淆类名:0个
//自动混淆变量:0个

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
        $this->initvar( "newsid", JIEQI_TYPE_INT, 0, "新闻序号", 10 );
        $this->initvar( "newscontent", JIEQI_TYPE_TXTAREA, "", "新闻内容", true );
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
