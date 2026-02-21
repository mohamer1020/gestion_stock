<?php
// include 'entete.php';
require_once 'entete.php';
?>
<div class="welcome-message">
    <h3>📊 Bienvenue dans EasyStock !</h3>
    <p>Système de gestion de stock </p>
</div>
<div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Commande</div>
              <div class="number"> <?php echo getAllcommande()['nbre']?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Vente</div>
              <div class="number"> <?php echo getAllvente()['nbre']?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Article</div>
              <div class="number"><?php echo getAllarticle()['nbre']?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Chiffre d'affaire</div>
              <div class="number"><?php echo number_format(getCA()['prix'],0,',',' ')?></div>
              <div class="indicator">
                <i class="bx bx-down-arrow-alt down"></i>
                <span class="text">Aujourd'hui</span>
              </div>
            </div>
            <i class="bx bxs-cart-download cart four"></i>
          </div>
        </div>

        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Vente recentes</div>
            <?php
             $ventes=getLastVente();
               ?>
            <div class="sales-details">
              <ul class="details">
                <li class="topic">Date</li>
                <?php
                foreach($ventes as $key=>$value){
                  ?>
                <li><a href="#"><?php echo date ('d M Y', strtotime($value['date_vente']))?></a></li>

                  <?php
                }
                ?>
                 </ul>
              <ul class="details">
                <li class="topic">Client</li>
                <?php
                foreach($ventes as $key=>$value){
                  ?>
              <li><a href="#"><?php echo $value['nom']." ".$value['prenom']?></a></li>

                  <?php
                }
                ?>
              </ul>
              <ul class="details">
                <li class="topic">Article</li>
                <?php
                foreach($ventes as $key=>$value){
                  ?>
              <li><a href="#"><?php echo $value['nom_article']?></a></li>
                  <?php
                }
                ?>
              </ul>
              <ul class="details">
                <li class="topic">Prix</li>
                 <?php
                foreach($ventes as $key=>$value){
                  ?>
              <li><a href="#"><?php echo number_format($value['prix'],0,","," ")."DA"?></a></li>
                  <?php
                }
                ?>
            
              </ul>
            </div>
            <div class="button">
              <a href="#">Voir Tout</a>
            </div>
          </div>
          <div class="top-sales box">
            <div class="title">Article le plus vendu</div>
            <ul class="top-sales-details">
                <?php
             $article=getMostVente();
             foreach($article as $key=>$value){
               
               ?>
                  <li>
                <a href="#">                  
                  <span class="product"><?php echo $value['nom_article']?> </span>
                </a>
                <span class="price"><?php echo number_format($value['prix'],0,","," ")."DA"?></span>
              </li>
              <?php
             }
               ?>

              
            </ul>
          </div>
        </div>
      </div>
    </section>
 <?php
include 'pied.php';
?>