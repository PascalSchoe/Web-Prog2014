<?php
    session_start();
    
    include './DatenbankManager.php';
    include './hilfsFunktionen.php';
    
    $db = new DatenbankManager();
    
    if(isset($_POST["loginSubmit"]))
    {
        $benutzerName = testeEingabe($_POST["benutzerNameLogin"]);
        $passwort = testeEingabe($_POST["passwortLogin"]);
        
        if($db->benutzerEinloggen($benutzerName, md5($passwort)))
        {
            $_SESSION["benutzerName"] = $benutzerName;
             
            header("Location: kanal.html");
        }
        else 
        {
            echo "Leider kenne ich dich nicht ";
        }
    }

?>
