/*
MySQL Data Transfer
Source Host: localhost
Source Database: gotcms1.3
Target Host: localhost
Target Database: gotcms1.3
Date: 2014/4/30 15:33:27
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for admin_navigation
-- ----------------------------
CREATE TABLE `admin_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `keyid` int(11) DEFAULT '0',
  `url` varchar(50) CHARACTER SET gb2312 COLLATE gb2312_bin DEFAULT NULL,
  `menu` int(1) DEFAULT NULL,
  `classname` varchar(100) DEFAULT '0',
  `sort` int(5) DEFAULT '0',
  `display` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1227 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `admin_navigation` VALUES ('1', '系统管理', '0', '', '0', 'system', '11', '0');
INSERT INTO `admin_navigation` VALUES ('3', '用户管理', '0', '', '0', 'user', '9', '0');
INSERT INTO `admin_navigation` VALUES ('4', '资讯管理', '0', '', '0', null, '8', '1');
INSERT INTO `admin_navigation` VALUES ('5', '页面生成', '0', '', '0', 'generate', '7', '0');
INSERT INTO `admin_navigation` VALUES ('6', '运营管理', '0', '', '0', 'operations', '6', '0');
INSERT INTO `admin_navigation` VALUES ('127', '网站工具', '0', '', '0', 'tool', '0', '0');
INSERT INTO `admin_navigation` VALUES ('8', '基础配置', '1', '', '0', null, '4', '0');
INSERT INTO `admin_navigation` VALUES ('134', '公告管理', '124', 'index.php?M=admin_announcement', '0', null, '1', '0');
INSERT INTO `admin_navigation` VALUES ('11', '网站配置', '8', '/admin/config/config', '2', null, '10', '0');
INSERT INTO `admin_navigation` VALUES ('12', '企业管理', '2', '', '0', null, '4', '0');
INSERT INTO `admin_navigation` VALUES ('141', '发送邮件', '137', 'index.php?M=email', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('85', '企业会员分类', '80', 'index.php?M=comclass', '1', null, '2', '0');
INSERT INTO `admin_navigation` VALUES ('142', '新闻首页', '49', 'index.php?M=cache&amp;C=news', '1', null, '7', '0');
INSERT INTO `admin_navigation` VALUES ('29', '审核企业', '12', 'admin_company.php?usertype=0', '0', null, '5', '0');
INSERT INTO `admin_navigation` VALUES ('30', '普通会员', '12', 'admin_company.php?usertype=1', '0', null, '4', '0');
INSERT INTO `admin_navigation` VALUES ('31', '收费会员', '12', 'admin_company.php?usertype=vip', '0', null, '3', '0');
INSERT INTO `admin_navigation` VALUES ('35', '用户管理', '3', '', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('78', '栏目管理', '0', '', '0', 'column', '8', '0');
INSERT INTO `admin_navigation` VALUES ('38', '个人用户列表', '35', 'index.php?M=user_member', '1', null, '7', '0');
INSERT INTO `admin_navigation` VALUES ('133', '新闻管理', '124', '/admin/news', '2', null, '1', '0');
INSERT INTO `admin_navigation` VALUES ('143', '风格管理', '128', 'index.php?M=admin_style', '1', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('80', '类别管理', '78', '', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('135', '独立页面管理', '124', 'index.php?M=description', '1', null, '1', '0');
INSERT INTO `admin_navigation` VALUES ('136', '企业用户列表', '35', 'index.php?M=com_member', '0', null, '3', '0');
INSERT INTO `admin_navigation` VALUES ('138', '广告管理', '137', 'index.php?M=advertise', '1', null, '1', '0');
INSERT INTO `admin_navigation` VALUES ('49', '生成新闻', '5', '', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('50', '生成缓存', '49', '/admin/cache', '2', null, '4', '0');
INSERT INTO `admin_navigation` VALUES ('128', '网站工具', '127', '', '0', '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('144', '职位类别管理', '80', 'index.php?M=admin_job', '1', null, '3', '0');
INSERT INTO `admin_navigation` VALUES ('86', '区域管理', '80', 'index.php?M=admin_city', '1', null, '5', '0');
INSERT INTO `admin_navigation` VALUES ('122', '支付配置', '8', '/admin/payconfig', '2', null, '3', '0');
INSERT INTO `admin_navigation` VALUES ('137', '运营管理', '6', '', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('124', '资讯管理', '9', '', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('126', '用户配置', '8', 'index.php?M=userconfig', '1', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('104', '个人会员分类', '80', 'index.php?M=userclass', '1', null, '9', '0');
INSERT INTO `admin_navigation` VALUES ('132', '管理员配置', '8', 'index.php?M=admin_user', '0', null, '3', '0');
INSERT INTO `admin_navigation` VALUES ('139', '友情链接', '137', 'index.php?M=link', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('145', '行业管理', '80', 'index.php?M=industry', '1', null, '4', '1');
INSERT INTO `admin_navigation` VALUES ('146', '导航配置', '8', '/admin/navigation', '2', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('147', '数据库', '128', 'index.php?M=database', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('148', '整合UC', '128', 'index.php?M=admin_uc', '1', null, '4', '0');
INSERT INTO `admin_navigation` VALUES ('149', '一句话招聘', '35', 'index.php?M=admin_once', '1', null, '1', '0');
INSERT INTO `admin_navigation` VALUES ('150', '简历管理', '35', '/admin/resume', '2', null, '5', '0');
INSERT INTO `admin_navigation` VALUES ('151', '公司管理', '35', 'index.php?M=admin_company', '0', null, '2', '0');
INSERT INTO `admin_navigation` VALUES ('152', '职位管理', '35', '/admin/companyjob', '2', null, '2', '0');
INSERT INTO `admin_navigation` VALUES ('155', '充值记录', '137', '/admin/order', '2', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('156', '消费记录', '137', 'index.php?M=company_pay', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('157', '邮件配置', '8', 'index.php?M=emailconfig', '0', null, '6', '0');
INSERT INTO `admin_navigation` VALUES ('158', '短信配置', '8', 'index.php?M=msgconfig', '0', null, '6', '0');
INSERT INTO `admin_navigation` VALUES ('159', '快捷登录', '128', 'index.php?M=qqconfig', '1', '', '3', '0');
INSERT INTO `admin_navigation` VALUES ('162', '后台充值', '137', 'index.php?M=recharge', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('163', '短信群发', '137', 'index.php?M=information', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('164', '首页生成', '49', 'index.php?M=cache&amp;C=index', '1', null, '1', '0');
INSERT INTO `admin_navigation` VALUES ('168', '新闻类别', '49', 'index.php?M=cache&amp;C=newsclass', '1', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('167', '新闻详细页', '49', 'index.php?M=cache&amp;C=archive', '1', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('169', '关键字管理', '137', 'index.php?M=admin_keyword', '1', null, '6', '0');
INSERT INTO `admin_navigation` VALUES ('171', '站内信管理', '35', 'index.php?M=admin_message', '1', '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('172', '短信记录', '137', 'index.php?M=mobliemsg', '0', null, '3', '0');
INSERT INTO `admin_navigation` VALUES ('173', '名企招聘', '137', 'index.php?M=hotjob', '1', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('174', '企业认证审核', '35', 'index.php?M=comcert', '1', null, '1', '0');
INSERT INTO `admin_navigation` VALUES ('176', 'SEO设置', '8', 'index.php?M=seo', '0', null, '3', '0');
INSERT INTO `admin_navigation` VALUES ('178', '分站管理', '128', 'index.php?M=admin_domain', '1', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('179', '企业模板', '128', 'index.php?M=comtpl', null, null, '5', '0');
INSERT INTO `admin_navigation` VALUES ('188', '企业新闻管理', '35', 'index.php?M=comnews', null, null, '1', '0');
INSERT INTO `admin_navigation` VALUES ('189', '企业产品管理', '35', 'index.php?M=comproduct', null, null, '2', '0');
INSERT INTO `admin_navigation` VALUES ('191', '招聘会', '137', 'index.php?M=zhaopinhui', '1', null, '5', '0');
INSERT INTO `admin_navigation` VALUES ('194', '整合PW', '128', 'index.php?M=admin_pw', '1', null, '2', '0');
INSERT INTO `admin_navigation` VALUES ('170', '行业类别管理', '80', 'index.php?M=admin_industry', null, null, '4', '0');
INSERT INTO `admin_navigation` VALUES ('195', '个人认证审核', '35', 'index.php?M=usercert', '0', null, '6', '0');
INSERT INTO `admin_navigation` VALUES ('1197', '求职咨询', '35', 'index.php?M=admin_msg', '0', null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('1203', '微简历', '35', 'index.php?M=admin_tiny', '0', null, '4', '0');
INSERT INTO `admin_navigation` VALUES ('1210', '社交', '0', '', '0', 'social', '0', '0');
INSERT INTO `admin_navigation` VALUES ('9', '新闻资讯', '0', '', null, 'news', '5', '0');
INSERT INTO `admin_navigation` VALUES ('1212', '问答管理', '1216', 'index.php?M=admin_question', '1', '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('1213', '问答类别', '80', 'index.php?M=question_class', null, null, '0', '0');
INSERT INTO `admin_navigation` VALUES ('1216', '社交', '1210', '', '0', '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('1217', '留言管理', '1216', 'index.php?M=friend_message', null, '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('1218', '动态管理', '1216', 'index.php?M=friend_state', null, '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('1219', '举报原因管理', '1211', 'index.php?M=admin_reason', '1', '', '0', '1');
INSERT INTO `admin_navigation` VALUES ('1220', '数据调用', '137', 'index.php?M=datacall', '1', '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('1223', '举报管理', '137', 'index.php?M=report', '1', '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('1224', '高级搜索', '128', '/admin/searchest', '2', '', '0', '0');
INSERT INTO `admin_navigation` VALUES ('1225', '举报管理', '137', 'index.php?M=report&amp;amp;amp;type=0', '1', '', '0', '1');
INSERT INTO `admin_navigation` VALUES ('1226', '企业评论', '35', 'index.php?M=com_pl', '1', null, '1', '0');
