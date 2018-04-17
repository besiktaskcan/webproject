
<?php
$q = intval($_GET['q']);
$con = mysqli_connect('localhost','root','','BDE');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


<<<<<<< HEAD
$sql="SELECT * FROM image_event WHERE id_event = '".$q."'";
=======
$sql="SELECT * FROM image_goodie";
>>>>>>> Boutique
$result = mysqli_query($con,$sql);

$sql2="SELECT * FROM goodie";
$result2 = mysqli_query($con,$sql2);

echo '<div id ="eventPictures_section">';
echo '<div id="eventPictures_title">';
echo '<h2>Images de l\'évènement</h2>';
echo '</div>';
echo '<div id="eventPictures_container">';
while($row = mysqli_fetch_array($result)) {
    echo '<div class="eventPictures_box">';
<<<<<<< HEAD
    echo '<div class="event_picture"><img src='.$row["image"].' /></div>';
    echo '<div class="likes_box" id="event_picture_like"><a href="#"><img src="images/like.svg" alt="like"/> </a></div>';
    echo '  <div class="likes_box" id="event_picture_number_of_likes">  Likes </div>';
    echo "</div>";
=======
		echo '<div class="event_picture" >
					<img src='.$row["image"].'/>
					</div>';
					echo '<div class=boutique_article_infos>
								<p>.$row["description"].</p>
							</div>';
		echo "</div>";
>>>>>>> Boutique
}
	echo "</div>";
echo "</div>";
mysqli_close($con);
?>
