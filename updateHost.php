<?php
if (!(isset($_POST["Ip"])
&& isset($_POST["NetworkId"])
&& isset($_POST["Hostname"])
&& isset($_POST["FQDN"])
&& isset($_POST["MacAddress"])
&& isset($_POST["Comments"]))) {
    header("HTTP/1.x 400 Bad Request");
    die();
}

$ip = (int) $_POST["Ip"];
$networkId = (int) $_POST["NetworkId"];

try {
    include "connect.php";
    $update = $db->prepare("
        INSERT INTO Hosts(IpAddress, NetworkId, Hostname, FQDN, MacAddress, Comments)
        VALUES($ip, $networkId, :i_hostname, :i_fqdn, :i_macAddress, :i_comments)
        ON DUPLICATE KEY UPDATE Hostname = :u_hostname, FQDN = :u_fqdn, MacAddress = :u_macAddress, Comments = :u_comments
    ");
    $update->execute([
        'i_hostname' => $_POST["Hostname"],
        'i_fqdn' => $_POST["FQDN"],
        'i_macAddress' => $_POST["MacAddress"],
        'i_comments' => $_POST["Comments"],
        'u_hostname' => $_POST["Hostname"],
        'u_fqdn' => $_POST["FQDN"],
        'u_macAddress' => $_POST["MacAddress"],
        'u_comments' => $_POST["Comments"]
    ]);
}  catch(Exception $e) {
    header("HTTP/1.x 500 " . $e->getMessage());
    die($e->getMessage());
}
?>