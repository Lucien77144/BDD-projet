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
</head>
<body>

<?php
    include("view/header.php");
?>

<section class="nvBillet">
        <?php
            if(isadmin()){
                include("view/addbillet.php");
            }
        ?>
</section>

<section>
    <?php
    if(isset($_GET['view']) && $_GET["view"] == "archives"){
        afficheArchives();
    }else if(isset($_GET['view']) && $_GET["view"] == "billet"){
        afficheBillet(htmlspecialchars($_GET["id"]));
    }else{
        afficheAllBillets();
    }
    ?>
</section> <!-- il y aura le billet puis pour acceder au commentaire il faut appuyer sur le bouton -->
    

    <div><!-- parti pour la page "archive" la consigne dit : - Par défaut sur la page de garde du site les 3 derniers billets apparaissent. L'ensemble des billets est
également consultable dans une section "archives".  -->
    </div>
</body>
</html>