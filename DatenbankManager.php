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
       $id = DatenbankManager::$gridFS->storeUpload('file', $name);
       

   }
   
   function getImage($daten)
   {
        $file = DatenbankManager::$gridFS->findOne(array('filename' => $daten));
        echo $file->getBytes();
   }
}