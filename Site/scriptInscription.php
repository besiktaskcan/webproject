<?php

session_start();
$_SESSION["pseudo"]=$_POST["pseudo"];
$_SESSION["motDePasse"]=$_POST["motDePasse"];

try {$bdd = new PDO('mysql:host=localhost;dbname=giselleshop;charset=utf8', 'root', '');}
catch (Exception $e) {die("L'accès à la base de donnée est impossible.");}


    $st = $bdd->query("SELECT COUNT(*) FROM utilisateurs WHERE pseudo='".$_SESSION["pseudo"]."' AND motDePasse='".$_SESSION["motDePasse"]."'")->fetch();
    if ($st['COUNT(*)'] == 1){echo "Déjà pris";;}

    else{
      $pseudo = $_POST['pseudo'];
      $motDePasse = $_POST['motDePasse'];

      $requete = $bdd->prepare("INSERT INTO utilisateurs (pseudo, motDePasse) VALUES( :pseudo,:motDePasse)");

      $requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
      $requete->bindValue(':motDePasse', $motDePasse, PDO::PARAM_STR);

      $requete->execute();
      header("Location: index.php");
  }

?>
