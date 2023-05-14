<?php
//Importation du code de connexion à la base de donnée
require_once('connection.php');
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOUVEAU ARTICLE</title>
</head>
<body>
    <form action="saveArticle.php" method="post" enctype="multipart/form-data">
        <div class="input-groupe">
            <label for="">Titre</label>
            <input type="text" name="titre" id="titre">
        </div>

        <div class="input-groupe">
            <label for="">Contenu</label>
            <input type="text" name="contenu" id="contenu">
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