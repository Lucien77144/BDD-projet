<?php
getSession(){
    session_start();
    if(isset($_SESSION['user'])){
        $title="Bienvenue {$_SESSION['user']}";
    }else{
        $title="Accueil"
    }
}
?>