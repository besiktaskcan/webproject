<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
    <form method="post" action="">
      <a href="#eventlist_suggestion_section" class="deleteMeetingClose">&times;</a>
      <br/>
    <p>
        Entrez un titre : </br>
        <input type="text" name="name" /> </br></br> <!--ajout du titre-->
        Entrez votre description : </br>
        <textarea name="description" row="5" cols="70"></textarea> </br></br><!--ajout description!-->
        <input type="submit" name="envoie" value="Ajouter l'évènement" /><!--envoie des donnees-->
    </p>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');

  if(isset($_POST['envoie']))
  {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id_user = $_SESSION['id_user'];		//ajout de l'id user connecté à la session actuelle

    $req = $bdd->prepare('INSERT INTO suggestion_event(name, description, id_user) VALUES(?, ?, ?)'); //enregistrement dans la bdd
    $req->execute(array($name, $description, $id_user));
  }
?>
</body>
</html>
