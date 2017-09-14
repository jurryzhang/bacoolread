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

class blocknewstop extends jieqiblock
{

	var $blockvars = array( );
	var $exevars = array( 'newsid' => 0, 'titlewords' => 16, 'summarywords' => 255 );
	var $template = "block_newstop.html";
	var $cachetime = JIEQI_CACHE_LIFETIME;

	public function blocknewstop( &$VARS )
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
				if ( $_GET['block'] == "dynamic" && $_GET['nid'] )
				{
					$varary[0] = trim( $_GET['nid'] );
				}
				else
				{
					$varary[0] = trim( $varary[0] );
				}
				if ( is_numeric( $varary[0] ) && 0 < $varary[0] )
				{
					$this->exevars['newsid'] = intval( $varary[0] );
				}
			}
			if ( 1 < $arynum )
			{
				$varary[1] = trim( $varary[1] );
				if ( is_numeric( $varary[1] ) && 0 < $varary[1] )
				{
					$this->exevars['titlewords'] = intval( $varary[1] );
				}
			}
			if ( 2 < $arynum )
			{
				$varary[2] = trim( $varary[2] );
				if ( is_numeric( $varary[2] ) && 0 < $varary[2] )
				{
					$this->exevars['summarywords'] = intval( $varary[2] );
				}
			}
		}
		if ( !empty( $this->blockvars['template'] ) && is_file( $jieqiModules['news']['path']."/templates/blocks/".$this->blockvars['template'] ) )
		{
			$this->template = $this->blockvars['template'];
		}
		$this->blockvars['cacheid'] = $this->blockvars['bid'];
	}

	function setcontent( $isreturn = false )
	{
		global $jieqiTpl;
		global $jieqiCache;
		global $jieqiModules;
		include_once( $jieqiModules['news']['path']."/class/topic.php" );
		include_once( $jieqiModules['news']['path']."/lang/lang_body.php" );
		include( JIEQI_ROOT_PATH."/configs/news/configs.php" );
		$topic_handler = JieqiNewsTopicHandler::getInstance( "JieqiNewsTopicHandler" );
		$criteria = new criteriacompo( );
		$criteria->add( new criteria( "newsid", $this->exevars['newsid'] ) );
		$criteria->add( new criteria( "newsstatus", 1 ) );
		$topic_handler->queryobjects( $criteria );
		if ( $v = $topic_handler->getobject( ) )
		{
			$jieqiTpl->assign( "news_title", jieqi_substr( $v->getvar( "newstitle" ), 0, $this->exevars['titlewords'], "" ) );
			$jieqiTpl->assign( "news_summary", jieqi_substr( $v->getvar( "newssummary" ), 0, $this->exevars['summarywords'], "..." ) );
			$jieqiTpl->assign( "news_date", $v->getvar( "newsdate" ) );
			$jieqiTpl->assign( "news_url", $jieqiConfigs['news']['htmlfilesenable'] ? JIEQI_URL."/files/news/".$v->getvar( "newshtmlpath" ) : $jieqiModules['news']['url']."/newshow.php?id=".$v->getvar( "newsid" ) );
		}
		else
		{
			$jieqiTpl->assign( "news_error", $jieqiLang['news']['news_top_id_error'] );
		}
	}

}

?>
