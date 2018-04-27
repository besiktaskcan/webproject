

<div class="">

<a href="#" class="deleteMeetingClose">&times;</a>
<br/>
<p>Etes vous sûr de vouloir supprimer cette événement?</p>
<form method="post" enctype="multipart/form-data" action="">
  <p>

  <input type="submit" name="delete" value="Oui"></br>

  <a class="non" href="#">Non</a>
  </p>
</form>
</br></br>



<?php

if( isset($_POST['delete']) ) // vérification si formulaire soumis
{

try {$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');}
catch (PDOException $e) {die("L'accès à la base de donnée est impossible."); echo $sql . "<br>" . $e->getMessage();}
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $bdd->prepare("SELECT id_image FROM image_event WHERE id_event='".$q."'") ;
    $sql->execute();
      $i = $sql->fetch();
    $bdd->beginTransaction();
    $bdd->exec("DELETE FROM aime WHERE id_image ='".$i['id_image']."'") ;
    $bdd->exec("DELETE FROM image_event WHERE id_event ='".$q."'") ;
    $bdd->exec("DELETE FROM participe WHERE id_event ='".$q."'") ;
    $bdd->exec("DELETE FROM evenement WHERE id_event ='".$q."'") ;
    $bdd->commit();
    $bdd = null;
    echo "<script>window.location.href='index.php'</script>";



}
    ?>


</div>
