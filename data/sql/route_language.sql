CREATE  TABLE `giteluch`.`route_language` (
  `route_id` BIGINT NOT NULL ,
  `language_id` BIGINT NOT NULL ,
  `value` TEXT NOT NULL ,
  PRIMARY KEY (`route_id`, `language_id`) ,
  INDEX `fk_routelng_route` (`route_id` ASC) ,
  INDEX `fk_routelng_lang` (`language_id` ASC) ,
  CONSTRAINT `fk_routelng_route`
    FOREIGN KEY (`route_id` )
    REFERENCES `giteluch`.`route` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_routelng_lang`
    FOREIGN KEY (`language_id` )
    REFERENCES `giteluch`.`language` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
