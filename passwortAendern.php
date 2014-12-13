<?php
    session_start();
    
    include './DatenbankManager.php';
    
    if(isset($_POST["passwortAlt"]))
    {
        $db = new DatenbankManager();
       
        echo $db->aenderPasswortVon($_SESSION["benutzerName"], md5($_POST["passwortAlt"]),md5($_POST["passwortNeu"]));
    }
?>