-- --------------------------------------------------------

-- 
-- ��Ľṹ `jieqi_news_category`
-- 
DROP TABLE IF EXISTS `jieqi_news_category`;
CREATE TABLE `jieqi_news_category` (
  `categoryid` smallint(5) unsigned NOT NULL auto_increment,
  `parentid` smallint(5) unsigned NOT NULL default '0',
  `categoryname` varchar(20) NOT NULL default '',
  `categoryorder` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`categoryid`),
  KEY `parentid` (`parentid`)
) TYPE=MyISAM;


-- --------------------------------------------------------

-- 
-- ��Ľṹ `jieqi_news_topic`
-- 
DROP TABLE IF EXISTS `jieqi_news_topic`;
CREATE TABLE `jieqi_news_topic` (
  `newsid` int(10) unsigned NOT NULL auto_increment,
  `firstid` smallint(5) unsigned NOT NULL default '0',
  `secondid` smallint(5) unsigned NOT NULL default '0',
  `newstitle` varchar(50) NOT NULL default '',
  `newskeyword` varchar(50) default '',
  `newssummary` varchar(255) default '',
  `newssource` varchar(20) default '',
  `newsimage` varchar(50) NOT NULL default '',
  `newsputtop` tinyint(3) unsigned NOT NULL default '0',
  `newsclick` smallint(5) unsigned NOT NULL default '0',
  `newsstatus` tinyint(3) unsigned NOT NULL default '0',
  `newsdate` date NOT NULL,
  `newshtmlpath` varchar(100) NOT NULL default '',
  `newsauthorid` int(10) unsigned NOT NULL default '0',
  `newsauthor` varchar(20) NOT NULL default '',
  `newsposterid` int(10) unsigned NOT NULL default '0',
  `newsposter` varchar(20) NOT NULL default '',
  `newsip` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`newsid`),
  KEY `firstid` (`firstid`),
  KEY `secondid` (`secondid`)
) TYPE=MyISAM;


-- --------------------------------------------------------

-- 
-- ��Ľṹ `jieqi_news_content`
-- 
DROP TABLE IF EXISTS `jieqi_news_content`;
CREATE TABLE `jieqi_news_content` (
  `newsid` int(10) unsigned NOT NULL,
  `newscontent` text NOT NULL,
  PRIMARY KEY  (`newsid`)
) TYPE=MyISAM;


-- --------------------------------------------------------

-- 
-- ��Ľṹ `jieqi_news_attachment`
-- 
DROP TABLE IF EXISTS `jieqi_news_attachment`;
CREATE TABLE `jieqi_news_attachment` (
  `attachid` int(10) unsigned NOT NULL auto_increment,
  `attachname` varchar(50) NOT NULL default '',
  `attachtype` varchar(5) NOT NULL default '',
  `attachpath` varchar(50) NOT NULL default '',
  `attachsize` smallint(5) unsigned NOT NULL default '0',
  `attachdate` date NOT NULL,
  PRIMARY KEY  (`attachid`)
) TYPE=MyISAM;