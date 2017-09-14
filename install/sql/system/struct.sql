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
  `juan` int(11) NOT NULL DEFAULT '0',
  `expenses` int(11) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `overtime` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_persons`;
CREATE TABLE `jieqi_system_persons` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) binary NOT NULL DEFAULT '',
  `realname` varchar(30) NOT NULL DEFAULT '',
  `gender` varchar(6) NOT NULL DEFAULT '',
  `telephone` varchar(13)  NOT NULL DEFAULT '',
  `mobilephone` varchar(11) NOT NULL DEFAULT '',
  `idcardtype` varchar(30) NOT NULL DEFAULT '',
  `idcard` varchar(11)  NOT NULL DEFAULT '',
  `qq` varchar(11) NOT NULL DEFAULT '',
  `address` varchar(60) NOT NULL DEFAULT '',
  `zipcode` varchar(6) NOT NULL DEFAULT '',
  `banktype` varchar(20) NOT NULL DEFAULT '',
  `bankname` varchar(60) NOT NULL DEFAULT '',
  `bankcard` varchar(20) NOT NULL DEFAULT '',
  `bankuser` varchar(30) NOT NULL DEFAULT '',
  `divided` int(3) NOT NULL DEFAULT '0',
  `denyedit` int(1) NOT NULL DEFAULT '0',
  `mynote` text,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `realname` (`realname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_action`;
CREATE TABLE `jieqi_system_action` (
  `actionid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `acttype` varchar(50) NOT NULL DEFAULT '',
  `acttitle` varchar(50) NOT NULL DEFAULT '',
  `minscore` int(11) NOT NULL DEFAULT '0',
  `islog` tinyint(1) NOT NULL DEFAULT '0',
  `isreview` tinyint(1) NOT NULL DEFAULT '0',
  `isvip` tinyint(1) NOT NULL DEFAULT '0',
  `ispay` tinyint(1) NOT NULL DEFAULT '0',
  `ismessage` tinyint(1) NOT NULL DEFAULT '0',
  `paytitle` varchar(50) NOT NULL DEFAULT '',
  `paybase` int(11) NOT NULL DEFAULT '0',
  `paymin` int(11) NOT NULL DEFAULT '0',
  `paymax` int(11) NOT NULL DEFAULT '0',
  `earnscore` int(11) NOT NULL DEFAULT '0',
  `earncredit` int(11) NOT NULL DEFAULT '0',
  `earnvipvote` int(11) NOT NULL DEFAULT '0',
  `lenmin` int(11) NOT NULL DEFAULT '0',
  `lenmax` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `actiontype` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`actionid`),
  KEY `acttype` (`acttype`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_vips`;
CREATE TABLE `jieqi_system_vips` (
  `vipid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `minegold` int(11) NOT NULL DEFAULT '0',
  `maxgold` int(11) NOT NULL DEFAULT '0',
  `extraegold` int(11) NOT NULL DEFAULT '0',
  `extradiv` int(11) NOT NULL DEFAULT '0',
  `viptype` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vipid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `jieqi_system_qiandao`;
CREATE TABLE `jieqi_system_qiandao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `totalsign` int(11) NOT NULL,
  `dates` text NOT NULL,
  `times` int(11) unsigned NOT NULL DEFAULT '0',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;