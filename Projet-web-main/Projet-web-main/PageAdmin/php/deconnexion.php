<?php
session_start();
unset($_SESSION['role']);
unset($_SESSION['connecte']);
session_destroy();
header("Location:../../pagePrincipale/php/accueil.php");
exit();

?>