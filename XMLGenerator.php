<?php
/*
    <album benutzer="?" name="" anordnung="" template="">
        <albumText index="">
        </albumText>
        <foto name="" index="">
 *         <fotoText>
 *         </fotoText> 
 *      </foto>
    </album>
  
 */ 

class XMLGenerator
{
    private $doc;
    private $album;
    
    function __construct($benutzerName,$albumName,$anordnung,$template) 
    {
       $this->initialisiereXML();
       $this->albumErstellen($benutzerName, $albumName, $anordnung, $template);
    }
    
    function initialisiereXML()
    {
        $this->doc = new DomDocument("1.0", "utf-8");
        $this->doc->formatOutput =true;
       
    }
    
    function albumErstellen($benutzerName,$albumName,$anordnung,$template)
    {
        $this->album = $this->doc->createElement("album");
        $this->album->setAttribute("name", $albumName);
        $this->album->setAttribute("benutzer", $benutzerName);
        $this->album->setAttribute("anordnung", $anordnung);
        $this->album->setAttribute("template", $template);
        $this->album = $this->doc->appendChild($this->album);
    }
    
    function albumTextErstellen($index, $text)
    {
        $albumText = $this->doc->createElement("albumText");
        $albumText->setAttribute("index", $index);
        $aText = $this->doc->createTextNode($text);
        $aText = $albumText->appendChild($aText);
        $albumText= $this->album->appendChild($albumText);
    }
    
    function fotoErstellen($fotoName, $index, $text)
    {
        $foto = $this->doc->createElement("foto");
        $foto->setAttribute("name", $fotoName);
        $foto->setAttribute("index", $index);
        $fotoText = $this->doc->createElement("fotoText");
        $fText =$this->doc->createTextNode($text);
        $fText = $fotoText->appendChild($fText);
        $fotoText =$foto->appendChild($fotoText);
        $foto = $this->album->appendChild($foto);
    }
    
    function speicherXMLFile($benutzerName,$albumName,$version, $seite)
    {
        if($seite > 0)
            $datei = "XML/" . $benutzerName . $albumName . $version . $seite . ".xml";
        else
            $datei = "XML/" . $benutzerName . $albumName . $version . ".xml";
        
        $bytes = $this->doc->save($datei);
        
        flush();
    }
    function beliebigesElementErstellen($element, $class, $id, $text)
    {
        $ele = $this->doc->createElement($element);
        $eText= $this->doc->createTextNode($text);
        $ele->setAttribute("class", $class);
        
        $eText = $ele->appendChild($eText);
        $ele = $this->album->appendChild($ele);
    }
}
?>