<?php
    session_start();
    
    include './DatenbankManager.php';
    include './hilfsFunktionen.php';
    
    $db = new DatenbankManager();
    
    if(isset($_POST["loginSubmit"]))
    {
        $benutzerName = testeEingabe($_POST["benutzerNameLogin"]);
        $passwort = testeEingabe($_POST["passwortLogin"]);
        
        if($db->benutzerEinloggen($benutzerName, $passwort))
        {
            $_SESSION["benutzerName"] = $benutzerName;
        }
    }

?>
