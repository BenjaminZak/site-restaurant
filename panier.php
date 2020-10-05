<?php require('inc_identification_user.php');?>
<?php require('inc_connexion.php'); ?>
<?php require('inc_cookie_user.php'); ?>
<?php require('inc_delete_basket.php'); ?>
<?php require('inc_header.php') ?>

<?php echo $web_user_id ?>

<!DOCTYPE html>
<html>
<head>
<?php
// echo $web_user_id;

// suppression du panier à la demande if(isset($_GET['delete']))
/*
{
$delete = $_GET['delete'];
// supression du panier complet if( $delete == 'panier')
{
$mysqli->query('DELETE FROM panier WHERE user_id = "'. $web_user_id .'"');
$message = 'Le panier a bien été supprimé'; }
// supression d'une ligne du panier else
{
$mysqli->query('DELETE FROM panier WHERE user_id = "'.
$web_user_id .'" AND produit_id = '. $delete);
$message = 'Le produit a bien été retiré de votre panier';
} }*/
// vérification et récupération de la variable externe
// si elle existe alors nous enregistrons le produit dans le panier dans la base de données
if(isset($_GET['produit_id']))
{
$produit_id = $_GET['produit_id'];
// verifions avec count() que le produit_id existe bien dans la base
$result = $mysqli->query('SELECT count(produit_id) FROM catalogue WHERE produit_id = "' . $produit_id .'"');
$row = $result->fetch_array();
if($row[0] <= 0) {
$message = '<p class="error">Le catalogue ne contient pas cette référence. Aucun produit n\'est ajouté a panier.</p>';
} else {
// ajout du produit dans le panier
// remarquons les double quotes pour la première valeur user_id qui est une chaine de caracteres pour MySQL
if ($mysqli->query('INSERT INTO panier (user_id, produit_id) VALUES ("'.$web_user_id.'", '.$produit_id.')'))
{
$message = '<p class="message">L\'ajout du produit dans le
panier est bien effectué.</p>';
} else {
$message = '<p class="error">L\'ajout du produit dans le panier n\'est pas effectué.</p>';
} }
}
// affichage des produits dans le panier et de leur prix pour cet utilisateur
// requête de récupération des identifiants de produits
// remarquons à nouveau les double quotes pour user_id qui est une chaine de caracteres pour MySQL
// n produits avec same id
echo '<pre>';
$result = $mysqli->query('SELECT panier_id, produit_id FROM panier WHERE user_id = "'. $web_user_id .'"');
while ($row = $result->fetch_array())
{
$panier_id = $row['panier_id']; $produit_id = $row['produit_id'];
$panier_user[$panier_id] = $produit_id; }
if(!empty($panier_user)) {
$count_values = array_count_values($panier_user);
foreach($count_values as $produit_id => $nombre) {
$result = $mysqli->query('SELECT produit_nom, produit_prix FROM catalogue WHERE produit_id = '. $produit_id);
$row = $result->fetch_array();
$produit_nom = $row['produit_nom']; $produit_prix = $row['produit_prix'];
$produits[$produit_id]['nom'] = $produit_nom; $produits[$produit_id]['prix'] = $produit_prix;
$produits[$produit_id]['nombre'] = $nombre; $produits[$produit_id]['sous_total'] = $nombre * $row['produit_prix'] ;
// calcul du prix total
$total[] = $nombre * $row['produit_prix'] ; }
$prix_total = array_sum($total);

}
echo '</pre>';
?>
<title>Votre panier</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head> <body> <div>
<h1>Votre panier</h1>
<?php if(isset($message)) :?>
<p><?php echo $message ?></p>
<?php endif ?>
<?php if(!empty($produits)) :?>
<p><a href="?delete=panier">Supprimer votre panier</a></p> <table>
<tr>
<th>Produit</th> <th>Prix</th> <th>Quantite</th> <th>Sous-total</th>
</tr>
<?php foreach($produits as $id => $produit) : ?> <tr>
<td><?php echo $produit['nom'] ?></td>
<td><?php echo $produit['prix'] ?></td>
<td><?php echo $produit['nombre'] ?></td>
<td><?php echo $produit['sous_total'] ?></td>
<td><img src="cancel.png"><br /><a href="?delete=<?php echo $id
?>">Supprimer<a/></td>
</tr>
<?php endforeach ?>
<tr class="total">
<td colspan="3">Total</td>
<td colspan="2"><?php echo $prix_total ?> euros</td> </tr>
</table>
<!--<p>Valider votre commande</p>-->
<?php else:?>
<p>Votre panier est vide</p>
<?php endif ?>
<p><a href="boutique.php">Retour au catalogue</a></p> </div>
</div>
<?php //require('inc_menu.php') ?> <?php require('inc_footer.php') ?>