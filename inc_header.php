<?php require('inc_connexion.php');?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<header>
	<?php if (!isset($_SESSION['user_login'])) { ?>
		<div class="nav">
			<h1>Restaurant chez Zaken</h1>
			<div class="form">
			 	<form method="post">
			 	<?php if(isset($message)) echo $message ?>
			 	<p>Identifiant : <input type="text" name="user_input_login" class="left"> 
				<p>Mot de passe : <input type="password" name="user_input_password"></p>
				<input type="submit" name="submit_form" value="valider"></p>
			 	</form>
			</div>
		</div>
	<?php } else { ?>
		<div class="nav">
			<h1>Restaurant chez Zaken</h1>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="boutique.php">Boutique</a></li>
				<li><a href="panier.php?id=<?php echo $_SESSION['id']?>">Mon panier</a></li>
				<li><a href="logout.php">Déconnexion</a></li>
			</ul>
		</div>
	<?php }; ?>
</header>
</html>