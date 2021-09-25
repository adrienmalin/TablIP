<?php
if (isset($_GET["site"])) {
    include "siteNetworks.php";
} else {
    include "sitesList.php";
}
?>