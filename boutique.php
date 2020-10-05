<?php require('inc_identification_user.php');?>
<?php require('inc_connexion.php'); ?> 
<?php require('inc_cookie_user.php'); ?> 
<?php require('inc_header.php') ?>
<!DOCTYPE html>
<html>
<head>
<?php
// récupération de la variable externe
// requête.
$result = $mysqli->query('SELECT produit_id, produit_nom, produit_prix FROM catalogue');
while ($row = $result->fetch_array())
{
$produit_id = $row['produit_id']; $produit_nom = $row['produit_nom']; $produit_prix = $row['produit_prix'];
$produits[$produit_id]['nom'] = $produit_nom;
$produits[$produit_id]['prix'] = $produit_prix; }
?>
<title>Catalogue</title>
<link rel="stylesheet" type="text/css" href="style.css" />
 </head>
 <body>
 <div>
<h1>Nos produits</h1>
<p><a href="panier.php">Voir votre panier</a></p>
<?php foreach($produits as $produit_id => $produit) : ?>
<div>
               <?php echo $produit['nom'] ?>
               <br />
               <?php echo $produit['prix'] ?> euros
</div>
<a href="panier.php?produit_id=<?php echo $produit_id ?>">Ajouter au panier</a><br><br>
<?php endforeach ?>
</div>
</div>
<?php require('inc_footer.php') ?>