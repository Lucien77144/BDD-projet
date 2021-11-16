<?php
require('model.php');
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getTitle(); ?></title>
</head>
<body>

<form action="">

<h1> Me connecter </h1>
<div>
   <label for="identifiant">Votre Email</label>
   <input type="email" id="" name="email">
 </div>
 <div>
   <br><label for="pseudo"> Votre Pseudo</label></br>
  <br> <input type="text" id="" name="pseudo"> </br>
 </div>
 <div>
   <br><label for="mot de passe"> Votre Mot de passe</label></br>
  <br> <input type="text" id="" name="mdp"> </br>
 </div>


 <div>
 <br>
  <input type="submit" value="Se connecter" >
 </br>
 </div>
</form>

</body>
</html>