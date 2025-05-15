<?php
$siteId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$siteId) {
    header("Location: 400.php");
    exit;
}
include "connect.php";
$site = $db->query("SELECT Name from `Sites` WHERE `id`=$siteId")->fetch();
$siteName = $site["Name"];
if (!$siteName) {
    header("Location: 404.php");
    exit;
}
?>
<html>
    <head>
        <title>TablIP - <?=$siteName?></title>
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
                    <a class="breadcrumb"><?=$siteName?></a>
                </div>
            </nav>
        </header>
        <div class="container">
            <div id="linksCard" class="card">
                <div class="collection with-header">
                    <div class="collection-header teal lighten-3 white-text"><h5><?=$siteName?></h5></div>
<?php
include "connect.php";
foreach ($db->query("SELECT * FROM `Networks` WHERE `SiteId` = $siteId ORDER BY `Address`") as $network) {
    print "            <a href='network.php?id=${network['id']}' class='collection-item'>".$network['Name']." @ ".long2ip($network['Address'])." / ".long2ip($network['Mask'])."</a>\n";
}
?>
                </div>
                <button id="addButton" type="button" class="btn-floating halfway-fab waves-effect waves-light teal scale-transition" onclick="showCard(addCard, this)"><i class="material-icons">add</i></button>
            </div>
            <div id="addCard" class="card teal scale-transition scale-out">
                <form name="addNetwork" id="addNetwork" class="card-content" action="addNetwork.php" method="post">
                    <span class="card-title">Nouveau réseau</span>
                    <input type="hidden" name="siteId" value="<?=$siteId?>"/>
                    <div class="input-field">
                        <label for="nameInput">Nom</label>
                        <input type="text" class="validate" id="nameInput" name="name" placeholder="LAN" required/>
                    </div>
                    <div class="input-field">
                        <label for="gatewayInput">Passerelle</label>
                        <input type="text" class="validate" id="gatewayInput" name="gateway" placeholder="192.168.0.1" pattern="^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" title="XXX.XXX.XXX.XXX"/>
                    </div>
                    <div class="input-field">
                        <label for="maskInput">Masque</label>
                        <input type="text" class="validate" id="maskInput" name="mask" placeholder="255.255.255.0" pattern="^(255\.255\.(248|252|255)\.0|255\.255\.255\.(0|128|192|224|240|248|252|255))$" title="Plus grand masque autorisé : 255.255.248.0"/>
                    </div>
                    <div class="card-action right-align">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                            <i class="material-icons right">add</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

