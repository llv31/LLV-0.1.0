-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 15 Décembre 2012 à 18:43
-- Version du serveur: 5.5.9
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `llv`
--

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

CREATE TABLE `activity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `position` bigint(20) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `location` text,
  `part_of_shuffling` tinyint(4) NOT NULL DEFAULT '1',
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activity_category` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `activity`
--

INSERT INTO `activity` VALUES(1, 1, 1, 1, '', 1, '2012-11-24 02:40:04', '2012-11-27 07:19:19', NULL);
INSERT INTO `activity` VALUES(2, 1, 2, 1, '', 1, '2012-11-24 02:43:00', '2012-11-24 02:43:03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `activity_category`
--

CREATE TABLE `activity_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `activity_category`
--

INSERT INTO `activity_category` VALUES(1);
INSERT INTO `activity_category` VALUES(2);
INSERT INTO `activity_category` VALUES(3);
INSERT INTO `activity_category` VALUES(4);

-- --------------------------------------------------------

--
-- Structure de la table `activity_category_language`
--

CREATE TABLE `activity_category_language` (
  `category_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`category_id`,`language_id`),
  KEY `fk_categorylang_category` (`category_id`),
  KEY `fk_categorylang_lang` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `activity_category_language`
--

INSERT INTO `activity_category_language` VALUES(1, 1, 'Hiver');
INSERT INTO `activity_category_language` VALUES(1, 2, 'ES Hiver');
INSERT INTO `activity_category_language` VALUES(1, 3, 'Winter');
INSERT INTO `activity_category_language` VALUES(1, 4, 'DE Hiver');
INSERT INTO `activity_category_language` VALUES(2, 1, 'Été');
INSERT INTO `activity_category_language` VALUES(2, 2, 'ES été');
INSERT INTO `activity_category_language` VALUES(2, 3, 'Summer');
INSERT INTO `activity_category_language` VALUES(2, 4, 'DE été');
INSERT INTO `activity_category_language` VALUES(3, 1, 'Restaurants');
INSERT INTO `activity_category_language` VALUES(3, 2, 'ES Resto');
INSERT INTO `activity_category_language` VALUES(3, 3, 'Restaurants');
INSERT INTO `activity_category_language` VALUES(3, 4, 'DE Resto');
INSERT INTO `activity_category_language` VALUES(4, 1, 'Autres');
INSERT INTO `activity_category_language` VALUES(4, 2, 'ES Autres');
INSERT INTO `activity_category_language` VALUES(4, 3, 'Others');
INSERT INTO `activity_category_language` VALUES(4, 4, 'DE Autres');

-- --------------------------------------------------------

--
-- Structure de la table `activity_illustration`
--

