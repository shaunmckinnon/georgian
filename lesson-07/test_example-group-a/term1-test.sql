/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : comp-1006-lesson-examples

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 06/21/2016 14:14:20 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `term1_cities`
-- ----------------------------
DROP TABLE IF EXISTS `term1_cities`;
CREATE TABLE `term1_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `term1_cities`
-- ----------------------------
BEGIN;
INSERT INTO `term1_cities` VALUES ('12', 'Orillia'), ('22', 'Barrie'), ('32', 'Kingston'), ('42', 'Brampton'), ('52', 'Bradford'), ('62', 'Hamilton'), ('72', 'Toronto'), ('82', 'Huntsville'), ('92', 'Bracebridge'), ('102', 'Penetang'), ('112', 'Midland'), ('122', 'Waterloo'), ('132', 'Severn');
COMMIT;

-- ----------------------------
--  Table structure for `term1_users`
-- ----------------------------
DROP TABLE IF EXISTS `term1_users`;
CREATE TABLE `term1_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
