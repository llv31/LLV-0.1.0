SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `news_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `language_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `online` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_language_newscategory` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



ALTER TABLE `news_category`
  ADD CONSTRAINT `fk_language_newscategory` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
