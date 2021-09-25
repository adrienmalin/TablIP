<?php
if (!isset($_POST['siteName'])) {
    die("Nom du site manquant !<br/><a href='javascript:history.back(1);'>Revenir en arrière</a>");
}
include "connect.php";
try {
    $insert = $db->prepare("INSERT INTO Sites(Name) VALUES(:name)");
    $insert->execute(['name' => $_POST['siteName']]);
    header("Location: .?site=${_POST['siteName']}");
    exit;
} catch(Exception $e) {
    echo($e->getMessage() . "<br/><a href='javascript:history.back(1);'>Revenir en arrière</a>");
}
?>