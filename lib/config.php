<?php
/**
    CREATE TABLE `tuguldur`.`students` 
    ( `id` INT NOT NULL AUTO_INCREMENT ,  
      `st_code` VARCHAR(10) NOT NULL , 
      `st_name` VARCHAR(50) NOT NULL , 
      `st_huis` BOOLEAN NOT NULL ,  
      `st_nas` INT NOT NULL ,  
      `st_phone_number` INT NOT NULL ,  
      `st_address` TEXT NOT NULL ,  
      `password` VARCHAR(255) NOT NULL ,    
      PRIMARY KEY  (`id`),    
      UNIQUE  (`st_code`)) ENGINE = InnoDB;
*/
define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "tuguldur");

$connect = new mysqli(HOST,USERNAME,PASSWORD,DATABASE);
// Check connection
if ($connect -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}