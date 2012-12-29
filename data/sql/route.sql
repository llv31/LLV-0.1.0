CREATE  TABLE `giteluch`.`route` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `name` TEXT NOT NULL ,
  `rule` TEXT NOT NULL ,
  `controller` TEXT NOT NULL ,
  `action` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
