<?php

require('model.php');

$login = htmlspecialchars($_POST['login']);
$pw = htmlspecialchars($_POST['mdp']);

login($login, $pw);

?>