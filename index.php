<?php include "connect.php"; ?>
<html>
    <head>
        <title>TablIP</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/icons.css"/>
        <link rel="stylesheet" href="css/materialize.css"/>
        <script type="text/javascript" src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <script type="text/javascript" src="js/materialize.js"></script>
<?php
if (isset($_GET["site"])) {
    include "siteNetworks.php";
} else {
    include "sitesList.php";
}
?>
    </body>
</html>