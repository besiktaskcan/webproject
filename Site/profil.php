<?php
session_start();
try {
      //on se connecte à MySQL
      $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
      if(isset($_GET['id_user']) AND $_GET['id_user'] > 0)
      {
          $getid = intval($_GET['id_user']);
          $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE id_user = ?");
          $requser->execute(array($getid));
          

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
        <title>Profil de <?php echo $_SESSION['firstname'] ?></title>
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



    </body>
</html>
<?php
?>
