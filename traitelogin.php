<?php

require('model.php');
$db = connect();

$login = htmlspecialchars($_POST['login']);
$pw = htmlspecialchars($_POST['mdp']);

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

?>