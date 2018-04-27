<!--TELECHARGER TOUTES LES IMAGES DANS "images_event" pour les membres du cesi-->
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

$zip = new ZipArchive();
		if(is_dir('eventimages/'))        //teste si  dossier existe
    {
           if($zip->open('Image_site_BDE.zip', ZipArchive::CREATE) == TRUE)
     {
      $fichiers = scandir('eventimages/');      // Récupération des fichiers.
      unset($fichiers[0], $fichiers[1]);
      foreach($fichiers as $f)
      {
        if(!$zip->addFile('eventimages/'.$f, $f))        // On ajoute chaque fichier à l’archive
        {
          echo 'Impossible d&#039;ajouter &quot;'.$f.'&quot;.<br/>';
        }
      }
      $zip->close();
	 }
	}
	?>
<a href="Image_site_BDE.zip" download="Image_site_BDE.zip">Images</a>
</body>
</html>
