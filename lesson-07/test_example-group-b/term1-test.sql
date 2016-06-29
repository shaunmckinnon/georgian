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

 Date: 06/23/2016 10:46:19 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `term1_categories`
-- ----------------------------
DROP TABLE IF EXISTS `term1_categories`;
CREATE TABLE `term1_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `term1_categories`
-- ----------------------------
BEGIN;
INSERT INTO `term1_categories` VALUES ('1', 'Dairy'), ('2', 'Meat'), ('3', 'Vegetables'), ('4', 'Fruit'), ('5', 'Soup'), ('6', 'Pop'), ('7', 'Misc');
COMMIT;

-- ----------------------------
--  Table structure for `term1_products`
-- ----------------------------
DROP TABLE IF EXISTS `term1_products`;
CREATE TABLE `term1_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `fk_pro_cat_cat_id` FOREIGN KEY (`category_id`) REFERENCES `term1_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
