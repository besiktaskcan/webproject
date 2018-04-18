<!DOCTYPE html>
<html>
<head>
<style>
table {

    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
session_start();

$con = mysqli_connect('localhost','root','','BDE');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

header('Content-type: text/html; charset=iso-8859-1');

$sql="SELECT * FROM image_goodie";
$result = mysqli_query($con,$sql);

$sql2="SELECT * FROM goodie";
$result2 = mysqli_query($con,$sql2);

echo '<div id ="goodies_section">';
echo '<div id="eventPictures_title">';
echo '<h2>Les goodies:</h2>';
echo '</div>';
echo '<div id="eventPictures_container">';
while($row = mysqli_fetch_array($result) and $row2 = mysqli_fetch_array($result2)) {
   
   // the image
   echo '<div class="eventPictures_box">
				<div class="event_picture" >
					<img src='.$row["image"].'>
				</div>';
					
					// description part
					echo '<div class=boutique_article_infos>
								<p>'.$row2["description"].'</p>';
					
					// buy button
					/*echo'<form method="post" action="">
						<div class="eventHeader_gestion_box" id="acheter_goodie">
								<input type="button" name="ajouter_panier" value="Acheter"/>
							</div>
							 </form>';
							
							//name="'.$row2["id_goodie"].'" */
					?>
					<form method="post" action="acheter.php">
					<input type="submit" name="ajouter_panier" value="test">
					</form>
					
					
					
						<?php
						
						
						
						/*
						if( isset($_POST['ajouter_panier']))
						{							
							$quantite = 1;//$_POST['quantite'];
							$id_commande = 1;//$_POST['id_commande'];
							$id_goodie = 1;//$_POST['id_goodie'];
							//$id_user = 7;//$_SESSION['id_user'];
							echo "hello";
							$req=$bdd->prepare("INSERT INTO contient (quantite, id_commande, id_goodie) VALUES(?, ?, ?)");
							$req->execute(array($quantite, $id_commande, $id_goodie));
							
							
							
							
							
							
						}*/


							
				echo'</div>';
		echo "</div>";
}
	echo "</div>";
	
	/*
	try {
	$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
	$req=$bdd->prepare("INSERT INTO contient (quantite, id_commande, id_goodie) VALUES(?, ?, ?)");
	//echo '<p>'.$_POST['ajouter_panier'].'</p>';
	var_dump($_POST);
	if(isset($_POST['ajouter_panier']))
	{
		var_dump($_POST);
		$quantite = 1;//$_POST['quantite'];
		$id_commande = 1;//$_POST['id_commande'];
		$id_goodie = 1;//$_POST['id_goodie'];
		$id_user = 7;//$_SESSION['id_user'];
		$req->execute(array($quantite, $id_commande, $id_goodie));
		echo "boucle";
	}
	
	
} catch (Exception $e) {
	die("L'accès à la base de donnée est impossible.");
}*/
	
mysqli_close($con);
?>
</body>
</html>