CREATE TABLE `activity_illustration` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(20) NOT NULL,
  `filename` text NOT NULL,
  `original_filename` text NOT NULL,
  `online` tinyint(4) NOT NULL,
  `position` bigint(20) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activityillustration_activity` (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `activity_illustration`
--

INSERT INTO `activity_illustration` VALUES(2, 1, '50b0ce3d49302.jpeg', '175416_1789837661874_5110926_o.jpeg', 1, 1, '2012-11-24 02:40:13', NULL);
INSERT INTO `activity_illustration` VALUES(3, 1, '50b0ce5723d85.jpeg', '413843_3870151628423_606535435_o.jpeg', 1, 2, '2012-11-24 02:40:39', '2012-11-24 02:40:51');
INSERT INTO `activity_illustration` VALUES(4, 1, '50b0ce87d42c1.jpeg', '278460_2166851966996_4129011_o.jpeg', 1, 3, '2012-11-24 02:41:27', '2012-11-24 02:42:24');
INSERT INTO `activity_illustration` VALUES(5, 1, '50b0ce8e4d87c.jpeg', '69797_1604147659740_2207325_n.jpeg', 1, 4, '2012-11-24 02:41:34', NULL);
INSERT INTO `activity_illustration` VALUES(6, 2, '50b5066abb2a5.jpeg', '278460_2166851966996_4129011_o.jpeg', 1, 5, '2012-11-27 07:28:58', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `activity_language`
--

CREATE TABLE `activity_language` (
  `activity_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` text,
  `content` text,
  `link` text,
  PRIMARY KEY (`activity_id`,`language_id`),
  KEY `fk_actilang_acti` (`activity_id`),
  KEY `fk_actilang_lang` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `activity_language`
--

INSERT INTO `activity_language` VALUES(1, 1, 'Test', '<u><i><b>Test</b></i></u><br>', '');
INSERT INTO `activity_language` VALUES(1, 2, '', '<br>', '');
INSERT INTO `activity_language` VALUES(1, 3, '', '<br>', '');
INSERT INTO `activity_language` VALUES(1, 4, '', '<br>', '');
INSERT INTO `activity_language` VALUES(2, 1, 'Test 2', 'sdfghj<br>', '');
INSERT INTO `activity_language` VALUES(2, 2, '', '<br>', '');
INSERT INTO `activity_language` VALUES(2, 3, '', '<br>', '');
INSERT INTO `activity_language` VALUES(2, 4, '', '<br>', '');

-- --------------------------------------------------------

--
-- Structure de la table `cms_caroussel_element`
--

CREATE TABLE `cms_caroussel_element` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `filename` text NOT NULL,
  `original_filename` text NOT NULL,
  `mime_type` text NOT NULL,
  `size` int(11) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL,
  `link` text,
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `cms_caroussel_element`
--

INSERT INTO `cms_caroussel_element` VALUES(1, '50b0b71d4b629.jpeg', '69797_1604147659740_2207325_n.jpeg', 'image/jpeg', 144701, 1, 1, NULL, '2012-11-24 01:01:33', '2012-11-24 01:01:33', NULL);
INSERT INTO `cms_caroussel_element` VALUES(2, '50b0b71d4be29.jpeg', '175416_1789837661874_5110926_o.jpeg', 'image/jpeg', 294064, 1, 2, NULL, '2012-11-24 01:01:33', '2012-11-24 01:01:33', NULL);
INSERT INTO `cms_caroussel_element` VALUES(3, '50b0b71d4c279.jpeg', '278460_2166851966996_4129011_o.jpeg', 'image/jpeg', 668515, 1, 3, NULL, '2012-11-24 01:01:33', '2012-11-24 01:01:33', NULL);
INSERT INTO `cms_caroussel_element` VALUES(4, '50b0b71d4c63a.jpeg', '413843_3870151628423_606535435_o.jpeg', 'image/jpeg', 868862, 1, 4, NULL, '2012-11-24 01:01:33', '2012-11-24 01:01:33', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cms_page`
--

CREATE TABLE `cms_page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `cms_page`
--

INSERT INTO `cms_page` VALUES(1, '2012-07-21 00:00:00', '2012-11-24 02:54:48', NULL);
INSERT INTO `cms_page` VALUES(2, '2012-07-21 00:00:00', '2012-08-02 08:13:52', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cms_page_language`
--

