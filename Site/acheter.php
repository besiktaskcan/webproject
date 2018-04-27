
					
						<?php
						
						 error_reporting(E_ALL);
						 ini_set('display_errors', 1);
						
						try {$bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root', '');
						
						session_start();
						
						
						if( isset($_POST['ajouter_panier']))
						{							
							$quantite = 1;//$_POST['quantite'];
							$id_commande = 1;//$_POST['id_commande'];
							$id_goodie = 1;//$_POST['id_goodie'];
							//$id_user = 7;//$_SESSION['id_user'];

							$req=$bdd->prepare("INSERT INTO contient (quantite, id_commande, id_goodie) VALUES(?,?,?)");
							
							$req->execute(array($quantite, $id_commande, $id_goodie));
							echo ''.$quantite.'';
							echo ''.$id_commande.'';
							echo ''.$id_goodie.'';
							var_dump($_POST);
							}
						}catch (Exception $e) { die('Erreur : ' . $e->getMessage());}
						
							
						
							?>
							<!DOCTYPE html>
							<html>
							<form method="post" action="acheter.php">
					<input type="submit" name="ajouter_panier" value="test">
					</form>
					</html>