<?php
    include './DatenbankManager.php';
    include './hilfsFunktionen.php';
    
    $db = new DatenbankManager();
    
    
    
    if(isset($_POST['regSubmit']))
    {
        $benutzerName = testeEingabe($_POST['benutzerNameReg']);
        $passwort1 = testeEingabe($_POST['passwortReg']);
        $passwort2 = testeEingabe($_POST['passwortRegWdh']);
        
        
        if($passwort1 == $passwort2)
        {
            if($db->testeVerfuegbarkeitBenutzername($benutzerName))
            {
                $db->erstelleBenutzer($benutzerName, md5($passwort1));
                header("Location: login.html");
            }
        }
    
    }
    
?>


