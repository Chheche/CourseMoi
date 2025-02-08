<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/connexion.css">
    <script src="../js/connexion.js"></script>
</head>
<body>
    <nav>
        <a class="gauche" ></a>
        <div class="droite">
            <button id="boutonConnexion" onclick="document.location.href='connexion.php';">Se Connecter</button>
            <button id="boutonCreation" onclick="document.location.href='creation.php';">Creer Compte</button>
        </div>
    </nav>
    <main>
    <div id="ouverture">
            <div class="titre">
                <h1>Bienvenue sur</h1>
                <h1>CourseMoi</h1>
            </div>
            <div class="avertissement">
                <h1>Avertissements</h1>
                <div class="texte">
                    <p>Ce site web a pour but d'aider les étudiants en leurs rendant service.</p>
                    <p>Cependant, si des problèmes devaient survenir à causes du comportement de certains utilisateurs, des mesures seront</p>
                    <p>prises pour endiguer ces débordements.</p>
                    <br>
                    <p>De manière totalement différente, n'oubliez pas qu'un accès plus facile à une ressource ne doit pas impliquer</p>
                    <p>son utilisation sans restriction.</p>
                    <h4>Ne gaspillez donc pas s'il vous plaît.</h4>
                    <br>
                    <p>De plus, souvenez vous que plusieurs minutes de marches par jour sont conseillées </p>
                    <p>pour rester en bonne santée, et de la même façon :</p>
                    <h4>Évitez de manger trop gras, trop sucré, trop salé.</h4>
                    <br>
                    <p>Merci de prendre connaissance de ces informations.</p>
                </div>
            </div>
            <div class="presentation">
                <h1>Qui sommes nous</h1>
                <div class="texte">
                    <p>Etudiants en classe préparatoire en école d'ingénieur informatique (3iL à Limoges), nous sommes 3.</p>
                    <p>Nos noms : Axelle LEGER, Rafael BARRETO et Ruben LE GOURRIEREC</p>
                    <br>
                    <p>Nous avons l'honneur de vous accueillir sur notre site conçu par des étudiants, pour des étudiants.</p>
                    <br>
                    <p>L'objectif principal est l'entraide, si un étudiant de votre école souhaite manger au même endroit que vous,</p>
                    <p>Pourquoi ne pas l'y déposer ou simplement lui ramener ce qu'il veut ?</p>
                    <br>
                    <p>Ceci étant un projet étudiant, nous avons besoin de VOUS pour rendre ce site connu et utile</p>
                    <p>Même la plus petite participation sera la bienvenue</p>
                    <p>Nous comptons sur vous !</p>
                    <br>
                    <p>En vous souhaitant l'expérience la plus agréable possible :D</p>
                </div>
            </div>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>