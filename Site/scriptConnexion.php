<?php

       session_start();
$_SESSION["pseudo"]=$_POST["pseudo"];
$_SESSION["motDePasse"]=$_POST["motDePasse"];

try {$bdd = new PDO('mysql:host=localhost;dbname=giselleshop;charset=utf8', 'root', '');}
catch (Exception $e) {die("L'accès à la base de donnée est impossible.");}

if (empty($_SESSION["pseudo"]) or empty($_SESSION['motDePasse'])) {
    echo "veuillez saisir un login et un mot de passe";
}
else {
    $st = $bdd->prepare("SELECT COUNT(*) FROM utilisateurs WHERE pseudo='".$_SESSION["pseudo"]."' AND motDePasse='".$_SESSION["motDePasse"]."'")->fetch();
    if ($st['COUNT(*)'] == 1)
      $st->execute();
        header("Location: index.php");
}
?>
