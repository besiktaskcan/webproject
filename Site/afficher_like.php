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

$image = 11;

	$nbr_like = $bdd->query('SELECT COUNT(*) as total_vote FROM aime WHERE id_image = 11');//afficher les likes

	$donnees = $nbr_like->fetch();
	$nbr_like->closeCursor();
	echo $donnees['total_vote'];
?>
</body>
</html>