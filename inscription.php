<html>
<form method="POST" action="">
<center>
<h1>Inscription<h1>
<input type="text" name="nom" size="20" placeholder="Nom" maxlength="35"> <input type="text" name="prenom" size="20" placeholder="Prénom" maxlength="35"><br>
<input type="text" name="email" size="20" placeholder="Adresse email" maxlength="70"><br>
<input type="password" name="password" size="20" maxlength="35" placeholder="Mot de passe"><input type="password" name="repeatpassword" size="20" maxlength="35" placeholder="Repeter mot de passe"><br>
<input type="submit" value="Envoyer" name="envoyer">
</center>
</form>
</html>
<?php
      
if (isset($_POST['submit']))
{
   /* on test si les champ sont bien remplis */
    if(!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['repeatpassword']))
    {
        /* on test si le mdp contient bien au moins 6 caractère */
        if (strlen($_POST['password'])>=6)
        {
            /* on test si les deux mdp sont bien identique */
            if ($_POST['password']==$_POST['repeatpassword'])
            {
                // On crypte le mot de passe
                $_POST['password']= md5($_POST['password']);
                // on se connecte à MySQL et on sélectionne la base
                $c = new mysqli("127.0.0.1","root","","ecobank");
                //On créé la requête
                $sql = "INSERT INTO newclient VALUES ('".$_POST['id']."','".$_POST['Nom']."','".$_POST['Prenom']."','".$_POST['email']."','".$_POST['password']."')";
                 
                /* execute et affiche l'erreur mysql si elle se produit */
                if(!$c->query($sql))
                {
                    printf("Message d'erreur : %s\n", $c->error);
                }
            // on ferme la connexion
            mysqli_close($c);
            }
            else echo "Les mots de passe ne sont pas identiques";
        }
        else echo "Le mot de passe est trop court !";
    }
    else echo "Veuillez saisir tous les champs !";
}
?>