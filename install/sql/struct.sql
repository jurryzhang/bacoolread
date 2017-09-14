SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `jieqi_article_actlog`;
CREATE TABLE `jieqi_article_actlog` (
  `actlogid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) NOT NULL DEFAULT '',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(30) NOT NULL DEFAULT '',
  `tid` int(11) unsigned NOT NULL DEFAULT '0',
  `tname` varchar(30) NOT NULL DEFAULT '',
  `linkid` int(11) unsigned NOT NULL DEFAULT '0',
  `acttype` smallint(6) unsigned NOT NULL DEFAULT '0',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  `actname` varchar(50) NOT NULL DEFAULT '',
  `actnum` int(11) unsigned NOT NULL DEFAULT '0',
  `actvalue` int(11) unsigned NOT NULL DEFAULT '0',
  `islog` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `egold` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`actlogid`),
  KEY `articleid` (`articleid`,`actlogid`),
  KEY `uid` (`uid`,`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_applywriter`;
CREATE TABLE `jieqi_article_applywriter` (
  `applyid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `applytime` int(11) unsigned NOT NULL DEFAULT '0',
  `applyuid` int(11) unsigned NOT NULL DEFAULT '0',
  `applyname` varchar(30) binary NOT NULL DEFAULT '',
  `penname` varchar(30) binary NOT NULL DEFAULT '',
  `authtime` int(11) unsigned NOT NULL DEFAULT '0',
  `authuid` int(11) unsigned NOT NULL DEFAULT '0',
  `authname` varchar(30) binary NOT NULL DEFAULT '',
  `applytitle` varchar(100) NOT NULL DEFAULT '',
  `applytext` mediumtext,
  `applysize` int(11) unsigned NOT NULL DEFAULT '0',
  `authnote` text,
  `applyflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`applyid`),
  KEY `applyflag` (`applyflag`),
  KEY `applyename` (`applyname`),
  KEY `authname` (`authname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_article`;
CREATE TABLE `jieqi_article_article` (
  `articleid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourceid` int(11) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) binary NOT NULL DEFAULT '',
  `articlecode` varchar(200) NOT NULL DEFAULT '',
  `backupname` varchar(100) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `roles` varchar(200) NOT NULL DEFAULT '',
  `initial` char(1) NOT NULL DEFAULT '',
  `authorid` int(11) unsigned NOT NULL DEFAULT '0',
  `author` varchar(30) binary NOT NULL DEFAULT '',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(30) binary NOT NULL DEFAULT '',
  `agentid` int(11) unsigned NOT NULL DEFAULT '0',
  `agent` varchar(30) binary NOT NULL DEFAULT '',
  `sortid` smallint(3) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(3) unsigned NOT NULL DEFAULT '0',
  `libid` smallint(3) unsigned NOT NULL DEFAULT '0',
  `intro` text,
  `notice` text,
  `foreword` text,
  `setting` text,
  `lastvolumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvolume` varchar(100) NOT NULL DEFAULT '',
  `lastchapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `lastchapter` varchar(100) NOT NULL DEFAULT '',
  `lastsummary` text,
  `chapters` smallint(6) unsigned NOT NULL DEFAULT '0',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `daysize` int(11) unsigned NOT NULL DEFAULT '0',
  `weeksize` int(11) unsigned NOT NULL DEFAULT '0',
  `monthsize` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `dayvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `weekvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `monthvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `allvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvote` int(11) unsigned NOT NULL DEFAULT '0',
  `dayvote` int(11) unsigned NOT NULL DEFAULT '0',
  `weekvote` int(11) unsigned NOT NULL DEFAULT '0',
  `monthvote` int(11) unsigned NOT NULL DEFAULT '0',
  `allvote` int(11) unsigned NOT NULL DEFAULT '0',
  `goodnum` int(11) unsigned NOT NULL DEFAULT '0',
  `reviewsnum` int(11) unsigned NOT NULL DEFAULT '0',
  `ratenum` int(11) unsigned NOT NULL DEFAULT '0',
  `ratesum` int(11) unsigned NOT NULL DEFAULT '0',
  `toptime` int(11) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `salenum` int(11) unsigned NOT NULL DEFAULT '0',
  `totalcost` int(11) unsigned NOT NULL DEFAULT '0',
  `articletype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `permission` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `firstflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fullflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `imgflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `upaudit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `power` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `progress` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issign` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `signtime` int(11) unsigned NOT NULL DEFAULT '0',
  `buyout` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `monthly` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `discount` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `quality` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isshort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `inmatch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isshare` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rgroup` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `freetime` int(11) unsigned NOT NULL DEFAULT '0',
  `freesize` int(11) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `viptime` int(11) unsigned NOT NULL DEFAULT '0',
  `vipid` int(11) unsigned NOT NULL DEFAULT '0',
  `vippubid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `vipchapters` smallint(6) unsigned NOT NULL DEFAULT '0',
  `vipsize` int(11) unsigned NOT NULL DEFAULT '0',
  `vipvolumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `vipvolume` varchar(100) NOT NULL DEFAULT '',
  `vipchapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `vipchapter` varchar(100) NOT NULL DEFAULT '',
  `vipsummary` text,
  PRIMARY KEY (`articleid`),
  KEY `articlename` (`articlename`),
  KEY `posterid` (`posterid`),
  KEY `authorid` (`authorid`),
  KEY `sortid` (`sortid`,`typeid`),
  KEY `size` (`size`),
  KEY `lastupdate` (`lastupdate`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_articlelog`;
CREATE TABLE `jieqi_article_articlelog` (
  `logid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `logtime` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) binary NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(255) binary NOT NULL DEFAULT '',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `chaptername` varchar(255) NOT NULL DEFAULT '',
  `reason` text,
  `chginfo` text,
  `chglog` text,
  `ischapter` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `databak` mediumtext,
  PRIMARY KEY (`logid`),
  KEY `userid` (`userid`),
  KEY `ischapter` (`ischapter`),
  KEY `isdel` (`isdel`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_attachs`;
CREATE TABLE `jieqi_article_attachs` (
  `attachid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `class` varchar(30) NOT NULL DEFAULT '',
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `needexp` int(11) unsigned NOT NULL DEFAULT '0',
  `uptime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attachid`),
  KEY `articleid` (`articleid`),
  KEY `chapterid` (`chapterid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_avote`;
CREATE TABLE `jieqi_article_avote` (
  `voteid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `item1` varchar(100) NOT NULL DEFAULT '',
  `item2` varchar(100) NOT NULL DEFAULT '',
  `item3` varchar(100) NOT NULL DEFAULT '',
  `item4` varchar(100) NOT NULL DEFAULT '',
  `item5` varchar(100) NOT NULL DEFAULT '',
  `item6` varchar(100) NOT NULL DEFAULT '',
  `item7` varchar(100) NOT NULL DEFAULT '',
  `item8` varchar(100) NOT NULL DEFAULT '',
  `item9` varchar(100) NOT NULL DEFAULT '',
  `item10` varchar(100) NOT NULL DEFAULT '',
  `useitem` tinyint(2) NOT NULL DEFAULT '0',
  `description` text,
  `ispublish` tinyint(1) NOT NULL DEFAULT '0',
  `mulselect` tinyint(1) NOT NULL DEFAULT '0',
  `timelimit` tinyint(1) NOT NULL DEFAULT '0',
  `needlogin` tinyint(1) NOT NULL DEFAULT '0',
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`voteid`),
  KEY `articleid` (`articleid`,`ispublish`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_avstat`;
CREATE TABLE `jieqi_article_avstat` (
  `statid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `voteid` int(11) unsigned NOT NULL DEFAULT '0',
  `statall` int(11) unsigned NOT NULL DEFAULT '0',
  `stat1` int(11) unsigned NOT NULL DEFAULT '0',
  `stat2` int(11) unsigned NOT NULL DEFAULT '0',
  `stat3` int(11) unsigned NOT NULL DEFAULT '0',
  `stat4` int(11) unsigned NOT NULL DEFAULT '0',
  `stat5` int(11) unsigned NOT NULL DEFAULT '0',
  `stat6` int(11) unsigned NOT NULL DEFAULT '0',
  `stat7` int(11) unsigned NOT NULL DEFAULT '0',
  `stat8` int(11) unsigned NOT NULL DEFAULT '0',
  `stat9` int(11) unsigned NOT NULL DEFAULT '0',
  `stat10` int(11) unsigned NOT NULL DEFAULT '0',
  `canstat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`statid`),
  KEY `voteid` (`voteid`,`canstat`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_bookcase`;
CREATE TABLE `jieqi_article_bookcase` (
  `caseid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) binary NOT NULL DEFAULT '',
  `classid` smallint(3) NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) binary NOT NULL DEFAULT '',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `chaptername` varchar(100) binary NOT NULL DEFAULT '',
  `chapterorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `joindate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`caseid`),
  KEY `articleid` (`articleid`),
  KEY `userid` (`userid`,`classid`),
  KEY `chapterid` (`chapterid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_chapter`;
CREATE TABLE `jieqi_article_chapter` (
  `chapterid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourceid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourcecid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourcecorder` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) binary NOT NULL DEFAULT '',
  `volumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(30) binary NOT NULL DEFAULT '',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `chaptername` varchar(100) binary NOT NULL DEFAULT '',
  `chapterorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `salenum` int(11) unsigned NOT NULL DEFAULT '0',
  `totalcost` int(11) unsigned NOT NULL DEFAULT '0',
  `attachment` text,
  `summary` text,
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(6) unsigned NOT NULL DEFAULT '0',
  `chaptertype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `power` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`chapterid`),
  KEY `lastupdate` (`lastupdate`),
  KEY `articleid` (`articleid`,`chapterorder`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_credit`;
CREATE TABLE `jieqi_article_credit` (
  `creditid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) NOT NULL DEFAULT '',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(30) NOT NULL DEFAULT '',
  `point` int(11) unsigned NOT NULL DEFAULT '0',
  `payegold` int(11) unsigned NOT NULL DEFAULT '0',
  `buyegold` int(11) unsigned NOT NULL DEFAULT '0',
  `upnum` int(11) unsigned NOT NULL DEFAULT '0',
  `uptime` int(11) unsigned NOT NULL DEFAULT '0',
  `vars` text,
  PRIMARY KEY (`creditid`),
  UNIQUE KEY `uid` (`uid`,`articleid`),
  KEY `articleid` (`articleid`,`point`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_draft`;
CREATE TABLE `jieqi_article_draft` (
  `draftid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) binary NOT NULL DEFAULT '',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(30) binary NOT NULL DEFAULT '',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `pubdate` int(11) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) NOT NULL DEFAULT '0',
  `chaptername` varchar(100) binary NOT NULL DEFAULT '',
  `chaptercontent` mediumtext,
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `note` text,
  `drafttype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`draftid`),
  KEY `articleid` (`articleid`),
  KEY `drafttype` (`drafttype`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_replies`;
CREATE TABLE `jieqi_article_replies` (
  `postid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `topicid` int(10) unsigned NOT NULL DEFAULT '0',
  `istopic` tinyint(1) NOT NULL DEFAULT '0',
  `replypid` int(10) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(10) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `posterip` varchar(25) NOT NULL DEFAULT '',
  `editorid` int(10) NOT NULL DEFAULT '0',
  `editor` varchar(30) NOT NULL DEFAULT '',
  `edittime` int(10) NOT NULL DEFAULT '0',
  `editorip` varchar(25) NOT NULL DEFAULT '',
  `editnote` varchar(250) NOT NULL DEFAULT '',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `attachment` text,
  `subject` varchar(80) NOT NULL DEFAULT '',
  `posttext` mediumtext,
  `size` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`postid`),
  KEY `ownerid` (`ownerid`),
  KEY `ptopicid` (`topicid`,`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_review`;
CREATE TABLE `jieqi_article_review` (
  `reviewid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) binary NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) binary NOT NULL DEFAULT '',
  `reviewtitle` varchar(100) NOT NULL DEFAULT '',
  `reviewtext` mediumtext,
  `topflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `goodflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviewid`),
  KEY `articleid` (`articleid`),
  KEY `userid` (`userid`),
  KEY `display` (`display`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_reviews`;
CREATE TABLE `jieqi_article_reviews` (
  `topicid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `replierid` int(10) NOT NULL DEFAULT '0',
  `replier` varchar(30) NOT NULL DEFAULT '',
  `replytime` int(11) NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `islock` tinyint(1) NOT NULL DEFAULT '0',
  `istop` int(11) NOT NULL DEFAULT '0',
  `isgood` tinyint(1) NOT NULL DEFAULT '0',
  `rate` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `needperm` int(10) unsigned NOT NULL DEFAULT '0',
  `needscore` int(10) unsigned NOT NULL DEFAULT '0',
  `needexp` int(10) unsigned NOT NULL DEFAULT '0',
  `needprice` int(10) unsigned NOT NULL DEFAULT '0',
  `sortid` tinyint(3) NOT NULL DEFAULT '0',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `typeid` tinyint(3) NOT NULL DEFAULT '0',
  `lastinfo` varchar(255) NOT NULL DEFAULT '',
  `linkurl` varchar(100) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `posterid` (`posterid`,`replytime`),
  KEY `ownerid` (`ownerid`,`istop`,`replytime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_searchcache`;
CREATE TABLE `jieqi_article_searchcache` (
  `cacheid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `searchtime` int(11) unsigned NOT NULL DEFAULT '0',
  `hashid` varchar(32) NOT NULL DEFAULT '0',
  `keywords` varchar(60) binary NOT NULL DEFAULT '',
  `searchtype` tinyint(1) NOT NULL DEFAULT '0',
  `results` int(11) unsigned NOT NULL DEFAULT '0',
  `aids` text,
  PRIMARY KEY (`cacheid`),
  UNIQUE KEY `hashid` (`hashid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_article_synclog`;
CREATE TABLE `jieqi_article_synclog` (
  `logid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `starttime` int(11) unsigned NOT NULL DEFAULT '0',
  `finishtime` int(11) unsigned NOT NULL DEFAULT '0',
  `fromtime` int(11) unsigned NOT NULL DEFAULT '0',
  `articlenum` int(11) unsigned NOT NULL DEFAULT '0',
  `finishnum` int(11) unsigned NOT NULL DEFAULT '0',
  `retcode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issuccess` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`logid`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_forum_attachs`;
CREATE TABLE `jieqi_forum_attachs` (
  `attachid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `topicid` int(11) unsigned NOT NULL DEFAULT '0',
  `postid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `class` varchar(30) NOT NULL DEFAULT '',
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `needperm` int(10) unsigned NOT NULL DEFAULT '0',
  `needscore` int(10) unsigned NOT NULL DEFAULT '0',
  `needexp` int(11) unsigned NOT NULL DEFAULT '0',
  `needprice` int(10) unsigned NOT NULL DEFAULT '0',
  `uptime` int(11) NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `remote` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attachid`),
  KEY `topicid` (`topicid`),
  KEY `postid` (`postid`,`attachid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_forum_forumcat`;
CREATE TABLE `jieqi_forum_forumcat` (
  `catid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `cattitle` varchar(100) NOT NULL DEFAULT '',
  `catorder` mediumint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`),
  KEY `catorder` (`catorder`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_forum_forumposts`;
CREATE TABLE `jieqi_forum_forumposts` (
  `postid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `topicid` int(11) unsigned NOT NULL DEFAULT '0',
  `istopic` tinyint(1) NOT NULL DEFAULT '0',
  `replypid` int(10) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(10) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) binary NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `posterip` varchar(25) NOT NULL DEFAULT '',
  `editorid` int(10) NOT NULL DEFAULT '0',
  `editor` varchar(30) NOT NULL DEFAULT '',
  `edittime` int(11) NOT NULL DEFAULT '0',
  `editorip` varchar(25) NOT NULL DEFAULT '',
  `editnote` varchar(250) NOT NULL DEFAULT '',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `attachment` text,
  `subject` varchar(80) NOT NULL DEFAULT '',
  `size` int(10) NOT NULL DEFAULT '0',
  `posttext` mediumtext,
  PRIMARY KEY (`postid`),
  KEY `ownerid` (`ownerid`),
  KEY `ptopicid` (`topicid`,`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_forum_forums`;
CREATE TABLE `jieqi_forum_forums` (
  `forumid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `catid` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `forumname` varchar(100) NOT NULL DEFAULT '',
  `forumdesc` text,
  `forumstatus` tinyint(4) NOT NULL DEFAULT '0',
  `forumorder` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `forumtype` tinyint(1) NOT NULL DEFAULT '0',
  `forumtopics` int(11) unsigned NOT NULL DEFAULT '0',
  `forumposts` int(11) unsigned NOT NULL DEFAULT '0',
  `forumlastinfo` text,
  `authview` text,
  `authread` text,
  `authpost` text,
  `authreply` text,
  `authupload` text,
  `authedit` text,
  `authdelete` text,
  `master` text,
  PRIMARY KEY (`forumid`),
  KEY `forumorder` (`forumorder`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_forum_forumtopics`;
CREATE TABLE `jieqi_forum_forumtopics` (
  `topicid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `posterid` int(10) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `replierid` int(10) NOT NULL DEFAULT '0',
  `replier` varchar(30) NOT NULL DEFAULT '',
  `replytime` int(11) NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `islock` tinyint(1) NOT NULL DEFAULT '0',
  `istop` int(11) NOT NULL DEFAULT '0',
  `isgood` tinyint(1) NOT NULL DEFAULT '0',
  `rate` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `needperm` int(10) unsigned NOT NULL DEFAULT '0',
  `needscore` int(10) unsigned NOT NULL DEFAULT '0',
  `needexp` int(10) unsigned NOT NULL DEFAULT '0',
  `needprice` int(10) unsigned NOT NULL DEFAULT '0',
  `sortid` tinyint(3) NOT NULL DEFAULT '0',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `typeid` tinyint(3) NOT NULL DEFAULT '0',
  `lastinfo` varchar(250) NOT NULL DEFAULT '',
  `linkurl` varchar(100) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `topictype` (`sortid`),
  KEY `ownerid` (`ownerid`,`istop`,`replytime`),
  KEY `posterid` (`posterid`,`replytime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_obook_obook`;
CREATE TABLE `jieqi_obook_obook` (
  `obookid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourceid` int(11) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) binary NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `initial` char(1) NOT NULL DEFAULT '',
  `sortid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `intro` text,
  `notice` text,
  `setting` text,
  `lastvolumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvolume` varchar(255) NOT NULL DEFAULT '',
  `lastchapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `lastchapter` varchar(255) NOT NULL DEFAULT '',
  `lastsummary` text,
  `chapters` smallint(6) unsigned NOT NULL DEFAULT '0',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `authorid` int(11) unsigned NOT NULL DEFAULT '0',
  `author` varchar(50) binary NOT NULL DEFAULT '',
  `aintro` text,
  `agentid` int(11) unsigned NOT NULL DEFAULT '0',
  `agent` varchar(50) binary NOT NULL DEFAULT '',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(50) binary NOT NULL DEFAULT '',
  `publishid` int(11) unsigned NOT NULL DEFAULT '0',
  `tbookinfo` text,
  `toptime` int(11) unsigned NOT NULL DEFAULT '0',
  `goodnum` int(11) unsigned NOT NULL DEFAULT '0',
  `badnum` int(11) unsigned NOT NULL DEFAULT '0',
  `fullflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `imgflag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `vipprice` int(11) unsigned NOT NULL DEFAULT '0',
  `sumegold` int(11) unsigned NOT NULL DEFAULT '0',
  `sumesilver` int(11) unsigned NOT NULL DEFAULT '0',
  `sumtip` int(11) unsigned NOT NULL DEFAULT '0',
  `sumhurry` int(11) unsigned NOT NULL DEFAULT '0',
  `sumbesp` int(11) unsigned NOT NULL DEFAULT '0',
  `sumaward` int(11) unsigned NOT NULL DEFAULT '0',
  `sumagent` int(11) unsigned NOT NULL DEFAULT '0',
  `sumgift` int(11) unsigned NOT NULL DEFAULT '0',
  `sumother` int(11) unsigned NOT NULL DEFAULT '0',
  `sumemoney` int(11) unsigned NOT NULL DEFAULT '0',
  `summoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paidmoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paidemoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paytime` int(11) unsigned NOT NULL DEFAULT '0',
  `normalsale` int(11) unsigned NOT NULL DEFAULT '0',
  `vipsale` int(11) unsigned NOT NULL DEFAULT '0',
  `freesale` int(11) unsigned NOT NULL DEFAULT '0',
  `bespsale` int(11) unsigned NOT NULL DEFAULT '0',
  `totalsale` int(11) unsigned NOT NULL DEFAULT '0',
  `daysale` int(11) unsigned NOT NULL DEFAULT '0',
  `weeksale` int(11) unsigned NOT NULL DEFAULT '0',
  `monthsale` int(11) unsigned NOT NULL DEFAULT '0',
  `allsale` int(11) unsigned NOT NULL DEFAULT '0',
  `lastsale` int(11) unsigned NOT NULL DEFAULT '0',
  `canvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `canfree` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `canbesp` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hasebook` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hastbook` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`obookid`),
  KEY `articleid` (`articleid`),
  KEY `obookname` (`obookname`),
  KEY `display` (`display`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_obook_obuy`;
CREATE TABLE `jieqi_obook_obuy` (
  `obuyid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `osaleid` int(11) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `lastbuy` int(11) unsigned NOT NULL DEFAULT '0',
  `lastread` int(11) unsigned NOT NULL DEFAULT '0',
  `readnum` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `ochapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) binary NOT NULL DEFAULT '',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `chapternum` int(11) unsigned NOT NULL DEFAULT '0',
  `buynum` int(11) unsigned NOT NULL DEFAULT '0',
  `buypay` int(11) unsigned NOT NULL DEFAULT '0',
  `isread` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isfull` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `autobuy` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `buymode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `starlevel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `oflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`obuyid`),
  UNIQUE KEY `userid` (`userid`,`obookid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_obook_obuyinfo`;
CREATE TABLE `jieqi_obook_obuyinfo` (
  `obuyinfoid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `osaleid` int(11) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `ochapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) binary NOT NULL DEFAULT '',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `lastread` int(11) unsigned NOT NULL DEFAULT '0',
  `readnum` int(11) unsigned NOT NULL DEFAULT '0',
  `checkcode` varchar(10) NOT NULL DEFAULT '',
  `buyprice` int(11) unsigned NOT NULL DEFAULT '0',
  `buynum` int(11) unsigned NOT NULL DEFAULT '0',
  `buypay` int(11) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`obuyinfoid`),
  KEY `userid` (`userid`),
  KEY `obookid` (`obookid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_obook_ochapter`;
CREATE TABLE `jieqi_obook_ochapter` (
  `ochapterid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourceid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourcecid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourcecorder` int(11) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) NOT NULL DEFAULT '',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `chaptertype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `chapterorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `volumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `summary` text,
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(6) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(50) NOT NULL DEFAULT '',
  `toptime` int(11) unsigned NOT NULL DEFAULT '0',
  `picflag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `vipprice` int(11) unsigned NOT NULL DEFAULT '0',
  `sumegold` int(11) unsigned NOT NULL DEFAULT '0',
  `sumesilver` int(11) unsigned NOT NULL DEFAULT '0',
  `normalsale` int(11) unsigned NOT NULL DEFAULT '0',
  `vipsale` int(11) unsigned NOT NULL DEFAULT '0',
  `freesale` int(11) unsigned NOT NULL DEFAULT '0',
  `bespsale` int(11) unsigned NOT NULL DEFAULT '0',
  `totalsale` int(11) unsigned NOT NULL DEFAULT '0',
  `daysale` int(11) unsigned NOT NULL DEFAULT '0',
  `weeksale` int(11) unsigned NOT NULL DEFAULT '0',
  `monthsale` int(11) unsigned NOT NULL DEFAULT '0',
  `allsale` int(11) unsigned NOT NULL DEFAULT '0',
  `lastsale` int(11) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ochapterid`),
  KEY `obookid` (`obookid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_obook_ocontent`;
CREATE TABLE `jieqi_obook_ocontent` (
  `ochapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `ocontent` mediumtext,
  UNIQUE KEY `ochapterid` (`ochapterid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_obook_osale`;
CREATE TABLE `jieqi_obook_osale` (
  `osaleid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `accountid` int(11) unsigned NOT NULL DEFAULT '0',
  `account` varchar(30) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `ochapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) binary NOT NULL DEFAULT '',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `salenum` int(11) unsigned NOT NULL DEFAULT '0',
  `sumprice` int(11) unsigned NOT NULL DEFAULT '0',
  `pricetype` tinyint(1) NOT NULL DEFAULT '0',
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `payflag` tinyint(1) NOT NULL DEFAULT '0',
  `paynote` varchar(255) NOT NULL DEFAULT '',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`osaleid`),
  KEY `accountid` (`accountid`),
  KEY `obookid` (`obookid`),
  KEY `ochapterid` (`ochapterid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_obook_paidlog`;
CREATE TABLE `jieqi_obook_paidlog` (
  `paidid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `paytime` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `masterid` int(11) unsigned NOT NULL DEFAULT '0',
  `master` varchar(30) NOT NULL DEFAULT '',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `sumegold` int(11) NOT NULL DEFAULT '0',
  `sumesilver` int(11) NOT NULL DEFAULT '0',
  `sumemoney` int(11) NOT NULL DEFAULT '0',
  `paidemoney` int(11) NOT NULL DEFAULT '0',
  `payemoney` int(11) NOT NULL DEFAULT '0',
  `remainemoney` int(11) NOT NULL DEFAULT '0',
  `summoney` int(11) NOT NULL DEFAULT '0',
  `paymoney` int(11) NOT NULL DEFAULT '0',
  `remainmoney` int(11) NOT NULL DEFAULT '0',
  `paidcurrency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `paidtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `paidflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `payinfo` text,
  `paynote` text,
  PRIMARY KEY (`paidid`),
  KEY `userid` (`userid`),
  KEY `obookid` (`obookid`),
  KEY `articleid` (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_pay_balance`;
CREATE TABLE `jieqi_pay_balance` (
  `balid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `baltime` int(11) unsigned NOT NULL DEFAULT '0',
  `fromid` int(11) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(30) binary NOT NULL DEFAULT '',
  `toid` int(11) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(30) binary NOT NULL DEFAULT '',
  `baltype` varchar(255) NOT NULL DEFAULT '',
  `ballog` varchar(255) NOT NULL DEFAULT '',
  `balegold` int(11) NOT NULL DEFAULT '0',
  `moneytype` tinyint(3) NOT NULL DEFAULT '0',
  `balmoney` int(11) NOT NULL DEFAULT '0',
  `balflag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`balid`),
  KEY `fromid` (`fromid`),
  KEY `fromname` (`fromname`),
  KEY `toid` (`toid`),
  KEY `toname` (`toname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_pay_paylog`;
CREATE TABLE `jieqi_pay_paylog` (
  `payid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `rettime` int(11) unsigned NOT NULL DEFAULT '0',
  `buyid` int(11) unsigned NOT NULL DEFAULT '0',
  `buyname` varchar(30) binary NOT NULL DEFAULT '',
  `buyinfo` text,
  `moneytype` tinyint(3) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `egoldtype` tinyint(1) NOT NULL DEFAULT '0',
  `egold` int(11) NOT NULL DEFAULT '0',
  `paytype` varchar(30) NOT NULL DEFAULT '',
  `retserialno` varchar(100) NOT NULL DEFAULT '',
  `retaccount` varchar(100) NOT NULL DEFAULT '',
  `retinfo` text,
  `masterid` int(11) unsigned NOT NULL DEFAULT '0',
  `mastername` varchar(30) binary NOT NULL DEFAULT '',
  `masterinfo` text,
  `note` text,
  `payflag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payid`),
  KEY `flag` (`payflag`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_pay_transfer`;
CREATE TABLE `jieqi_pay_transfer` (
  `transid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transtime` int(11) unsigned NOT NULL DEFAULT '0',
  `fromid` int(11) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(30) binary NOT NULL DEFAULT '',
  `toid` int(11) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(30) binary NOT NULL DEFAULT '',
  `translog` varchar(255) NOT NULL DEFAULT '',
  `transegold` int(11) NOT NULL DEFAULT '0',
  `receiveegold` int(11) NOT NULL DEFAULT '0',
  `mastertime` int(11) unsigned NOT NULL DEFAULT '0',
  `masterid` int(11) unsigned NOT NULL DEFAULT '0',
  `mastername` varchar(30) binary NOT NULL DEFAULT '',
  `masterlog` varchar(255) NOT NULL DEFAULT '',
  `transtype` tinyint(1) NOT NULL DEFAULT '0',
  `errflag` tinyint(1) NOT NULL DEFAULT '0',
  `transflag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`transid`),
  KEY `fromid` (`fromid`),
  KEY `fromname` (`fromname`),
  KEY `toid` (`toid`),
  KEY `toname` (`toname`),
  KEY `transtype` (`transtype`),
  KEY `transflag` (`transflag`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_blocks`;
CREATE TABLE `jieqi_system_blocks` (
  `bid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `blockname` varchar(50) NOT NULL DEFAULT '',
  `modname` varchar(50) NOT NULL DEFAULT '',
  `filename` varchar(50) NOT NULL DEFAULT '',
  `classname` varchar(50) NOT NULL DEFAULT '',
  `side` tinyint(3) NOT NULL DEFAULT '0',
  `title` text,
  `description` text,
  `content` mediumtext,
  `vars` text,
  `template` varchar(50) NOT NULL DEFAULT '',
  `cachetime` int(11) NOT NULL DEFAULT '0',
  `contenttype` tinyint(3) NOT NULL DEFAULT '0',
  `weight` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `showstatus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `custom` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `canedit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hasvars` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `modname` (`modname`),
  KEY `publish` (`publish`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_configs`;
CREATE TABLE `jieqi_system_configs` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `cname` varchar(50) NOT NULL DEFAULT '',
  `ctitle` varchar(50) NOT NULL DEFAULT '',
  `cvalue` text,
  `cdescription` text,
  `cdefine` tinyint(1) NOT NULL DEFAULT '0',
  `ctype` tinyint(1) NOT NULL DEFAULT '0',
  `options` text,
  `catorder` int(10) NOT NULL DEFAULT '0',
  `catname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `modname` (`modname`,`cname`),
  KEY `catorder` (`catorder`),
  KEY `cdefine` (`cdefine`),
  KEY `catname` (`catname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_friends`;
CREATE TABLE `jieqi_system_friends` (
  `friendsid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adddate` int(11) NOT NULL DEFAULT '0',
  `myid` int(11) unsigned NOT NULL DEFAULT '0',
  `myname` varchar(30) binary NOT NULL DEFAULT '',
  `yourid` int(11) unsigned NOT NULL DEFAULT '0',
  `yourname` varchar(30) binary NOT NULL DEFAULT '',
  `teamid` int(11) unsigned NOT NULL DEFAULT '0',
  `team` varchar(50) NOT NULL DEFAULT '',
  `fset` text,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`friendsid`),
  UNIQUE KEY `myid` (`myid`,`yourid`),
  KEY `teamid` (`teamid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_groups`;
CREATE TABLE `jieqi_system_groups` (
  `groupid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `grouptype` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_honors`;
CREATE TABLE `jieqi_system_honors` (
  `honorid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(250) NOT NULL DEFAULT '',
  `minscore` int(11) NOT NULL DEFAULT '0',
  `maxscore` int(11) NOT NULL DEFAULT '0',
  `setting` text,
  `honortype` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`honorid`),
  KEY `minscore` (`minscore`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_logs`;
CREATE TABLE `jieqi_system_logs` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `siteid` int(11) NOT NULL DEFAULT '0',
  `logtype` tinyint(3) NOT NULL DEFAULT '0',
  `loglevel` tinyint(3) NOT NULL DEFAULT '0',
  `logtime` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `userip` varchar(25) NOT NULL DEFAULT '',
  `targetname` varchar(60) NOT NULL DEFAULT '',
  `targetid` int(11) NOT NULL DEFAULT '0',
  `targettitle` varchar(60) NOT NULL DEFAULT '',
  `logurl` varchar(100) NOT NULL DEFAULT '',
  `logcode` int(11) NOT NULL DEFAULT '0',
  `logtitle` varchar(100) NOT NULL DEFAULT '',
  `logdata` text,
  `lognote` text,
  `fromdata` text,
  `todata` text,
  PRIMARY KEY (`logid`),
  KEY `logtype` (`logtype`),
  KEY `loglevel` (`loglevel`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_message`;
CREATE TABLE `jieqi_system_message` (
  `messageid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) NOT NULL DEFAULT '0',
  `fromid` int(11) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(30) binary NOT NULL DEFAULT '',
  `toid` int(11) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(30) binary NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` mediumtext,
  `messagetype` tinyint(1) NOT NULL DEFAULT '0',
  `isread` tinyint(1) NOT NULL DEFAULT '0',
  `fromdel` tinyint(1) NOT NULL DEFAULT '0',
  `todel` tinyint(1) NOT NULL DEFAULT '0',
  `enablebbcode` tinyint(1) NOT NULL DEFAULT '1',
  `enablehtml` tinyint(1) NOT NULL DEFAULT '0',
  `enablesmilies` tinyint(1) NOT NULL DEFAULT '1',
  `attachsig` tinyint(1) NOT NULL DEFAULT '1',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`messageid`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_modules`;
CREATE TABLE `jieqi_system_modules` (
  `mid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `caption` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `version` smallint(5) unsigned NOT NULL DEFAULT '100',
  `vtype` varchar(30) NOT NULL DEFAULT '',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `weight` smallint(5) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `modtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_online`;
CREATE TABLE `jieqi_system_online` (
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `sid` varchar(32) NOT NULL DEFAULT '',
  `uname` varchar(30) binary NOT NULL DEFAULT '',
  `name` varchar(30) binary NOT NULL DEFAULT '',
  `pass` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `groupid` tinyint(3) NOT NULL DEFAULT '0',
  `logintime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `operate` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(25) NOT NULL DEFAULT '',
  `browser` varchar(50) NOT NULL DEFAULT '',
  `os` varchar(50) NOT NULL DEFAULT '',
  `location` varchar(100) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  KEY `uid` (`uid`),
  KEY `sid` (`sid`),
  KEY `groupid` (`groupid`),
  KEY `updatetime` (`updatetime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_power`;
CREATE TABLE `jieqi_system_power` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `pname` varchar(50) NOT NULL DEFAULT '',
  `ptitle` varchar(50) NOT NULL DEFAULT '',
  `pdescription` text,
  `pgroups` text,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `modname` (`modname`,`pname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_pposts`;
CREATE TABLE `jieqi_system_pposts` (
  `postid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `topicid` int(10) unsigned NOT NULL DEFAULT '0',
  `istopic` tinyint(1) NOT NULL DEFAULT '0',
  `replypid` int(10) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(11) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `posterip` varchar(25) NOT NULL DEFAULT '',
  `editorid` int(10) NOT NULL DEFAULT '0',
  `editor` varchar(30) NOT NULL DEFAULT '',
  `edittime` int(10) NOT NULL DEFAULT '0',
  `editorip` varchar(25) NOT NULL DEFAULT '',
  `editnote` varchar(250) NOT NULL DEFAULT '',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `attachment` text,
  `subject` varchar(80) NOT NULL DEFAULT '',
  `posttext` mediumtext,
  `size` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`postid`),
  KEY `ownerid` (`ownerid`),
  KEY `ptopicid` (`topicid`,`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_promotions`;
CREATE TABLE `jieqi_system_promotions` (
  `ip` varchar(15) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_ptopics`;
CREATE TABLE `jieqi_system_ptopics` (
  `topicid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `replierid` int(10) NOT NULL DEFAULT '0',
  `replier` varchar(30) NOT NULL DEFAULT '',
  `replytime` int(11) NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `islock` tinyint(1) NOT NULL DEFAULT '0',
  `istop` int(11) NOT NULL DEFAULT '0',
  `isgood` tinyint(1) NOT NULL DEFAULT '0',
  `rate` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `needperm` int(10) unsigned NOT NULL DEFAULT '0',
  `needscore` int(10) unsigned NOT NULL DEFAULT '0',
  `needexp` int(10) unsigned NOT NULL DEFAULT '0',
  `needprice` int(10) unsigned NOT NULL DEFAULT '0',
  `sortid` tinyint(3) NOT NULL DEFAULT '0',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `typeid` tinyint(3) NOT NULL DEFAULT '0',
  `lastinfo` varchar(255) NOT NULL DEFAULT '',
  `linkurl` varchar(100) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `ownerid` (`ownerid`,`istop`,`replytime`),
  KEY `posterid` (`posterid`,`replytime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_registerip`;
CREATE TABLE `jieqi_system_registerip` (
  `ip` char(15) NOT NULL DEFAULT '',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0',
  `count` smallint(6) NOT NULL DEFAULT '0',
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_report`;
CREATE TABLE `jieqi_system_report` (
  `reportid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `reporttime` int(11) unsigned NOT NULL DEFAULT '0',
  `reportuid` int(11) unsigned NOT NULL DEFAULT '0',
  `reportname` varchar(30) binary NOT NULL DEFAULT '',
  `authtime` int(11) unsigned NOT NULL DEFAULT '0',
  `authuid` int(11) unsigned NOT NULL DEFAULT '0',
  `authname` varchar(30) binary NOT NULL DEFAULT '',
  `reporttitle` varchar(100) NOT NULL DEFAULT '',
  `reporttext` mediumtext,
  `reportsize` int(11) unsigned NOT NULL DEFAULT '0',
  `reportfield` varchar(250) NOT NULL DEFAULT '',
  `authnote` text,
  `reportsort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `reporttype` smallint(6) unsigned NOT NULL DEFAULT '0',
  `authflag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`reportid`),
  KEY `reportsort` (`reportsort`),
  KEY `reporttype` (`reporttype`),
  KEY `reportname` (`reportname`),
  KEY `authname` (`authname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_right`;
CREATE TABLE `jieqi_system_right` (
  `rid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `rname` varchar(50) NOT NULL DEFAULT '',
  `rtitle` varchar(50) NOT NULL DEFAULT '',
  `rdescription` text,
  `rhonors` text,
  PRIMARY KEY (`rid`),
  KEY `modname` (`modname`,`rname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_session`;
CREATE TABLE `jieqi_system_session` (
  `sess_id` varchar(32) NOT NULL DEFAULT '',
  `sess_updated` int(11) unsigned NOT NULL DEFAULT '0',
  `sess_data` text,
  PRIMARY KEY (`sess_id`),
  KEY `sess_updated` (`sess_updated`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_userapi`;
CREATE TABLE `jieqi_system_userapi` (
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `apiflag` int(11) unsigned NOT NULL DEFAULT '0',
  `apidata` text,
  `apiset` text,
  `qqid` varchar(100) NOT NULL DEFAULT '',
  `qqtid` varchar(100) NOT NULL DEFAULT '',
  `baiduid` varchar(100) NOT NULL DEFAULT '',
  `weiboid` varchar(100) NOT NULL DEFAULT '',
  `taobaoid` varchar(100) NOT NULL DEFAULT '',
  `alipayid` varchar(100) NOT NULL DEFAULT '',
  `kaixin001id` varchar(100) NOT NULL DEFAULT '',
  `doubanid` varchar(100) NOT NULL DEFAULT '',
  `163id` varchar(100) NOT NULL DEFAULT '',
  `sohuid` varchar(100) NOT NULL DEFAULT '',
  `renrenid` varchar(100) NOT NULL DEFAULT '',
  `tianyaid` varchar(100) NOT NULL DEFAULT '',
  `sdoid` varchar(100) NOT NULL DEFAULT '',
  `googleid` varchar(100) NOT NULL DEFAULT '',
  `msnid` varchar(100) NOT NULL DEFAULT '',
  `yohooid` varchar(100) NOT NULL DEFAULT '',
  `facebookid` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  KEY `qqid` (`qqid`),
  KEY `qqtid` (`qqtid`),
  KEY `weiboid` (`weiboid`),
  KEY `taobaoid` (`taobaoid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_userlink`;
CREATE TABLE `jieqi_system_userlink` (
  `ulid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ultitle` varchar(60) NOT NULL DEFAULT '',
  `ulurl` varchar(100) NOT NULL DEFAULT '',
  `ulinfo` varchar(255) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `score` tinyint(1) NOT NULL DEFAULT '0',
  `weight` smallint(6) NOT NULL DEFAULT '0',
  `toptime` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL DEFAULT '0',
  `allvisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ulid`),
  KEY `userid` (`userid`,`toptime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_userlog`;
CREATE TABLE `jieqi_system_userlog` (
  `logid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `logtime` int(11) unsigned NOT NULL DEFAULT '0',
  `fromid` int(11) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(30) binary NOT NULL DEFAULT '',
  `toid` int(11) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(30) binary NOT NULL DEFAULT '',
  `reason` text,
  `chginfo` text,
  `chglog` text,
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userlog` mediumtext,
  PRIMARY KEY (`logid`),
  KEY `logtime` (`logtime`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`),
  KEY `fromname` (`fromname`),
  KEY `toname` (`toname`),
  KEY `isdel` (`isdel`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_users`;
CREATE TABLE `jieqi_system_users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(30) binary NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `pass` varchar(32) NOT NULL DEFAULT '',
  `groupid` tinyint(3) NOT NULL DEFAULT '0',
  `regdate` int(11) unsigned NOT NULL DEFAULT '0',
  `initial` char(1) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `avatar` int(11) NOT NULL DEFAULT '0',
  `workid` tinyint(3) NOT NULL DEFAULT '0',
  `qq` varchar(15) NOT NULL DEFAULT '',
  `icq` varchar(15) NOT NULL DEFAULT '',
  `msn` varchar(60) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `sign` text,
  `intro` text,
  `setting` text,
  `badges` text,
  `lastlogin` int(10) unsigned NOT NULL DEFAULT '0',
  `showsign` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `viewemail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notifymode` tinyint(1) NOT NULL DEFAULT '0',
  `adminemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `monthscore` int(11) NOT NULL DEFAULT '0',
  `weekscore` int(11) NOT NULL DEFAULT '0',
  `dayscore` int(11) NOT NULL DEFAULT '0',
  `lastscore` int(11) unsigned NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `egold` int(11) NOT NULL DEFAULT '0',
  `esilver` int(11) NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '0',
  `goodnum` int(11) NOT NULL DEFAULT '0',
  `badnum` int(11) NOT NULL DEFAULT '0',
  `expenses` int(11) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `overtime` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
