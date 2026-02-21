<?php
session_start();
include 'connexion.php';
include_once 'function.php';

// Vérifier si tous les champs sont remplis
if(!empty($_POST['id_article']) 
&& !empty($_POST['id_client']) 
&& !empty($_POST['quantite']) 
&& !empty($_POST['prix'])) {
    
    // Récupérer l'article
    $article = getArticle($_POST['id_article']);
    
    if(!empty($article) && is_array($article)) {
        // Vérifier la quantité disponible
        if($_POST['quantite'] > $article['quantite']) {
            $_SESSION['message']['text'] = "La quantite a vendre n'est pas disponible. Stock: " . $article['quantite'];
            $_SESSION['message']['type'] = "danger";
        } else {
            // Insérer la vente - CORRECTION: 4 valeurs, pas 6
            $sql = "INSERT INTO vente(id_article, id_client, quantite, prix, date_vente) 
                    VALUES(?, ?, ?, ?, NOW())";
            
            $req = $connexion->prepare($sql);
            $req->execute(array(
                $_POST['id_article'],
                $_POST['id_client'],
                $_POST['quantite'],
                $_POST['prix']
            ));

            if($req->rowCount() != 0) {
                // Mettre à jour le stock
                $sql = "UPDATE article SET quantite = quantite - ? WHERE id = ?";
                $req = $connexion->prepare($sql);
                $req->execute(array(
                    $_POST['quantite'],
                    $_POST['id_article']
                ));

                if($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = "Vente effectuée avec succès";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Impossible de mettre à jour le stock";
                    $_SESSION['message']['type'] = "danger";
                }
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de la vente";
                $_SESSION['message']['type'] = "danger";
            }
        }
    } else {
        $_SESSION['message']['text'] = "Article non trouvé";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/vente.php');
?>