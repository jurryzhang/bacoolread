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

class blocknewsupdatelist extends jieqiblock
{

	var $blockvars = array( );
	var $exevars = array( 'firstid' => 0, 'secondid' => 0, 'listnum' => 10, 'titlewords' => 16 );
	var $template = "block_newsupdatelist.html";
	var $cachetime = JIEQI_CACHE_LIFETIME;

	public function blocknewsupdatelist( &$VARS )
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
				if ( $_GET['block'] == "dynamic" && $_GET['pid'] )
				{
					$varary[0] = trim( $_GET['pid'] );
				}
				else
				{
					$varary[0] = trim( $varary[0] );
				}
				if ( is_numeric( $varary[0] ) && 0 < $varary[0] )
				{
					$this->exevars['firstid'] = intval( $varary[0] );
				}
			}
			if ( 1 < $arynum )
			{
				if ( $_GET['block'] == "dynamic" && $_GET['pid'] && $_GET['cid'] )
				{
					$varary[1] = trim( $_GET['cid'] );
				}
				else
				{
					$varary[1] = trim( $varary[1] );
				}
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
		include_once( $jieqiModules['news']['path']."/class/topic.php" );
		include_once( $jieqiModules['news']['path']."/class/category.php" );
		include( JIEQI_ROOT_PATH."/configs/news/configs.php" );
		$topic_handler = JieqiNewsTopicHandler::getInstance( "JieqiNewsTopicHandler" );
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
		while ( $v = $topic_handler->getobject() ){
			$newsrows[$k] = jieqi_query_rowvars($v);
			$newsrows[$k]['news_url'] = $jieqiConfigs['news']['htmlfilesenable'] ? JIEQI_URL."/files/news/".$v->getvar( "newshtmlpath" ) : $jieqiModules['news']['url']."/newshow.php?id=".$v->getvar( "newsid" );
			$k++;
		}
		$jieqiTpl->assign( "newsrows", $newsrows );
		$jieqiTpl->assign( "iconpath", $jieqiModules['news']['url']."/images/" );
		if ( $this->exevars['firstid'] && $this->exevars['secondid'] )
		{
			$jieqiTpl->assign( "url_more", $jieqiModules['news']['url']."/newslist.php?pid=".$this->exevars['firstid']."&cid=".$this->exevars['secondid'] );
		}
		else if ( $this->exevars['firstid'] )
		{
			$jieqiTpl->assign( "url_more", $jieqiModules['news']['url']."/newslist.php?pid=".$this->exevars['firstid']."&cid=0" );
		}
		else
		{
			$jieqiTpl->assign( "url_more", $jieqiModules['news']['url']."/indexa.php" );
		}
	}

}

?>
