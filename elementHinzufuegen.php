<?php
    session_start();
    include './DatenbankManager.php';
    
        $db = new DatenbankManager();
    
        if(isset($_POST["albumText"]))
        {
           $db->speicherAlbumNamen($_SESSION["benutzerName"],$_POST["albumText"]);
            echo $_POST["albumText"];
           //echo $db->gibAlleAlbenVon("pschoe");
        }
        else if(isset($_FILES))
        {
            $db->fotoHochladen($_FILES);
           echo "<img class='vorschauBild' src='getImage.php?filename=".$_FILES["file"]["name"]."'>";
           
        }
        
      
?>
