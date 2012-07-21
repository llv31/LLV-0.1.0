SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `cms_caroussel_element` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `caroussel_id` bigint(20) NOT NULL DEFAULT '1',
  `title` text NOT NULL,
  `content` text,
  `link` text,
  `filename` text NOT NULL,
  `original_filename` text NOT NULL,
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;