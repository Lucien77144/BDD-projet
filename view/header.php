<header>

    <?php if(isset($connect)){ // Si l'utilisateur est connecté, lui ajouter un bouton de deconnexion ?>
        
        <form action="deconnexion.php"> 
            <input type="submit" value="Se déconnecter">
        </form>

    <?php }else{ // Sinon afficher le formulaire de connexion et d'inscription ?>

        <div>
            <h1> Se connecter </h1>
            <form action="traitelogin.php" method="POST">
                <div>
                    <label for="login">Email ou Pseudo*</label><br><br>
                    <input type="text" id="" name="login" required>
                </div>
                <div>
                    <label for="mdp"> Votre Mot de passe*</label><br><br>
                    <input type="password" id="" name="mdp" required>
                </div>
                <div>
                    <br>
                    <br>
                    <input type="submit" value="Se connecter" class="boutton">
                </div>
            </form>
            <?php
                // Afficher les erreurs du formulaire de connexion
                if(isset($_GET["erreur"]) && ($_GET["erreur"] == "pw")){
                    echo "Mot de passe incorrect !";
                }
                if(isset($_GET["erreur"]) && ($_GET["erreur"] == "id")){
                    echo "Nom d'utilisateur incorrect !";
                }
            ?>
        </div>
        <div>
            <h1> S'inscrire </h1>
            <form action="traiteinscription.php" method="POST">
                <div>
                    <label for="email">Email*</label><br><br>
                    <input type="email" id="" name="email" required>
                </div>
                <div>
                    <label for="pseudo">Pseudo*</label><br><br>
                    <input type="text" id="" name="pseudo" required>
                </div>
                <div>
                    <label for="mdp"> Votre Mot de passe*</label><br><br>
                    <input type="password" id="" name="mdp" required>
                </div>
                <div>
                    <br><br>
                    <input type="submit" value="S'inscrire"  class="boutton">
                </div>
            </form>

            <?php
                // Afficher les erreurs du formulaire de connexion
                if(isset($_GET["erreur"]) && ($_GET["erreur"] == "exist")){
                    echo " Cet utilisateur existe déjà!";
                }
            ?>
        </div>
    <?php } ?>

    <!-- Afficher un bouton d'accès au archives si la view est sur non définie (si on est sur l'accueil) -->
    <form action='index.php'>
        <?php if(!isset($_GET['view'])){ ?>
            <input type="hidden" name="view" value="archives">
            <input type='submit' value='Archives' class="archiveretour">
        <?php }else{ ?>
            <input type='submit' value='Accueil'class="archiveretour">
        <?php } ?>
    </form>

    <?php
        // Indiquer dans le Header que l'utilisateur connecté est administrateur
        if(isAdmin()){
            echo "<h1 class='admin'>ADMINISTRATEUR</h1>";
        }
    ?>

</header>