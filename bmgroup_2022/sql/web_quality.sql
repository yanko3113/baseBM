/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100134
Source Host           : 127.0.0.1:3306
Source Database       : web_quality

Target Server Type    : MYSQL
Target Server Version : 100134
File Encoding         : 65001

Date: 2021-07-20 21:13:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `full` tinyint(4) DEFAULT '0',
  `perms` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Administrador', '1', null);

-- ----------------------------
-- Table structure for sliders
-- ----------------------------
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `link` longtext,
  `uuid` varchar(255) DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sliders
-- ----------------------------
INSERT INTO `sliders` VALUES ('2', '2021-07-20_14352160f71769a84ff.jpg', 'nosotros_2', 'https://www.google.com', '9a6e60c0-87d8-4a08-ae30-aececf560902', 'image/jpeg', '99KoRNR.jpg', '63131');
INSERT INTO `sliders` VALUES ('3', '2021-07-20_14384560f718350a182.jpg', 'nosotros_2', '', '78ed6daf-8d2b-43bc-9f65-880e70c77ea5', 'image/jpeg', 'CcvjqNCUYAAnC5P.jpg', '63897');
INSERT INTO `sliders` VALUES ('5', '2021-07-20_14410460f718c0dca81.png', 'nosotros_2', '', '6e542218-0be5-42a2-8423-4609853b3a72', 'image/png', 'Oreilly Spoof titles.png', '1895447');
INSERT INTO `sliders` VALUES ('6', '2021-07-20_15040860f71e2884491.png', 'nosotros_2', '', '36c3c192-0377-4e87-9a22-74aadbdb3a39', 'image/png', 'google_down.png', '20118');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '560e34f255e7f5ac422ca87c723f9bb5', '05660a42e2521b35bc05563425af17ce', 'Administrador', null, '1', null, '2021-07-13 15:16:08', '1');
