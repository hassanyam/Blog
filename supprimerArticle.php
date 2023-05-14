<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
   
    $sql = 'DELETE FROM  article WHERE id_article= :id';

    $statement = $conn->prepare($sql);

    $statement->execute([
        ':id' => $id
    ]);
    $conn = null;

    header('Location: listArticle.php');
}
?>