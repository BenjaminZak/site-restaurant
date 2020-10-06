<?php require('inc_identification_user.php');?>
<?php require('inc_connexion.php');?>
<?php require('inc_header.php') ?>
<!DOCTYPE html>
<html>
<body>
	<div class="catalogue">
		<?php 
			$result = $mysqli->query('SELECT * FROM catalogue');
			while ($row = $result->fetch_array()) { ?>
				<form action="get">
					<p><?php echo $row['produit_nom']?><br>
					<?php echo $row['produit_description'];?><br>
					Prix : <?php echo $row['produit_prix'];?>€<br>
					<a href="panier.php?id=<?php echo $row['produit_id'] ?>&prix=<?php echo $row['produit_prix'] ?>">Ajouter au panier</a></p>
				</form>
		<?php } ?>

	</div>