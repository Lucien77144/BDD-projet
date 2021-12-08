<?php
require('model.php');

$id = $_POST['id'];
$action = $_POST['action'];
deleteCom($id, $action);

?>