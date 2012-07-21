SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `activity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `link` text,
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  `position` bigint(20) NOT NULL,
  `online` tinyint(4) NOT NULL DEFAULT '0',
  `coordinate` text,
  PRIMARY KEY (`id`),
  KEY `fk_activity_category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



ALTER TABLE `activity`
  ADD CONSTRAINT `fk_activity_category` FOREIGN KEY (`category_id`) REFERENCES `activity_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;