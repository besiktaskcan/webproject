<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
try {
      //on se connecte à MySQL
      $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');

      if(isset($_POST['forminscription']))
      {
         $prenom = htmlspecialchars($_POST['prenom']);
         $nom = htmlspecialchars($_POST['nom']);
         $email = htmlspecialchars($_POST['email']);
         $mdp = sha1($_POST['mdp']);
         $mdp2 = sha1 ($_POST['mdp2']);
         //$role = htmlspecialchars($_POST['role']);
         //$longpassw = strlen($mdp);

        //si les variables ne sont pas vides on execute la requete prepare
        if (!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
        {
           $reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
           $reqmail->execute(array($email));
           //la variable existmail permet de determiner si le mail existe deja grace a la fonction rowCount
           $existmail = $reqmail->rowCount();
           //si le mail entré n'existe pas on continue
           if($existmail == 0)
           {
             //si les deux mots de passes sont égaux alors on execute la requete Insert
               if ($mdp == $mdp2) {
                 $insertmbr = $bdd->prepare("INSERT INTO utilisateur(firstname, name, mail, password, role) VALUES(?, ?, ?, ?, 1)");
                 $insertmbr->execute(array($prenom, $nom, $email, $mdp));
                 $erreur = "Votre compte a bien été crée ! <a href=\"connexion.php\">Me connecter</a>";
               } else {
                 $erreur = "Les mots de passe ne correspondent pas !";
                 }
           } else {
             $erreur = "Adresse email déjà utilisée !";
           }
        } else {
          $erreur = "Tous les champs doivent être complétés !";
        }
      }

} catch (Exception $e) {
         //En cas d'erreur, on affiche un message et on arrête tout
         die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cantarell?<?php echo time(); ?>" />
        <link rel="stylesheet" media="(orientation:portrait)" href="css/style.css?<?php echo time(); ?>">
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style.css?<?php echo time(); ?>">
        <link rel="stylesheet"  href="css/style-menuBar.css?<?php echo time(); ?>">
        <link rel="stylesheet"  href="css/style-slideShow.css?<?php echo time(); ?>">
        <link rel="stylesheet"  href="css/style-footer.css?<?php echo time(); ?>">
        <link rel="stylesheet"  href="css/styleInscription.css?<?php echo time(); ?>">
        <title>Inscription</title>
    </head>

    <body id="s1_enventlist">

    <!-- L'en-tête -->
    <header>
    <?php include("menuBar.php"); ?>
    </header>



    <!-- Le corps -->
    <div id="corps">


<div class="container">


        <section class="noS">
          <div id="container" >
              <a class="hiddenanchor" id="toregister"></a>
              <a class="hiddenanchor" id="tologin"></a>
              <a class="hiddenanchor" id="tologout"></a>
              <div id="wrapper">
                 <div id="login" class="animate form">
                  <form method="post" action="" autocomplete="on">
                    <h1>Inscription</h1>
                      <table>
                       <tr>
                         <td align="left">
                           <label for="prenom">Prénom</label>
                         </td>
                         <td>
                           <input type="text" placeholder="Votre prénom..." name="prenom" id="prenom"/>
                         </td>
                      </tr>
                      <tr>
                         <td align="left">
                           <label for="nom">Nom</label>
                         </td>
                         <td>
                           <input type="text" placeholder="Votre nom..." name="nom" id="nom"/>
                         </td>
                      </tr>
                      <tr>
                         <td align="left">
                           <label for="email">E-mail</label>
                         </td>
                         <td>
                           <input type="email" placeholder="Votre email..." name="email" id="email"/>
                         </td>
                     </tr>
                     <tr>
                         <td align="left">
                           <label for="mdp">Mot de passe</label>
                         </td>
                         <td>
                           <input type="password" placeholder="Votre mot de passe..." name="mdp" id="mdp"/>
                         </td>
                    </tr>
                    <tr>
                         <td align="left">
                           <label for="mdp2">Confirmation du mot de passe</label>
                         </td>
                         <td>
                           <input type="password" placeholder="Confirmez votre mdp..." name="mdp2" id="mdp2"/>
                         </td>
                    <tr>
                         <td></td>
                         <td>
                           <p class="signin button">
                               <input type="submit" name="forminscription" value="Je m'inscris"/>
                           </p>
                           <p class="change_link">
                              Déjà inscrit ?
                              <a href=connexion.php> Connexion </a>
                           </p>
                         </td>
                    </tr>
                 </table>
               </form>
               </br>
               <?php
                 if (isset($erreur))
                 {
                   echo '<font color="red">'.$erreur."</font>";
                 }
               ?>
              </div>
             </div>
           </div>
        </section>
</div>
    </div>
</body>


<footer>
  <?php include("footer.php");?>
</footer>

</html>
