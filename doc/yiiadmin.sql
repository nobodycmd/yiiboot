SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(50) NOT NULL COMMENT '角色编号',
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `des` varchar(400) DEFAULT NULL COMMENT '角色描述',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '更新人',
  `update_date` datetime DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态',
  `rule` text COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES ('1', '003', '超级管理员', 'admins', null, '2016-12-17 06:58:30', null, '2016-12-18 09:49:51', '1', null);
INSERT INTO `admin_role` VALUES ('2', '001', '普通管理员2', '普通管理员', null, '2016-12-25 08:54:55', null, '2016-12-25 09:17:19', '1', '14,13,5,9,8,11,10,12,7,1,6');

-- ----------------------------
-- Table structure for admin_rule
-- ----------------------------
DROP TABLE IF EXISTS `admin_rule`;
CREATE TABLE `admin_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `route` char(80) DEFAULT '' COMMENT '路由',
  `title` char(20) DEFAULT '' COMMENT '名称',
  `icon` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '类型',
  `condition` char(100) DEFAULT '' COMMENT '描述',
  `order` int(11) DEFAULT NULL COMMENT '排序',
  `tips` text COMMENT '提示',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否显示',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_rule
-- ----------------------------
INSERT INTO `admin_rule` VALUES ('1', '0', 'admin', '系统管理', 'glyphicon glyphicon-cog orange', '3', '1', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('2', '1', 'rule', '权限管理', 'glyphicon glyphicon-lock aqua', '3', '权限管理', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('3', '2', 'admin-rule/index', '权限列表', 'fa fa-unlock ', '1', '权限列表', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('4', '2', 'admin-rule/create', '创建权限', 'fa fa-key ', '1', '是', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('5', '1', 'user', '用户管理', 'glyphicon glyphicon-list red ', '3', '是', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('6', '5', 'admin-user/index', '用户列表', 'glyphicon glyphicon-user ', '1', '是', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('7', '5', 'admin-user/create', '创建用户', 'glyphicon glyphicon-user ', '1', '是', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('8', '1', 'role', '角色管理', 'fa fa-users', '3', '是', '8', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('9', '8', 'admin-role/index', '角色列表', 'glyphicon glyphicon-th', '1', '是', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('10', '8', 'admin-role/create', '创建角色', 'glyphicon glyphicon-plus', '1', '是', '3', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('11', '8', 'admin-rule/update', '修改权限', '', '2', '是', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('12', '5', 'admin-user/update', '修改用户', '', '2', '是', '1', '1', '1', '1');
INSERT INTO `admin_rule` VALUES ('13', '0', 'personal', '个人中心', '', '3', '1', '1', '1', '0', '1');
INSERT INTO `admin_rule` VALUES ('14', '13', 'personal/index', '个人资料', '', '1', '', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `mobile` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT '手机',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', '', '$2y$13$dicJv5XPyPTB0rex0yatZueHScMAD1nr4i/HX8Lk9UHtAvOIdnFu2', null, 'admin@admin.com', '1', '1481353369', '1483432305', '1', '');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
