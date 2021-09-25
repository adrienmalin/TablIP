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
            <h1>Sites</h1>
            <div class="collection">

<?php
include "connect.php";
$sites = $db->query('SELECT Name FROM Sites ORDER BY Name');
while ($site = $sites->fetch())
{
    echo "            <a href='.?site=${site['Name']}' class='collection-item'>${site['Name']}</a>\n";
}
$sites->closeCursor();
?>

            </div>
            <div class="card teal lighten-5">
                <div class="card-content">
                    <span class="card-title">Nouveau site</span>
                    <form name="addSite" id="addSite" action="addSite.php" method="post">
                        <div class="input-field">
                            <label for="siteName">Nom</label>
                            <input type="text" class="validate" id="siteName" name="siteName" placeholder="Site" required/>
                        </div>
                        <button type="submit" class="btn-floating halfway-fab waves-effect waves-light teal"><i class="material-icons">add</i></button>
                    </form>
                </div>
            </div>
        </div>