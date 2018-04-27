<div>

  <a href="#" class="deleteMeetingClose">&times;</a>
  <br/>
	<p>Le fichier dois être une image : JPG, JPEG, PNG avec une taille maximale de 10Mo !</p>
	<form method="post" enctype="multipart/form-data" action="">
		<p>

		<input type="file" name="fichier" size="64"></br></br>
		<input type="submit" name="upload" value="Send your photos !"></br>
		</p>
	</form>
</br></br>
<?php
	$png = ".png";
	$rand = '';

	if( isset($_POST['upload']) ) // vérification si formulaire soumis
	{
		$content_dir = 'eventimages/'; // dossier où sera déplacé le fichier
		$tmp_file = $_FILES['fichier']['tmp_name'];




		if( !is_uploaded_file($tmp_file) ) //verif si le fichier existe
		{ exit("Le fichier est introuvable"); }
		echo "Fichier ajouté en mémoire";
		echo "<br/>";

		$type_file = $_FILES['fichier']['type']; //verif l'extension jpg/png
		if( !strstr($type_file, 'png') && !strstr($type_file, 'jpeg')&& !strstr($type_file, 'jpg'))
		{ exit("Le fichier n'est pas une image"); }

		$maxsize = 10485760;
		if ($_FILES['fichier']['size'] > $maxsize)	//verifier la taille en octets
		{ exit ("Le fichier est trop gros"); }
		echo "Le fichier est de la bonne taille !";
		echo "<br/>";

		$maxwidth = 9000;
		$maxheight = 9000;
		$image_length = getimagesize($_FILES['fichier']['tmp_name']);	//verifier la taille en pixel
		if ($image_length[0] > $maxwidth OR $image_length[1] > $maxheight)
		{ exit("Image trop grande, veillez la réduire un peu !");}
		echo "Image de taille acceptable";
		echo "<br/>";

		$name_file = $_FILES['fichier']['name'];
		$name_file = rand().time();	//random nom du fichier
		$name_file .= ".jpg";
		if( !move_uploaded_file($tmp_file, $content_dir . $name_file) ) //copie du fichier dans le dossier
		{ exit("Impossible de copier le fichier dans $content_dir"); }	//verif si il a été copié


    $path = $content_dir . $name_file;

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO image_event (image, id_event) VALUES ('".$path."', '".$q."')";
        // use exec() because no results are returned
        $bdd->exec($sql);
        echo "New record created successfully";
          }
    catch (PDOException $e) {
      die("L'accès à la base de donnée est impossible.");
      echo $sql . "<br>" . $e->getMessage();
      }

		echo "Le fichier a bien été uploadé !";
    $bdd = null;

	}

?>




</div>
