<?php
/* si le cookie n'existe pas, on le crée pour identifier
l'utilisateur */
if(!isset($_COOKIE['web_user']))
{
	$web_user_id = uniqid() . time();
	$date = time()+1296000;
	// envoi du cookie
	setcookie('web_user', $web_user_id, $date);
	//enregistrement dans la table 'user' : id du client + date de conservation du panier (deux semaines)
	$mysqli->query('INSERT INTO users SET user_id =
	"'.$web_user_id.'"'); //, date = "'.$date.'"'
}
else
{
	$web_user_id = $_COOKIE['web_user'];
}