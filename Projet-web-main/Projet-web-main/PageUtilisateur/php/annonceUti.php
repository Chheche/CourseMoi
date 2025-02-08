<?php
session_start();
if(empty($_SESSION['connecte'])){
    header('Location: ../../pagePrincipale/php/connexion.php');
    exit();
}

if(!empty($_SESSION['ville']) && !empty($_SESSION['etablissement']) && !empty($_SESSION['description']) && !empty($_SESSION['telephone']) && !empty($_SESSION['mail'])){
    $ville = $_SESSION['ville'];
    $etablissement = $_SESSION['etablissement'];
    $descr = $_SESSION['description'];
    $places = $_SESSION['places'];
    $telephone = $_SESSION['telephone'];
    $mail = $_SESSION['mail'];
    $valueMail = "Voir le Mail";
    $valueNumero = "Voir le Numéro";
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    global $bdd;
    $statement = $bdd->prepare("SELECT * FROM annonce WHERE id = :n");
    $statement->execute(["n" => $id]);
    $resultat = $statement->fetchAll();
    if(count($resultat) == 1){
        $annonce = $resultat[0];
        $ville = $annonce['ville'];
        $etablissement = $annonce['etablissement'];
        $description = $annonce['description'];
        $nombrePlaces = intval($annonce['place']);
        $telephone = $annonce['telephone'];
        $mail = $annonce['mail'];
    }
}

if (isset($_POST['boutMail'])) {
    $valueMail = $mail;
}

if (isset($_POST['boutNum'])) {
    $valueNumero = $telephone;
}

if(isset($_POST['ajoutPassager'])) {
    if(intval($places)>0){
        $places = intval($places)-1;
        $nombrePlaces = intval($places);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/head.css">
    <link rel="stylesheet" href="../css/main1.css">
    <link rel="stylesheet" href="../css/main2.css">
    <link rel="stylesheet" href="../css/foot.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>CourseMoi</title>
</head>
<body>
    <header>
        <nav id="desktop-nav">
            <div class="logo" onclick="reloadPage()">CourseMoi</div>
            <div class="btn-ctn">
                <button class="button-profil" id="button-profil"><img src="../../img/menu.png" alt="menu" width="20px" height="20px"><img src="../../img/user.png" alt="user" width="20px" height="20px"></button>
            </div>
        </nav>
    </header>
    <body>
    <div id="profileModal" class="profil">
            <div class="profil-content">
                <a href="indexUti.php" class="bt-pr pr-top">Accueil</a>
                <a href="profil.php" class="bt-pr pr-mid">Profil</a>
                <div class="barre"></div>
                <a href="aide.php" class="bt-pr pr-top1">Centre d'aide</a>
            </div>
        </div>
        <div id="annonceUti">
            <div class="infos">
                <div class="photo"></div>
                <div class="description">
                    <h1>Détails</h1>
                    <div class="lieu">
                        <?='<h2 name="ville">'.$etablissement.' - '.$ville.'</h2>';?>
                    </div>
                    <h2>Description</h2>
                    <form method="post">
                        <?='<label>'.$descr.'</label>';?></br>
                        <?='<h3>Il reste '.$places.' places</h3>'?>
                        <button id="ajoutPassager" name="ajoutPassager" type="submit">Ajouter un passager</button>
                    </form>
                </div>
            </div>
            <div class="annonceur">
                <h2>Nom Utilisateur</h2>
                <form method="post">
                    <button id="boutMail" name="boutMail" type="submit">
                        <?='<label>'.$valueMail.'</label>';?>
                    </button>
                    <button id="boutNum" name="boutNum" type="submit">
                        <?='<label>'.$valueNumero.'</label>';?>
                    </button>
                </form>
            </div>
        </div>
        <script src="../js/indexAnUti.js"></script>
    </body>
</html>