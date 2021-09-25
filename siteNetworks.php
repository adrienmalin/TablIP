<?php
$MAX_LINES = 2500;

include "connect.php";
$siteName = $_GET["site"];
// Check if site is known
$site = $db->prepare('SELECT id from Sites WHERE Name=:siteName');
$site->execute(['siteName' => $siteName]);
$siteId = $site->fetch()["id"];
if (!$siteId) {
    header("HTTP/1.1 404 Not Found");
    die("Erreur ! Site inconnu : ${_GET["site"]}<br/><a href=".">Accueil</a>");
}
?>

<html>
    <head>
        <title>TablIP - <?=$siteName?></title>
        <link rel="stylesheet" href="style.css"/>
        <script src="script.js"></script>
    </head>
    <body>
        <header>
            <h1>TablIP</h1>
            <h2><?=$siteName?></h2>
        </header>

<?php
$networks = $db->query("SELECT * FROM `Networks` WHERE `SiteId` = $siteId");
while ($network = $networks->fetch())
{
    $networkId = $network["id"];
    $networkAddress = (int) $network["Address"];
    $networkMask = (int) $network["Mask"];
?>
        <table style="width:100%">
            <caption><?=$network['Name']." : ".long2ip($networkAddress)." / ".long2ip($networkMask)?><caption>
            <thead>
                <tr>
                    <th>Adresse IP</th>
                    <th>Nom d'hôte</th>
                    <th>FQDN</th>
                    <th>Adresse MAC</th>
                    <th>Commentaires</th>
                <tr>
                    <td><em><?= long2ip($networkAddress)?></em></td>
                    <td colspan="4"><em>Adresse réseau</em></td>
                </tr>
                </tr>
            </thead>
            <tbody>
<?php
    for ($ip = $networkAddress + 1; ($ip+1 & $networkMask) == $networkAddress && $ip < $networkAddress + $MAX_LINES; $ip++ ) {
        $hosts = $db->query("SELECT * from `Hosts` WHERE IPAddress=$ip AND NetworkId=$networkId");
        $host = $hosts->fetch();
?>
                <tr>
                    <form>
                        <input type="hidden" name="Ip" value=<?=$ip?>/>
                        <input type="hidden" name="NetworkId" value=<?=$networkId?>/>
                        <td><?=long2ip($ip)?></td>
                        <td><input type="text" onchange="updateHost(this)" name='Hostname' value="<?=$host["Hostname"]?>"/></td>
                        <td><input type="text" onchange="updateHost(this)" name='FQDN' value="<?=$host["FQDN"]?>"/></td>
                        <td><input type="text" onchange="updateHost(this)" name='MacAddress' value="<?=$host["MacAddress"]?>"/></td>
                        <td><input type="text" onchange="updateHost(this)" name='Comments' value="<?=$host["Comments"]?>"/></td>
                    </form>
                </tr>
<?php
    }
?>                  
                </tbody>
                <tfoot>
                    <tr>
                        <td><em><?= long2ip($ip)?></em></td>
                        <td colspan="4"><em>Adresse de diffusion</em></td>
                    </tr>
                </tfoot>
        </table>
<?php
}
$networks->closeCursor();
?>

        <form name="addNetwork" id="addNetwork" action="addNetwork.php" method="post">
            <fieldset class="add">
                <legend>Ajouter un réseau</legend>
                <label for="nameInput">Nom</label>
                <input type="text" id="nameInput" name="name" required/>
                <label for="gatewayInput">Passerelle</label>
                <input type="text" id="gatewayInput" name="gateway" pattern="^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$"/>
                <label for="maskInput">Masque</label>
                <input type="text" id="maskInput" name="mask" pattern="^((0|128|192|224|240|248|252|255)\.0\.0.0|255\.(0|128|192|224|240|248|252|255)\.0\.0|255\.255\.(0|128|192|224|240|248|252|255)\.0|255\.255\.255\.(0|128|192|224|240|248|252|255))$"'/>
                <input type="hidden" name="siteId" value="<?=$siteId?>"/>
                <input type="hidden" name="siteName" value="<?=$siteName?>"/>
                <button id="addButton" type="submit">Ajouter</button>
            </fieldset>
        </form>

        <footer>
            <a href=".">Accueil</a>
        </footer>
    </body>
</html>