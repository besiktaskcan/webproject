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


$sql="SELECT * FROM image_event";
$result = mysqli_query($con,$sql);

echo '<div id ="eventPictures_section">';
echo '<div id="eventPictures_title">';
echo '<h2>Images de l\'évènement</h2>';
echo '</div>';
echo '<div id="eventPictures_container">';
while($row = mysqli_fetch_array($result)) {
    echo '<div class="eventPictures_box">';
    echo '<div class="event_picture"><img src='.$row["image"].' /></div>';
    echo "</div>";
}
echo "</div>";
echo "</div>";
mysqli_close($con);
?>
</body>
</html>
