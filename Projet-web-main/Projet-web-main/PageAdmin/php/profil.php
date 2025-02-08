<?php
session_start();
if(empty($_SESSION['connecte'])){
    header('Location: ../../pagePrincipale/php/connexion.php');
    exit();
}

$nbAnnonces = $_SESSION['nbAnnonces'];

if(!empty($_POST['nom']) && !empty($_POST['pass'])){
    $mail = $_SESSION['connecte'];
    $nom = $_POST['nom'];
    $mdphashed =  password_hash($_POST['pass'], PASSWORD_BCRYPT);

    $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

    $sql = $bdd->prepare("UPDATE utilisateur SET nom='$nom' WHERE mail='$mail'");
    $sql->execute();

    $sql2 = $bdd->prepare("UPDATE utilisateur SET motdepasse='$mdphashed' WHERE mail='$mail'");
    $sql2->execute();
    
    $_SESSION['nom'] = $nom;
}

function afficherInfos():string{
    $nom = $_SESSION['nom'];
    $mail = $_SESSION['connecte'];

    return '
    <div class="infosPerso">
        <div class="bloc">
            <div class="form__group field">
                <p>Nom : ' . $nom . '</p>
            </div>
        </div>
        <div class="bloc">
            <div class="form__group field">
                <p>Mail : ' . $mail . '</p>
            </div>
        </div>
    </div>
    ';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil</title>
        <link rel="stylesheet" href="../css/main1.css">
        <link rel="stylesheet" href="../css/profil.css">
    </head>
<body>
    <nav>
        <header>
                <a href="index.php"><div class="logo">CourseMoi</div></a>
                <div class="btn-ctn">
                    <button class="button-profil" id="button-profilId"><img src="../../img/menu.png" alt="menu" width="20px" height="20px"><img src="../../img/user.png" alt="user" width="20px" height="20px"></button>
                </div>
        </header>
    </nav>
    <main>
        <div id="profileId" class="profil">
            <div class="profil-content">
                <a href="index.php" class="bt-pr pr-top">Accueil</a>
                <a href="deconnexion.php" class="bt-pr pr-bottom">Déconnexion</a>
                <div class="barre"></div>
                <a href="aide.php" class="bt-pr pr-top1">Centre d'aide</a>
            </div>
        </div>
        <div class="profil-ctn">
            <div class="profil-form" id="photoProfil">
                <img src="../../img/user.png" alt="user" width="40px" height="40px">
            </div>

            <form type="file" method="post" action="uploadImage.php" id="formUpload">
                 <!-- On limite le fichier à 100Ko -->
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                Fichier : <input type="file" name="avatar">
                <input type="submit" name="envoyer" value="Envoyer le fichier">
            </form>
        </div>
        <div class="reg">
            <h1>Réglages</h1>
        </div>
        <div class="barre"></div>
        <div class="profile-ctn">
            <div class="title">
                <h2>Mon Profil</h2>
            </div>
            <?php
            echo(afficherInfos());
            ?>
            <div id="modifInfos">
                <input type="checkbox" class="checkmark" name="checkboxInversion" id="modifierInfos">
                <p>Changer mes informations</p>
            </div>
            <form method="post" id="montrerForm">
                <div class="info-ctn">
                    <div class="bloc">
                        <div class="form__group field">
                            <input type="text" class="form__field border-width" placeholder="Nom" name="nom">
                            <label for="nom" class="form__label">Nom</label>
                        </div>
                    </div>
                </div>
                <div class="info2-ctn">
                    <div class="bloc">
                        <div class="bloc">
                            <div class="form__group field">
                                <input type="password" class="form__field border-width1" placeholder="Password" name="pass">
                                <label for="password" class="form__label">New Password</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" name="miseAJourInfos" id="soumettre">Enregistrer</button>
            </form>
        </div>
        <div class="rating-ctn">
            <div class="title">
                <h2>Stats</h1>
            </div>
            <div class="rating">
                <input value="5" name="rate" id="star5" type="radio">
                <label title="text" for="star5"></label>
                <input value="4" name="rate" id="star4" type="radio">
                <label title="text" for="star4"></label>
                <input value="3" name="rate" id="star3" type="radio" checked="">
                <label title="text" for="star3"></label>
                <input value="2" name="rate" id="star2" type="radio">
                <label title="text" for="star2"></label>
                <input value="1" name="rate" id="star1" type="radio">
                <label title="text" for="star1"></label>
                <div class="rate-txt">
                    <p>Moyenne des avis:</p>
                </div>
            </div>
            <div class="txt">
                <p>Nombre d'annonces postées: <?='<label>'.$nbAnnonces.'</label>';?></p>
            </div>
        </div>
        <div class="comment-ctn">
            <div class="title">
                <h2>Commentaires</h1>
            </div>
            <div class="card">
                <div class="infos">
                  <p class="date-time">
                    2 day ago
                  </p>
                  <p class="description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur.
                  </p>
                </div>
                <div class="author">
                    — John Doe
                </div>
            </div>
            <div class="arrow-but">
                <button>
                    Commentaires
                    <div class="arrow-wrapper">
                        <div class="arrow"></div>
                    </div>
                </button>
            </div>
        </div>
    </main>
    <script src="../js/profil.js"></script>
</body>
</html>