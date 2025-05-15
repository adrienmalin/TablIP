<?php
$name = filter_input(INPUT_POST, "siteName", FILTER_SANITIZE_STRING);
$gateway = ip2long(filter_input(INPUT_POST, "gateway", FILTER_VALIDATE_IP));
$mask = ip2long(filter_input(INPUT_POST, "mask", FILTER_VALIDATE_IP));
$siteId = filter_input(INPUT_POST, "siteId", FILTER_VALIDATE_INT);
if (!($name && $gateway && $mask && $siteId)) {
    /*header("Location: 400.php");
    exit;*/
    include "400.php";
    die();
}
$networkAddress = $gateway & $mask;
include "connect.php";
try {
    $insert = $db->prepare("INSERT INTO Networks(Name, Address, Mask, SiteId) VALUES(:name, $networkAddress, $mask, $siteId)");
    $insert->execute(['name' => $_POST['name']]);
    $networkId = $db->lastInsertId();
    $insert = $db->exec("INSERT INTO Hosts(IPAddress, NetworkId, Comments) VALUES($gateway, $networkId, 'Passerelle')");
    header("Location: network.php?networkId=$networkId");
} catch (Exception $e) {
    header("Location: 500.php");
    exit;
}
