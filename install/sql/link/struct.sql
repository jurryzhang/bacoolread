DROP TABLE IF EXISTS `jieqi_link_link`;
CREATE TABLE `jieqi_link_link` (
  `linkid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `linktype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `namecolor` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `logo` varchar(250) NOT NULL DEFAULT '',
  `introduce` text,
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `mastername` varchar(50) NOT NULL DEFAULT '',
  `mastertell` varchar(250) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `passed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `addtime` int(20) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkid`),
  KEY `typeid` (`passed`,`listorder`,`linkid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;