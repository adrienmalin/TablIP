<?php
header("HTTP/1.1 400 Bad Request");
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
            <nav class="nav-wrapper navbar-fixed teal lighten-2">
                <div class="container">
                    <a href="." class="breadcrumb">TablIP</a>
                </div>
            </nav>
        </header>
        <div class="container">
            <h4>Erreur</h4>
            <p>Données requises non reçues</p>
            <a class="waves-effect waves-light btn" href='javascript:history.back(1);'><i class="material-icons left">arrow_back</i>Retour</a>
        </div>
    </body>
</html>