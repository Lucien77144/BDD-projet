<?php
require('model.php');
$db = connect();

$content = htmlspecialchars($_POST['contentBillet']);
uploadBillet($content);

?>