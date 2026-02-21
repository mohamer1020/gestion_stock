<?php
// model/auth.php - 15 lignes seulement !
session_start();

function checkLogin($username, $password) {
    // Connexion directe
    $pdo = new PDO('mysql:host=localhost;dbname=gestion_stock;charset=utf8', 'admin', 'admin');
    
    $sql = "SELECT id FROM users WHERE username = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password]);
    
    $user = $stmt->fetch();
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        return true;
    }
    
    return false;
}

function isLogged() {
    return isset($_SESSION['user_id']);
}

function logout() {
    session_destroy();
}
?>