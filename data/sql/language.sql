SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `language` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `label` text,
  `locale` text,
  `short_tag` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;