<<<<<<< HEAD:Site/getimage.php

<?php
$q = intval($_GET['q']);
$con = mysqli_connect('localhost','root','','BDE');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


$sql="SELECT * FROM image_event WHERE id_event = '".$q."'";
$result = mysqli_query($con,$sql);


echo '<div id="eventPictures_container">';
while($row = mysqli_fetch_array($result)) {
    echo '<div class="eventPictures_box">';
    echo '<div class="event_picture"><img src='.$row["image"].' /></div>';
    echo '<div class="likes_box" id="event_picture_like"><a href="#"><img src="images/like.svg" alt="like"/> </a></div>';
    echo '  <div class="likes_box" id="event_picture_number_of_likes">  Likes </div>';
    echo "</div>";
}
echo "</div>";
echo "</div>";
mysqli_close($con);
?>
=======
<!DOCTYPE html>
<html>
<head>
<style>
p
{
	font-size: 15px;
}
#cart_container
{
	padding:10px 10px 10px 10px;
	border: groove;
}
</style>
</head>
<body>

<?php
session_start();
$con = mysqli_connect('localhost','root','','BDE');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

header('Content-type: text/html; charset=iso-8859-1');
$id_user = 7;

$sql="SELECT quantite, goodie.name, goodie.prix_goodie
FROM utilisateur
JOIN commande
ON utilisateur.id_user = commande.id_user
JOIN CONTIENT
ON commande.id_commande = CONTIENT.id_commande
JOIN goodie
ON goodie.id_goodie = contient.id_goodie
WHERE utilisateur.id_user=7";


$result = mysqli_query($con,$sql);
$sql2="SELECT SUM(goodie.prix_goodie) AS prix
FROM utilisateur
JOIN commande
ON utilisateur.id_user = commande.id_user
JOIN CONTIENT
ON commande.id_commande = CONTIENT.id_commande
JOIN goodie
ON goodie.id_goodie = contient.id_goodie
WHERE utilisateur.id_user=7";
$result2 = mysqli_query($con,$sql2);
echo '<div id ="goodies_section">';
	echo '<div id="eventPictures_title">';
	echo '<h2>Votre commande:</h2>';
		echo '</div>';
			echo '<div id="eventPictures_container">';
			$row2 = mysqli_fetch_array($result2);
			while($row = mysqli_fetch_array($result)) {

			// description part
			echo '<div id="cart_container">';
				echo '<p>Nombre: '.$row["quantite"].'</p>';
				echo '<p>Produit: '.$row["name"].'</p>';
				echo '<p>Prix:'.$row["prix_goodie"].' Euros</p>';
				echo "</div>";
}
		echo '<p>Prix total: '.$row2["prix"].'';
		echo "</div>";
		echo "</div>";
	echo "</div>";
mysqli_close($con);
?>
</body>
</html>
>>>>>>> Boutique:Site/GetCart.php
