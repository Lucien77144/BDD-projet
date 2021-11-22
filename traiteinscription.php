<?php

require('model.php');
$db = connect();

$pseudo = htmlspecialchars($_POST['pseudo']);
$email = htmlspecialchars($_POST['email']);
$pw = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);

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
    $stmt -> bindValue(':mdp', $pw, PDO::PARAM_STR);
    $stmt -> execute();
}else($result!= NULL){
    header("Location: index.php?erreur=exist");
}

?>