CREATE TABLE `cms_page_language` (
  `page_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` text,
  `content` text,
  `url` text,
  PRIMARY KEY (`page_id`,`language_id`),
  KEY `fk_pagecmslang_pagecms` (`page_id`),
  KEY `fk_pagecmslang_language` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cms_page_language`
--

INSERT INTO `cms_page_language` VALUES(1, 1, 'Qui sommes-nous ?', 'Charentais d\\''origine, nous sommes devenus pyrénéens d\\''adoption depuis \r\npeu, après avoir été vignerons au service du vignoble cognaçais durant \r\ntrente ans. Tombés sous le charme et la quiétude qui se dégage de <a target=\\"\\" title=\\"\\" href=\\"http://www.luchon.com/\\"><span class=\\"lien\\">Bagnères de Luchon</span></a> et de ses alentours, nous avons décidé d\\''y venir vivre et de créer Luchon Location Vacances sarl.\r\n			<br><br>\r\n			Que vous soyez seul, en couple, en famille ou entre amis, notre seule\r\n ambition : que vos vacances soient un vrai moment de repos, de \r\nrelaxation, d\\''évasion et de plaisir. Pour y parvenir, notre choix s\\''est \r\nporté sur deux maisons et sur deux options possibles.\r\n			<br><br>\r\n			<a href=\\"http://www.gite-luchon.com/fr/chambre-2\\" id=\\"body\\" class=\\"lien\\">\\''Au-Delà du Temps\\''</a>,\r\n notre maison consacrée à nos 4 chambres d\\''hôtes de charme est située à \r\nSaint Mamet, petit village de 900 habitants jouxtant Bagnères de Luchon.\r\n			<br><br>\r\n			<a href=\\"http://www.gite-luchon.com/fr/chambre-1\\" id=\\"body\\" class=\\"lien\\">\\''Etch Soulet\\''</a>,\r\n charmant chalet de montagne (1275m), situé à Portet de Luchon, village \r\nd\\''une trentaine d\\''âmes au pied du col de Peyresourde, est composé de \r\ndeux grands appartements. Le premier pouvant accueillir 8 personnes et \r\nle second 13 personnes. Ces gîtes de standing et de charme peuvent être \r\nréunis grâce à un escalier commun offrant une possibilité de 21 \r\ncouchages.\r\n			<br><br>\r\n			Après cette présentation rapide, nous vous laissons découvrir les \r\npossibilités qui s\\''offrent à vous pour vivre des vacances inoubliables \r\ndans ce petit coin de paradis \r\n		', NULL);
INSERT INTO `cms_page_language` VALUES(1, 2, '', '<br>', NULL);
INSERT INTO `cms_page_language` VALUES(1, 3, '', '<br>', NULL);
INSERT INTO `cms_page_language` VALUES(1, 4, '', '<br>', NULL);
INSERT INTO `cms_page_language` VALUES(2, 1, 'Partenaires', '<a target=\\"_blank\\" title=\\"Abritel\\" href=\\"http://www.abritel.fr\\">Abritel</a><br><span class=\\"ctr-p\\" id=\\"body\\"><div id=\\"lga\\" style=\\"height:231px;margin-top:-22px\\"><a href=\\"https://www.google.fr/search?q=Londres+2012+Tennis+de+table&amp;oi=ddle&amp;ct=table_tennis-2012-hp\\"><img alt=\\"Londres 2012 Tennis de table\\" src=\\"https://www.google.fr/logos/2012/table_tennis-2012-hp.jpg\\" title=\\"Londres 2012 Tennis de table\\" id=\\"hplogo\\" style=\\"padding-top:0px\\" border=\\"0\\" height=\\"207\\" width=\\"530\\"></a><br><br><br><br><span class=\\"ctr-p\\" id=\\"body\\"><div id=\\"lga\\" style=\\"height:231px;margin-top:-22px\\"><a href=\\"https://www.google.fr/search?q=Londres+2012+Tennis+de+table&amp;oi=ddle&amp;ct=table_tennis-2012-hp\\"><img alt=\\"Londres 2012 Tennis de table\\" src=\\"https://www.google.fr/logos/2012/table_tennis-2012-hp.jpg\\" title=\\"Londres 2012 Tennis de table\\" id=\\"hplogo\\" style=\\"padding-top:0px\\" border=\\"0\\" height=\\"207\\" width=\\"530\\"></a></div></span><br></div></span><br><br><br><br><br><br><br>', NULL);
INSERT INTO `cms_page_language` VALUES(2, 2, 'aa', 'aa<br>', NULL);
INSERT INTO `cms_page_language` VALUES(2, 3, 'Partners', 'a', NULL);
INSERT INTO `cms_page_language` VALUES(2, 4, 'Deutsch', '<br>', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE `language` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `label` text,
  `locale` text,
  `short_tag` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `language`
--

INSERT INTO `language` VALUES(1, 'Français', 'fr_FR', 'fr');
INSERT INTO `language` VALUES(2, 'Español', 'es_ES', 'es');
INSERT INTO `language` VALUES(3, 'English', 'en_GB', 'en');
INSERT INTO `language` VALUES(4, 'Deutsch', 'de_DE', 'de');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `position` bigint(20) NOT NULL,
  `location` text,
  `online` tinyint(1) DEFAULT NULL,
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_news_category` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` VALUES(54, 1, 1, '', 1, '2012-09-29 02:50:30', '2012-09-29 04:26:25', NULL);
INSERT INTO `news` VALUES(55, 1, 3, '', 1, '2012-09-29 02:56:08', '2012-09-29 04:26:33', NULL);
INSERT INTO `news` VALUES(56, 1, 4, '', 1, '2012-09-29 03:15:37', '2012-09-29 03:15:37', NULL);
INSERT INTO `news` VALUES(57, 1, 2, 'Test', 1, '2012-09-29 04:40:23', '2012-09-29 04:58:26', NULL);
INSERT INTO `news` VALUES(58, 1, 6, '', 1, '2012-09-29 05:02:41', '2012-12-15 05:41:13', NULL);
INSERT INTO `news` VALUES(59, 1, 5, '', 1, '2012-09-29 05:02:58', '2012-11-24 01:39:52', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `news_category`
--

CREATE TABLE `news_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `online` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `news_category`
--

INSERT INTO `news_category` VALUES(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `news_category_language`
--

CREATE TABLE `news_category_language` (
  `category_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` text,
  PRIMARY KEY (`category_id`,`language_id`),
  KEY `fk_newscateglang_category` (`category_id`),
  KEY `fk_newscateglang_lang` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news_category_language`
--

INSERT INTO `news_category_language` VALUES(1, 1, 'Défaut');
INSERT INTO `news_category_language` VALUES(1, 2, 'ES Défaut');
INSERT INTO `news_category_language` VALUES(1, 3, 'Default');
INSERT INTO `news_category_language` VALUES(1, 4, 'DE Défaut');

-- --------------------------------------------------------

--
-- Structure de la table `news_illustration`
--

CREATE TABLE `news_illustration` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) NOT NULL,
  `filename` text NOT NULL,
  `original_filename` text NOT NULL,
  `online` tinyint(4) NOT NULL,
  `position` bigint(20) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_newsillustration_news` (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `news_illustration`
--

INSERT INTO `news_illustration` VALUES(1, 58, '50b0bb9845a9a.jpeg', '413843_3870151628423_606535435_o.jpeg', 1, 1, '2012-11-24 01:20:40', NULL);
INSERT INTO `news_illustration` VALUES(2, 58, '50ccac347eb9f.jpeg', '69797_1604147659740_2207325_n.jpeg', 1, 2, '2012-12-15 05:58:28', NULL);
INSERT INTO `news_illustration` VALUES(3, 58, '50ccac489bbff.png', 'Capture d’écran 2012-05-24 à 20.27.47.png', 1, 3, '2012-12-15 05:58:48', NULL);
INSERT INTO `news_illustration` VALUES(4, 58, '50ccac4d4ed53.jpg', 'contact.jpg', 1, 4, '2012-12-15 05:58:53', NULL);
INSERT INTO `news_illustration` VALUES(5, 58, '50ccac53cb121.png', 'Capture d’écran 2012-04-22 à 17.37.14.png', 1, 5, '2012-12-15 05:58:59', NULL);
INSERT INTO `news_illustration` VALUES(6, 58, '50ccac5ba11dc.png', 'Capture d’écran 2012-05-24 à 19.43.06.png', 1, 6, '2012-12-15 05:59:07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `news_language`
--

CREATE TABLE `news_language` (
  `news_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` text,
  `content` text,
  `link` text,
  PRIMARY KEY (`news_id`,`language_id`),
  KEY `fk_newslang_news` (`news_id`),
  KEY `fk_newslang_lang` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news_language`
--

INSERT INTO `news_language` VALUES(54, 1, 'Réservation hiver 2013', '<b><font size="\\&quot;\\\\&quot;\\\\\\\\&quot;3\\\\\\\\&quot;\\\\&quot;\\&quot;">État des réservation Février / Mars 2013</font></b><br><br><span style="\\&quot;\\\\&quot;\\\\\\\\&quot;color:\\\\&quot;\\&quot;" rgb(128,="\\&quot;\\\\&quot;\\\\&quot;\\&quot;" 0,="\\&quot;\\\\&quot;\\\\&quot;\\&quot;" 128);\\\\\\\\\\\\\\"="\\&quot;\\\\&quot;\\\\&quot;\\&quot;">Notre Chalet "Etch Soulet"<br>\r\n            </span><span style="\\&quot;\\\\&quot;\\\\\\\\&quot;color:\\\\&quot;\\&quot;" rgb(128,="\\&quot;\\\\&quot;\\\\&quot;\\&quot;" 0,="\\&quot;\\\\&quot;\\\\&quot;\\&quot;" 128);\\\\\\\\\\\\\\"="\\&quot;\\\\&quot;\\\\&quot;\\&quot;"><u>En Février :</u> du lundi 04 au vendredi 08 février 2013 est encore disponible. ( 4 nuitées )<br>\r\n            </span><span style="\\&quot;\\\\&quot;\\\\\\\\&quot;color:\\\\&quot;\\&quot;" rgb(128,="\\&quot;\\\\&quot;\\\\&quot;\\&quot;" 0,="\\&quot;\\\\&quot;\\\\&quot;\\&quot;" 128);\\\\\\\\\\\\\\"="\\&quot;\\\\&quot;\\\\&quot;\\&quot;"><u>En Mars</u>\r\n  : le chalet reste actuellement disponible du samedi 02 mars au samedi \r\n 16 mars ( vacances scolaires zone A et zone C)&nbsp; puis&nbsp; du samedi soir 16\r\n mars au vendredi  29 Mars 2013 matin.(hors vacances scolaires)</span>  <br>', '');
INSERT INTO `news_language` VALUES(54, 2, '', '<br>', '');
INSERT INTO `news_language` VALUES(54, 3, '', '<br>', '');
INSERT INTO `news_language` VALUES(54, 4, '', '<br>', '');
INSERT INTO `news_language` VALUES(55, 1, 'Premières neiges', '												Nous avons eu le bonheur de découvrir que la neige a commencé à faire son apparition dans la nuit du 25 au 26 septembre à partir de 2400m.<br><br>Nous en profitons pour vous rappeler le calendrier d''ouverture<font size="1">**</font> des stations à proximité de votre location<br><br>\r\n<h3><b><font size="3">Peyragudes</font></b></h3>* 24 et 25 novembre 2012<br>* 1 et 2 décembre&nbsp;2012, <br>\r\n* 6 au 9 décembre&nbsp;2012<br>* 15 et 16 décembre 2012 <br>\r\n* 22 décembre 2012 au Lundi&nbsp;1er Avril 2013&nbsp; \r\n<br><br><font size="1"><br>** Sous réserve de bonne conditions d’enneigement.</font><br>', '');
INSERT INTO `news_language` VALUES(55, 2, '', '<br>', '');
INSERT INTO `news_language` VALUES(55, 3, '', '<br>', '');
INSERT INTO `news_language` VALUES(55, 4, '', '<br>', '');
INSERT INTO `news_language` VALUES(56, 1, 'Test', 'Test<br>', '');
INSERT INTO `news_language` VALUES(56, 2, '', '<br>', '');
INSERT INTO `news_language` VALUES(56, 3, '', '<br>', '');
INSERT INTO `news_language` VALUES(56, 4, '', '<br>', '');
INSERT INTO `news_language` VALUES(57, 1, 'Test', '<p><strong>Lorem Ipsum</strong> is simply dummy \r\ntext of the printing and typesetting industry. Lorem Ipsum has been the \r\nindustry''s standard dummy text ever since the 1500s, when an unknown \r\nprinter took a galley of type and scrambled it to make a type specimen \r\nbook. It has survived not only five centuries, but also the leap into \r\nelectronic typesetting, remaining essentially unchanged. It was \r\npopularised in the 1960s with the release of Letraset sheets containing \r\nLorem Ipsum passages, and more recently with desktop publishing software\r\n like Aldus PageMaker including versions of Lorem Ipsum.</p><div class="rc"><p>It\r\n is a long established fact that a reader will be distracted by the \r\nreadable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using ''Content here, content here'', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for ''lorem ipsum'' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p></div>&nbsp;<div class="lc"><p>Contrary\r\n to popular belief, Lorem Ipsum is not simply random text. It has roots \r\nin a piece of classical Latin literature from 45 BC, making it over 2000\r\n years old. Richard McClintock, a Latin professor at Hampden-Sydney \r\nCollege in Virginia, looked up one of the more obscure Latin words, \r\nconsectetur, from a Lorem Ipsum passage, and going through the cites of \r\nthe word in classical literature, discovered the undoubtable source. \r\nLorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus \r\nBonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written \r\nin 45 BC. This book is a treatise on the theory of ethics, very popular \r\nduring the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum \r\ndolor sit amet..", comes from a line in section 1.10.32.</p></div>', '');
INSERT INTO `news_language` VALUES(57, 2, '', '<br>', '');
INSERT INTO `news_language` VALUES(57, 3, '', '<br>', '');
INSERT INTO `news_language` VALUES(57, 4, '', '<br>', '');
INSERT INTO `news_language` VALUES(58, 1, 'Ceci n\\''est pas un titre habituel', '<div class="accro-art">\r\n<h1 class="tit-art">\r\n« J''ai signé à Liévin »</h1><p><br></p></div><div class="illus-art"><h4 class="leg-art">\r\nJonathan Godin regrette déjà l''ambiance des Vauzelles, qu''il retrouvera \r\nl''an prochain sous le maillot de Liévin. (photo anne lacaud)</h4>\r\n</div>\r\n\r\n\r\n\r\n\r\n<div class="texte-art">\r\n<p><br></p><p><br></p><p>A l''heure d''évoquer son départ et les raisons qui l''ont poussé à \r\nchoisir sa future destination, le désormais ex-capitaine du CBB n''élude \r\naucune question. De sa déception liée à « un certain manque de \r\nconsidération de la part du club », à sa signature en faveur de Liévin \r\n(N1), Jonathan Godin fait le tour de la question. Entretien. </p><p>« Sud Ouest ». Quelles sont les raisons qui vous ont poussé à quitter le CBB ?</p><p>Jonathan Godin. Le club m''a fait comprendre qu''il cherchait un meneur\r\n de Pro B, et que s''il ne trouvait pas, il me garderait. J''étais un peu \r\ndéçu au vu d''une saison que j''estime correcte. Je pensais pouvoir être \r\nprolongé. J''étais un peu devenu une solution de rechange, où bien je ne \r\ncomprends pas trop le sens de leur démarche. À partir de ce moment, tout\r\n est devenu plus clair dans ma tête. J''avais plusieurs contacts que \r\nj''étudiais, avant cet épisode. Mon agent avait même fait savoir que nous\r\n attendions une éventuelle proposition du CBB avant de prendre une \r\ndécision. Nous n''avons pas eu de proposition dans l''immédiat de la part \r\ndu club, j''ai donc décidé de partir. Du côté du club, j''ai l''impression \r\nqu''ils avaient fait le tour de la question alors que du mien, ce n''était\r\n pas forcément le cas. J''aurais aimé, pourquoi pas, monter d''une \r\ndivision avec Cognac. Car cette année, il n''a pas manqué grand-chose. On\r\n aurait pu le faire. Maintenant, il s''agit de ne plus regretter et \r\nd''aller de l''avant. </p><p>Aujourd''hui, prenez-vous toujours le temps de la réflexion ? </p><p>Ca\r\n y est, j''ai trouvé un club puisque je viens de signer à Liévin. C''est \r\ndrôle car je ne serai pas très loin de Mathieu (Bigote, NDLR), qui a \r\nsigné au Portel. J''ai eu un bon feeling avec le coach qui m''a expliqué \r\nsa manière de fonctionner. J''ai vraiment senti quelque chose lorsque je \r\nl''ai eu au téléphone. Ça a collé, désormais, je vais tenter l''aventure \r\nlà-bas. </p><p>Aviez-vous d''autres touches ? </p><p>Quelques N1, des N2 \r\nambitieuses et même un club promu en Pro B. En tout cas, je n''ai pas \r\nfait mon choix par défaut. Liévin ambitionne les play-offs, c''est un \r\nchallenge qui m''intéresse aussi. Mon but est de tout faire pour y \r\nparvenir. </p><p>Que retenez-vous de vos années cognaçaises ? </p><p>L''ambiance\r\n des Vauzelles. Ici, c''est quelque chose. Les titres que nous avons \r\nremportés restent aussi de très bons souvenirs, surtout lorsque nous les\r\n avons gagnés à la maison. Il y a aussi eu la finale à Bercy, où les \r\nsupporteurs étaient venus nombreux. À ce titre, je voulais les remercier\r\n car tous les clubs n''ont pas la chance de bénéficier de cette ferveur. \r\nIls m''ont toujours soutenu pendant ces trois ans, malgré la première \r\nannée, qui pour moi a été la plus dure. Même en N2, ils étaient toujours\r\n derrière nous. Leur soutien a véritablement contribué à nos succès. </p><p>D''un point de vu personnel, que vous ont amené ces trois années à Cognac ? </p><p>Je\r\n pense avoir pas mal mûri, que ce soit dans mon jeu ou dans mon \r\ncomportement. Avant, j''étais assez nerveux. De ce côté-là, je me suis \r\ncalmé. Évidemment, j''ai aussi pris beaucoup d''expérience malgré le fait \r\nd''avoir été relégué. </p><p>Que peut-on vous souhaiter pour cette nouvelle aventure ? </p><p>D''atteindre mes objectifs en emmenant Liévin en play-offs, voire plus ci possible. </p>\r\n</div>', '');
INSERT INTO `news_language` VALUES(58, 2, '', '<br>', '');
INSERT INTO `news_language` VALUES(58, 3, '', '<br>', '');
INSERT INTO `news_language` VALUES(58, 4, '', '<br>', '');
INSERT INTO `news_language` VALUES(59, 1, 'Ouh bah ça alors !', '<p>The \r\nstandard chunk of Lorem Ipsum used since the 1500s is reproduced below \r\nfor those interested. Sections 1.10.32 and 1.10.33 from "de Finibus \r\nBonorum et Malorum" by Cicero are also reproduced in their exact \r\noriginal form, accompanied by English versions from the 1914 translation\r\n by H. Rackham.The \r\nstandard chunk of Lorem Ipsum used since the 1500s is reproduced below \r\nfor those interested. Sections 1.10.32 and 1.10.33 from "de Finibus \r\nBonorum et Malorum" by Cicero are also reproduced in their exact \r\noriginal form, accompanied by English versions from the 1914 translation\r\n by H. Rackham.</p>', '');
INSERT INTO `news_language` VALUES(59, 2, '', '<br>', '');
INSERT INTO `news_language` VALUES(59, 3, '', '<br>', '');
INSERT INTO `news_language` VALUES(59, 4, '', '<br>', '');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_category_id` bigint(20) NOT NULL,
  `url` text NOT NULL,
  `availability` text NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_productcategory` (`product_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` VALUES(6, 1, 'peyresourde', '', 1);
INSERT INTO `product` VALUES(7, 1, 'venasque', '', 2);
INSERT INTO `product` VALUES(8, 1, 'estive', '', 3);
INSERT INTO `product` VALUES(9, 2, 'etch-soulet-1', '', 1);
INSERT INTO `product` VALUES(10, 2, 'etch-soulet-2', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `label` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `product_category`
--

INSERT INTO `product_category` VALUES(1, 'Au delà du temps');
INSERT INTO `product_category` VALUES(2, 'Etch Soulet');

-- --------------------------------------------------------

--
-- Structure de la table `product_category_goldbook`
--

CREATE TABLE `product_category_goldbook` (
  `id` bigint(20) NOT NULL,
  `product_category_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `validated` tinyint(1) DEFAULT '0',
  `date_stay` text,
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pcg_product` (`product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product_category_goldbook`
--


-- --------------------------------------------------------

--
-- Structure de la table `product_category_language`
--

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

--
-- Contenu de la table `product_category_language`
--

INSERT INTO `product_category_language` VALUES(1, 1, 'Au delà du temps', 'Lorem ipsum', 'guesthouse-room-list');
INSERT INTO `product_category_language` VALUES(2, 1, 'Etch Soulet', 'Lorem ipsum', 'chalet-room-list');

-- --------------------------------------------------------

--
-- Structure de la table `product_illustration`
--

CREATE TABLE `product_illustration` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `filename` text NOT NULL,
  `original_filename` text NOT NULL,
  `online` tinyint(4) NOT NULL DEFAULT '1',
  `position` bigint(20) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productillu_product` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `product_illustration`
--


-- --------------------------------------------------------

--
-- Structure de la table `product_language`
--

CREATE TABLE `product_language` (
  `product_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `introduction` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`product_id`,`language_id`),
  KEY `fk_productlang_product` (`product_id`),
  KEY `fk_productlang_language` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product_language`
--

INSERT INTO `product_language` VALUES(6, 1, 'Peyresourde', 'Lorem ipsum', 'Lorem ipsum');
INSERT INTO `product_language` VALUES(7, 1, 'Venasque', 'Lorem ipsum', 'Lorem ipsum');
INSERT INTO `product_language` VALUES(8, 1, 'Estive', 'Lorem ipsum', 'Lorem ipsum');
INSERT INTO `product_language` VALUES(9, 1, 'Etch Soulet 1', 'Etch Soulet 1', 'Etch Soulet 1');
INSERT INTO `product_language` VALUES(10, 1, 'Etch Soulet 2', 'Etch Soulet 2', 'Etch Soulet 2');

-- --------------------------------------------------------

--
-- Structure de la table `product_night_price`
--

CREATE TABLE `product_night_price` (
  `product_id` bigint(20) NOT NULL,
  `one` float NOT NULL,
  `two` float DEFAULT NULL,
  `three` float DEFAULT NULL,
  `four` float DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_productnightprice_product` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product_night_price`
--


-- --------------------------------------------------------

--
-- Structure de la table `product_season_price`
--

CREATE TABLE `product_season_price` (
  `product_id` bigint(20) NOT NULL,
  `season_type_id` bigint(20) NOT NULL,
  `week` float DEFAULT NULL,
  `midweek` float DEFAULT NULL,
  `weekend` float DEFAULT NULL,
  PRIMARY KEY (`season_type_id`,`product_id`),
  KEY `fk_proseasprice_product` (`product_id`),
  KEY `fk_proseasprice_season` (`season_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product_season_price`
--


-- --------------------------------------------------------

--
-- Structure de la table `season_type`
--

CREATE TABLE `season_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `season_type`
--


-- --------------------------------------------------------

--
-- Structure de la table `season_type_language`
--

CREATE TABLE `season_type_language` (
  `type_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `label` text NOT NULL,
  PRIMARY KEY (`type_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `season_type_language`
--


-- --------------------------------------------------------

--
-- Structure de la table `season_week`
--

CREATE TABLE `season_week` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_id` bigint(20) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `date_begining` datetime NOT NULL,
  `date_ending` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_seasonweek_seasontype` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `season_week`
--


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` VALUES(1, 'webmaster', 'abcdef');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_cms_page`
--
CREATE TABLE `view_cms_page` (
`page_id` bigint(20)
,`language_id` bigint(20)
,`title` text
,`content` text
,`url` text
,`date_add` datetime
,`date_update` datetime
,`date_delete` datetime
);
-- --------------------------------------------------------

--
-- Structure de la vue `view_cms_page`
--
DROP TABLE IF EXISTS `view_cms_page`;

CREATE ALGORITHM=UNDEFINED DEFINER=`llv`@`localhost` SQL SECURITY DEFINER VIEW `view_cms_page` AS select `cpl`.`page_id` AS `page_id`,`cpl`.`language_id` AS `language_id`,`cpl`.`title` AS `title`,`cpl`.`content` AS `content`,`cpl`.`url` AS `url`,`cp`.`date_add` AS `date_add`,`cp`.`date_update` AS `date_update`,`cp`.`date_delete` AS `date_delete` from ((`cms_page` `cp` join `cms_page_language` `cpl` on((`cp`.`id` = `cpl`.`page_id`))) join `language` `l` on((`l`.`id` = `cpl`.`language_id`)));

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk_activity_category` FOREIGN KEY (`category_id`) REFERENCES `activity_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `activity_category_language`
--
ALTER TABLE `activity_category_language`
  ADD CONSTRAINT `fk_categorylang_category` FOREIGN KEY (`category_id`) REFERENCES `activity_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_categorylang_lang` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `activity_language`
--
ALTER TABLE `activity_language`
  ADD CONSTRAINT `fk_actilang_acti` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_actilang_lang` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cms_page_language`
--
ALTER TABLE `cms_page_language`
  ADD CONSTRAINT `fk_pagecmslang_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pagecmslang_pagecms` FOREIGN KEY (`page_id`) REFERENCES `cms_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_category` FOREIGN KEY (`category_id`) REFERENCES `news_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `news_category_language`
--
ALTER TABLE `news_category_language`
  ADD CONSTRAINT `fk_newscateglang_category` FOREIGN KEY (`category_id`) REFERENCES `news_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_newscateglang_lang` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `news_illustration`
--
ALTER TABLE `news_illustration`
  ADD CONSTRAINT `fk_newsillustration_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `news_language`
--
ALTER TABLE `news_language`
  ADD CONSTRAINT `fk_newslang_lang` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_newslang_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_productcategory` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_category_goldbook`
--
ALTER TABLE `product_category_goldbook`
  ADD CONSTRAINT `fk_pcg_productcategory` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_category_language`
--
ALTER TABLE `product_category_language`
  ADD CONSTRAINT `fk_category_productcategorytrad` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_language_productcategorytrad` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_illustration`
--
ALTER TABLE `product_illustration`
  ADD CONSTRAINT `fk_productillu_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_language`
--
ALTER TABLE `product_language`
  ADD CONSTRAINT `fk_productlang_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productlang_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_night_price`
--
ALTER TABLE `product_night_price`
  ADD CONSTRAINT `fk_productnightprice_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_season_price`
--
ALTER TABLE `product_season_price`
  ADD CONSTRAINT `fk_proseasprice_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proseasprice_seasontype` FOREIGN KEY (`season_type_id`) REFERENCES `season_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
