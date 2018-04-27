<style type="text/css">
.non {
    border-bottom: 1px solid #777777;
    border-left: 1px solid #000000;
    border-right: 1px solid #333333;
    border-top: 1px solid #000000;
    color: #000000;

    height: 18px;
    padding: 1px;
    font-size: 15px;
    width: 35px;
    text-decoration: none;
}
</style>

<div class="">

<a href="#" class="deleteMeetingClose">&times;</a>
<br/>
<p>Etes vous sûr de vouloir vous inscrire à cette événement?</p>
<form method="post" enctype="multipart/form-data" action="">
  <p>

  <input type="submit" name="registration" value="Oui"></br>

  <a class="non" href="#">Non</a>
  </p>
</form>
</br></br>



<?php

if( isset($_POST['registration']) ) // vérification si formulaire soumis
{

try {$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');}
catch (PDOException $e) {die("L'accès à la base de donnée est impossible."); echo $sql . "<br>" . $e->getMessage();}
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $bdd->prepare("INSERT INTO participe(id_user, id_event) VALUES(?, ?)") ;
    $sql->execute(array($_SESSION['id_user'], $q));
    $bdd = null;
    echo "<script>window.location.href='listEvenement.php'</script>";



}
    ?>


</div>
