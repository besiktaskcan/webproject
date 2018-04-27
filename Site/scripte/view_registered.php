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
<p>List des inscrits!</p>

</br>

<?php
try
{
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');


    // On recupere tout le contenu de la table Client
$sql = $bdd->prepare("SELECT name, firstname, mail FROM utilisateur RIGHT JOIN participe ON utilisateur.id_user = participe.id_user  WHERE participe.id_event = '".$q."'");

  $sql->execute();
// On affiche le resultat
while ($donnees = $sql->fetch())
{
    //On affiche l'id et le nom du client en cours
    echo "<p> $donnees[name] $donnees[firstname]  ($donnees[mail]) </p>";



}
$sql->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>


</div>
