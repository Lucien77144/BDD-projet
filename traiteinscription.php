<?php

require('model.php');
$db = connect();

$pseudo = htmlspecialchars($_POST['pseudo']);
$email = htmlspecialchars($_POST['email']);
$pw = htmlspecialchars($_POST['mdp']);

inscription($pseudo, $email, $pw);

?>