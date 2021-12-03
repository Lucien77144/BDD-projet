<?php

function connect(){
    $db= new PDO ('mysql:host=localhost;dbname=tpfinal;port3306;charset=utf8','root', '', array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return $db;
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
    $req = "SELECT id FROM utilisateur WHERE id={$_SESSION['id']}";
}

function afficheBillet(){
    $db = connect();
    $req="SELECT * FROM billet ORDER BY id_billet DESC LIMIT 3";
    $stmt=$db->prepare($req);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    $user = getUser();
    foreach($result as $row){
        echo "<div class='billet'>Date du post : {$row["date_billet"]}<br> Contenu <div>{$row["contenu_billet"]}</div>";
        afficheCommentaire($row["id_billet"]);
        if(isset($user)){
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
            echo "<li>Date du commentaire : {$row["date_com"]}<br> Contenu <div>{$row["contenu_com"]}</div>Auteur : {$row["pseudo"]}<br>
            </li>";
        } 
        echo "</ul>";
    }
}
function commenter($billet){
    echo
    "<form action='traitecommentaire.php' method='POST'>
        <input type='hidden' value='{$billet}' name='billet' />
        <label for='commentaire'>Commenter</label>
        <textarea  name='commentaire' rows='5' cols='33'></textarea>
        <input type='submit'>
    </form>";
}

?>