<?php
require('model.php');
$db = connect();

session_start();
$id = getIdUser();

$com = htmlspecialchars($_POST['commentaire']);
$billet = $_POST['billet'];
uploadCom($com, $billet, $id);

?>