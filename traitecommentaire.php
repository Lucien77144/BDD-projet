<?php
require('model.php');
$db = connect();

session_start();
$id = getIdUser();

$com = htmlspecialchars($_POST['commentaire']);
$billet = $_POST['billet'];

// le $_POST['action'] permet de transmettre la page emetrice de la demande
uploadCom($com, $billet, $id, $_POST['action']);

?>