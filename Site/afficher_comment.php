<!--
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
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');


$id_image = 11;

	$query = $bdd->query("SELECT * FROM image_comment WHERE id_image = '".$id_image."'");//afficher les commentaires
	$comments = $query->fetchAll();

	foreach($comments as $comment) {
		echo $comment['comment_text'].'<br />';
		echo $comment['id_user'].'<br />';
	}
	
	$query->closeCursor();


?>
</body>
</html>
