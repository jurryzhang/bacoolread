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