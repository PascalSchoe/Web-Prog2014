<?php
    include './DatenbankManager.php';
    
        $db = new DatenbankManager();
    
        if(isset($_POST["albumText"]))
        {
            echo $_POST["albumText"];
        }
        else if(isset($_FILES))
        {
            $db->fotoHochladen($_FILES);
           echo "<img class='vorschauBild' src='getImage.php?filename=".$_FILES["file"]["name"]."'>";
           
        }
        
      
?>
