<?php
//Zend 5.2 PHP程序修复由:找源码 http://Www.ZhaoYuanMa.Com 网站在线提供,QQ:7530782  
//修复混淆函数:0个
//修复混淆变量:5个
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
class jieqiattachment extends jieqiobjectdata
{

    function jieqiattachment( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "attachid", JIEQI_TYPE_INT, 0, "附件序号", 10 );
        $this->initvar( "attachname", JIEQI_TYPE_TXTBOX, "", "附件名称", true, 20 );
        $this->initvar( "attachtype", JIEQI_TYPE_TXTBOX, "", "附件类型", true, 5 );
        $this->initvar( "attachpath", JIEQI_TYPE_TXTBOX, "", "附件路径", true, 50 );
        $this->initvar( "attachsize", JIEQI_TYPE_INT, 0, "附件大小", true, 5 );
        $this->initvar( "attachdate", JIEQI_TYPE_TXTBOX, "", "上传日期", true, 20 );
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
