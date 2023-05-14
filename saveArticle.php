<?php
include 'connection.php';

if (isset($_POST['Enregistrer'])) {
    $titre = $_POST['titre']; 
    $contenu = $_POST['contenu']; 
    $categorie = $_POST['categorie'];
    $editeur = $_POST['editeur'];
    $date_creation = date('Y-m-d');
    $date_publication = date('Y-m-d');
   
    if(isset($_FILES['imageToUpload'])){
        move_uploaded_file($_FILES['imageToUpload']['tmp_name'], "images/". $_FILES['imageToUpload']['name']);
        $image = $_FILES['imageToUpload']['name'];
      }
      else{
          echo "image not found!";
          $image = "";
      }

    $sql = 'INSERT INTO article(titre, 
                                contenu, 
                                editeur, 
                                categorie, 
                                date_creation,
                                date_publication,
                                image) 
                                VALUES(
                                :t, 
                                :c, 
                                :e, 
                                :cat,
                                :dc,
                                :dp,
                                :i )';

    $statement = $conn->prepare($sql);

    $statement->execute([
        ':t' => $titre,
        ':c' => $contenu,
        ':cat' => $categorie,
        ':e' => $editeur,
        ':dc' => $date_creation,
        ':dp' => $date_publication,
        ':i' => $image
    ]);
    $conn = null;

    header('Location: listArticle.php');
}
?>