<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>

<?php
$q = htmlspecialchars($_GET["id"]);
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
$sql = $bdd->prepare("SELECT * FROM suggestion_event WHERE id_suggestion = '".$q."'") ;
$sql->execute();
$eventinfo = $sql->fetch();

?>
	<form method="post" enctype="multipart/form-data" action="">	<!--FORMULAIRE AJOUT EVENT-->
	<p>Entrez un titre :</br></br>
  <input name="titre" type="text" value="<?php echo "$eventinfo[name]"; ?>" /></br></br>
	Entrez une description :</br></br>
	<textarea name="description" row="5" cols="70"><?php echo "$eventinfo[description]"; ?></textarea> </br></br>
	Entrez un prix :</br></br>
	<input type="text" name="prix" /> </br></br>
	Entrez une date :</br></br>
	<input type="date" name="date" /> </br></br>
	Ajoutez une image :</br></br>
	<input type="file" name="image" size="64"></br></br></br>
	<input type="submit" name="envoyer" value="Ajouter en tant que nouvel évènement !"></br>
	</p>
	</form>
<?php

	$png = ".png";
 if( isset($_POST['envoyer']) )
	{
	$titre_post = $_POST['titre'];
	$description_post = $_POST['description'];
	$prix_post = $_POST['prix'];
	$date_post = $_POST['date'];

	$status_event = 1;
	$id_user = $_SESSION['id_user']; //ajout de l'id user connecté à la session actuelle

	$content_dir = 'eventimages/'; // dossier où sera déplacé le fichier
	$tmp_image = $_FILES['image']['tmp_name'];
  echo "$date_post";

		if( !is_uploaded_file($tmp_image) ) //verif si le fichier existe
		{ exit("Le fichier est introuvable"); }
		echo "Fichier ajouté en mémoire";
		echo "<br/>";

		$type_file = $_FILES['image']['type']; //verif l'extension jpg/png
		if( !strstr($type_file, 'png') && !strstr($type_file, 'jpeg')&& !strstr($type_file, 'jpg'))
		{ exit("Le fichier n'est pas une image"); }

		$maxsize = 10485760;
		if ($_FILES['image']['size'] > $maxsize)	//verifier la taille en octets
		{ exit ("Le fichier est trop gros"); }
		echo "Le fichier est de la bonne taille !";
		echo "<br/>";

		$maxwidth = 9000;
		$maxheight = 9000;
		$image_length = getimagesize($_FILES['image']['tmp_name']);	//verifier la taille en pixel
		if ($image_length[0] > $maxwidth OR $image_length[1] > $maxheight)
		{ exit("Image trop grande, veillez la réduire un peu !");}
		echo "Image de taille acceptable", "<br/>";


		$name_file = $_FILES['image']['name'];
		$name_file = rand().time();	//random nom du fichier
		$name_file .= ".jpg";
		if( !move_uploaded_file($tmp_image, $content_dir . $name_file) ) //copie du fichier dans le dossier
		{ exit("Impossible de copier le fichier dans $content_dir"); }	//verif si il a été copié
		echo "Le fichier a bien été uploadé !", "<br/>";

      $path = $content_dir . $name_file;

		/*echo $titre_post;			echo "</br>";		DEBUG AFFICHAGE DES VARIABLE SI BESOIN
		echo $description_post;		echo "</br>";
		echo $prix_post;			echo "</br>";
		echo $date_post;			echo "</br>";
		echo $content_dir;			echo "</br>";*/
	

    		$req = $bdd->prepare("INSERT INTO evenement(name, description, date_event, prix_event, id_user, background_img_event)
        VALUES('".$titre_post."','".$description_post."', '".$date_post."', '".$prix_post."', '".$id_user."', '".$path."')");
		$req->execute();

}

?>
</body>
</html>
