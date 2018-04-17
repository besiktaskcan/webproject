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

$con = mysqli_connect('localhost','root','','BDE');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

header('Content-type: text/html; charset=iso-8859-1');

$sql="SELECT * FROM image_goodie";
$result = mysqli_query($con,$sql);

$sql2="SELECT * FROM goodie";
$result2 = mysqli_query($con,$sql2);

echo '<div id ="eventPictures_section">';
echo '<div id="eventPictures_title">';
echo '<h2>Les goodies:</h2>';
echo '</div>';
echo '<div id="eventPictures_container">';
while($row = mysqli_fetch_array($result) and $row2 = mysqli_fetch_array($result2)) {
    echo '<div class="eventPictures_box">';
		echo '<div class="event_picture" >
					<img src='.$row["image"].'>
					</div>';
					echo '<div class=boutique_article_infos>
								<p>'.$row2["description"].'</p>
							</div>';
		echo "</div>";
}
	echo "</div>";
echo "</div>";
mysqli_close($con);
?>
</body>
</html>
