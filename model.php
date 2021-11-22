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

function comment(){
    if(isset($connect)){//si un utilisateur est logué(connecté) il peut commenter  donc peut ecrire dans textarea
 //peut commenter 
    }else{ //il ne peut pas commenter donc ne pas accéder à textarea juste masquer et afficher les commentaires 
// afficheBillet() et afficheCommentaire() c'est tout 
    }
}
function afficheBillet(){
    $db = connect();
    $req="SELECT * FROM billet ORDER BY id_billet DESC LIMIT 3";
    $stmt=$db->prepare($req);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    foreach($result as $row){
        echo "<div class='billet'>Date du post : {$row["date_billet"]}<br> Contenu <div>{$row["contenu_billet"]}</div>
        ";
        afficheCommentaire($row["id_billet"]);
        echo "<button id='affiche_com'>Afficher les commentaires</button></div>";
    }
}

function afficheCommentaire($id){
    $db = connect();
    $req="SELECT * FROM commentaire, utilisateur WHERE ext_billet=? AND ext_utilisateur=id ORDER BY id_com DESC";
    $stmt=$db->prepare($req);
    $stmt -> bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach($result as $row){
        echo "<li class='commentaire'>Date du commentaire : {$row["date_com"]}<br> Contenu <div>{$row["contenu_com"]}</div>Auteur : {$row["pseudo"]}<br>
        </li>";
    } 
    echo "</ul>";
}

?>