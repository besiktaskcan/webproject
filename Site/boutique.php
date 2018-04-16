<?php
session_start();
?>
<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="refresh" content=""/>
        <meta name="author" content="Florian Pfeifer">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cantarell?<?php echo time(); ?>" />
        <link rel="stylesheet" media="(orientation:portrait)" href="css/style2.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style-menuBar.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style-slideShowevents.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style-footer.css?<?php echo time(); ?>">

        <title>BDE EXIA CESI ST</title>

        <script>
        function showUser(str) {
          if (str=="") {
            document.getElementById("txtHint").innerHTML="";
            return;
          }
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              document.getElementById("txtHint").innerHTML=this.responseText;
            }
          }
          xmlhttp.open("GET","getimage.php?q="+str,true);
          xmlhttp.send();
        }
        </script>

    </head>




    <body onload="showUser(this.value)">

      <header>
        <?php include("menuBar.php"); ?>
      </header>





        <footer>
          <?php include("footer.php");?>
        </footer>





    </body>
</html>
