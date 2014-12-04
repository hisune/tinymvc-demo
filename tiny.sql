/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tiny

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-12-04 11:04:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for demo
-- ----------------------------
DROP TABLE IF EXISTS `demo`;
CREATE TABLE `demo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `char` char(120) NOT NULL,
  `int` int(11) unsigned NOT NULL,
  `time` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of demo
-- ----------------------------
INSERT INTO `demo` VALUES ('5', 'create1', '174', '2014-12-03 17:25:11', '2014-12-03 17:25:11', '2014-12-03 17:25:11');
INSERT INTO `demo` VALUES ('6', 'create1', '400', '2014-12-03 17:25:14', '2014-12-03 17:25:14', '2014-12-03 17:25:14');
INSERT INTO `demo` VALUES ('7', 'create1', '373', '2014-12-03 17:25:17', '2014-12-03 17:25:17', '2014-12-03 17:25:17');
INSERT INTO `demo` VALUES ('8', 'create1', '51', '2014-12-03 17:25:18', '2014-12-03 17:25:18', '2014-12-03 17:25:18');
INSERT INTO `demo` VALUES ('9', 'create1', '259', '2014-12-03 17:25:18', '2014-12-03 17:25:18', '2014-12-03 17:25:18');
INSERT INTO `demo` VALUES ('10', 'create1', '238', '2014-12-03 17:25:18', '2014-12-03 17:25:18', '2014-12-03 17:25:18');
INSERT INTO `demo` VALUES ('11', 'create1', '182', '2014-12-03 17:25:19', '2014-12-03 17:25:19', '2014-12-03 17:25:19');
INSERT INTO `demo` VALUES ('12', 'create1', '69', '2014-12-03 17:25:19', '2014-12-03 17:25:19', '2014-12-03 17:25:19');
INSERT INTO `demo` VALUES ('13', 'create1', '351', '2014-12-03 17:25:19', '2014-12-03 17:25:19', '2014-12-03 17:25:19');
INSERT INTO `demo` VALUES ('14', 'create1', '322', '2014-12-03 17:25:20', '2014-12-03 17:25:20', '2014-12-03 17:25:20');
INSERT INTO `demo` VALUES ('15', 'create1', '209', '2014-12-03 17:25:20', '2014-12-03 17:25:20', '2014-12-03 17:25:20');

-- ----------------------------
-- Table structure for join
-- ----------------------------
DROP TABLE IF EXISTS `join`;
CREATE TABLE `join` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `demo_id` int(11) unsigned NOT NULL,
  `select` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of join
-- ----------------------------
INSERT INTO `join` VALUES ('1', '5', '1');
