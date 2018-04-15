<?php

$DB_DSN = "mysql:dbname=db_mycamagru;host=192.168.99.100;port=3306";
$DB_USER = "root";
$DB_PASSWORD = "superpassword";
try {
    $data = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion failed: ' . $e->getMessage();
}

?>
