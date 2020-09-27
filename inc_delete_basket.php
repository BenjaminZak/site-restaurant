<?php
// fichier dédié à la suppression des panier dont le délai deconservation de deux semaines est écoulé
// 1. date actuelle au format timestamp UNIX
// les timestamp sont des nombres (des secondes) et peuventdonc être comparées.
// voir le manuel :
http://www.php.net/manual/fr/function.time.php
$timestamp = time();
// 2. suppression des paniers dont le délai de conservationest écoulé
// 2.1 - recherche des délais écoulés dans la table user. Lestimestamp (nombres) doivent être inférieurs au timestamp actuel.
// requête.
$result = $mysqli->query('SELECT user_id, date FROM users WHERE
date < '. $timestamp);
while ($row = $result->fetch_array())
{
$user_id = $row['user_id'];
$date = $row['date'];
$user_ids[] = $user_id;
}
// 2.1 - suppression des paniers dont le user_id est associé à un délai de conservation est écoulé
// boucle + requête.
foreach($user_ids as $user_id)
{
$mysqli->query('DELETE FROM panier WHERE user_id =
"'.$user_id.'"');
}