<?php
$siteName = filter_input(INPUT_POST, "siteName", FILTER_SANITIZE_STRING);
if (!$siteName) {
    /*header("Location: 400.php");
    exit;*/
    include "400.php";
    die();
}
include "connect.php";
try {
    $insert = $db->prepare("INSERT INTO Sites(Name) VALUES(:name)");
    $insert->execute(['name' => $siteName]);
    $siteId = $db->lastInsertId();
    header("Location: site.php?id=$siteId");
} catch(Exception $e) {
    header("Location: 500.php");
    exit;
}
?>