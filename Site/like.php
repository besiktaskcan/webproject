
<?php
$q = intval($_GET['q']);
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$bdd2 = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');


		$id_user = $_SESSION['id_user']; //ajout de l'id user connect� �� la session actuelle
    echo "$id_user";
		$id_image = $q; //AJOUTER ICI L'ID DE L'IMAGE A TRAITER !
    echo "$id_image";

		$req = $bdd2->prepare('INSERT INTO aime(id_user, id_image) VALUES(?, ?)'); //enregistrement dans la bdd de id_user+ id_image
		$req->execute(array($id_user, $id_image));
		$reponse = $bdd2->query('SELECT * FROM aime');

?>
