
#ģ����Ϣ
INSERT INTO `jieqi_system_modules` (`mid`, `name`, `caption`, `description`, `version`, `lastupdate`, `weight`, `publish`, `modtype`) VALUES (5, 'badge', '�û�����', '', 230, 0, 0, 1, 0);


#Ŀǰϵͳ�����������
#1-�ȼ����� 2-ͷ�λ��� 1010-�������� 2010-Ȧ�ӻ���  3010-�����

INSERT INTO `jieqi_badge_btype` (`btypeid`, `title`, `sysflag`) VALUES (1, '�ȼ�����', 1);
INSERT INTO `jieqi_badge_btype` (`btypeid`, `title`, `sysflag`) VALUES (2, 'ͷ�λ���', 1);
INSERT INTO `jieqi_badge_btype` (`btypeid`, `title`, `sysflag`) VALUES (3, 'VIP����', 1);
INSERT INTO `jieqi_badge_btype` (`btypeid`, `title`, `sysflag`) VALUES (1010, '��������', 2);
INSERT INTO `jieqi_badge_btype` (`btypeid`, `title`, `sysflag`) VALUES (2010, 'Ȧ�ӻ���', 3);
INSERT INTO `jieqi_badge_btype` (`btypeid`, `title`, `sysflag`) VALUES (3010, '�����', 2);


#��ز���
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'badge', 'imagedir', '����ͼƬ����Ŀ¼', 'image', '', 0, 1, '', 10100, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'badge', 'sysimgtype', 'ϵͳ����ͼƬ����', '.gif', 'ֻ�̶ܹ�����һ��ͼƬ����', 0, 1, '', 10200, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'badge', 'imagetype', '�Զ������ͼƬ����', '.gif .jpg .jpeg .png', '���������ÿո�ֿ����硰.gif .jpg .jpeg .png��', 0, 1, '', 10300, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'badge', 'maximagesize', '����ͼƬ���ܳ�����K', '30', '', 0, 1, '', 10400, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'badge', 'defaultmaxnum', 'Ĭ�ϻ�������', '0', '�����»���ʱ��Ĭ�ϵĻ������������ 0 ��ʾ�����ơ�', 0, 1, '', 10500, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'badge', 'userbadgenum', '�û���ϢĬ����ʾ��������', '5', '������������Ļ�����Ҫ���û���ϸ�������濴', 0, 3, '', 11100, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'badge', 'pagenum', 'ÿҳ��ʾ��������', '50', '', 0, 3, '', 11200, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'badge', 'awardpnum', 'ÿҳ��ʾ������¼�¼��', '50', '', 0, 3, '', 11300, '��ʾ����');


#���Ȩ��
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(0, 'badge', 'managesystem', '����ϵͳ����', '�����޸�ϵͳĬ�ϵĻ���', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(0, 'badge', 'managemodule', '����ģ�����', '�������ӡ��޸ĺ�ɾ��ģ����ػ���', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(0, 'badge', 'managecustom', '�����Զ������', '�������ӡ��޸ĺ�ɾ���Զ������ͻ���', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(0, 'badge', 'awardview', '�鿴���������¼', '', '');
