<?php
    session_start();
    include './DatenbankManager.php';
    include './hilfsFunktionen.php';
    
        $db = new DatenbankManager();
    
        if(isset($_POST["albumText"]))
        { 
           $db->speicherAlbumText($_SESSION["benutzerName"], $_POST["albumName"], $_POST["albumText"]);
           echo $_POST["albumText"];
        }
      
        
        if(isset($_POST["albumName"]) && (!isset($_POST["albumText"]) && (!isset($_FILES["file"]))))
        {
            $status = $db->speicherAlbumNamen($_SESSION["benutzerName"],testeEingabe($_POST["albumName"]),$_POST["template"], $_POST["anordnung"]);
           
            echo $status;
        }
        
        if(isset($_FILES["file"]))
        {
            //eingabe testen
          $status = $db->fotoHochladen($_FILES["file"]["name"], $_SESSION["benutzerName"], $_POST["albumName"],$_POST["fotoText"]);
          
          if($status == "erfolgreich")
          {
            echo "<img class='vorschauBild' src='getImage.php?filename=".$_FILES["file"]["name"]."'>";   
              //klappt nicht wie gewollt
            //echo "getImage.php?filename=".$_FILES["file"]["name"];
          }
          else
          {
              echo 'Bitte waehle einen anderen Fotonamen';
          }
        }
        
        if(isset($_GET["editieren"]))
        {
            $album = array($db->gibAlbum($_SESSION["benutzerName"], $_GET["editieren"]));
            
            echo json_encode($album);            
        }
        
      
?>
