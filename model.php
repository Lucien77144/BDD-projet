<?php

function connect(){
    $db= new PDO ('mysql:host=localhost;dbname=tpfinal;port3306;charset=utf8','root', '', array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return $db;
}

function getUser(){
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        return $user;
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
    $req = "SELECT id FROM utilisateur WHERE id={$_SESSION['user']}";
}
?>