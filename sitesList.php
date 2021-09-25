<html>
    <head>
        <title>TablIP</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <h1>TablIP</h1>
        </header>
        <ul>

<?php
include "connect.php";
$sites = $db->query('SELECT Name FROM Site ORDER BY Name');
while ($site = $sites->fetch())
{
    echo "        <li><a href='.?site=${site['Name']}'>${site['Name']}</a></li>\n";
}
$sites->closeCursor();
?>

        </ul>
        <form name="addSite" id="addSite" action="addSite.php" method="post">
            <fieldset class="add">
                <legend>Ajouter un site</legend>
                <label for="siteName">Nom</label>
                <input type="text" id="siteName" name="siteName" required/>
                <button type="submit">Ajouter</button>
            </fieldset>
        </form>
    </body>
</html>