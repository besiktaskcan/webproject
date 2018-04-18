
<?php
$q = intval($_GET['q']);
try {
    $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $bdd->prepare("SELECT * FROM image_event WHERE id_event = '".$q."'") ;
    $sql->execute();


    ?>
    <div id="eventPictures_section">
        <div id="eventPictures_title">
        <h2>Images de l'évènement</h2>
        </div>
        <div id="eventPictures_container">
          <?php        // On affiche chaque entrée une à une
            while ($row = $sql->fetch())
            {
              ?>
              <div class="eventPictures_box">
              <?php echo '<div class="event_picture"><img src='.$row["image"].' /></div>'; ?>
              <div class="likes_box" id="event_picture_like"><a href="#"><img src="images/like.svg" alt="like"/> </a></div>
              <div class="likes_box" id="event_picture_number_of_likes">  Likes </div>
              </div>
              <?php
            }
              ?>
          </div>
    </div>
      <?php
      $sql->closeCursor(); // Termine le traitement de la requête
    }

catch (PDOException $e) {
  die("L'accès à la base de donnée est impossible.");
  echo $sql . "<br>" . $e->getMessage();
  }
?>
