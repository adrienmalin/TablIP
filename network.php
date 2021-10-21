<?php
$networkId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$networkId) {
    header("Location: 400.php");
    exit;
}
include "connect.php";
$network = $db->query("SELECT * from `Networks` WHERE id=$networkId")->fetch();
$networkName = $network["Name"];
if (!$networkName) {
    header("Location: 404.php");
    exit;
}
$networkAddress = $network["Address"];
$networkAddressStr = long2ip($networkAddress);
$networkMask = $network["Mask"];
$networkMaskStr = long2ip($networkMask);
$siteId = $network["SiteId"];
$site = $db->query("SELECT Name from `Sites` WHERE id=$siteId")->fetch();
$siteName = $site["Name"];
if (!$siteName) {
    header("Location: 404.php");
    exit;
}
?>
<html>
    <head>
        <title>TablIP - <?=$networkName?></title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/icons.css"/>
        <link rel="stylesheet" href="css/materialize.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <header>
            <nav class="nav-wrapper navbar-fixed teal lighten-2">
                <div class="container">
                    <a href="." class="breadcrumb">TablIP</a>
                    <a href="site.php?id=<?=$siteId?>" class="breadcrumb"><?=$siteName?></a>
                    <a class="breadcrumb"><?=$networkName?></a>
                </div>
            </nav>
        </header>
        <div class="container">
            <div class="card">
                <div class="card-content">
                    <h5><?=$networkName?></h5>
                    <p>@ <?=$networkAddressStr?> / <?=$networkMaskStr?></p>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Adresse IP</th>
                                <th>Nom d'hôte</th>
                                <th>FQDN</th>
                                <th>Adresse MAC</th>
                                <th>Commentaires</th>
                                <th>Lien</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td-input"><input type="text" name='ip' value="<?=$networkAddressStr?>" disabled/></td>
                                <td class="td-input" colspan="5"><input type="text" value="Adresse réseau" disabled/></td>
                            </tr>
<?php
    for ($ip = $networkAddress + 1; ($ip+1 & $networkMask) == $networkAddress; $ip++ ) {
        $host = $db->query("SELECT * from `Hosts` WHERE IPAddress=$ip AND NetworkId=$networkId")->fetch();
?>
                            <tr>
                                <form>
                                    <input type="hidden" name="ip" value="<?=$ip?>"/>
                                    <input type="hidden" name="networkId" value="<?=$networkId?>"/>
                                    <td class="td-input"><input type="text" value="<?=long2ip($ip)?>" disabled/></td>
                                    <td class="td-input"><input type="text" onchange="updateHost(this)" name="hostname" pattern="^[A-Za-z0-9_-]*$" value="<?=$host["Hostname"]?>"/></td>
                                    <td class="td-input"><input type="text" onchange="updateHost(this)" name="fqdn" pattern="^[a-zA-Z0-9._-]*$" value="<?=$host["FQDN"]?>"/></td>
                                    <td class="td-input"><input type="text" onchange="updateHost(this)" name="macAddress" pattern="^([a-fA-F0-9]{2}[:-]{1}){5}[a-fA-F0-9]{2}$" title="XX:XX:XX:XX:XX:XX" value="<?=$host["MacAddress"]?>"/></td>
                                    <td class="td-input"><input type="text" onchange="updateHost(this)" name="comments" value="<?=$host["Comments"]?>"/></td>
                                    <td class="td-input"><input type="url" onchange="updateHost(this)" name="link" value="<?=$host["Link"]?>"/></td>
                                    <td><a href="<?=$host["Link"]?>" target="_blank"><i class="material-icons">launch</i></a></td>
                                </form>
                            </tr>
<?php
    }
?>                  
                            <tr>
                                <td class="td-input"><input type="text" name='ip' value="<?=long2ip($ip)?>" disabled/></td>
                                <td class="td-input" colspan="5"><input type="text" value="Adresse de diffusion" disabled/></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
