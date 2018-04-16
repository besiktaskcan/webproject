<?php
session_start();
?>
<!DOCTYPE html>

<!--####################################
 Auteur : Emma Prudent
 Date : 2017
 Contexte : Prosit Exia CESI - PHP/BDD
 #######################################-->

<html>

    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>" />
        <link rel="stylesheet" type="text/css" href="css/styleConnexion.css?<?php echo time(); ?>" />
        <link rel="stylesheet" type="text/css" href="css/animate-custom.css?<?php echo time(); ?>" />
        <link rel="stylesheet" media="(orientation:landscape)" href="css/style-menuBar.css?<?php echo time(); ?>">
        <title>Connexion</title>
    </head>

    <body>

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
                            <form method="post" action="scriptConnexion.php" autocomplete="on">
                                <h1>Connexion</h1>
                                <p>
                                    <label for="username" class="uname" data-icon="u" > Pseudo : </label>
                                    <input id="username" name="pseudo" required="required" type="text" placeholder="pseudo"/>
                                </p>
                                <p>
                                    <label for="password" class="youpasswd" data-icon="p"> Mot de passe : </label>
                                    <input id="password" name="motDePasse" required="required" type="password" placeholder="motdepasse" />
                                </p>

                                <p class="login button">
                                    <input type="submit" value="Connexion" />
                                </p>
                                <p class="change_link">
                                    Pas encore inscrit ?
                                    <a href="#toregister">Inscription</a>
                                </p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  method="post" action="scriptInscription.php" autocomplete="on">
                                <h1> Inscription </h1>
                                <p>
                                    <label for="usernamesignup" class="uname" data-icon="u" >Pseudo : </label>
                                    <input id="usernamesignup" name="pseudo" required="required" type="text" placeholder="pseudo" />
                                </p>

                                <p>
                                    <label for="passwordsignup" class="youpasswd" data-icon="p" >Mot de passe : </label>
                                    <input id="passwordsignup" name="motDePasse" required="required" type="password" placeholder="mot de passe"/>
                                </p>

                                <p class="signin button">
                                    <input type="submit" value="S'inscrire"/>
                                </p>
                                <p class="change_link">
                                    Déjà inscrit ?
                                    <a href="#tologin"> Connexion </a>
                                </p>
                            </form>
                        </div>

                        <div id="logout" class="animate form">
                            <form method="post" action="scriptDeconnexion.php" autocomplete="on">
                                <h1>Déconnexion</h1>


                                <p class="login button">
                                    <input type="submit" value="Déconnexion" />
                                </p>

                            </form>
                        </div>

                    </div>
                </div>
            </section>
        </div>


    </div>

    </body>

</html>
