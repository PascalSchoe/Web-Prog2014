<?php
    session_start();
    include './DatenbankManager.php';
    include './hilfsFunktionen.php';
    
        $db = new DatenbankManager();
    
        if(isset($_POST["albumText"]))
        {
           $db->speicherAlbumText($_SESSION["benutzerName"], $_SESSION["albumName"], $_POST["albumText"]);
            echo $_POST["albumText"];
           //echo $db->gibAlleAlbenVon("pschoe");
        }
        /*
        */
        if(isset($_POST["albumName"]))
        {
            $status = $db->speicherAlbumNamen($_SESSION["benutzerName"],testeEingabe($_POST["albumName"]),$_POST["template"], $_POST["anordnung"]);
            
            if($status == "erfolgreich")
            {
                $_SESSION["albumName"] =testeEingabe($_POST["albumName"]);
            }
            echo $status;
        }
        
        if(isset($_FILES["file"]))
        {
            //eingabe testen
          $status = $db->fotoHochladen($_FILES["file"]["name"], $_SESSION["benutzerName"], $_SESSION["albumName"],$_POST["fotoText"]);
          
          if($status == "erfolgreich")
          {
            echo "<img class='vorschauBild' src='getImage.php?filename=".$_FILES["file"]["name"]."'>";   
          }
          else
          {
              echo 'Bitte waehle einen anderen Fotonamen';
          }
        }
        
      
?>
