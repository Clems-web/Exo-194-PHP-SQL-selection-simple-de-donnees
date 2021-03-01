<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>



<?php

/**
 * 1. Importez le fichier SQL se trouvant dans le dossier SQL.
 * 2. Connectez vous à votre base de données avec PHP
 * 3. Sélectionnez tous les utilisateurs et affichez toutes les infos proprement dans un div avec du css
 *    ex:  <div class="classe-css-utilisateur">
 *              utilisateur 1, données ( nom, prenom, etc ... )
 *         </div>
 *         <div class="classe-css-utilisateur">
 *              utilisateur 2, données ( nom, prenom, etc ... )
 *         </div>
 * 4. Faites la même chose, mais cette fois ci, triez le résultat selon la colonne ID, du plus grand au plus petit.
 * 5. Faites la même chose, mais cette fois ci en ne sélectionnant que les noms et les prénoms.
 */
try {
    $server = "localhost";
    $db = "exo_194";
    $user = "root";
    $password = "";

    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * from exo_194.user");
    $state = $stmt->execute();
    if ($state) {
        foreach ($stmt->fetchAll() as $user) {
            echo "<div class='divUser'>Utilisateur : ". $user['nom']." ".$user['prenom']." ".$user['numero']." ".$user['rue']." ".$user['code_postal']." ".$user['ville']." ".$user['pays']." ".$user['mail']."</div>";
        }
    }

    $stmt2 = $pdo->prepare("SELECT * from exo_194.user ORDER BY id DESC");
    $state2 = $stmt2->execute();

    if ($state2) {
        foreach ($stmt2->fetchAll() as $user) {
            echo "<div class='divUser'>Utilisateur : ". $user['nom']." ".$user['prenom']." ".$user['numero']." ".$user['rue']." ".$user['code_postal']." ".$user['ville']." ".$user['pays']." ".$user['mail']."</div>";
        }
    }

    $stmt3 = $pdo->prepare("SELECT nom, prenom from exo_194.user ORDER BY id DESC");
    $state3 = $stmt3->execute();

    if ($state3) {
        foreach ($stmt3->fetchAll() as $user) {
            echo "<div class='divUser'>Utilisateur : ". $user['nom']." ".$user['prenom']."</div>";
        }
    }

}
catch (PDOException $exception) {
    echo $exception->getMessage();
}
?>


</body>
</html>
