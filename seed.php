<?php
require 'bootstrap.php';
// Өгөгдлийн бааз дээр Student хүснэгтийг (id, st_code, st_name, st_huis, st_nas, st_phone_number, st_ address) гэсэн талбартай үүсгэ.
$statement = <<<EOS
    CREATE TABLE IF NOT EXISTS `students` (
        `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `st_code` varchar(10) NOT NULL UNIQUE KEY `st_code` (`st_code`),
        `st_name` varchar(255) NOT NULL,
        `st_huis` tinyint(1) DEFAULT NULL,
        `st_nas` int(11) NOT NULL,
        `st_phone_number` int(11) DEFAULT NULL,
        `st_address` text DEFAULT NULL,
        `st_password` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    INSERT INTO students
        (id, st_code, st_name, st_huis, st_nas, st_phone_number, st_ address,st_password)
    VALUES
       (1, 'B170910005', 'Tuguldur', 1, 20, 99557323, 'Address','password'),
       (2, 'B170910001', 'Name - 2', 1, 20, 99000000, 'Address','password'),
       (3, 'B170910002', 'Name - 3', 1, 20, 99000000, 'Address','password'),
       (4, 'B170910003', 'Name - 4', 0, 20, 99000000, 'Address','password'),
       (5, 'B170910004', 'Name - 5', 1, 20, 99000000, 'Address','password'),
       (6, 'B170910006', 'Name - 6', 1, 20, 99000000, 'Address','password'),
       (7, 'B170910007', 'Name - 7', 1, 20, 99000000, 'Address','password'),
       (8, 'B170910008', 'Name - 8', 0, 20, 99000000, 'Address','password'),
       (9, 'B170910009', 'Name - 9', 1, 20, 99000000, 'Address','password'),
       (10, 'B170910010', 'Name - 10', 1, 20, 99000000, 'Address','password');
EOS;

try {
    $createTable = $dbConnection->exec($statement);
    echo "Success!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}