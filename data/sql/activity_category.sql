SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `activity_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `language_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `online` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_language_activitycategory` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



ALTER TABLE `activity_category`
  ADD CONSTRAINT `fk_language_activitycategory` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
