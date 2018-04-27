
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');


	$nbr_like = $bdd->query("SELECT COUNT(*) as total_vote FROM aime WHERE id_image = '".$row["id_image"]."'");

	$donnees = $nbr_like->fetch();
	$nbr_like->closeCursor();
	echo $donnees['total_vote'];

?>
