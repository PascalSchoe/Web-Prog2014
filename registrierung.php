<html>
    <head>
        <script type="text/javascript" src="JS/hilfsFunktionen.js"></script>
        <script type="text/javascript" src="JS/severBenachrichtigungen.js"></script> 
    </head>
    <body>


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
            else 
            {
?>

        <script type="text/javascript">
            macheMeldung("login.html", "Leider gibt es schon einen Account mit diesem Namen");
                </script>
<?php
            }
        }
    
    }
    
?>
                </body>
</html>
