<?php
require('model.php');
session_start();
$connect = getUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getTitle(); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    if(isset($connect)){   // Si l'utilisateur est connecté :
        echo("connecté");
    }else{  // Sinon :
    ?>
    <header>
    <h1> Se connecter </h1>
        <form action="index.php"> <!-- renvoie a la même page -->
     
        <div>
        <label for="identifiant">Votre Email</label> <br>
       <br> <input type="email" id="" name="email">
        </div>
        <div>
        <label for="pseudo"> Votre Pseudo</label></br>
        <br> <input type="text" id="" name="pseudo"> </br>
        </div>
        <div>
        <label for="mot de passe"> Votre Mot de passe</label></br>
        <br> <input type="text" id="" name="mdp"> </br>
        </div>
        <div>
        <br>
        <input type="submit" value="Se connecter" >
        </br>
        </div>
        </form>
        </header>
    <?php } ?>

    <div class="billet"><!-- partie ou l'on voit le billet et le "voir les commentaire" -->
     <section>
         <!-- je pense qu'il faut mettre du code pphp dedans affin d'afficher le billet -->
     </section> <!-- il y aura le billet puis pour acceder au commentaire il faut appuyer sur le bouton -->
     
     <input type="submit" value="voir les commentaires">
    </div>

    <div class="commentaire"><!-- cette div est en display none je pense puis quand la personne appuie sur le bouton la balise apparaît? on utilise du js? on fait une popup en ajax? -->
        <section></section><!-- il y aura ici tous les commentaires du billet -->

   <textarea name="com" id="" cols="30" rows="5"></textarea> <!-- un espace pour que la personne puisse ecrire son commentaire puis un bouton pour l'envoyer il faut faire le lien dans la bdd avec la table commentaire -->

<input type="submit" value="commenter">
    </div>
    <div><!-- parti pour la page "archive" la consigne dit : - Par défaut sur la page de garde du site les 3 derniers billets apparaissent. L'ensemble des billets est
également consultable dans une section "archives".  -->
    </div>
</body>
</html>