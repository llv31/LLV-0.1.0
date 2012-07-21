SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `product_category_language` (
  `category_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` text,
  `content` text,
  `url` text,
  PRIMARY KEY (`language_id`,`category_id`),
  KEY `fk_category_productcategorytrad` (`category_id`),
  KEY `fk_language_productcategorytrad` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE `product_category_language`
  ADD CONSTRAINT `fk_category_productcategorytrad` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_language_productcategorytrad` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
