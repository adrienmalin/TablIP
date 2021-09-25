<?php
if (!(isset($_POST['name'])
&& isset($_POST['gateway'])
&& isset($_POST['mask'])
&& isset($_POST['siteId'])
&& isset($_POST['siteName']))) {
    die("Erreur : données manquantes !<br/><a href='javascript:history.back(1);'>Revenir en arrière</a>");
}

$siteId = (int) $_POST['siteId'];
$gateway = ip2long($_POST['gateway']);
$mask = ip2long($_POST['mask']);
$networkAddress = $gateway & $mask;

include "connect.php";
try {
    $insert = $db->prepare("INSERT INTO Networks(Name, Address, Mask, SiteId) VALUES(:name, $networkAddress, $mask, $siteId)");
    $insert->execute(['name' => $_POST['name']]);
    $networkId = $db->lastInsertId();
    $insert = $db->exec("INSERT INTO Hosts(IPAddress, NetworkId, Comments) VALUES($gateway, $networkId, 'Passerelle')");

    header("Location: .?site=${_POST['siteName']}");
} catch(Exception $e) {
    echo($e->getMessage() . "<br/><a href='javascript:history.back(1);'>Revenir en arrière</a>");
}
exit;
?>
