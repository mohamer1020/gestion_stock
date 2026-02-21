 <?php
// <!-- require_once '../model/auth.php';

//  Protéger la page
// protegerPage();
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include_once '../model/function.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title> <?php
   echo ucfirst(str_replace(".php","",basename( $_SERVER['PHP_SELF'])));

   ?>
   </title>
<link rel="stylesheet" href="../public/css/style.css?v=<?php echo time(); ?>" />
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  </head>
  <body>
    <body class="page-<?php echo str_replace('.php', '', basename($_SERVER['PHP_SELF'])); ?>">
    <div class="sidebar hidden-print">
      <div class="logo-details">
        <i class="bx bxl-c-plus-plus"></i>
        <span class="logo_name">EasyStock</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php" class="<?php echo basename( $_SERVER['PHP_SELF'])=="dashboard.php" ? "active":"" ?>">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
         <li>
          <a href="vente.php" class="<?php echo basename( $_SERVER['PHP_SELF'])=="vente.php" ? "active":"" ?>">
           <i class='bxr  bx-shopping-bag'></i>       
                 <span class="links_name">Vente</span>
          </a>
        </li>
         <li>
          <a href="client.php" class="<?php echo basename( $_SERVER['PHP_SELF'])=="client.php" ? "active":"" ?>">
            <i class="bx bx-user"></i>
            <span class="links_name">Client</span>
          </a>
        </li>
        <li>
          <a href="article.php"class="<?php echo basename( $_SERVER['PHP_SELF'])=="article.php" ? "active":"" ?>">
            <i class="bx bx-box"></i>
            <span class="links_name">Article</span>
          </a>
        </li>
         <li>
          <a href="fournisseur.php" class="<?php echo basename( $_SERVER['PHP_SELF'])=="fournisseur.php" ? "active":"" ?>">
            <i class="bx bx-user"></i>
            <span class="links_name">Fournisseur</span>
          </a>
        </li>
        <li>
          <a href="commande.php" class="<?php echo basename( $_SERVER['PHP_SELF'])=="commande.php" ? "active":"" ?>">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Commandes</span>
          </a>
        </li>
         <li>
          <a href="categorie.php" class="<?php echo basename( $_SERVER['PHP_SELF'])=="categorie.php" ? "active":"" ?>">
            <i class="bx bx-category"></i>
            <span class="links_name">Catégorie</span>
          </a>
        </li>
      <!-- Remplacer le lien de déconnexion existant -->
<li class="log_out">
    <a href="logout.php">
        <i class="bx bx-log-out"></i>
        <span class="links_name">Déconnexion</span>
    </a>
</li>
      </ul>
    </div>
    <section class="home-section">
      <nav class="hidden-print">
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard"> <?php
   echo ucfirst(str_replace(".php","",basename( $_SERVER['PHP_SELF'])));
   ?>
   </span>
        </div>
      </nav>                            