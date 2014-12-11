<?php
    session_start();
    
    include './DatenbankManager.php';
    
    $aufforderung;
    
   
    
    if(isset($_GET["aufforderung"]))
    {
        
        $aufforderung = $_GET["aufforderung"]; 
        ladeAlben("kanalInitialisierung", "");
    }
    
    function ladeAlben($ausloeser, $suchStr)
    {
        $db = new DatenbankManager();
        $antwort ="";
        if($ausloeser == "kanalInitialisierung")
        {
            
            $alben = $db->gibAlleAlbenVon($_SESSION["benutzerName"]);
            
            foreach ($alben as $album)
            {
                $antwort .= "<div class='albumIcon'><p>" . $album . "</p><img src='./res/img/albumIcon.jpg'><div class='kanalUI loeschen' style='margin-top: 10%'></div><div class='kanalUI bearbeiten'></div><div class='kanalUI freigeben'></div><div class='kanalUI betrachten'></div></div>";
                //$antwort .= "<div class='albumIcon'><p>" . $album . "</p><img src='./res/img/albumIcon.jpg'><div class='kanalUI loeschen' style='margin-top: 10%'></div><div class='kanalUI bearbeiten'></div><div class='kanalUI freigeben'></div><div class='kanalUI betrachten'></div></div>";
            }
            echo $antwort;
        }
        elseif ($ausloeser == "suche") 
        {
            //suche nach allen alben die suchstr beinhalten
        }
        
        
    }
    
?>
