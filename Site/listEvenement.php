<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page-->
        <title>BDE EXIA CESI ST</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cantarell?<?php echo time(); ?>" />
        <link rel="stylesheet" media="(orientation:portrait)" href="css/style2.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style-menuBar.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style-slideShowevents.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style-footer.css?<?php echo time(); ?>">
    </head>

    <body>
        <!-- Corps de la page-->
        <header>
          <?php include("menuBar.php"); ?>
        </header>

        <div id="Formul_boite_idee" class="box_window"><?php include("boite_id.php") ?></div>


        <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $bdd->prepare("SELECT * FROM evenement WHERE date_event > CURRENT_DATE") ;
            $sql->execute();

            if(!empty($_SESSION['id_user']))
            {
              if($_SESSION['role']==2) {}


            else{
            ?>
            <style type="text/css">#creat_event{
            visibility: hidden;
            }</style>
            <?php
            }
            }

            if(isset($_POST['voir_info_event']))
            {
              if(empty($_SESSION['id_user']))
              {
                header("Location:connexion.php");
              }
              else
              {
                header("Location: Evenements.php?id=".$_POST['postid_event']);
              }
            }

            if(isset($_POST['creat_event']))
            {
              header("Location: form_new_event.php?id=".$_POST['postid_suggestion']);
            }




            ?>
            <div id="eventlist_section">

              <h2 style="color: white;">Prochains événements</h2>

            <?php        // On affiche chaque entrée une à une
              while ($eventinfo = $sql->fetch())
              {
              ?>
                  <div id="eventlist_prochain_container">

                      <div class="eventinfo">
                        Événement n°<?php echo $eventinfo['id_event']; ?>
                      </div>
                      <br/>
                      <div class="eventinfo" id="name_event">
                        <?php echo $eventinfo['name']; ?>
                      </div>
                      <br/>
                      <div class="eventinfo" id="description_event">
                      <?php echo $eventinfo['description']; ?>
                      </div>
                      <br/>
                      <div class="eventinfo" id="date_event">
                      <?php echo $eventinfo['date_event']; ?>
                      </div>
                      <div class="eventinfo" id="prix_event">
                      <?php echo $eventinfo['prix_event'];?>€
                      </div>
                      <br/>
                      <form method="post" action="" autocomplete="on">
                      <?php echo '<input name="postid_event" type="text" value='. $eventinfo["id_event"].' />'; ?>
                      <input type="submit" name="voir_info_event" value="Voir les information">
                      </form>
                 </div>
              <?php
              }
              $sql->closeCursor(); // Termine le traitement de la requête
              $sql = $bdd->prepare("SELECT * FROM evenement WHERE date_event < CURRENT_DATE") ;
              $sql->execute();

              ?>

                <h2 id="eventlist_passer_title" style="color: white;">Événements passés</h2>
              <?php        // On affiche chaque entrée une à une
                while ($eventinfo = $sql->fetch())
                {
                ?>
                    <div id="eventlist_passer_container">

                        <div class="eventinfo">
                          Événement n°<?php echo $eventinfo['id_event']; ?>
                        </div>
                        <br/>
                        <div class="eventinfo" id="name_event">
                          <?php echo $eventinfo['name']; ?>
                        </div>
                        <br/>
                        <div class="eventinfo" id="description_event">
                        <?php echo $eventinfo['description']; ?>
                        </div>
                        <br/>
                        <div class="eventinfo" id="date_event">
                        <?php echo $eventinfo['date_event']; ?>
                        </div>
                        <div class="eventinfo" id="prix_event">
                        <?php echo $eventinfo['prix_event'];?>€
                        </div>
                        <br/>
                        <form method="post" action="" autocomplete="on">
                        <?php echo '<input name="postid_event" type="text" value='. $eventinfo["id_event"].' />'; ?>
                        <input type="submit" name="voir_info_event" value="Voir les information">
                        </form>
                   </div>

                   <?php
                   }
                   $sql->closeCursor(); // Termine le traitement de la requête

               $sql = $bdd->prepare("SELECT * FROM suggestion_event") ;
               $sql->execute();


               ?>

               <h2 id="eventlist_boite_id" style="color: white;">Boite à idées</h2>
            <div class="listevent_gestion_box" id="propose_event">
           <a href="#Formul_boite_idee"> Proposer un Événement! </a>
         </div>
               <?php        // On affiche chaque entrée une à une
                 while ($eventinfo = $sql->fetch())
                 {
                   $reqUsername = $bdd->prepare('SELECT utilisateur.name, utilisateur.firstname FROM utilisateur RIGHT JOIN suggestion_event ON suggestion_event.id_user = utilisateur.id_user WHERE utilisateur.id_user =  "'.$eventinfo["id_user"].'" ');
                   $reqUsername->execute();
                   $Username = $reqUsername->fetch();
                 ?>
                     <div id="eventlist_suggestion_container">

                         <div class="eventinfo">
                           Idée n°<?php echo $eventinfo['id_suggestion']; ?>
                         </div>
                         <br/>
                         <div class="eventinfo" id="name_event">
                           <?php echo $eventinfo['name']; ?>
                         </div>
                         <br/>
                         <div class="eventinfo" id="description_event">
                         <?php echo $eventinfo['description']; ?>
                         </div>
                         <br/>
                         <div class="eventinfo" id="date_event">
                         <?php echo $eventinfo['date_suggestion']; ?>
                         </div>
                         <br/>
                         <div class="eventinfo" id="username_event">
                           Proposé par :
                         <?php echo $Username['name']; echo "  "; echo $Username['firstname'];?>
                         </div>

                         <br/>
                         <form method="post" action="" autocomplete="on">
                         <?php echo '<input name="postid_suggestion" type="text" value='. $eventinfo["id_suggestion"].' />'; ?>
                         <input id="creat_event" type="submit" name="creat_event" value="Créer l'événement">
                         </form>

                    </div>

                    <?php
                    }
                    $sql->closeCursor(); // Termine le traitement de la requête
                    ?>


              </div>

<?php
 }
        catch (PDOException $e) {
          die("L'accès à la base de donnée est impossible.");
          echo $sql . "<br>" . $e->getMessage();
          }
        ?>



    </body>

    <footer>
      <?php include("footer.php");?>
    </footer>
</html>
<?php
?>
