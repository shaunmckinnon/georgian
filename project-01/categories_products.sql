CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
)

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
