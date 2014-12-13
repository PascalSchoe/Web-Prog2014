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
                $albumEintrag = $db->gibAlbum($_SESSION["benutzerName"], $album);
               
                $antwort .= "<div class='albumIcon " . $albumEintrag["freigabe"] . "' id='". $album ."'><p>" . $album . "</p><img src='./res/img/albumIcon.png'><div class='kanalUI loeschen' style='margin-top: 10%'></div><div class='kanalUI bearbeiten'></div><div class='kanalUI freigeben' ></div><div class='kanalUI betrachten'></div></div>";
            }
            echo $antwort;
        }
        elseif ($ausloeser == "suche") 
        {
            //suche nach allen alben die suchstr beinhalten
        }
        
        
    }
    
    if(isset($_GET["freigabe"]))
    {
        $db = new DatenbankManager();
        
        $db->wechselFreigabeVon($_SESSION["benutzerName"], $_GET["freigabe"]);
    
    }
        
    
    
?>
