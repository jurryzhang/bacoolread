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

DROP TABLE IF EXISTS `jieqi_pay_paycard`;
CREATE TABLE `jieqi_pay_paycard` (
  `cardid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `batchno` varchar(30) binary NOT NULL DEFAULT '',
  `cardno` varchar(30) binary NOT NULL DEFAULT '',
  `cardpass` varchar(30) binary NOT NULL DEFAULT '',
  `cardtype` int(1) unsigned NOT NULL DEFAULT '0',
  `payemoney` int(11) unsigned NOT NULL DEFAULT '0',
  `emoneytype` int(1) unsigned NOT NULL DEFAULT '0',
  `ispay` int(1) unsigned NOT NULL DEFAULT '0',
  `paytime` int(11) unsigned NOT NULL DEFAULT '0',
  `payuid` int(11) unsigned NOT NULL DEFAULT '0',
  `payname` varchar(30) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `flag` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cardid`),
  KEY `cardno` (`cardno`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
