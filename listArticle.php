<?php
require_once('connection.php');
//Requete pour retrouver la liste des articles 
$sql = 'SELECT * FROM article';
//Préparation de la requete
$statement = $conn->query($sql);
//Récupération et conversion de la réponse en un tableau d'articles
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-LISTE DES ARTICLES</title>
</head>
<body>
    <table>
        <thead>
            <tr>
            <th>id</th>
            <th>Titre</th>
            <th>Création</th>
            <th>Publication</th>
            <th>Contenu</th>
            <th>Image</th>
            <th>Editeur</th>
            <th>Catégorie</th>
            <th></th>
            <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
                //Affichage de chaque article dans une ligne du tableau <tr>
                if ($articles) {
                    foreach ($articles as $article) {
                        echo '<tr>';
                        echo '<th>' . $article['id_article'] . '</th>';
                        echo '<th>' . $article['titre'] . '</th>';
                        echo '<th>' . $article['date_creation'] . '</th>';
                        echo '<th>' . $article['date_publication'] . '</th>';
                        echo '<th>' . $article['contenu'] . '</th>';
                        echo '<th></th>';
                        echo '<th>' . $article['editeur'] . '</th>';
                        echo '<th>' . $article['categorie'] . '</th>';
                        echo '<th><a href="supprimerArticle.php?id='. $article['id_article'] . '">Supprimer</a></th>';
                        echo '<th><a href="modifierArticle.php?id='. $article['id_article'] . '">Modifier</a></th>';
                        echo '</tr>';
                    }
                }
                ?>
        </tbody>
    </table>
</body>
</html>