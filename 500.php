<?php
header("HTTP/1.1 500 Internal Server Error");
?>
<html>
    <head>
        <title>TablIP - Erreur</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/icons.css"/>
        <link rel="stylesheet" href="css/materialize.css"/>
        <script type="text/javascript" src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <script type="text/javascript" src="js/materialize.js"></script>
        <header>
            <nav>
                <div class="nav-wrapper navbar-fixed teal lighten-2">
                    <a href="." class="brand-logo center">TablIP</a>
                    <div>
                        <a href="." class="breadcrumb">Sites</a>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <h1>Erreur</h1>
            <p>Problème côté serveur</p>
            <a class="waves-effect waves-light btn" href='javascript:history.back(1);'><i class="material-icons left">arrow_back</i>Retour</a>
        </div>
    </body>
</html>