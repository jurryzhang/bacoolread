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
/*  Dezend for PHP5  */
/*         NWS       */
/*      Nulled.WS    */
/*                   */
/*********************/

class BlockNewslist extends jieqiblock
{

	var $blockvars = array( );
	var $exevars = array( 'firstid' => 0, 'secondid' => 0, 'listnum' => 7, 'titlewords' => 40 );
	var $template = "block_newslist.html";
	var $cachetime = JIEQI_CACHE_LIFETIME;

	public function BlockNewslist( &$VARS )
	{
		global $jieqiModules;
		global $jieqiTpl;
		global $jieqiTop;
		$this->jieqiblock( $VARS );
		if ( empty( $this->blockvars['vars'] ) )
		{
			$varary = explode( ",", trim( $this->blockvars['vars'] ) );
			$arynum = count( $varary );
			if ( 0 < $arynum )
			{
				$varary[0] = trim( $varary[0] );
				if ( is_numeric( $varary[0] ) && 0 < $varary[0] )
				{
					$this->exevars['firstid'] = intval( $varary[0] );
				}
			}
			if ( 1 < $arynum )
			{
				$varary[1] = trim( $varary[1] );
				if ( is_numeric( $varary[1] ) && 0 < $varary[1] )
				{
					$this->exevars['secondid'] = intval( $varary[1] );
				}
			}
			if ( 2 < $arynum )
			{
				$varary[2] = trim( $varary[2] );
				if ( is_numeric( $varary[2] ) && 0 < $varary[2] )
				{
					$this->exevars['listnum'] = intval( $varary[2] );
				}
			}
			if ( 3 < $arynum )
			{
				$varary[3] = trim( $varary[3] );
				if ( is_numeric( $varary[3] ) && 0 < $varary[3] )
				{
					$this->exevars['titlewords'] = intval( $varary[3] );
				}
			}
		}
		if ( !empty( $this->blockvars['template'] ) && is_file( $jieqiModules['news']['path']."/templates/blocks/".$this->blockvars['template'] ) )
		{
			$this->template = $this->blockvars['template'];
		}
		$this->blockvars['cacheid'] = $this->blockvars['bid'];
	}

	public function setcontent( $isreturn = false )
	{
		global $jieqiTpl;
		global $jieqiCache;
		global $jieqiModules;
		
		include_once $jieqiModules['news']['path'].'/class/topic.php';
		include_once $jieqiModules['news']['path'].'/class/category.php';
//		include_once $jieqiModules['news']['path'].'/include/category.php';
		include( JIEQI_ROOT_PATH."/configs/news/configs.php" );
//		include_once JIEQI_ROOT_PATH."/global.php";
		$topic_handler = JieqiNewsTopicHandler::getInstance("JieqiNewsTopicHandler");
		$criteria = new criteriacompo( );
		if ( $this->exevars['firstid'] )
		{
			$criteria->add( new criteria( "firstid", $this->exevars['firstid'] ) );
		}
		if ( $this->exevars['secondid'] )
		{
			$criteria->add( new criteria( "secondid", $this->exevars['secondid'] ) );
		}
		$criteria->add( new criteria( "newsstatus", 1 ) );
		$criteria->setsort( "newsputtop DESC, newsid" );
		$criteria->setorder( "DESC" );
		$criteria->setlimit( $this->exevars['listnum'] );
		$criteria->setstart( 0 );
		$topic_handler->queryobjects( $criteria );
		$newsrows = array( );
		$k = 0;
		while ( $v = $topic_handler->getobject( ) )
		{
			$category_handler = &JieqiCategoryHandler::getInstance( "JieqiCategoryHandler" );
			$newsrows[$k]['id'] = $v->getvar( "newsid" );
			$newsrows[$k]['category'] = $category_handler->jieqicategorynamebyid( $v->getvar( "secondid" ) );
			$newsrows[$k]['url'] = jieqi_geturl('news','show',$v->getvar( "newsid" ));
			$newsrows[$k]['sort'] = $v->getvar( "newsclick" );
			$newsrows[$k]['title'] = $v->getvar( "newstitle" );
/*			$newsrows[$k]['title'] = $jieqiConfigs['news']['newshow'] ? "<a href=\"".JIEQI_URL."/files/news/".$v->getvar( "newshtmlpath" )."\" " : "<a href=\"".$jieqiModules['news']['url']."/newshow.php?id=".$v->getvar( "newsid" )."\" ";
			$newsrows[$k]['title'] .= "target=\"_blank\" title=\"".$v->getvar( "newstitle" )." [".$v->getvar( "newsclick" )."]\">";
			$newsrows[$k]['title'] .= jieqi_substr( $v->getvar( "newstitle" ), 0, $this->exevars['titlewords'], "" );
			$newsrows[$k]['title'] .= "</a> ";
			if ( $v->getvar( "newsimage" ) )
			{
				$newsrows[$k]['title'] .= "[图]";
			}
			if ( $v->getvar( "newsputtop" ) )
			{
				$newsrows[$k]['title'] .= "[顶]";
			}     */
			$newsrows[$k]['date'] = $v->getvar( "newsdate" );
			$k++;
		}
		$jieqiTpl->assign_by_ref( "newsrows", $newsrows );
		$jieqiTpl->assign( "iconpath", $jieqiModules['news']['url']."/images/" );
		$jieqiTpl->assign( "url_more", $jieqiModules['news']['url']."/newslist.php?pid=".$this->exevars['firstid']."&cid=".$this->exevars['secondid'] );
	}

}

?>
