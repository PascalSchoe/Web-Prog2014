<?php
    session_start();
    include './XMLGenerator.php';
    include './DatenbankManager.php';
    
    $db = new DatenbankManager();

    $zwischenAnsicht = new XMLGenerator($_SESSION["benutzerName"],$_POST["albumName"],$_POST["anordnung"],$_POST["template"]);
    $gesamtAnsicht = new XMLGenerator($_SESSION["benutzerName"],$_POST["albumName"],$_POST["anordnung"],$_POST["template"]);
    switch($_POST["anordnung"])
    {
        case "anordnung1":
            $foto1Name = $db->gibFotoName($_SESSION["benutzerName"], $_POST["albumName"], 0);
            $foto2Name = $db->gibFotoName($_SESSION["benutzerName"], $_POST["albumName"], 1);
            $foto3Name = $db->gibFotoName($_SESSION["benutzerName"], $_POST["albumName"], 2);
            $foto4Name = $db->gibFotoName($_SESSION["benutzerName"], $_POST["albumName"], 3);
            $foto5Name = $db->gibFotoName($_SESSION["benutzerName"], $_POST["albumName"], 4);
            $foto6Name = $db->gibFotoName($_SESSION["benutzerName"], $_POST["albumName"], 5);
            
            $foto1Text = $db->gibFotoText($_SESSION["benutzerName"], $_POST["albumName"], $foto1Name);
            $foto2Text = $db->gibFotoText($_SESSION["benutzerName"], $_POST["albumName"], $foto2Name);
            $foto3Text = $db->gibFotoText($_SESSION["benutzerName"], $_POST["albumName"], $foto3Name);
            $foto4Text = $db->gibFotoText($_SESSION["benutzerName"], $_POST["albumName"], $foto4Name);
            $foto5Text = $db->gibFotoText($_SESSION["benutzerName"], $_POST["albumName"], $foto5Name);
            $foto6Text = $db->gibFotoText($_SESSION["benutzerName"], $_POST["albumName"], $foto6Name);
            
            $zwischenAnsicht->fotoErstellen($foto1Name, 0, $foto1Text);
            $zwischenAnsicht->fotoErstellen($foto2Name, 1, $foto2Text);
            $zwischenAnsicht->fotoErstellen($foto3Name, 2, $foto3Text);
            
            $zwischenAnsicht->beliebigesElementErstellen("div", "clearFix", "", " ");
            
            $zwischenAnsicht->fotoErstellen($foto4Name, 3, $foto4Text);
            $zwischenAnsicht->albumTextErstellen(0, $_POST["albumText1"]);
            
            $zwischenAnsicht->fotoErstellen($foto5Name, 4, $foto5Text);
            $zwischenAnsicht->albumTextErstellen(1, $_POST["albumText2"]);
            
            $zwischenAnsicht->fotoErstellen($foto6Name, 5, $foto6Text);
            $zwischenAnsicht->albumTextErstellen(2, $_POST["albumText3"]);
            
            
            $zwischenAnsicht->speicherXMLFile($_SESSION["benutzerName"], $_POST["albumName"],"ZwischenA",1);
            
            
            //GesamtAnsicht generieren
            
            $gesamtAnsicht->fotoErstellen($foto1Name, 0, $foto1Text);
            $gesamtAnsicht->fotoErstellen($foto2Name, 1, $foto2Text);
            $gesamtAnsicht->fotoErstellen($foto3Name, 2, $foto3Text);
            $gesamtAnsicht->fotoErstellen($foto4Name, 3, $foto4Text);
            $gesamtAnsicht->fotoErstellen($foto5Name, 4, $foto5Text);
            $gesamtAnsicht->fotoErstellen($foto6Name, 5, $foto6Text);
            
            $gesamtAnsicht->speicherXMLFile($_SESSION["benutzerName"], $_POST["albumName"], "GesamtA", 0);
            echo 'ich war erfolgreich!';
            
            break;
        case "anordnung2":
            break;
        case "anordnung3":
            break;
        case "anordnung4":
            break;
        case "anordnung5":
            break;
        case "anordnung6":
            break;
        case "anordnung7":
            break;
        case "anordnung8":
            break;
        case "anordnung9":
            break;
    }

?>

