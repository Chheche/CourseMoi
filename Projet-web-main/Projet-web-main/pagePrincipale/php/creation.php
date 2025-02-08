<?php
session_start();

if(!empty($_SESSION['connecte'])){
    if(!empty($_SESSION['role'])){
        header("Location:../../PageAdmin/php/index.php");
        exit();
    }
    header('Location: ../../PageUtilisateur/php/indexUti.php');
    exit();
}

function creation($mail, $nom, $mdp) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

        $statement = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = :n");
        $statement->execute(["n" => $mail]);
        $resultat = $statement->fetchAll();

        if (count($resultat) === 0) {
            $motdepasse_hashed = password_hash($mdp, PASSWORD_BCRYPT);
            $sqlQuery = "INSERT INTO utilisateur(mail, nom, motdepasse) VALUES (:mail, :nom, :motdepasse)";
            $insertStatement = $bdd->prepare($sqlQuery);

            $insertStatement->execute([
                'mail' => $mail,
                'nom' => $nom,
                'motdepasse' => $motdepasse_hashed,
            ]);
            $_SESSION['nom'] = $nom;
            $_SESSION['nbAnnonces'] = intval($nbAnnonces);
            $_SESSION['connecte'] = $mail;
            header('Location: ../../PageUtilisateur/php/indexUti.php');

            return "Utilisateur ajouté avec succès";
        } else {
            return "L'utilisateur existe déjà";
        }
    } catch (Exception $e) {
        return 'Erreur : ' . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["newEmail"];
    $nom = $_POST["username"];
    $mdp = $_POST["newPassword"];
    $nbAnnonces = 0;
    creation($mail, $nom, $mdp);      
}
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/connexion.css">
    <script src="../js/connexion.js"></script>
</head>
<body>
    <?php include("head.php"); ?>
    <main>
        <div class="page">
            <section id="creation">
                <div class="titre">
                    <h2>Création de Compte</h2>
                </div>
                <div class="formulaire">
                    <form method="post">
                        <div class="email">
                            <label>Email :</label>
                            <input type="email" id="newEmail" name="newEmail"required>
                        </div>
                        <div class="username">
                            <label>Nom Utilisateur :</label>
                            <input type="text" id="username" name="username"required>
                        </div>
                        <div class="password">
                            <label>Mot De Passe :</label>
                            <input type="password" id="newPassword" name="newPassword" required oninput="validerMotDePasse()">
                        </div>
                        <div id="messageErreur"></div>
                        <div class="bouton">
                            <button id="bouton" name="bouton">Créer un compte</button>
                        </div>
                        <div class="changement">
                            Vous avez déjà un compte ?
                            <a href="#connexion" id="lienCo" onclick="document.location.href='connexion.php';"> Connectez-vous</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>