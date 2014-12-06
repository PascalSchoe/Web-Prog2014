<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>


<!-- This Php-file generates XML, out of userinput 
   
These XML Tags are:
    
    - <Album>
        - <Template>
        - <AlbumTitle>
        - <AlbumText>
        - <Foto>
            - <FotoTitle>
            - <FotoText>


Theoretisch unbegrenzt viele Fotos und texte in einem Album 
-->


<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Editor Prototype
        </title>
        <style>
            body
            {
                background: #bbb;
            }
            #wrapper
            {
                width: 100%;
            }
            #wrapper input
            {
                width: 50%;
            }
            p{
                font-weight: bold;
            }
            img{
                border: 2px solid #bbb;
            }
            img:hover{
                border: 2px solid crimson;
                box-shadow: 0 0 25px crimson;
            }
            div{
                float: left;
            }
            .clearFix
            {
                clear: both;
            }
        </style>
    </head>
    <body>
        
        <div id="wrapper">
        
            <?php
                if(isset($_GET["template"])){
                    $template = $_GET["template"];
                    $anordnung = $_GET["anordnung"]; 
                 
                echo "Du hast folgende Anordnung gewaehlt: " . $anordnung. "dein Template ist:" . $template;
                }
            ?>
            <h1>Hier kannst du dir dein eigenes Album erstellen</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p> Albumname: <input name="albumName" type="text" value=""></p>
                <p> Albumtext: <input name="albumText" type="text" value=""></p>
                <p> Fotoname: <input name="fotoName" type="text" value=""></p>
                <p> Fototext: <input name="fotoText" type="text" value=""></p>
                
                
                
                
                
                
                
                <!-- hier später Divs oder  Bilder der Templates-->
                <select name="template">
                    <option>
                        Temp1
                    </option>
                    <option>
                        Temp2
                    </option>
                    <option>
                        Temp3
                    </option>
                </select>  
                
                <br>
                <br>
                
                <input type="submit" value="erstellen" name="erstellen" style="width: 15%">
            </form>
            <hr>
            <br>
        </div>
        
        
        
        
        
        
        
        <?php
        
            //abfragen ob submit ausgelöst wurde, wenn ja dann Werte entgegennehmen und als XML Document hinterlegen
                //Fehler abfangen noch notwendig
            if(isset($_POST["erstellen"]))
            {
                $doc = new DOMDocument("1.0", "utf-8");
                $doc->formatOutput = true;
                
                $channel = $doc->createElement("channel");
                
                $album = $doc->createElement("album");
                
                $template = $doc->createElement("Template");
                $templateText = $doc->createTextNode($_POST["template"]);
                
                
                $albumTitle = $doc->createElement("albumTitle");
                $albumTitleText = $doc->createTextNode($_POST["albumName"]);
                
                
                $albumText = $doc->createElement("albumText");
                $albumTextInput = $doc->createTextNode($_POST["albumText"]);
                
                
                $foto = $doc->createElement("foto");
                $fotoTitleTag = $doc->createElement("fotoTitleTag");
                $fotoTitle = $doc->createTextNode($_POST["fotoName"]);
                
                $fotoTextTag = $doc->createElement("fotoTextTag");
                $fotoText = $doc->createTextNode($_POST["fotoText"]);
                
                
                
                
                $templateText = $template->appendChild($templateText);
                $template = $album->appendChild($template);
                
                $albumTitleText = $albumTitle->appendChild($albumTitleText);
                $albumTitle = $album->appendChild($albumTitle);
                
                $albumTextInput = $albumText->appendChild($albumTextInput);
                $albumText = $album->appendChild($albumText);
                
                $fotoTitle = $fotoTitleTag->appendChild($fotoTitle);
                $fotoTitleTag = $foto->appendChild($fotoTitleTag);
                
                $fotoText = $fotoTextTag->appendChild($fotoText);
                $fotoTextTag = $foto->appendChild($fotoTextTag);
                $foto = $album->appendChild($foto);
                
                $album = $channel->appendChild($album);
                $channel = $doc->appendChild($channel);
                
                
                
                $xmlFile = "channel2.xml";
                $bytes = $doc->save($xmlFile);
            
                echo "Danke wir haben deine Daten erhalten und in der Datenbank hinterlegt";
                flush();
            }
        
            /*
            $doc = new DOMDocument("1.0", "utf-8");
            $doc->formatOutput = true;
            
            //Container for all albums 
            $channel = $doc->createElement("channel");
            $channel = $doc->appendChild($channel);
            
            
            $albumsNames = ["erstes Album", "zweites Album", "drittes Album", "viertes Album", "fuenftes Album"];
            $FotoTitles = ["albOneFotoOne","albOneFotoTwo","albOneFotoThree",
                "albTwoFotoOne","albTwoFotoTwo","albTwoFotoThree","albThreeFotoOne","albThreeFotoTwo","albThreeFotoThree",
                "albFourFotoOne","albFourFotoTwo","albFourFotoThree","albFiveFotoOne","albFiveFotoTwo","albFiveFotoThree"];
            
            
            foreach ($albumsNames as $albumName){
                
                $album = $doc->createElement('album');
                $album->setAttribute('title', $albumName);
                
                
                
                $textTagAlbum= $doc->createElement('albumText');
                
                $albumText = $doc->createTextNode("Suuuuuper spannender Text fuer das Album!kndsgjkndlkgndflkgndfklgndlkfgdkllfgdfgdgdgdgkldnglkdngldkngkldg");
                $albumText = $textTagAlbum->appendChild($albumText);
                
                $textTagAlbum= $album->appendChild($textTagAlbum);
                
                
                
                foreach ($FotoTitles as $fotoTitle)
                {
                    $foto= $doc->createElement('foto');
                    $fotoTitleTag = $doc->createElement('fotoTitle');
                    
                    $fotoT = $doc->createTextNode($fotoTitle);
                    $fotoT = $fotoTitleTag->appendChild($fotoT);
                    
                    $fotoTitleTag = $foto->appendChild($fotoTitleTag);
                    
                    $fotoDescription = $doc->createElement('fotoDescription');
                    $fotoText = $doc->createTextNode("Suuuuuper spannender Text fuer das Foto!kndsgjkndlkgndflkgndfklgndlkfgdkllfgdfgdgdgdgkldnglkdngldkngkldg");
                    $fotoText = $fotoDescription->appendChild($fotoText);
                    $fotoDescription = $foto->appendChild($fotoDescription);
                    
                    
                    $foto = $album->appendChild($foto);
                }
                
                $album = $channel->appendChild($album);
            }
            
            */
            
        ?>
    </body>
</html>
