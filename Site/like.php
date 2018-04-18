

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');

?>

<form method="post" action="">
<p>
	<input type="submit" name="like" value="+1" />	<!--envoie les donnees-->
</p>
</form>

<?php

	if(isset($_POST['like']))
	{
		$id_user = $_SESSION['id_user']; //ajout de l'id user connecté à  la session actuelle 

		$id_image = 11; //AJOUTER ICI L'ID DE L'IMAGE A TRAITER !

		$req = $bdd->prepare('INSERT INTO aime(id_user, id_image) VALUES(?, ?)'); //enregistrement dans la bdd de id_user+ id_image
		$req->execute(array($id_user, $id_image));
		$reponse = $bdd->query('SELECT * FROM aime');

	/*while ($donnees = $reponse->fetch())	SUPPRIMER SI TESTS CONCLUANTS
	 {										+
			echo "</br>";					+
		echo $donnees['id_image'];			+
		echo "</br>";						+
		echo $donnees['id_user'];			+
	 }										+
	}*/										
?>
</body>
</html>