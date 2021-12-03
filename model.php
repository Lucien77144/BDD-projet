<?php

function connect(){
    $db= new PDO ('mysql:host=localhost;dbname=tpfinal;port3306;charset=utf8','root', '', array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return $db;
}

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
            header("Location: index.php?erreur=pw");
        }
    }else{
        header("Location: index.php?erreur=id");
    }
}

function inscription($pseudo, $email, $pw){

    $db = connect();

    $req = "SELECT * FROM utilisateur WHERE `email`=:email OR `pseudo`=:pseudo";
    $stmt = $db -> prepare($req);
    $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
    $stmt -> bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt -> execute();
    
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    
    if($result == NULL){
        $req = "INSERT INTO `utilisateur` (`id`, `pseudo`, `email`, `mdp`) VALUES (NULL, :pseudo, :email, :mdp)";
        $stmt = $db -> prepare($req);
        $stmt -> bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
        $stmt -> bindValue(':mdp', password_hash($pw, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt -> execute();
        login($pseudo, $pw);
        header("Location: index.php");
    }else{
        header("Location: index.php?erreur=exist");
    }
}

function getUser(){
    if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    }
}

function getIdUser(){
    if(isset($_SESSION['id'])){
        return $_SESSION['id'];
    }
}

function getTitle(){
    $user = getUser();
    if(isset($user)){
        $title="Bienvenue {$user}";
    }else{
        $title="Accueil";
    }
    return $title;
}

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


function afficheAllBillets(){
    $db = connect();
    $req="SELECT * FROM billet ORDER BY id_billet DESC LIMIT 3";
    $stmt=$db->prepare($req);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    $user = getUser();
    foreach($result as $row){
        echo "<div class='billet'><h3>Date du post : {$row["date_billet"]}</h3><p>{$row["contenu_billet"]}</p>";
        
        if(isset($user)){
            ?>
            <form action="index.php" class="voirBillet">
                <input type="hidden" name="view" value="billet">
                <input type="hidden" name="id" value="<?= $row["id_billet"] ?>">
                <input type="submit" value="Voir le billet">
            </form>
            <?php
            commenter($row["id_billet"]);
        }
        afficheCommentaire($row["id_billet"]);
        echo "</div>";
    }
}

function afficheBillet($id){
    $db = connect();
    $req = "SELECT * FROM billet WHERE id_billet=?";
    $stmt = $db->prepare($req);
    $stmt -> bindValue(1, $id, PDO::PARAM_INT);
    $stmt -> execute();
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='billet'><h3>Date du post : {$result["date_billet"]}</h3><p>{$result["contenu_billet"]}</p>";
    }
    afficheCommentaire($id);
}

function afficheArchives(){
    $db = connect();
    $req="SELECT * FROM billet ORDER BY id_billet ASC";
    $stmt=$db->prepare($req);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    $user = getUser();
    foreach($result as $row){
        echo "<div class='billet'><h3>Date du post : {$row["date_billet"]}</h3><p>{$row["contenu_billet"]}</p>";
        afficheCommentaire($row["id_billet"]);
        if(isset($user)){
            ?>
            <form action="index.php" class="voirBillet">
                <input type="hidden" name="view" value="billet">
                <input type="hidden" name="id" value="<?= $row["id_billet"] ?>">
                <input type="submit" value="Voir le billet">
            </form>
            <?php
            commenter($row["id_billet"]);
        }
        echo "</div>";
    }
}

function afficheCommentaire($id){
    $db = connect();
    $req="SELECT * FROM commentaire, utilisateur WHERE ext_billet=? AND ext_utilisateur=id ORDER BY id_com DESC";
    $stmt=$db->prepare($req);
    $stmt -> bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    if($result != NULL){
        echo "<button id='affiche_com'>Afficher les commentaires</button><ul class='commentaire'>";
        foreach($result as $row){
            echo "<li>Date du commentaire : {$row["date_com"]}<br><div>{$row["contenu_com"]}</div>Auteur : {$row["pseudo"]}<br>
            </li>";
        } 
        echo "</ul>";
    }
}

function commenter($billet){
    echo
    "<form class='commenter' action='traitecommentaire.php' method='POST'>
        <input type='hidden' value='{$billet}' name='billet' />
        <label for='commentaire'>Commenter</label>
        <textarea  name='commentaire' rows='5' cols='33'></textarea>
        <input type='submit'>
    </form>";
}

function uploadCom($com, $billet, $id){
    
    $db = connect();

    $req = "INSERT INTO `commentaire` (`id_com`, `date_com`, `contenu_com`, `ext_billet`, `ext_utilisateur`) VALUES (NULL, CURRENT_DATE(), :commentaire, :billet, :id_utilisateur)";
    $stmt = $db -> prepare($req);
    $stmt -> bindValue(':commentaire', $com, PDO::PARAM_STR);
    $stmt -> bindValue(':billet', $billet, PDO::PARAM_STR);
    $stmt -> bindValue(':id_utilisateur', $id, PDO::PARAM_STR);
    $stmt -> execute();

    header("Location: index.php");
}

function uploadBillet($content){
    
    $db = connect();

    $req = "INSERT INTO `billet` (`id_billet`, `date_billet`, `contenu_billet`) VALUES (NULL, CURRENT_DATE(), :content)";
    $stmt = $db -> prepare($req);
    $stmt -> bindValue(':content', $content, PDO::PARAM_STR);
    $stmt -> execute();
    header("Location: index.php");
}

?>