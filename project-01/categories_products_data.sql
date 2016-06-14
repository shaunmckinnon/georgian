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

 Date: 05/23/2016 16:38:11 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `categories`
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES ('1', 'Vegetables', null), ('2', 'Fruits', null), ('3', 'Meats', null), ('4', 'Dairy', null), ('5', 'Dry Goods', null);
COMMIT;

-- ----------------------------
--  Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `products`
-- ----------------------------
BEGIN;
INSERT INTO `products` VALUES ('1', 'Celery', '', '1.27', '1'), ('2', 'Red Onions', '', '1.35', '1'), ('3', 'White Onions', '', '1.24', '1'), ('4', 'Iceberg Lettuce', '', '0.99', '1'), ('5', 'Red Delicious Apples', '', '5.65', '2'), ('6', 'Milk', '', '3.99', '4'), ('7', 'Mild Cheddar Cheese', '', '4.99', '4'), ('8', 'Medium Cheddar Cheese', '', '4.99', '4'), ('9', 'Old Cheddar Cheese', '', '4.99', '4'), ('10', 'Mozzarella Cheese', '', '4.99', '4'), ('11', 'Green Onions', '', '0.99', '1'), ('12', 'Bananas', '', '0.59', '2'), ('13', 'Tomatoes', '', '2.57', '2'), ('14', 'Lemons', '', '6.99', '2'), ('15', 'Watermelons', '', '3.59', '2'), ('16', 'Ribeyes', '', '7.89', '3'), ('17', 'Boneless Chicken Breasts', '', '7.99', '3'), ('18', 'Bologna', '', '2.99', '3'), ('19', 'Black Forest Ham', '', '8.99', '3'), ('20', 'Leadbetter Steaks', '', '29.99', '3'), ('21', 'Kraft Dinner', '', '1.29', '5'), ('22', 'Spaghetti', '', '1.69', '5'), ('23', 'Assorted Campbells Soup', '', '1.29', '5'), ('25', 'Assorted Spices', '', '1.19', '5'), ('26', 'French Onion Soup Mix', '', '0.69', '5');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
