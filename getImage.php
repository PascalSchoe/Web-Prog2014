<?php
include './DatenbankManager.php';

$db = new DatenbankManager();

echo $db->getImage($_GET["filename"]);

?>