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
   private static $gridFS;
  
   function __construct() {
       if(DatenbankManager::$verbindung == null)
           $this->DBInitialisieren();
   }
   
   
   function DBInitialisieren(){
       DatenbankManager::$verbindung = new Mongo();
       DatenbankManager::$datenbank = DatenbankManager::$verbindung->selectDB('PSchoe_Voila_DB');
       DatenbankManager::$benutzer = DatenbankManager::$datenbank->selectCollection('Benutzer');
       DatenbankManager::$gridFS = DatenbankManager::$datenbank->getGridFS();
       //DatenbankManager::$gridFS = new MongoGridFS(DatenbankManager::$datenbank, "meineBilder");
       
   }
   
   function textHinzufuegen($daten){
       $text = array("text" => $daten);
       DatenbankManager::$benutzer->insert($text);
   }
   function fotoHochladen($daten){
       $name = $daten['file']["name"];
       $id = DatenbankManager::$gridFS->storeUpload("file", array("fotoName" => $name));
       

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
   
   function gibAlleAlbenVon($benutzerName)
   {
       $benutzer = DatenbankManager::$benutzer->findOne(array("benutzerName" => $benutzerName));
       
       return $benutzer["alben"];
   }
   function speicherAlbumNamen($benutzerName, $albumName)
   {
       $alben = $this->gibAlleAlbenVon($benutzerName);
       
       array_push($alben, $albumName);
       
       $benutzer = DatenbankManager::$benutzer->findAndModify(
                    array("benutzerName" => $benutzerName),
                    array('$set' => array("alben" => $alben)),
                    array(),
                    array("new" => true)
               );
   }
}
