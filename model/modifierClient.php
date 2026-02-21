<?php
include 'connexion.php';  // Ça reste pareil car ils sont dans le même dossier
session_start();
if(!empty($_POST['nom'])
&& !empty($_POST['prenom'])
&& !empty($_POST['telephone'])
&& !empty($_POST['adresse'])
&& !empty($_POST['idclient'])
){
    $sql = "UPDATE client SET nom=?, prenom=?, telephone=?, adresse=? WHERE idclient=?";
    
    // CORRECTION ICI : Utilise $GLOBALS['connexion'] au lieu de $connexion
    $req = $GLOBALS['connexion']->prepare($sql);
    
    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse'],
        $_POST['idclient']
    ));
    
    if($req->rowCount() != 0){
        $_SESSION['message']['text'] = "Client modifié avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Rien n'a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/client.php');