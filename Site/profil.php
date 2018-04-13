<?php
session_start();

try {
      //on se connecte à MySQL
      $bdd = new PDO('mysql:host=localhost;dbname=bdeweb;charset=utf8', 'root', 'root');

      if(isset($_GET['id']) AND $_GET['id'] > 0)
      {
          $getid = intval($_GET['id']);
          $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
          $requser->execute(array($getid));
          $userinfo = $requser->fetch();
      }
} catch (Exception $e) {
         //En cas d'erreur, on affiche un message et on arrête tout
         die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page-->
        <title>Profil de <?php echo $userinfo['prenom']; ?></title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>" />
        <link rel="stylesheet" type="text/css" href="css/styleInscription.css?<?php echo time(); ?>" />
        <link rel="stylesheet" type="text/css" href="css/animate-custom.css?<?php echo time(); ?>" />
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style-menuBar.css?<?php echo time(); ?>">
    </head>

    <body>
        <!-- Corps de la page-->
        <header>
          <?php include("menuBar.php"); ?>
        </header>


        <?php
        if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
        ?>
        <div class="deconnexion">
          <a href="deconnexion.php">Se déconnecter</a>
        </div>
        <?php
        }
        ?>
    </body>
</html>
<?php

?>
