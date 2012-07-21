SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `cms_caroussel_element` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `caroussel_id` bigint(20) NOT NULL DEFAULT '1',
  `user_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `content` text,
  `link` text,
  `filename` text NOT NULL,
  `original_filename` text NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1',
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cmscarousselelement_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



ALTER TABLE `cms_caroussel_element`
  ADD CONSTRAINT `fk_cmscarousselelement_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
