
<?php
$q = intval($_GET['q']);
$con = mysqli_connect('localhost','root','','BDE');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


$sql="SELECT * FROM image_event WHERE id_event = '".$q."'";
$result = mysqli_query($con,$sql);

echo '<div id ="eventPictures_section">';
echo '<div id="eventPictures_title">';
echo '<h2>Images de l\'évènement</h2>';
echo '</div>';
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
