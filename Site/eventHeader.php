<?php
try {$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');}
catch (PDOException $e) {die("L'accès à la base de donnée est impossible."); echo $sql . "<br>" . $e->getMessage();}
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $bdd->prepare("SELECT * FROM evenement WHERE id_event='".$q."'") ;
    $sql->execute();
    $eventinfo = $sql->fetch();


   if($_SESSION['role']==2) {}
   else{
   ?>
   <style type="text/css">#supprimer{
   visibility: hidden;
   }</style>
   <style type="text/css">#afficher_inscrit{
   visibility: hidden;
   }</style>
   <?php
   }


   if($_SESSION['role']==1) {
     ?>
   <style type="text/css">#afficher_inscrit{
   display: none;
   }</style>
   <?php
   }
   else{
   ?>
   <style type="text/css">#inscrire_event{
   display: none;
   }</style>
   <?php
   }


   if($_SESSION['role']==3) {
     ?>
   <style type="text/css">#afficher_inscrit{
   display: none;
   }</style>
   <?php
   }
   else{
   ?>
   <style type="text/css">#signaler{
   display: none;
   }</style>
   <?php
   }







?>
  <div id="picture_uploader" class="box_window"><?php include("image.php") ?></div>
  <div id="event_deleter" class="box_window"><?php include("scripte/del_event.php") ?></div>


<div id="eventHeader_section">

  <div id="eventHeader_container">
    <div class="eventHeader_box" id="eventHeader_title">
      <h2><?php echo "$eventinfo[name]"; ?></h2>
    </div>
    <br>

    <div class="eventHeader_box" id="date">
      <?php echo "$eventinfo[date_event]"; ?>
    </div>

    <div class="eventHeader_box" id="lieu">
      <?php echo "Lieu"; ?>
    </div>
    <br>
    <div class="eventHeader_box" id="description">
      <?php echo "$eventinfo[description]"; ?>
    </div>

  </div>


  <div id="eventHeader_gestion">


    <div class="eventHeader_gestion_box" id="supprimer">
       <a href="#event_deleter">Supprimer</a>
    </div>



    <div class="eventHeader_gestion_box" id="ajouter_photo">
    <a href="#picture_uploader">  Ajouter une photo</a>
    </div>



    <div class="eventHeader_gestion_box" id="afficher_inscrit">
    <a href="#"> Voir les inscrit</a>
    </div>

    <div class="eventHeader_gestion_box" id="inscrire_event">
   <a href="#"> S'inscrire</a>
   </div>



    <div class="eventHeader_gestion_box" id="signaler">
    <a href="#"> Signaler</a>
    </div>


  </div>

</div>
