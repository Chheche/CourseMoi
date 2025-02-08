<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location:../../pagePrincipale/php/connexion.php");
    exit();
}


if(!empty($_SESSION['nom']) && !empty($_SESSION['connecte'])){
    $nom = $_SESSION['nom'];
    $nbAnnonces = $_SESSION['nbAnnonces'];
    $mailUti = $_SESSION['connecte'];
}

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

function ajouterAnnonce($ville, $etablissement, $description, $telephone, $place): void
{
    global $bdd;
    $sql = $bdd->prepare('INSERT INTO annonce(ville, etablissement, description, telephone, place, mail) VALUES (:ville, :etablissement, :description, :telephone, :place, :mail)');
    $sql->execute([
        'ville' => $ville,
        'etablissement' => $etablissement,
        'description' => $description,
        'telephone' => $telephone,
        'place' => $place,
        'mail' => $_SESSION['connecte']
    ]);
}

if (isset($_POST['submit-add'])) {
    if (!empty($_POST['ville']) && !empty($_POST['etablissement']) && !empty($_POST['description']) && !empty($_POST['telephone'])) {
        $ville = $_POST['ville'];
        $etablissement = $_POST['etablissement'];
        $description = $_POST['description'];
        $telephone = $_POST['telephone'];
        $place = $_POST['place'];
        $nbAnnonces = intval($nbAnnonces)+1;
        $_SESSION['nbAnnonces'] = $nbAnnonces;

        ajouterAnnonce($ville, $etablissement, $description, $telephone, $place);
    }
}

function recupererAnnonces($triInverse = false): array
{
    global $bdd;
    supprimerAnnoncesExpirées(); 
    $sqlRequete = 'SELECT * FROM annonce';
    if ($triInverse) {
        $sqlRequete .= ' ORDER BY id DESC';
    }
    $resultats = $bdd->query($sqlRequete)->fetchAll(PDO::FETCH_ASSOC);
    return $resultats;
}

function ajouter($annonce): string
{
    $id = $annonce['id'];

    $nombrePlaces = intval($annonce['place']);
    $img = '';

    for ($i = 0; $i < $nombrePlaces; $i++) {
        $img .= '<img src="../../img/body.png" alt="people" witdh="30px" height="30px">';
    }

    return '
    <form class="completerAnnonce" method="post">
        <div class="annonce" id="annonce_' . $annonce['id'] . '">
            <button class="suppression" data-id="' . $annonce['id'] . '"><img src="../../img/croix.png" alt="suppression" width="20px" height="20px"></button>
            <input type="text" name="id" value="'.$id.'" hidden>
            
            <div class="top-annonce">
                <p>Places: 0/' . $annonce['place'] . '</p>
                <div class="people">
                    ' . $img . '
                </div>
            </div>
            <div class="com">
                <div class="com-head">
                    <p>' . $annonce['ville'] . '</p>
                    <p>' . $annonce['etablissement'] . '</p>
                </div>
                <div class="com-main">
                    <p>' . $annonce['description'] . '</p>
                </div>
            </div>
            <button class="addition" id="addition" name="addition" type="submit"><img src="../../img/addition.png" alt="addition" width="20px" height="20px"></button>
        </div>
    </form>';
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
    
    /* mettre ds les cookies */
    $_SESSION['ville'] = $ville;
    $_SESSION['etablissement'] = $etablissement;
    $_SESSION['description'] = $description;
    $_SESSION['places'] = $nombrePlaces;
    $_SESSION['telephone'] = $telephone;
    $_SESSION['mail'] = $mail;

    header('Location: annonce.php');
    exit();
}

$triInverse = isset($_POST['checkboxInversion']);

$annonces = recupererAnnonces($triInverse);

/*Rajouter admin ds bdd*/ 

if(!empty($_POST['mail']) && !empty($_POST['motpasse'])){
    $mail = $_POST['mail'];
    $motpasshash = password_hash($_POST['motpasse'], PASSWORD_BCRYPT);
    $nom = 'admin';

    global $bdd;
    $sql = $bdd->prepare('INSERT INTO administrateur(mail, motdepasse, nom) VALUES (:mail, :motdepasse, :nom)');
    $sql->execute([
        'mail' => $mail,
        'motdepasse' => $motpasshash,
        'nom' => $nom
    ]);
}

