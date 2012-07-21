SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `cms_page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `language_id` bigint(20) NOT NULL,
  `title` text,
  `content` text,
  `link` text,
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_language_cms` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `cms_page`
  ADD CONSTRAINT `fk_language_cms_page` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
