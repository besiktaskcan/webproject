<!--
enregistrer dans la bdd :
- le commentaire avec une variable
- l'id User   -> super globale session
- l'id de l'image qui est dans le cadre généré auto


INSERT_INTO IMAGE_COMMENT (comment_text, id_image) VALUES(?, ?)'



SELECT FROM IMAGE_COMMENT (1) , (2) , (3) WHERE id_image = $var

-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
?>
<form method="post" action="">
	<textarea style="resize: vertical;"name="comment_message" row="20" cols="40" placeholder="Entrez votre message"></textarea> </br></br>
	<input type="submit" name="comment" value="Envoyer" />
</form>
<?php

if(isset($_POST['comment']))
	{

		$comment_text = $_POST['comment_message'];
		//$id_user = $_SESSION['id_user']; //ajout de l'id user connecté à  la session actuelle
		$id_user = 1;
		$id_image = 1; //AJOUTER ICI L'ID DE L'IMAGE A TRAITER !

		$req = $bdd->prepare('INSERT INTO image_comment(comment_text, id_user, id_image) VALUES(?, ?, ?)'); //enregistrement dans la bdd de id_user+ id_image
		$req->execute(array($comment_text, $id_user, $id_image));


		$reponse = $bdd->query('SELECT * FROM image_comment');

	while ($donnees = $reponse->fetch())
	 {
		echo "</br>";
		echo $donnees['comment_text'];
		echo "</br>";
		echo $donnees['id_user'];
		echo "</br>";
		echo $donnees['id_image'];
	 }
	}


//"'".$id_image."'"







?>
</body>
</html>