function supprimerAnnoncesExpirées() {
    global $bdd;
    $delaiExpiration = 35 * 3600;
    $dateExpiration = time() - $delaiExpiration;
    $sql = $bdd->prepare('DELETE FROM annonce WHERE UNIX_TIMESTAMP(timer) < :dateExpiration');
    $sql->execute(['dateExpiration' => $dateExpiration]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/head.css">
    <link rel="stylesheet" href="../css/main1.css">
    <link rel="stylesheet" href="../css/foot.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>CourseMoi</title>
</head>
<body>
    <header>
        <nav id = "desktop-nav">
            <div class="logo" onclick="reloadPage()">CourseMoi</div>
            <div class="navigation">
                <ul class = "nav-links">
                    <button id="admin" class="button-ads">Admin</button>
                    <button id="delete" class="button-pro">Supprimer</button>
                </ul>
            </div>
            <div class="btn-ctn">
                <button class="button-add" id="button-add">Mettre mon annonce en ligne</button>
                <button class="button-profil" id="button-profil"><img src="../../img/menu.png" alt="menu" width="20px" height="20px"><img src="../img/user.png" alt="user" width="20px" height="20px"></button>
            </div>
        </nav>
    </header>
    <main>
        <div class="info">
            <button class="setting-btn" id="filtreCtn">
                <div>
                    <span class="bar bar1"></span>
                    <span class="bar bar2"></span>
                    <span class="bar bar1"></span>
                </div>
                <span class="filter-text">Filtres</span>
            </button>
        </div>
        <form id="modal2" class="modal" method="post">
            <div class="modal-content2">
                <div class="modal-head">
                    <img class="sup" id="supprimer2" src="../../img/croix.png" alt="supprimer" width="30px" height="30px">
                    <div class="modal-title2">
                        <p>Ajout Admin</p>
                    </div>
                </div>
                <div class="modal-main">
                    <div class="box-ligne2">
                        <label class="input-color">Mail</label>
                        <br>
                        <input type="text" class="form-input taille2" name="mail" required>
                    </div>
                    <div class="box-ligne3">
                        <label class="input-color">Mot de passe</label>
                        <br>
                        <input type="text" class="form-input taille2" name="motpasse" required>
                    </div>
                    <button class="enr-but enr-pos1 enr-top" type="submit" name="submit-modal" id="enregistrer">Enregistrer</button>
                </div>
            </div>
        </form>
        <div id="modal" class="modal">
            <div class="modal-content">
                <div class="modal-head">
                    <img class="sup" id="supprimer" src="../../img/croix.png" alt="supprimer" width="30px" height="30px">
                    <div class="modal-title">
                        <p>Filtres</p>
                    </div>
                </div>
                <div class="modal-main">
                    <label for="checkboxInversion" class="check-container check-top">
                        <input type="checkbox" name="checkboxInversion" id="checkboxInversion">
                        <div class="checkmark"></div>
                        <p>Date par ordre croissant</p>
                    </label>
                    <label class="check-container">
                        <input type="checkbox">
                        <div class="checkmark"></div>
                        <p>Localisation</p>
                    </label>
                    <button class="enr-but enr-pos1" type="submit" name="submit-modal" id="enregistrer1">Enregistrer</button>
                </div>
            </div>
        </div>
        <div id="add" class="add">
            <div class="add-content" id="add-content">
                <div class="add-head">
                    <img class="sup" id="closeAdd" src="../../img/croix.png" alt="supprimer" width="30px" height="30px">
                    <div class="modal-title1">
                        <p>Annonce</p>
                    </div>
                </div>
                <div class="add-main">
                    <p>Entrez vos informations !</p>
                    <form class="form-container" method="post">
                        <div class="contact-ligne">
                            <div class="box-ligne">
                                <label class="input-color">Ville</label>
                                <br>
                                <input type="text" placeholder="Limoges" class="form-input taille1" name="ville" required>
                            </div>
                            <div class="box-ligne">
                                <label class="input-color">Etablissement</label>
                                <br>
                                <input type="text" placeholder="3iL" class="form-input taille1" name="etablissement" required>
                            </div>
                        </div>
                        <div class="contact-ligne">
                            <div class="box-ligne">
                                <label class="input-color">Description</label>
                                <br>
                                <input type="text" placeholder="rdv: 12h05, parking" class="form-input taille2" name="description" required>
                            </div>
                        </div>
                        <div class="contact-ligne">
                            <div class="box-ligne">
                                <label class="input-color">Telephone</label>
                                <br>
                                <input type="text" placeholder="+33 7 00 00 00 00" class="form-input taille2" name="telephone" oninput="validInput(this)" required>
                            </div>
                        </div>
                        <label class="check-container check-top">
                            <input type="checkbox" id="check1">
                            <div class="checkmark"></div>
                            <p>Transport de personne</p>
                        </label>
                        <div class="contact-ligne1" id="contact-ligne1">
                            <div class="box-ligne">
                                <label class="input-color">Nombre de place</label>
                                <br>
                                <input type="text" placeholder="3" class="form-input taille2" name="place" oninput="validInput(this)">
                            </div>
                        </div>
                        <button class="enr-but enr-pos2" type="submit" name="submit-add">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="profileModal" class="profil">
            <div class="profil-content">
                <a href="profil.php" class="bt-pr pr-top">Profil</a>
                <a href="deconnexion.php" class="bt-pr pr-bottom">Déconnexion</a>
                <div class="barre"></div>
                <a href="aide.php" class="bt-pr pr-top1">Centre d'aide</a>
            </div>
        </div>

        <div class="salutation">
            <?='<h1>Nous sommes heureux de vous voir '.$nom.'</h1>';?>
        </div>
        
        <div class="container">
            <h1>Des étudiants unis pour un repas réussi !</h1>
        </div>
        <div class="annonce-ctn1" id="annonce-ctn1">
        <?php
        $annonces = recupererAnnonces();
        foreach ($annonces as $annonce) {
            echo ajouter($annonce);
        }
        ?>
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
    <script src="../js/index.js"></script>
</body>
</html>