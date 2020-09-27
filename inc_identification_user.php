<?php 
	session_start();
	if (!isset($_SESSION['user_login'])) {
		echo 'Vous n\'avez pas accès à cette page.';
		echo '<br><a href="login.php>Retour vers la page d\'authentification</a>';
		exit;
	}
	$user_login = $_SESSION['user_login'];
	require('inc_connexion.php');
	$result = $mysqli->query('SELECT user_id, user_login FROM users WHERE user_login = "' .$user_login .'"');
	$row = $result->fetch_array();
		$_SESSION['id'] = $row['user_id'];
	if (!isset($row['user_login'])) {
		echo 'Vous n\'avez pas accès à cette page';
		echo "<br><a href='login.php'>Retour vers la page d\'authentification</a>";
		exit;
	}
?>