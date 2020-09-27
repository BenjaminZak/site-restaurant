<?php 
	/*
	ficher inclus; inc_footer.php
	contient la fermeture de la connexion et la fin de page HTLM
	-------------------------------------------- */
	// Libération des résultats
	$result->free();
	// Fermeture de la connexion
	$mysqli->close();
?>
</body>
</html>