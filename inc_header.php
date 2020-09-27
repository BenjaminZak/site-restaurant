<?php require('inc_connexion.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<header>
	<div class="nav">
		<h1>Restaurant chez Zaken</h1>
		<ul>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="boutique.php">Boutique</a></li>
			<li><a href="panier.php?id=<?php echo $_SESSION['id']?>">Mon panier</a></li>
			<li><a href="logout.php">Déconnexion</a></li>
		</ul>
	</div>
</header>
</html>