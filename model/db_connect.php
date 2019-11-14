<?php


$dsn = 'mysql:host=localhost;dbname=udp';

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
try {

    $db = new PDO($dsn, "root", "", $pdoOptions);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    exit();
}
?>
