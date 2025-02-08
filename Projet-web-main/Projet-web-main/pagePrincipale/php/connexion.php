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

function connexion($mail, $mdp) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

        
        $statement = $bdd->prepare("SELECT * FROM administrateur WHERE mail = :n");
        $statement->execute(["n" => $mail]);
        $resultat = $statement->fetchAll();


        if (count($resultat) === 1) {
            $admin = $resultat[0];
        
            if (password_verify($mdp, $admin['motdepasse'])) {
                $_SESSION['nom'] = $admin['nom'];
                $_SESSION['mail'] = $admin['mail'];
                $_SESSION['nbAnnonces'] = $admin['nbAnnonces'];
                $_SESSION['connecte'] = $mail;
                $_SESSION['role'] = 'admin';
                header("Location:../../PageAdmin/php/index.php");
                exit(); 
                return "parfait !";
            }
        }

        $statement = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = :n");
        $statement->execute(["n" => $mail]);
        $resultat = $statement->fetchAll();

        if (count($resultat) === 1) {
            $utilisateur = $resultat[0];
        
            if (password_verify($mdp, $utilisateur['motdepasse'])) {
                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['mail'] = $utilisateur['mail'];
                $_SESSION['nbAnnonces'] = $utilisateur['nbAnnonces'];
                $_SESSION['connecte'] = $mail;
                header('Location: ../../PageUtilisateur/php/indexUti.php');
                exit; 
            } else {
                return  "Mot de passe incorrect";
            }
        } else {
            return "Adresse mail introuvable";
        }
    } catch (Exception $e) {
        return 'Erreur : ' . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["email"];
    $mdp = $_POST["password"];
    connexion($mail, $mdp);
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
            <section id="connexion">
                <div class="titre">
                    <h2>Bonjour !</h2>
                    <h3>Connectez-vous pour accéder à toutes nos fonctionnalités</h3>
                </div>
                <div class="formulaire">
                    <form method="post">
                        
                        <div class="email">
                            <label>Email :</label>
                            <input type="email" id="email" name="email"required>
                        </div>
        
                        <div class="password">
                            <label>Mot De Passe :</label>
                            <input type="password" id="password" name="password" required>
                        </div>
        
                        <div class="bouton">
                            <button id="bouton" name="bouton">Se connecter</button>
                        </div>

                        <div class="changement">
                            Vous n'avez pas de compte ?
                            <a href="#creation" id="lienCrea" onclick="document.location.href='creation.php';"> Créez votre compte</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>