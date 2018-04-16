
<?php

$image = basename($_FILES['image']['name']);

$dossier = '/nom du dossier';<br> $extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['image']['name'], '.');
//Tu fais les vérifications nécéssaires
if(!in_array($extension, $extensions))
 //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
}
//S'il n'y a pas d'erreur
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier,
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier))
 //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
//La tu insère le nom du fichier dans ta table
$req = $bdd->prepare('INSERT INTO nom_table(image) VALUES(:image)'); // Evidemment il faut mettre un WHERE .. = .. (car l'image est forcément liée à un utilisateur?)
$req->execute(array($fichier));
$req->closeCursor();
 else
 //Sinon (la fonction renvoie FALSE.
     {

          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}

?>
