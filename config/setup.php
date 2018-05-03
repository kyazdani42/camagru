<?php
require_once "database.php";

$query = "CREATE TABLE `user` (id int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL, 
login VARCHAR(255) NOT NULL default '', 
password VARCHAR(255) NOT NULL default '', 
email VARCHAR(255) NOT NULL default '', 
`active` binary(1) NOT NULL default '0', 
`hash` VARCHAR(128));";

$query2 = "CREATE TABLE `images` (id int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
data VARCHAR(127) NOT NULL,
id_user tinyint(4) NOT NULL);";

$query3 = "CREATE TABLE `infos` (id int unsigned AUTO_INCREMENT PRIMARY KEY NOT NULL,
`type` ENUM('comment', 'like'),
`content` VARCHAR(255),
id_user tinyint(4) NOT NULL,
id_photo tinyint(4) NOT NULL);";

$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
try {
    $db->query("SELECT * FROM `user`");
    header('location: ' . URL . 'Home');
} catch (Exception $e) {
    $db->query($query);
    $db->query($query2);
    $db->query($query3);
}