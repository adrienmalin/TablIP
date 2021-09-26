<html>
    <head>
        <title>TablIP - Sites</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/icons.css"/>
        <link rel="stylesheet" href="css/materialize.css"/>
        <script type="text/javascript" src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <script type="text/javascript" src="js/materialize.js"></script>
        <header>
            <nav class="nav-wrapper navbar-fixed teal lighten-2">
                <a class="breadcrumb">TablIP</a>
            </nav>
        </header>
        <div class="container">
            <div id="linksCard" class="card">
                <div class="collection with-header">
                    <div class="collection-header"><h4>Sites</h4></div>
<?php
include "connect.php";
foreach ($db->query("SELECT * FROM `Sites` ORDER BY `Name`") as $site) {
    print "            </li><a href='site.php?id=${site['id']}' class='collection-item'>${site['Name']}</a>\n";
}
?>
                </div>
                <button id="addButton" type="button" class="btn-floating halfway-fab waves-effect waves-light teal scale-transition" onclick="showCard(addCard, this)"><i class="material-icons">add</i></button>
            </div>
            <div id="addCard" class="card teal lighten-5 scale-transition scale-out">
                <div class="card-content">
                    <span class="card-title">Nouveau site</span>
                    <form name="addSite" id="addSite" action="addSite.php" method="post">
                        <div class="input-field">
                            <label for="siteName">Nom</label>
                            <input type="text" class="validate" id="siteName" name="siteName" placeholder="Site" required/>
                        </div>
                        <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                            <i class="material-icons right">add</i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>