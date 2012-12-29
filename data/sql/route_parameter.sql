CREATE  TABLE `giteluch`.`route_parameter` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `route_id` BIGINT NOT NULL ,
  `name` TEXT NOT NULL ,
  `value` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_routeparams_route` (`route_id` ASC) ,
  CONSTRAINT `fk_routeparams_route`
    FOREIGN KEY (`route_id` )
    REFERENCES `giteluch`.`route` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
