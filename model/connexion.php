<?php
// CONFIGURATION CORRECTE POUR XAMPP
$nom_serveur = "localhost";      // ou "127.0.0.1"
$port = "3306";                  // Port MySQL standard XAMPP
$nom_base_de_donne = "gestion_stock";
$utilisateur = "admin";
$motpass = "admin";

try {
    // DSN CORRECT avec port séparé
    $dsn = "mysql:host=$nom_serveur;port=$port;dbname=$nom_base_de_donne;charset=utf8";
    $connexion = new PDO($dsn, $utilisateur, $motpass);
    
    // Configuration PDO
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Pas de return nécessaire si vous utilisez include/require
    // $connexion sera disponible dans le script appelant
    
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>