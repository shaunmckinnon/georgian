CREATE TABLE categories (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of categories
-- ----------------------------
BEGIN;
INSERT INTO categories VALUES ('24', 'Fruits'), ('25', 'Vegetables'), ('26', 'Movie Posters'), ('27', 'Candy');
COMMIT;

CREATE TABLE products (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  price decimal(10,2) NOT NULL,
  category_id int(11) NOT NULL,
  image varchar(100) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE
);

BEGIN;
INSERT INTO products VALUES ('74', 'Apples', '1.00', '24', null), ('75', 'Oranges', '1.00', '24', null), ('76', 'Bananas', '0.30', '24', null), ('77', 'Kiwi', '2.00', '24', null), ('78', 'Grapes', '4.00', '24', null), ('79', 'Watermelon', '2.00', '24', null), ('80', 'Cantaloupe', '1.00', '24', null), ('81', 'Pineapple', '5.00', '24', null), ('82', 'Carrots', '1.00', '25', null), ('83', 'Brocolli', '2.00', '25', null), ('84', 'Cauliflower', '3.00', '25', null), ('85', 'Parsnips', '1.00', '25', null), ('86', 'Peppers', '2.00', '25', null), ('87', 'Potatoes', '1.00', '25', null), ('88', 'The Crow', '17.00', '26', null), ('89', 'Dark City', '15.00', '26', null), ('90', 'Water World', '5.00', '26', null), ('91', 'Django', '10.00', '26', null), ('92', 'The Avengers', '15.00', '26', null), ('93', 'Nerds', '1.00', '27', 'nerds.jpg'), ('94', 'Swedish Berries', '0.75', '27', 'maynards-swedish-berries.jpg'), ('95', 'Licorice', '0.98', '27', 'licorice.jpeg'), ('96', 'Twizzlers', '2.00', '27', 'twizzlers.jpg'), ('97', 'Runts', '1.00', '27', 'runts.jpeg'), ('98', 'Chocolate-covered Almonds', '5.00', '27', 'chocolate-covered-almonds.jpeg'), ('99', 'Starbursts', '1.25', '27', 'starbursts.jpg');
COMMIT;

CREATE TABLE users (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  role tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
);
