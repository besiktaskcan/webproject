<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}


if(!empty($_SESSION['id_user']))
{
  ?>
  <style type="text/css">#connexion_box{
  display: none;
  }</style>
  <?php
}






   ?>

<div id="bar">

    <div id="title">
      <a href="index.php">
      <img id="logo" src="images/logo.png" alt="logo du BDE"/>
              <p id="title_text">BDE EXIA CESI ST</p>
      </a>
    </div>


            <div class="box"><a href="boutique.php">Boutique</a>

            </div>
            <div class="box"><a href="listEvenement.php">Événements</a>
                        <ul id="list">
                              <li><a href="listEvenement.php">A venir</a></li>
                              <li><a href="listEvenementPasser.php">Passé</a></li>
                              <li><a href="ListIdee.php">Boite à idées</a></li>
                            
                        </ul>
            </div>
            <div class="box" id="connexion_box"><a href="connexion.php"> Connexion </a></div>


           <div class="box">
             <?php
             if(!empty($_SESSION['id_user'])) {
                 echo "<a href='scripte/logout.php'>Déconnexion</a>";
             }
             ?>
           </div>

            <div class="social">
                <a href="https://www.facebook.com/BdeExiaStrasbourg/">
                  <img  src="images/facebook-lettre-logo.png" alt="facebook"/>
                </a>
            </div>
            <div class="social">
                <a href="https://twitter.com/bdeexiastrg?lang=fr">
                  <img  src="images/twitter.png" alt="twitter"/>
                </a>
            </div>



</div>
