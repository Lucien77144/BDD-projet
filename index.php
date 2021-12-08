<!-- --------------------------------------------------------- -->

<!-- INTERFACE ADMINISTRATEUR -->
<!-- LOGIN: admin | MDP: admin -->

<!-- INTERFACE UTILISATEUR -->
<!-- LOGIN: toto | MDP: toto -->

<!-- --------------------------------------------------------- -->

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

    <!-- Title personnalisé par le pseudo de l'utilisateur -->
    <title><?= getTitle(); ?></title>
    <!--  -->

    <link rel="stylesheet" href="style.css">

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            document.querySelectorAll("#affiche_com").forEach(e =>{
                e.addEventListener("click", () => {
                    if(e.nextElementSibling.style.display == "block"){
                        e.nextElementSibling.style.display="none";
                        e.innerHTML = "Afficher les commentaires";
                    }else{
                        e.nextElementSibling.style.display="block";
                        e.innerHTML = "Masquer les commentaires";
                    }
                });
            });
        });
    </script>
    <!--  -->

</head>
<body>

    <?php
        // Afficher le header (bandeau de connexion-deconnexion / inscription / archives)
        include("view/header.php");
    ?>

    <main>
        <?php 
            // Charger la page en fonction de la view indiquée en GET
            if(isset($_GET['view']) && $_GET["view"] == "archives"){ // Afficher les archives
                afficheArchives();
            }else if(isset($_GET['view']) && $_GET["view"] == "billet"){ // Afficher un billet unique
                afficheBillet(htmlspecialchars($_GET["id"]));
            }else{ // Sinon :
                if(isadmin()){ // Si l'utilisateur est admin :
                    include("view/addbillet.php"); // Ajouter la possibiliter de créer un nouveau billet
                }
                afficheAllBillets(); // Afficher les trois derniers billets
            }
        ?>
    </main>

</body>
</html>