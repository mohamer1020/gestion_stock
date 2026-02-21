<?php
session_start();
include 'connexion.php'; 
if(!empty($_POST['libelle_categorie'])
){

$sql="INSERT INTO categorie_article(libelle_categorie ) VALUES(?)";
$req=$connexion->prepare($sql);
$req->execute(array(
    $_POST['libelle_categorie']
));
if($req->rowCount()!=0){
    $_SESSION['message']['text']="categorie ajouté avec succes";
    $_SESSION['message']['type']="success";
}else{
     $_SESSION['message']['text']="une erreur s'est prouduite lors de l'ajout du catégorie";
    $_SESSION['message']['type']="danger";
}
}else{
      $_SESSION['message']['text']="une information obligatoire non rensigné";
    $_SESSION['message']['type']="danger";
}
header('Location: ../vue/categorie.php');