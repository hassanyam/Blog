<?php
require_once('connection.php');
//Requete pour retrouver la liste des articles 
$sql = 'SELECT * FROM article order by date_publication limit 4';
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
    <link rel="stylesheet" href="css/main.css">
    <title>Admin-LISTE DES ARTICLES</title>
</head>
<body>
    <div class="container">
        <?php
            //Affichage de chaque article dans une ligne du tableau <tr>
            if ($articles) {
                foreach ($articles as $article) {
                    echo '<div class="article">';
                        echo '<img src="images/'. $article['image'] .'" alt="">';
                        echo '<h2>'. $article['titre'] .'</h2>';
                        echo '<p class=date-publication>'. $article['date_publication'] .'</p>';
                        echo '<div class="article-content">'. $article['contenu'] .'</div>';
                        echo '<span class="more">read more</span>';
                    echo '</div>';    
                }
            }
        ?>
    </div>    
</body>
</html>