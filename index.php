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
    <!-- <script>
      document.addEventListener("DOMContentLoaded", function () {

document.querySelector("").addEventListener(["click"],e=>{
    document.querySelectorAll("").style.display="block";
});


});
</script> -->
</head>
<body>

<?php
    if(isset($connect)){   // Si l'utilisateur est connecté :
        ?>
        <form action="deconnexion.php">
            <input type="submit" value="Se déconnecter">
        </form>
        <?php
    }else{  // Sinon :
    ?>
    <header>
    <div>
        <h1> Se connecter </h1>
            <form action="traitelogin.php" method="POST"> <!-- renvoie a la même page -->
        
            <div>
            <label for="login">Email ou Pseudo*</label> <br>
           <br> <input type="text" id="" name="login" required>
            </div>
            <div>
            <label for="mdp"> Votre Mot de passe*</label></br>
            <br> <input type="password" id="" name="mdp" required> </br>
            </div>
            <div>
            <br>
            <input type="submit" value="Se connecter" >
            </br>
            </div>
            </form>
    </div>
        <div>
            <h1> S'inscrire </h1>
            <form action="traiteinscription.php" method="POST"> <!-- renvoie a la même page -->
            <div>
            <label for="email">Email*</label> <br>
                   <br> <input type="email" id="" name="email" required>
            </div>
            <div>
            <label for="pseudo">Pseudo*</label> <br>
                   <br> <input type="text" id="" name="pseudo" required>
            </div>
            <div>
            <label for="mdp"> Votre Mot de passe*</label></br>
            <br> <input type="password" id="" name="mdp" required> </br>
            </div>
            <div>
            <br>
            <input type="submit" value="S'inscrire" >
            </br>
            </div>
            </form>
        </div>
        </header>
    <?php } ?>
     <section>
        <?php
            afficheBillet()
        ?>
         <!-- je pense qu'il faut mettre du code pphp dedans affin d'afficher le billet -->
     </section> <!-- il y aura le billet puis pour acceder au commentaire il faut appuyer sur le bouton -->
    

    <div><!-- parti pour la page "archive" la consigne dit : - Par défaut sur la page de garde du site les 3 derniers billets apparaissent. L'ensemble des billets est
également consultable dans une section "archives".  -->
    </div>
</body>
</html>