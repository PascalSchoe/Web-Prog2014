<?php


/**
 * Description of DatenbankManager
 *
 * @author User
 */
class DatenbankManager {
   private static $verbindung;
   private static $datenbank;
   private static $benutzer;
   private static $alben;
   private static $fotos;
   private static $gridFS;
  
   function __construct() {
       if(DatenbankManager::$verbindung == null)
           $this->DBInitialisieren();
   }
   
   
   function DBInitialisieren(){
       DatenbankManager::$verbindung = new Mongo();
       DatenbankManager::$datenbank = DatenbankManager::$verbindung->selectDB('PSchoe_Voila_DB');
       DatenbankManager::$benutzer = DatenbankManager::$datenbank->selectCollection('Benutzer');
       DatenbankManager::$alben = DatenbankManager::$datenbank->selectCollection('Alben');
       DatenbankManager::$fotos = DatenbankManager::$datenbank->selectCollection('Fotos');
       DatenbankManager::$gridFS = DatenbankManager::$datenbank->getGridFS();
   }
   
   
   function speicherAlbumText($benutzerName,$albumName, $albumText)
   {
       $album = DatenbankManager::$alben->findOne(array("benutzerName" => $benutzerName, "albumName" => $albumName));
       
       $albumTexte = $album["albumTexte"];

       array_push($albumTexte, $albumText);
       
       $album = DatenbankManager::$alben->findAndModify(
                    array("benutzerName" => $benutzerName, "albumName" => $albumName),
                    array('$set' => array("albumTexte" => $albumTexte)),
                    array(),
                    array("new" => true)
               );
   }
   function fotoHochladen($fotoName, $benutzerName, $albumName, $fotoText){
       
      // $fotos = $this->gibAlleXVon("alben", "albumName", $albumName, "fotos");
       
       
       
       $alben = DatenbankManager::$alben->findOne(array("albumName" => $albumName));
       
       $fotos = $alben["fotos"];
       
       
       foreach($fotos as $foto)
       {
           if($foto == $fotoName)
           {
               return "fehlschlag";
           }
       }
       
       array_push($fotos, $fotoName);
       
       $album = DatenbankManager::$alben->findAndModify(
                    array("benutzerName" => $benutzerName, "albumName" => $albumName),
                    array('$set' => array("fotos" => $fotos)),
                    array(),
                    array("new" => true)
               );
       $id = DatenbankManager::$gridFS->storeUpload("file", array("fotoName" => $fotoName));
       
       DatenbankManager::$fotos->insert(array("fotoName" => $fotoName,"benutzerName" =>$benutzerName,"albumName" => $albumName, "fotoText" => $fotoText));
       
       return "erfolgreich";
   }
   
   function getImage($daten)
   {
        $file = DatenbankManager::$gridFS->findOne(array('filename' => $daten));
        echo $file->getBytes();
   }
   
   function testeVerfuegbarkeitBenutzername($name)
   {
       $verfuegbar = false;
       
       $bName = DatenbankManager::$benutzer->findOne(array("benutzerName" => $name));
       
       if($bName == null)
       {
           $verfuegbar = true;
       }
       
       return $verfuegbar;
   }
   
   function erstelleBenutzer($benutzerName, $passwort)
   {
       DatenbankManager::$benutzer->insert(array("benutzerName" => $benutzerName, "passwort" => $passwort, "alben" => array()));
       
   }
   
   function benutzerEinloggen($benutzerName, $passwort)
   {
       $erfolgreich = false;
       
       $benutzer = DatenbankManager::$benutzer->findOne(array("benutzerName" => $benutzerName, "passwort" => $passwort,));
       
       if($benutzer != null)
       {
           $erfolgreich = true;
       }
       return $erfolgreich;
   }
   /*
   function gibAlleXVon($col,$key,$value, $item)
   {
       
       $colItem = DatenbankManager::$$col->findOne(array($key => $value));
       
       return $colItem[$item];
   }
   */   
   function gibAlleAlbenVon($benutzerName)
   {
       $benutzer = DatenbankManager::$benutzer->findOne(array("benutzerName" => $benutzerName));
       
       return $benutzer["alben"];
   }
   
   function speicherAlbumNamen($benutzerName, $albumName, $template, $anordnung)
   {
       $alben = $this->gibAlleAlbenVon($benutzerName,"alben");
       
       foreach($alben as $album)
       {
           if($album == $albumName)
           {
               return "fehlschlag";
           }
       }
       
       array_push($alben, $albumName);
       
       $benutzer = DatenbankManager::$benutzer->findAndModify(
                    array("benutzerName" => $benutzerName),
                    array('$set' => array("alben" => $alben)),
                    array(),
                    array("new" => true)
               );
       DatenbankManager::$alben->insert(array("albumName" => $albumName, "benutzerName" => $benutzerName, "template" => $template, "anordnung" => $anordnung, "albumTexte" => array(), "fotos" => array(),"freigabe" => "nein"));
       
       return "erfolgreich";
   } 
}
