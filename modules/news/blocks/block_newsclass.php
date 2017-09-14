<?php
//Zend 5.2 PHP程序修复由:找源码 http://Www.ZhaoYuanMa.Com 网站在线提供,QQ:7530782  
//修复混淆函数:0个
//修复混淆变量:3个
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

class blocknewsclass extends jieqiblock
{

    var $blockvars = array( );
    var $exevars = array
    (
        "firstid" => 0,
        "secondid" => 0,
        "listnum" => 5,
        "titlewords" => 40
    );
    var $template = "block_newslist.html";
    var $cachetime = JIEQI_CACHE_LIFETIME;

    public function blocknewsclass( &$VARS )
    {
		global $jieqiModules;
		global $jieqiTpl;
		global $jieqiTop;
        $this->jieqiblock( $VARS );
        if ( !empty( $this->blockvars['vars'] ) )
        {
            $varary = explode( ",", trim( $this->blockvars['vars'] ) );
            $arynum = count( $varary );
            if ( 0 < $arynum )
            {
                $varary[0] = trim( $varary[0] );
                if ( is_numeric( $varary[0] ) && 0 < $varary[0] )
                {
                    $this->exevars['long'] = intval( $varary[0] );
                }
            }
            if ( 1 < $arynum )
            {
                $varary[1] = trim( $varary[1] );
                if ( is_numeric( $varary[1] ) && 0 < $varary[1] )
                {
                    $this->exevars['num'] = intval( $varary[1] );
                }
            }
        }
        if ( !empty( $this->blockvars['template'] ) || is_file( $jieqiModules['news']['path']."/templates/blocks/".$this->blockvars['template'] ) )
        {
            $this->template = $this->blockvars['template'];
        }
    }

    public function setcontent( $isreturn = false )
    {
        global $jieqiTpl;
        global $jieqiCache;
		global $jieqiModules;
        include_once( $jieqiModules['news']['path']."/class/category.php" );
        include( JIEQI_ROOT_PATH."/configs/news/configs.php" );
        $category_handler = jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
        $criteria = new criteriacompo( );
        $criteria->add( new criteria( "parentid", 0 ) );
        $criteria->setsort( "categoryid" );
        $criteria->setorder( "DESC" );
        $criteria->setlimit( $this->exevars['num'] );
        $criteria->setstart( 0 );
        $category_handler->queryobjects( $criteria );
        $newsrows = array( );
        $k = 0;
        while ( $v = $category_handler->getobject( ) )
        {
            $newsrows[$k]['categoryname'] = $v->getvar( "categoryname" );
            $newsrows[$k]['categoryid'] = $v->getvar( "categoryid" );
            $k++;
        }
        $jieqiTpl->assign( "long", $this->exevars['long'] );
        $jieqiTpl->assign_by_ref( "newsrows", $newsrows );
        $jieqiTpl->assign( "url_more", $jieqiModules['news']['url']."/indexa.php" );
    }

}

?>
