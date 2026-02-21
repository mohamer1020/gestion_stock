<?php
include 'connexion.php';
function getArticle($id = null,$searchDATA=array())
{
    if (!empty($id)) {
        $sql = "SELECT a.id, a.nom_article, c.libelle_categorie, a.quantite,
                a.prix_unitaire, a.date_fabrication, a.date_expiration, a.id_categorie
                FROM article AS a, categorie_article AS c 
                WHERE a.id_categorie = c.id AND a.id = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch(PDO::FETCH_ASSOC); 
    } elseif(!empty($searchDATA)) {
        $search="";
        extract($searchDATA);
        if(!empty($nom_article))$search.=" AND a.nom_article LIKE '%$nom_article%'";
        if(!empty($id_categorie))$search.=" AND a.id_categorie =$id_categorie";
        if(!empty($quantite))$search.=" AND a.quantite =$quantite";
        if(!empty($prix_unitaire))$search.=" AND a.prix_unitaire =$prix_unitaire";
       
       $sql = "SELECT a.id, a.nom_article, c.libelle_categorie, a.quantite,
                a.prix_unitaire
                FROM article AS a, categorie_article AS c 
                WHERE a.id_categorie = c.id $search ";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 


        }else {
        $sql = "SELECT a.id, a.nom_article, c.libelle_categorie, a.quantite,
                a.prix_unitaire, a.date_fabrication, a.date_expiration
                FROM article AS a, categorie_article AS c 
                WHERE a.id_categorie = c.id";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 
    }
}

function getClient($idclient = null)
{
    if (!empty($idclient )) {
        // Pour un client spécifique
        $sql = "SELECT * FROM client WHERE idclient = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($idclient));
        return $req->fetch(PDO::FETCH_ASSOC); 
    } else {
        // Pour TOUS les clients 
        $sql = "SELECT * FROM client"; 
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 
    }
}

function getVente($id = null)
{
    if (!empty($id)) {
        // Pour une vente spécifique
        $sql = "SELECT v.id, a.nom_article, c.nom, c.prenom, v.quantite,
                 v.prix, v.date_vente,v.id ,prix_unitaire,adresse,telephone
                FROM vente v, article a, client c 
                WHERE v.id_article = a.id 
                AND v.id_client = c.idclient 
                AND v.id = ?
                AND etat=?";


        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id,1));
        return $req->fetch(PDO::FETCH_ASSOC); 
    } else {
        // Pour TOUTES les ventes
        $sql = "SELECT v.id, a.nom_article, c.nom, c.prenom, v.quantite, v.prix, v.date_vente,v.id,a.id AS idArticle
                FROM vente v, article a, client c 
                WHERE v.id_article = a.id 
                AND v.id_client = c.idclient AND etat=? ";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array(1)); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 
    }
}

function getFournisseur($id = null)
{
    if (!empty($id )) {
        // Pour un client spécifique
        $sql = "SELECT * FROM fournisseur WHERE id = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch(PDO::FETCH_ASSOC); 
    } else {
        // Pour TOUS les clients 
        $sql = "SELECT * FROM fournisseur"; 
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 
    }
}


function getCommande($id = null)
{
    if (!empty($id)) {
        // Pour une commande spécifique
        $sql = "SELECT co.id, a.nom_article, f.nom, f.prenom, co.quantite, co.prix, co.date_commande,co.id ,prix_unitaire,adresse,telephone
                FROM commande co, article a, fournisseur f 
                WHERE co.id_article = a.id 
                AND co.id_fournisseur = f.id 
                AND co.id = ?";


        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch(PDO::FETCH_ASSOC); 
    } else {
        // Pour TOUTES les commandes
        $sql = "SELECT co.id, a.nom_article, f.nom, f.prenom, co.quantite, co.prix, co.date_commande,co.id,a.id AS idArticle
                FROM commande co, article a, fournisseur f
                WHERE co.id_article = a.id 
                AND co.id_fournisseur = f.id ";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 
    }
}

function getAllcommande()
{
     $sql="SELECT COUNT(*) AS nbre FROM commande";
     $req = $GLOBALS['connexion']->prepare($sql);

     $req->execute();
     return $req->fetch(); 

}

function getAllvente()
{
     $sql="SELECT COUNT(*) AS nbre FROM vente WHERE etat=? ";
     $req = $GLOBALS['connexion']->prepare($sql);

     $req->execute(array(1));
     return $req->fetch(); 

}

function getAllarticle()
{
     $sql="SELECT COUNT(*) AS nbre FROM article";
     $req = $GLOBALS['connexion']->prepare($sql);

     $req->execute();
     return $req->fetch(); 

}

function getCA()
{
     $sql="SELECT SUM(prix)AS prix FROM vente";
     $req = $GLOBALS['connexion']->prepare($sql);

     $req->execute();
     return $req->fetch(); 

}

function getLastVente($id = null)
{
  
        // Pour TOUTES les ventes
        $sql = "SELECT v.id, a.nom_article, c.nom, c.prenom, v.quantite, v.prix, v.date_vente,v.id,a.id AS idArticle
                FROM vente v, article a, client c 
                WHERE v.id_article = a.id 
                AND v.id_client = c.idclient AND etat=? 
                ORDER BY date_vente DESC LIMIT 10";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array(1)); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 
    }


    function getMostVente($id = null)
{
  
        // Pour TOUTES les ventes
        $sql = "SELECT nom_article,SUM(prix)AS prix
                FROM vente v, article a, client c 
                WHERE v.id_article = a.id 
                AND v.id_client = c.idclient AND etat=? 
                GROUP BY a.id
                ORDER BY SUM(prix) DESC LIMIT 10";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array(1)); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 
    }

    function getCategorie($id = null)
{
    if (!empty($id)) {
        // Pour un article spécifique
        $sql = "SELECT * FROM categorie_article WHERE id = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch(PDO::FETCH_ASSOC); 
    } else {
        // Pour TOUS les articles 
        $sql = "SELECT * FROM categorie_article"; 
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(); 
        return $req->fetchAll(PDO::FETCH_ASSOC); 
    }
}
?>

