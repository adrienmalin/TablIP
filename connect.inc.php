<?php
// Fill with your database login informations and rename file to connect.php 
$DB_HOST = "localhost";
$DB_NAME = "TableIP";
$DB_USER = "user";
$DB_PASSWORD = "password";
    
try {
    $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    header("Location: 500.php");
}
?>