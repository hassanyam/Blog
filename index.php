<?php
require_once('connection.php');
//Requete pour retrouver la liste des articles du premier au quatrième
$sql = 'SELECT * FROM article order by date_publication limit 1,4';
//Préparation de la requete
$statement = $conn->query($sql);
//Récupération et conversion de la réponse en un tableau d'articles
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);

//Requete pour retrouver la liste des articles du premier au quatrième
$sql = 'SELECT * FROM article order by date_publication limit 1';
//Préparation de la requete
$statement = $conn->query($sql);
//Récupération et conversion de la réponse en un tableau d'articles
$article = $statement->fetch();

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/main.css" />
    <title>RANA BLOG</title>
  </head>
  <body>
    <div class="container">
      <main class="main-content">
        <section class="article-container">
          <div class="last-article">
          <?php
            //Affichage du premier article
            if ($article) {
                
                    
                        echo '<img src="images/'. $article['image'] .'" class="article--image">';
                        echo '<h2>'. $article['titre'] .'</h2>';
                        echo '<p class=date-publication>'. $article['date_publication'] .'</p>';
                        echo '<div class="article-content">'. $article['contenu'] .'</div>';
                        echo '<span class="more">read more</span>';
                       
                
            }
        ?>
          </div>
          <div class="articles">
          <?php
            //Affichage de chaque article dans une ligne du tableau <tr>
            if ($articles) {
                foreach ($articles as $article) {
                    echo '<div class="article">';
                        echo '<img src="images/'. $article['image'] .'" class="article--image">';
                        echo '<h2>'. $article['titre'] .'</h2>';
                        echo '<p class=date-publication>'. $article['date_publication'] .'</p>';
                        echo '<div class="article-content">'. $article['contenu'] .'</div>';
                        echo '<span class="more">read more</span>';
                    echo '</div>';    
                }
            }
        ?>
          </div>
        </section>
        <aside>
          <div class="about-me"></div>
          <div class="social-media"></div>
          <div class="categories"></div>
        </aside>
      </main>
    </div>
  </body>
</html>
