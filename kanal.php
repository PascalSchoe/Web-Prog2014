<?php
    session_start();
    
    include './DatenbankManager.php';
    include './hilfsFunktionen.php';
    
    $aufforderung;
    
   
    
        
    
    
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
            $antwort = "Kein Treffer unter >> " . $suchStr . " <<";
           
            $alben = $db->gibAlleAlbenVon($_SESSION["benutzerName"]);
            
                
            $albumEintrag = $db->gibAlbum($_SESSION["benutzerName"], $suchStr);
           
            if($albumEintrag != null)
            {
                $antwort = "<div class='albumIcon " . $albumEintrag["freigabe"] . "' id='". $albumEintrag["albumName"] ."'><p>" . $albumEintrag["albumName"] . "</p><img src='./res/img/albumIcon.png'><div class='kanalUI loeschen' style='margin-top: 10%'></div><div class='kanalUI bearbeiten'></div><div class='kanalUI freigeben' ></div><div class='kanalUI betrachten'></div></div>";
            }
            
            echo $antwort;
            
        }
        
        
    }
    
    if(isset($_GET["aufforderung"]))
    {
        $aufforderung = $_GET["aufforderung"]; 
        if($aufforderung == "kanalInitialisierung")
            ladeAlben("kanalInitialisierung", "");
        elseif($aufforderung == "suche")
        {
            ladeAlben("suche", testeEingabe($_GET["suchEingabe"]));
        }
            
    }
    
    if(isset($_GET["freigabe"]))
    {
        $db = new DatenbankManager();
        
        $db->wechselFreigabeVon($_SESSION["benutzerName"], $_GET["freigabe"]);
    
    }
    if(isset($_GET["loeschen"]))
    {
        $db = new DatenbankManager();
        
        $db->albumLoeschen($_SESSION["benutzerName"], $_GET["loeschen"]);
    }
    
    
?>
