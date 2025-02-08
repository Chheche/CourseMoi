<?php
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

if (isset($_GET['id'])) {
    $annonceId = $_GET['id'];
    
    $sql = $bdd->prepare('DELETE FROM annonce WHERE id = :id');
    $sql->execute(['id' => $annonceId]);
    
    if ($sql->rowCount() > 0) {
        http_response_code(200);
        echo "L'annonce a été supprimée avec succès.";
    } else {
        http_response_code(404);
        echo "L'annonce avec l'identifiant spécifié n'a pas été trouvée.";
    }
} else {
    http_response_code(400);
    echo "L'identifiant de l'annonce n'a pas été fourni dans la requête.";
}
?>
