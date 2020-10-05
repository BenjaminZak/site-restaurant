<?php require('inc_identification_user.php');?>
<?php require('inc_connexion.php')?>
<?php require('inc_header.php')?>

<?php
	$produits = [];
	if(isset($_COOKIE['panier'])){ 
		$panier=$_COOKIE['panier'];
		$choix_produit=$_GET['id'];
		$choix_prix = $_GET['prix'];
		$panier_client=unserialize($panier);
		$panier_client[]=[$choix_produit, $choix_prix];
		$panier=serialize($panier_client);
		$mysqli->query('INSERT INTO panier(user_id, produit_id, produit_prix) VALUES ("'.$_SESSION['id'].'", "'.$choix_produit.'", "'.$choix_prix.'")');
	}
	else
	{  
		$choix_produit=$_GET['id'];
		$choix_prix = $_GET['prix'];
		$panier_client=[$choix_produit, $choix_prix ];
		$panier=serialize($panier_client);
		$mysqli->query('INSERT INTO panier(user_id, produit_id, produit_prix) VALUES ("'.$_SESSION['id'].'", "'.$choix_prix.'", "'.$choix_produit.'")');
	}

	setcookie('panier', $panier, time() + 1296000, null, null, false, true);

	$result=$mysqli->query('SELECT * FROM panier
								  INNER JOIN catalogue
								  ON panier.produit_id = catalogue.produit_id
								  WHERE panier.user_id = "'.$_SESSION['id'].'"'); //requéte de la base
	while ($row = $result->fetch_array())
	$produits[$row['produit_nom']]=$row['produit_prix'];
	$result->free();


	$result=$mysqli->query('SELECT SUM(produit_prix) AS total_prix FROM panier');//requéte de la base
	$row = $result->fetch_array();	
	$total_prix=$row['total_prix'];
	$result->free();
?>

<h2>Voici votre panier:</h2>

<?php foreach($produits as $nom => $prix) : ?>
	 	<li>Produit : <?php echo $nom ?><br>Prix : <?php echo $prix; ?></li><br>
	 	<?php endforeach  ?>

<a href="boutique.php">Revenir à la boutique</a>
<br>
<a href="suppression.php">Supprimer mon panier</a>
<p>Le prix total de votre panier est de <?php echo $total_prix ?> euros.</p> 