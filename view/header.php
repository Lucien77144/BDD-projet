<header>
<?php if(isset($connect)){ // Si l'utilisateur est connecté : ?>
    <form action="deconnexion.php">
        <input type="submit" value="Se déconnecter">
    </form>
<?php }else{ // Sinon : ?>
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
            <input type="submit" value="Se connecter" class="boutton">
            </br>
            </div>
            </form>
            <?php if(isset($_GET["erreur"]) && ($_GET["erreur"] == "pw")){
                    echo "Mot de passe incorrect !";
                }
                if(isset($_GET["erreur"]) && ($_GET["erreur"] == "id")){
                    echo "Nom d'utilisateur incorrect !";
                } ?>
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
            <?php
                if(isset($_GET["erreur"]) && ($_GET["erreur"] == "exist")){
                    echo " Ce nom d'utilisateur existe déjà!";
                }
            ?>
        </div>
    <?php } ?>

<form action='index.php'>
    <?php if(!isset($_GET['view'])){ ?>
        <input type="hidden" name="view" value="archives">
        <!-- demander au prof pour le hidden -->
        <input type='submit' value='Archives'>
    <?php }else{ ?>
        <input type='submit' value='Accueil'>
    <?php } ?>
</form>

<?php

if(isAdmin()){
    echo "<h1 class='admin'>ADMINISTRATEUR</h1>";
}

?>

</header>