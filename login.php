<?php require('inc_connexion.php');?>
<?php require('inc_header.php') ?>
<?php
	session_start();
	if (isset($_SESSION['user_login']))
		header('location:index.php');
	
	if (isset($_POST['submit_form'])) {
		$user_input_login = $_POST['user_input_login'];
		$user_input_password = $_POST['user_input_password'];
		// Vérification si les variables sont vides
		if ((empty($user_input_login)) OR empty($user_input_password))
			{
				$message = '<p class="error">Vous devez saisir les informations demandées.</p>';
			}
			else
			{
				/* le login saisi correspond-il à une valeur existant dans la BDD ?
				Nous posons la requête avec la clause WHERE portant sur le login */
				$result = $mysqli->query('SELECT user_login, user_password FROM users WHERE user_login = "' . $user_input_login .'"');
				$row = $result->fetch_array();
				if (!isset($row['user_login']))
				{
					// La requete ne retourne aucun résultat pour ce login
					$message = '<p class="error">Erreur d\'identification.<br>Login inexistant.</p>';
				}
				else
				{
					/* la requête retourne un résultat, le login existe dans la base. Vérifions avec la fonction crypt que le mot de passe saisi correspond à celui de la base.*/
					$user_login = $row['user_login'];
					$user_password = $row['user_password'];
					if (crypt($user_input_password, $user_password) != $user_password)
					{
						$message = '<p class="error">Erreur d\'identification.<br>Mauvais mot de passe.</p>';
					}
					else
					{
						/*l'utilisateur est reconnu.
						Nous créons une variable de session 'user_login' puis redirigeons l'utilisateur vers la page d'accueil.*/
						session_start();
						$_SESSION['user_login'] = $user_login;
						header('location:index.php');
					}
				}
			}
		}
?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<div class="img_login">
	<img src="images/fond_login.jpg" alt="image fond">
</div>
<div class="form">
 	<form method="post">
 	<?php if(isset($message)) echo $message ?>
 	<p>Identifiant : <input type="text" name="user_input_login"> 
	<p>Mot de passe : <input type="password" name="user_input_password"></p>
	<input type="submit" name="submit_form" value="valider"></p>
 	</form>
</div>