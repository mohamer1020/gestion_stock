<?php
include 'entete.php';

if(!empty($_GET['idclient'])){
   $client=getClient($_GET['idclient']);
}

?>
<div class="home-content">
     <div class="overview-boxes">
      <div class="box">
        <form action=" <?=!empty($_GET['idclient'])? "../model/modifierClient.php":"../model/ajoutClient.php"?>" method="post">
        <label for="nom">Nom </label>
          <input value="<?=!empty($_GET['idclient'])? $client['nom']:""?>" type="text" name="nom" id="nom" placeholder="Veuillez saisir le nom">
          <input value="<?=!empty($_GET['idclient'])? $client['idclient']:""?>" type="hidden" name="idclient" id="idclient" >

                <label for="prenom">Prénom </label>
          <input value="<?=!empty($_GET['idclient'])? $client['prenom']:""?>" type="text" name="prenom" id="prenom" placeholder="Veuillez saisir le prénom">


    
        
          <label for="telephone"> N° de telephone </label>
          <input  value="<?=!empty($_GET['idclient'])? $client['telephone']:""?>" type="text" name="telephone" id="telephone"placeholder="Veuillez saisir le numéro de téléphone">

           <label for="adresse">Adresse</label>
           <input  value="<?=!empty($_GET['idclient'])? $client['adresse']:""?>" type="texte" name="adresse" id="adresse"placeholder="Veuillez saisir l'adresse">
        
         
           <button type="submit">Valider</button>
             <?php 
      if(isset($_SESSION['message']) && !empty($_SESSION['message']['text'])){
?>
         <div class="alert <?= $_SESSION['message']['type'] ?>">
        <?= $_SESSION['message']['text'] ?>
    </div>
<?php 
    // Efface le message après l'avoir affiché
    unset($_SESSION['message']);
}
?>
          </form>
        </div>
        <div class="box">
       <table class="mtable">
          <tr>
                 <th> Nom </th>
                 <th>Prénom</th>
                 <th>Téléphone</th>
                 <th>Adresse </th>
                 <th>Action</th>

           </tr>
           <?php
           $clients=getClient();
           if(!empty($clients)&& is_array($clients)){
            foreach ($clients as $key => $value) {
               ?>
               <tr>
                  <td><?=$value['nom']?> </td>
                  <td><?=$value['prenom'] ?></td>
                  <td><?=$value['telephone'] ?></td>
                  <td><?=$value['adresse'] ?></td>
                  <td><a href="?idclient=<?=$value['idclient']?>"><i class='bx bx-edit'></i></a></td>
            </tr>
               <?php
               # code...
            }
           }
           ?>
        </table>
        </div>
     </div>   

      </div>
    </section>

<?php
include 'pied.php';
?>