<?php
$ip = filter_input(INPUT_POST, "ip", FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
$networkId = filter_input(INPUT_POST, "networkId", FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
$hostname = filter_input(INPUT_POST, "hostname", FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME);
$fqdn = filter_input(INPUT_POST, "fqdn", FILTER_VALIDATE_DOMAIN);
$macAddress = filter_input(INPUT_POST, "macAddress", FILTER_VALIDATE_MAC);
$comments = filter_input(INPUT_POST, "comments", FILTER_SANITIZE_STRING);
$link = filter_input(INPUT_POST, "link", FILTER_VALIDATE_URL);

if (is_null($ip)
|| is_null($networkId)) {
    header("Location: 400.php");
    exit;
}
include "connect.php";
try {
    $update = $db->prepare("
        INSERT INTO Hosts(IpAddress, NetworkId, Hostname, FQDN, MacAddress, Link, Comments)
        VALUES($ip, $networkId, :i_hostname, :i_fqdn, :i_macAddress, :i_link, :i_comments)
        ON DUPLICATE KEY UPDATE Hostname = :u_hostname, FQDN = :u_fqdn, MacAddress = :u_macAddress, Comments = :u_comments, Link = :u_link
    ");
    $update->execute([
        'i_hostname' => $hostname,
        'i_fqdn' => $fqdn,
        'i_macAddress' => $macAddress,
        'i_link' => $link,
        'i_comments' => $comments,
        'u_hostname' => $hostname,
        'u_fqdn' => $fqdn,
        'u_macAddress' => $macAddress,
        'u_link' => $link,
        'u_comments' => $comments
    ]);
}  catch(Exception $e) {
    header("Location: 500.php");
    exit;
}
?>