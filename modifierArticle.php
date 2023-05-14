<?php
//Importation du code de connexion à la base de donnée
require_once('connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $sql = 'SELECT * FROM article WHERE id_article= :id';
    $statement = $conn->prepare($sql);
    $statement->execute([
        ':id' => $id
    ]);
    $article = $statement->fetch(PDO::FETCH_ASSOC);
    
    //Requete pour retrouver les noms de tous les admins 
    $sql = 'SELECT nom_utilisateur FROM administrateur';
    //Préparation de la requete
    $statement = $conn->query($sql);
    //Récupération et conversion de la réponse en un tableau $admins
    $admins = $statement->fetchAll(PDO::FETCH_ASSOC);

    //Requete pour retrouver  toutes les catégories
    $sql = 'SELECT * FROM categorie';
    //Préparation de la requete
    $statement = $conn->query($sql);
    //Récupération et conversion de la réponse en un tableau $categories
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $conn = null;
}else{
    header('Location: listArticle.php');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFIER UN ARTICLE</title>
</head>
<body>
    <form action="updateArticle.php?id=<?php echo $article['id_article'] ?>" method="post" enctype="multipart/form-data">
        <div class="input-groupe">
            <label for="">Titre</label>
            <input type="text" name="titre" id="titre" value=<?php echo $article['titre']?>>
        </div>

        <div class="input-groupe">
            <label for="">Contenu</label>
            <input type="text" name="contenu" id="contenu" value=<?php echo $article['contenu']?>>
        </div>

        <div class="input-groupe">
            <label for="">Administrateur</label>
            <select name="editeur">
                <?php
                //Affichage de chaque administrateur dans la liste SELECT
                if ($admins) {
                    foreach ($admins as $admin) {
                        echo '<option value="' . $admin['nom_utilisateur'] .'">' . $admin['nom_utilisateur'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="input-groupe">
            <label for="">Catégorie</label>
            <select name = "categorie">
                <?php
                //Affichage da chaque catégorie dans la liste
                if ($categories) {
                    foreach ($categories as $categorie) {
                        echo '<option value="' . $categorie['id_categorie'] .'">' . $categorie['nom'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="input-groupe">
            <label for="imageToUpload">Importer image</label>
            <input type="file" name="imageToUpload" id="image">
        </div>

        <div class="input-groupe">
            <input type="submit" value="Enregistrer" name="Enregistrer">
        </div>
    </form>
</body>
</html>