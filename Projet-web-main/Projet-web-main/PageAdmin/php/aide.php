<?php
session_start();
if(empty($_SESSION['connecte'])){
    header('Location: ../../pagePrincipale/php/connexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/aide.css">
    <link rel="stylesheet" href="../css/foot.css">
</head>
<body>
    <header>
        <a href="index.php"><div class="logo">CourseMoi</div></a>
        <div class="btn-ctn">
            <button class="button-profil" id="button-profilId"><img src="../../img/menu.png" alt="menu" width="20px" height="20px"><img src="../img/user.png" alt="user" width="20px" height="20px"></button>
        </div>
    </header>
    <main>
        <div id="profileId" class="profil">
            <div class="profil-content">
                <a href="index.php" class="bt-pr pr-top">Accueil</a>
                <a href="profil.php" class="bt-pr pr-bottom">Profil</a>
                <div class="barre"></div>
                <a href="deconnexion.php" class="bt-pr pr-bottom">Déconnexion</a>
            </div>
        </div>
        <div class="mid">
            <p>Bonjour, comment pouvons-nous vous aider ?</p>
        </div>
        <h2 class="title">Guides pour démarrer</h2>
        <h2 class="title">Questions fréquentes</h2>
        <div class="question-ctn">
            <div class="ligne1">
                <a href>Modifier la date ou l'heure de la réservation</a>
                <a href>Modes de paiment acceptés</a>
                <a href>Quand vous payerez votre réservation</a>
            </div>
            <div class="ligne2">
                <a href>Annuler votre réservation</a>
            </div>
        </div>
    </main>
    <footer>
        <div id="haut">
            <div class="decouvrir">
                <h3>En Savoir Plus</h3>
                <div class="text">
                    <p>Investisseurs</p>  
                    <p>A propos</p>
                    <p>Nous rejoindre</p>
                </div>
            </div>
            <div class="mentions">
                <h3>Mentions Légales</h3>
                <div class="text">
                    <p>mentions légales</p>   
                    <p>Confidentialité</p>
                    <p>Cookies</p>
                </div>
            </div>
            <div class="aides">
                <h3>Aides</h3>
                <div class="text">
                    <p>Nous contacter</p> 
                    <p>Tutoriel</p>
                </div>
            </div>
        </div>
        <div id="bas">
            <img src="../../img/linkedin-grey.png" alt="image linkedin" class="network" onclick="location.href='https://'" width="30px" height="30px">
            <img src="../../img/instagram-grey.png" alt="image linkedin" class="network" onclick="location.href='https://'" width="30px" height="30px">
        </div>
    </footer>
    <script src="../js/aide.js"></script>
</body>
</html>