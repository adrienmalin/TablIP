<?php
$MAX_LINES = 2500;

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

        <header>
            <nav>
                <div class="nav-wrapper navbar-fixed cyan lighten-2">
                    <a href="." class="brand-logo center">TablIP</a>
                    <div>
                        <a href="." class="breadcrumb">Sites</a>
                        <a href=".?Site=<?=$siteName?>" class="breadcrumb"><?=$siteName?></a>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <h1><?=$siteName?></h1>

<?php
$networks = $db->query("SELECT * FROM `Networks` WHERE `SiteId` = $siteId");
while ($network = $networks->fetch())
{
    $networkId = $network["id"];
    $networkAddress = (int) $network["Address"];
    $networkMask = (int) $network["Mask"];
?>
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><?=$network['Name']." @ ".long2ip($networkAddress)." / ".long2ip($networkMask)?></span>
                    <table class="striped responsive-table">
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
                                    <td class="td-input"><input type="text" onchange="updateHost(this)" name='Hostname' value="<?=$host["Hostname"]?>"/></td>
                                    <td class="td-input"><input type="text" onchange="updateHost(this)" name='FQDN' value="<?=$host["FQDN"]?>"/></td>
                                    <td class="td-input"><input type="text" onchange="updateHost(this)" name='MacAddress' value="<?=$host["MacAddress"]?>"/></td>
                                    <td class="td-input"><input type="text" onchange="updateHost(this)" name='Comments' value="<?=$host["Comments"]?>"/></td>
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
                </div>
            </div>
<?php
}
$networks->closeCursor();
?>

            <div class="card teal lighten-5">
                <div class="card-content">
                    <span class="card-title">Nouveau réseau</span>
                    <form name="addNetwork" id="addNetwork" action="addNetwork.php" method="post">
                        <input type="hidden" name="siteId" value="<?=$siteId?>"/>
                        <input type="hidden" name="siteName" value="<?=$siteName?>"/>
                        <div class="input-field">
                            <label for="nameInput">Nom</label>
                            <input type="text" class="validate" id="nameInput" name="name" placeholder="LAN" required/>
                        </div>
                        <div class="input-field">
                            <label for="gatewayInput">Passerelle</label>
                            <input type="text" class="validate" id="gatewayInput" name="gateway" placeholder="192.168.0.1" pattern="^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$"/>
                        </div>
                        <div class="input-field">
                            <label for="maskInput">Masque</label>
                            <input type="text" class="validate" id="maskInput" name="mask" placeholder="255.255.255.0" pattern="^((0|128|192|224|240|248|252|255)\.0\.0.0|255\.(0|128|192|224|240|248|252|255)\.0\.0|255\.255\.(0|128|192|224|240|248|252|255)\.0|255\.255\.255\.(0|128|192|224|240|248|252|255))$"'/>
                        </div>
                        <button type="submit" class="btn-floating halfway-fab waves-effect waves-light teal"><i class="material-icons">add</i></button>
                    </form>
                </div>
            </div>
        </div>



