<?php require('inc_connexion.php');?>
<?php require('inc_identification_user.php');?>
<?php 
 
$result=$mysqli->query('DELETE FROM panier  WHERE user_id = "'.$_SESSION['id'].'"');   //suppression dans bdd

header('Location: boutique.php');
exit();
?>