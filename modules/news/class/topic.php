<?php
//Zend 5.2 PHP程序修复由:找源码 http://Www.ZhaoYuanMa.Com 网站在线提供,QQ:7530782  
//修复混淆函数:0个
//修复混淆变量:6个
//修复混淆类名:0个
//自动混淆变量:96个

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
        $this->initvar( "newsid", JIEQI_TYPE_INT, 0, "新闻序号", 10 );
        $this->initvar( "firstid", JIEQI_TYPE_INT, 0, "一级序号", true, 5 );
        $this->initvar( "secondid", JIEQI_TYPE_INT, 0, "二级序号", true, 5 );
        $this->initvar( "newstitle", JIEQI_TYPE_TXTBOX, "", "新闻标题", true, 50 );
        $this->initvar( "newskeyword", JIEQI_TYPE_TXTBOX, "", "关键字", 50 );
        $this->initvar( "newssummary", JIEQI_TYPE_TXTAREA, "", "新闻摘要", 255 );
        $this->initvar( "newssource", JIEQI_TYPE_TXTBOX, "", "新闻来源", 20 );
        $this->initvar( "newsimage", JIEQI_TYPE_TXTBOX, "", "新闻图片", 50 );
        $this->initvar( "newsputtop", JIEQI_TYPE_INT, 0, "新闻置顶", true, 3 );
        $this->initvar( "newsclick", JIEQI_TYPE_INT, 0, "新闻点击", true, 9 );
        $this->initvar( "newsstatus", JIEQI_TYPE_INT, 0, "新闻状态", true, 3 );
        $this->initvar( "newsdate", JIEQI_TYPE_TXTBOX, "", "新闻日期", true, 20 );
        $this->initvar( "newshtmlpath", JIEQI_TYPE_TXTBOX, "", "静态路径", true, 50 );
        $this->initvar( "newsauthorid", JIEQI_TYPE_INT, 0, "作者序号", true, 10 );
        $this->initvar( "newsauthor", JIEQI_TYPE_TXTBOX, "", "新闻作者", true, 20 );
        $this->initvar( "newsposterid", JIEQI_TYPE_INT, 0, "发布者号", true, 10 );
        $this->initvar( "newsposter", JIEQI_TYPE_TXTBOX, "", "发布者", true, 20 );
        $this->initvar( "newsip", JIEQI_TYPE_TXTBOX, "", "作者的IP", true, 20 );
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
