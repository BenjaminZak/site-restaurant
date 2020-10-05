 <h1>Inscription<h1>
      
    <form method="post" action="">
        <p>Nom</p>
        <input type="text" name="nom">
        <p>Prenom</p>
        <input type="text" name="prenom">
        <p>email</p>
        <input type="email" name="email">
        <p>Password</p>
        <input type="password" name="password">
        <p>Répetez votre password</p>
        <input type="password" name="repeatpassword"><br><br>
        <input type="submit" name="submit" value="Valider">
      
    </form>

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
                $mysqli = new mysqli('localhost', 'root', 'root', 'site_ecommerce');
                //On créé la requête
                $sql = "INSERT INTO users (user_id, user_nom, user_prenom, user_login, user_password) VALUES (NULL,'".$_POST['nom']."','".$_POST['prenom']."','".$_POST['email']."','".$_POST['password']."')";
                header('Location: index.php');
                 
                /* execute et affiche l'erreur mysql si elle se produit */
                if(!$mysqli->query($sql))
                {
                    printf("Message d'erreur : %s\n", $mysqli->error);
                }
            // on ferme la connexion
            mysqli_close($mysqli);
            }
            else echo "Les mots de passe ne sont pas identiques";
        }
        else echo "Le mot de passe est trop court !";
    }
    else echo "Veuillez saisir tous les champs !";
}
?>