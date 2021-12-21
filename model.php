<?php

// lien avec la base de donnée (LOCALHOST)
function connect(){
    $db= new PDO ('mysql:host=localhost;dbname=tpfinal;port3306;charset=utf8','root', '', array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return $db;
}

// Fonction de connexion
function login($login, $pw){

    $db = connect();

    $req = "SELECT * FROM utilisateur WHERE `email`=:login OR `pseudo`=:login";
    $stmt = $db -> prepare($req);
    $stmt -> bindValue(':login', $login, PDO::PARAM_STR);
    $stmt -> execute();

    $result = $stmt -> fetch(PDO::FETCH_ASSOC);

    if($result != NULL){
        if(password_verify($pw, $result['mdp'])){
            session_start();
            $_SESSION['user'] = $result['pseudo'];
            $_SESSION['mail'] = $result['email'];
            $_SESSION['id'] = $result['id'];
            header("Location: index.php");
        }else{
            // Renvoie du message d'erreur "mot de passe incorrect"
            header("Location: index.php?erreur=pw");
        }
    }else{
        // Renvoie du message d'erreur "identifiant incorrect"
        header("Location: index.php?erreur=id");
    }
}

// Fonction d'inscription
function inscription($pseudo, $email, $pw){

    $db = connect();

    // Requête de vérification de l'existence de l'utilisateur 
    $req = "SELECT * FROM utilisateur WHERE `email`=:email OR `pseudo`=:pseudo";
    $stmt = $db -> prepare($req);
    $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
    $stmt -> bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt -> execute();
    
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    
    if($result == NULL){ // Si l'utilisateur n'existe pas :
        $req = "INSERT INTO `utilisateur` (`id`, `pseudo`, `email`, `mdp`) VALUES (NULL, :pseudo, :email, :mdp)";
        $stmt = $db -> prepare($req);
        $stmt -> bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
        $stmt -> bindValue(':mdp', password_hash($pw, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt -> execute();
        
        // Connecter automatiquement l'utilisateur :
        login($pseudo, $pw);
    }else{ // Si l'utilisateur existe, renvoyer une erreur :
        header("Location: index.php?erreur=exist");
    }
}

// Obtenir le pseudo de l'utilisateur
function getUser(){
    if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    }
}

// Obtenir l'ID de l'utilisateur 
function getIdUser(){
    if(isset($_SESSION['id'])){
        return $_SESSION['id'];
    }
}

// Modifier le title de la page si l'utilisateur est connecté 
function getTitle(){
    $user = getUser();
    if(isset($user)){
        $title="Bienvenue {$user}";
    }else{
        $title="Accueil";
    }
    return $title;
}

// Verifier si l'utilisateur connecté est administrateur
function isAdmin(){
    $db = connect();
    $id = getIdUser();

    if(isset($id)){
        $req = "SELECT id FROM utilisateur WHERE id={$id}";
        $stmt = $db -> query($req);
        $result = $stmt -> fetch();
        if($result['id'] == 1){
            return true;
        }
    }
}

// Afficher les trois derniers billets 
function afficheAllBillets(){
    $db = connect();
    $req="SELECT * FROM billet ORDER BY id_billet DESC LIMIT 3";
    $stmt=$db->prepare($req);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    $user = getUser();
    foreach($result as $row){
        echo "<div class='billet'><h3>Date du post : {$row["date_billet"]}</h3><p>{$row["contenu_billet"]}</p>";
        
            if(isset($user)){ // Si l'utilisateur est connecté :

                // Afficher un bouton pour voir chaque billet individuellement
                ?>
                <form action="index.php" class="voirBillet">
                    <input type="hidden" name="view" value="billet">
                    <input type="hidden" name="id" value="<?= $row["id_billet"] ?>">
                    <input type="submit" value="Voir le billet">
                </form>
                <?php

                // Afficher le champs pour ajouter des commentaires : 
                commenter($row["id_billet"], "index.php");

            }

            // Afficher tout les commentaires liés à ce billet :
            afficheCommentaire($row["id_billet"], "index.php");
        echo "</div>";
    }
}

// Afficher un billet individuellement (CETTE FONCTION EST APELLEE UNIQUEMENT PAR DES UTILISATEURS CONNECTES)
function afficheBillet($id){
    $db = connect();
    $req = "SELECT * FROM billet WHERE id_billet=?";
    $stmt = $db->prepare($req);
    $stmt -> bindValue(1, $id, PDO::PARAM_INT);
    $stmt -> execute();
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='billet billetUnique'><h3>Date du post : {$result["date_billet"]}</h3><p>{$result["contenu_billet"]}</p></div>";

        // Afficher le champs pour ajouter des commentaires : 
        commenter($result["id_billet"], "index.php?view=billet&id={$result["id_billet"]}");
        afficheCommentaire($id, "index.php?view=billet&id={$result["id_billet"]}");
    }

    // Afficher tout les commentaires liés au billet :
}

// Afficher les archives de tout les billets (COMME ARCHIVES : LES AFFICHER DU PLUS ANCIEN AU PLUS RECENT)
function afficheArchives(){
    $db = connect();
    $req="SELECT * FROM billet ORDER BY id_billet ASC";
    $stmt=$db->prepare($req);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    $user = getUser();
    foreach($result as $row){
        echo "<div class='billet'><h3>Date du post : {$row["date_billet"]}</h3><p>{$row["contenu_billet"]}</p>";

        // Afficher tout les commentaires liés au billet :
        afficheCommentaire($row["id_billet"], "index.php?view=archives");
        if(isset($user)){
            ?>
            <form action="index.php" class="voirBillet">
                <input type="hidden" name="view" value="billet">
                <input type="hidden" name="id" value="<?= $row["id_billet"] ?>">
                <input type="submit" value="Voir le billet">
            </form>
            <?php
            
            // Afficher le champs pour ajouter des commentaires : 
            commenter($row["id_billet"], "index.php?view=archives");
        }
        echo "</div>";
    }
}

// Fonction d'affichage de tout les commentaires d'un billet
function afficheCommentaire($id, $action){
    $db = connect();
    $req="SELECT * FROM commentaire, utilisateur WHERE ext_billet=? AND ext_utilisateur=id ORDER BY id_com DESC";
    $stmt=$db->prepare($req);
    $stmt -> bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    if($result != NULL){
        echo "<button id='affiche_com'>Afficher les commentaires</button><ul class='commentaire'>";
        foreach($result as $row){
            if(isAdmin()){
                echo 
                "<form action='deletecom.php' class='delete' method='POST'>
                    <input type='hidden' value='{$row["id_com"]}' name='id'>
                    <input type='hidden' value='{$action}' name='action'>
                    <input type='submit' value='Supprimer'>
                </form>";
            }
            echo "<li>Date du commentaire : {$row["date_com"]}<br><div>{$row["contenu_com"]}</div>Auteur : {$row["pseudo"]}<br>
            </li>";
        } 
        echo "</ul>";
    }
}

// Fonction d'affichage du formulaire pour ajouter des commentaires
function commenter($billet, $action){
    echo
    "<form class='commenter' action='traitecommentaire.php' method='POST'>
        <input type='hidden' value='{$billet}' name='billet' />
        <input type='hidden' value='{$action}' name='action' />
        <label for='commentaire'>Commenter</label>
        <textarea  name='commentaire' rows='5' cols='33'></textarea>
        <input type='submit'>
    </form>";
}

// Fonction de publication des commentaires (avec redirection sur la page emetrice)
function uploadCom($com, $billet, $id, $action){
    
    $db = connect();

    $req = "INSERT INTO `commentaire` (`id_com`, `date_com`, `contenu_com`, `ext_billet`, `ext_utilisateur`) VALUES (NULL, CURRENT_DATE(), :commentaire, :billet, :id_utilisateur)";
    $stmt = $db -> prepare($req);
    $stmt -> bindValue(':commentaire', $com, PDO::PARAM_STR);
    $stmt -> bindValue(':billet', $billet, PDO::PARAM_STR);
    $stmt -> bindValue(':id_utilisateur', $id, PDO::PARAM_STR);
    $stmt -> execute();

    header("Location: {$action}");
}

// Fonction de publication d'un billet
function uploadBillet($content){
    
    $db = connect();

    $req = "INSERT INTO `billet` (`id_billet`, `date_billet`, `contenu_billet`) VALUES (NULL, CURRENT_DATE(), :content)";
    $stmt = $db -> prepare($req);
    $stmt -> bindValue(':content', $content, PDO::PARAM_STR);
    $stmt -> execute();
    header("Location: index.php");
}

// Fonction de supression d'un commentaire
function deleteCom($id, $action){
    $db = connect();
    $req = "DELETE FROM `commentaire` WHERE `commentaire`.`id_com` = ?";
    $stmt = $db -> prepare($req);
    $stmt -> bindValue(1, $_POST['id'], PDO::PARAM_STR);
    $stmt -> execute();
    header("Location: {$action}");
}

?>