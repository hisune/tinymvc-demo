/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : demo

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-07-22 19:54:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组id',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录名',
  `true_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '真实姓名',
  `department` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '部门',
  `tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '电话',
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `created_at` timestamp NOT NULL COMMENT '创建时间',
  `updated_at` timestamp NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='后台管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', '1', 'hisune', 'Hisune', 'PHP Developer', '2', 'b365ab1388da8a58dbac7885c172f087', '2015-06-23 00:00:00', '2015-06-23 14:36:07');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户组名称',
  `purview` text COLLATE utf8_unicode_ci NOT NULL COMMENT '控制器权限',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户组';

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('1', '超级管理员', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"8\",\"10\",\"11\",\"12\"]', '2015-06-19 15:58:46', '2015-06-25 17:08:51');
INSERT INTO `group` VALUES ('2', 'test', '[\"5\",\"6\",\"8\",\"9\",\"11\",\"12\"]', '2015-06-23 18:46:13', '2015-06-25 17:09:02');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `route` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `blank` tinyint(1) NOT NULL COMMENT '是否在新窗口中打开',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '系统设置', '0', '', 'cog', '1', '0', null, null);
INSERT INTO `menu` VALUES ('2', '管理员列表', '1', 'admin/list', '', null, '0', null, null);

-- ----------------------------
-- Table structure for purview
-- ----------------------------
DROP TABLE IF EXISTS `purview`;
CREATE TABLE `purview` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `data` text COLLATE utf8_unicode_ci NOT NULL COMMENT '权限内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='权限配置表';

-- ----------------------------
-- Records of purview
-- ----------------------------
INSERT INTO `purview` VALUES ('1', '管理员管理', '[\"admin@*\"]', '2015-06-19 17:04:58', '2015-06-19 17:25:22');
INSERT INTO `purview` VALUES ('2', '菜单管理', '[\"menu@*\"]', '2015-06-19 17:25:06', '2015-06-19 17:25:06');
INSERT INTO `purview` VALUES ('3', '用户组管理', '[\"group@*\"]', '2015-06-19 17:25:35', '2015-06-19 17:25:35');
INSERT INTO `purview` VALUES ('4', '权限管理', '[\"purview@*\"]', '2015-06-19 17:25:50', '2015-06-19 17:25:50');
INSERT INTO `purview` VALUES ('5', '修改密码', '[\"admin@password\"]', '2015-06-23 18:48:35', '2015-06-23 18:48:35');
