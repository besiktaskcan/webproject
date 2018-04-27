<script>
var idimg = 8;
function imageLike(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","like.php?q="+str,true);
        xmlhttp.send();
    }
      return false;
}
</script>


  <form method="post"  onclick="imageLike(this.value)">

  <input type="button" name="like" value="&#128077;"  onclick="imageLike(idimg)">
  </form>
