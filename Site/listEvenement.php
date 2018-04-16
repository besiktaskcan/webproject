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

        <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $bdd->prepare("SELECT * FROM evenement") ;
            $sql->execute();

            if(isset($_POST['voir_info_event']))
            {
              header("Location: Evenements.php?id=".$_POST['postid_event']);
            }
            ?>
            <div id="eventlist_section">
            <?php        // On affiche chaque entrée une à une
              while ($eventinfo = $sql->fetch())
              {
              ?>
                  <div id="eventlist_container">
                    <form method="post" action="" autocomplete="on">
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
                      
                      <?php echo '<input name="postid_event" type="text" value='. $eventinfo["id_event"].' />'; ?>
                      <input type="submit" name="voir_info_event" value="Voir les information">
                      </form>
                 </div>


              <?php
              }


              $sql->closeCursor(); // Termine le traitement de la requête
            }

        catch (PDOException $e) {
          die("L'accès à la base de donnée est impossible.");
          echo $sql . "<br>" . $e->getMessage();
          }
        ?>
        </div>
    </body>

    <footer>
      <?php include("footer.php");?>
    </footer>
</html>
<?php
?>
