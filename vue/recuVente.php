   <?php
include 'entete.php';

if(!empty($_GET['id'])){
   $vente=getVente($_GET['id']);
}

?>
<div class="home-content">

<!-- CHANGER id="btn" EN id="btnPrint" -->
<button class="hidden-print" id="btnPrint" style="position: relative; left:45%"> <i class='bx  bx-printer'></i> Imprimer </button>


    <div class="page">
    <div class="cote-a-cote" >

     <h2>EasyStock</h2>
     <div>
       <p> Reçu N° #:<?= $vente['id'] ?></p>
        <p> Date:<?=date('d/m/Y H:i:s',strtotime($vente['date_vente']))?></p>
</div>
    </div>

   <div class="cote-a-cote" style="width:50%;">

     <h2>Nom :</h2>
       <p> <?= $vente['nom']." ".$vente['prenom'] ?></p>
    </div>

       <div class="cote-a-cote" style="width:50%;">

     <h2>Tel :</h2>
       <p> <?= $vente['telephone']?> </p>
    </div> <!-- AJOUTER CETTE FERMETURE -->

   <div class="cote-a-cote" style="width:50%;">
     <h2>Adresse :</h2>
       <p> <?= $vente['adresse'] ?></p>
    </div>

    <br>
              <table class="mtable">
          <tr>
                 <th> Designation</th>
                 <th>Quantité</th>
                 <th>Prix unitaire </th>
                 <th>Prix total</th>
                 <!-- SUPPRIMER <th>Action</th> -->
           </tr>
               <tr>
                  <td><?=$vente['nom_article']?> </td>
                  <td><?=$vente['quantite'] ?></td>
                  <td><?=$vente['prix_unitaire'] ?></td>
                  <td><?=$vente['prix'] ?></td>
            </tr>
        </table>
          </div>

        </div>
 
      
    </section>
<?php
include 'pied.php';
?> 
<script>
// CHANGER '#btn' EN '#btnPrint'
var btnPrint = document.querySelector('#btnPrint');
if(btnPrint) {
    btnPrint.addEventListener("click", function(){
        window.print();
    });
}
function setPrix(){
    var article=document.querySelector('#id_article');
    var quantite=document.querySelector('#quantite');
    var prix=document.querySelector('#prix')
    var prixUnitaire=article.options[article.selectedIndex].getAttribute('data-prix');
    prix.value=Number(quantite.value)*Number(prixUnitaire);

}
</script>