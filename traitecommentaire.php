<?php
require('model.php');
$db = connect();

session_start();

$id = getIdUser();
echo ($id." ee");
$com = htmlspecialchars($_POST['commentaire']);
$billet = $_POST['billet'];

$req = "INSERT INTO `commentaire` (`id_com`, `date_com`, `contenu_com`, `ext_billet`, `ext_utilisateur`) VALUES (NULL, NOW(), :commentaire, :billet, :id_utilisateur)";
$stmt = $db -> prepare($req);
$stmt -> bindValue(':commentaire', $com, PDO::PARAM_STR);
$stmt -> bindValue(':billet', $billet, PDO::PARAM_STR);
$stmt -> bindValue(':id_utilisateur', $id, PDO::PARAM_STR);
$stmt -> execute();

$result = $stmt -> fetch(PDO::FETCH_ASSOC);

// if($result == NULL){
    
//     $stmt = $db -> prepare($req);
//     $stmt -> bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
//     $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
//     $stmt -> bindValue(':mdp', $pw, PDO::PARAM_STR);
//     $stmt -> execute();
//     session_start();
//     $_SESSION['user'] = $pseudo;
//     $_SESSION['mail'] = $email;
//     $_SESSION['id'] = $mdp;
//     // header("Location: index.php");
// }else{
//     // header("Location: index.php?erreur=exist");
// }

?>