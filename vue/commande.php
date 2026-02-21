<?php
include 'entete.php';

if(!empty($_GET['id'])){
   $commande=getCommande($_GET['id']);
}

?>
<div class="home-content">
     <div class="overview-boxes">
      <div class="box">
        <form action=" <?=!empty($_GET['id'])? "../model/modifierCommande.php":"../model/ajoutCommande.php"?>" method="post">

        <input value="<?=!empty($_GET['id'])? $commande['id']:""?>" type="hidden" name="id" id="id" >

        <label for="id_article">Article </label>
        <select name="id_article" id="id_article" onchange="setPrix()">
        <?php
           $articles=getArticle();  
           if(!empty($articles)&& is_array($articles)){
            foreach($articles as $key=>$value){
                ?>
              <option value="<?=$value['id']?>" data-prix="<?=$value['prix_unitaire']?>"> 
                <?=$value['nom_article']." - ".$value['quantite']." disponible"?>
              </option>
            <?php
              }
           }
          ?>
        </select>
        
         <label for="id_fournisseur">Fournisseur </label>
        <select name="id_fournisseur" id="id_fournisseur">
        <?php
           $fournisseurs=getFournisseur();
           if(!empty($fournisseurs)&& is_array($fournisseurs)){
            foreach($fournisseurs as $key=>$value){
                ?>
           <option value="<?=$value['id']?>"> <?=$value['nom']." ".$value['prenom']?></option>
           <?php
              }
           }
          ?>
        </select>
        
        <label for="quantite"> Quantité </label>
        <input onkeyup="setPrix()" value="<?=!empty($_GET['id'])? $commande['quantite']:""?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

        <label for="prix">Prix</label>
        <input value="<?=!empty($_GET['id'])? $commande['prix']:""?>" type="number" name="prix" id="prix" placeholder="Veuillez saisir le prix">
         
        <button type="submit">Valider</button>
        
        <?php 
        if(isset($_SESSION['message']) && !empty($_SESSION['message']['text'])){
        ?>
            <div class="alert <?= $_SESSION['message']['type'] ?>">
                <?= $_SESSION['message']['text'] ?>
            </div>
        <?php
            unset($_SESSION['message']);
        }
        ?>
        </form>
      </div>
      
      <div class="box">
       <table class="mtable">
          <tr>
                 <th> Article </th>
                 <th>Fournisseur</th>
                 <th>Quantité</th>
                 <th>Prix </th>
                 <th>Date</th>
           </tr>
           <?php
           $commandes=getCommande();  
           if(!empty($commandes)&& is_array($commandes)){
            foreach ($commandes as $key => $value) {
               ?>
               <tr>
                  <td><?=$value['nom_article']?> </td>
                  <td><?=$value['nom']." ".$value['prenom'] ?></td>
                  <td><?=$value['quantite'] ?></td>
                  <td><?=$value['prix'] ?></td>
                  <td><?= date('d/m/Y H:i:s',strtotime($value['date_commande']))?></td>
            </tr>
               <?php
            }
           }
           ?>
        </table>
      </div>
     </div>   
</div>

<script>
function setPrix(){
    var article=document.querySelector('#id_article');
    var quantite=document.querySelector('#quantite');
    var prix=document.querySelector('#prix')
    var prixUnitaire=article.options[article.selectedIndex].getAttribute('data-prix');
    prix.value=Number(quantite.value)*Number(prixUnitaire);
}
</script>

<?php
include 'pied.php';
?>