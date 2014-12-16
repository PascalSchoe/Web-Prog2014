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
   function aenderAlbumText($benutzerName, $albumName, $index, $albumText)
   {
       $album = DatenbankManager::$alben->findOne(array("benutzerName" => $benutzerName, "albumName" => $albumName));
       
       $albumTexte = $album["albumTexte"];
       
       $albumTexte[$index-1] = $albumText;
       
       $albumNeu = DatenbankManager::$alben->findAndModify(
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
   function aenderFoto($benutzerName, $albumName, $fotoName, $fotoText, $index)
   {
       $album = DatenbankManager::$alben->findOne(array("benutzerName" => $benutzerName, "albumName" => $albumName));
       
       $fotos = $album["fotos"];
       
       $altesFoto = $fotos[$index ];
       
       $fotos[$index] = $fotoName;
       
       $albumNeu = DatenbankManager::$alben->findAndModify(
                    array("benutzerName" => $benutzerName, "albumName" => $albumName),
                    array('$set' => array("fotos" => $fotos)),
                    array(),
                    array("new" => true)
               );
       // Auch aus gridFs ?
       DatenbankManager::$fotos->remove(array("fotoName" => $altesFoto,"benutzerName" => $benutzerName, "albumName" => $albumName), array("justOne" => true));
       DatenbankManager::$fotos->insert(array("fotoName" => $fotoName,"benutzerName" =>$benutzerName,"albumName" => $albumName, "fotoText" => $fotoText));
       $id = DatenbankManager::$gridFS->storeUpload("file", array("fotoName" => $fotoName));

   }
   
   function getImage($daten)
   {
        $file = DatenbankManager::$gridFS->findOne(array('filename' => $daten));
        echo $file->getBytes();
   }
   
   function gibFotoName($benutzerName,$albumName,$index)
   {
       $albumEintrag = DatenbankManager::$alben->findOne(array("benutzerName" => $benutzerName, "albumName" => $albumName));
       $fotoName = $albumEintrag["fotos"][$index];      
       return $fotoName;
   }
   function gibFotoText($benutzerName, $albumName, $fotoName)
   {
       $fotoEintrag = DatenbankManager::$fotos->findOne(array("benutzerName" =>$benutzerName, "albumName" => $albumName, "fotoName" => $fotoName));
   
        return $fotoEintrag["fotoText"];
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
   
   function gibAlbum($benutzerName, $albumName)
   {
       $album = DatenbankManager::$alben->findOne(array("benutzerName" => $benutzerName, "albumName" => $albumName));
       
       return $album;
   }
   
   function speicherAlbumNamen($benutzerName, $albumName, $template, $anordnung)
   {
       $alben = $this->gibAlleAlbenVon($benutzerName);
       
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
       DatenbankManager::$alben->insert(array("albumName" => $albumName, "benutzerName" => $benutzerName, "template" => $template, "anordnung" => $anordnung, "albumTexte" => array(), "fotos" => array(),"freigabe" => "freigegeben"));
       /*Test
         if($anordnung === "anordnung1")
       {
           DatenbankManager::$alben->insert(array("albumName" => $albumName, "benutzerName" => $benutzerName, "template" => $template, "anordnung" => $anordnung, "albumTexte" => [" "," ", " "], "fotos" => [" ", " "," "," "," "," "],"freigabe" => "freigegeben"));
       }
        * */
       
       return "erfolgreich";
   }
   function wechselFreigabeVon($benutzerName, $albumName)
   {
       $album = DatenbankManager::$alben->findOne(array("benutzerName" => $benutzerName, "albumName" => $albumName));
       
       
       $freigabe = $album["freigabe"];
       
       if($freigabe == "gesperrt")
       {
           $freigabe = "freigegeben";
       }
       else
       {
           $freigabe = "gesperrt";
       }
       
       
       $album = DatenbankManager::$alben->findAndModify(
               array("benutzerName" => $benutzerName, "albumName" => $albumName),
               array('$set' =>array("freigabe" => $freigabe)),
               array(),
               array("new" => true)
               );
       
       header("Location: kanal.html");
   }
   
   function albumLoeschen($benutzerName, $albumName)
   {
      $albenNeu = array();
       
       DatenbankManager::$alben->remove(array("benutzerName" => $benutzerName, "albumName" => $albumName), array("justOne" => true));
       
       $benutzer = DatenbankManager::$benutzer->findOne(array("benutzerName" => $benutzerName));
       
       $alben = $benutzer["alben"];
       
       foreach($alben as $album)
       {
           if($album != $albumName)
           {
               array_push($albenNeu, $album);
           }
       }
       $benutzerNeu = DatenbankManager::$benutzer->findAndModify(
                array("benutzerName" => $benutzerName),
                array('$set' =>array("alben" => $albenNeu)),
                array(),
                array("new" => true)
               );
       
        header("Location: kanal.html");
   }
   
   function aenderPasswortVon($benutzerName, $passwortAlt, $passwortNeu)
   {
       $status;
       
       $benutzer = DatenbankManager::$benutzer->findOne(array("benutzerName" => $benutzerName));
       
       $passwortDb = $benutzer["passwort"];
       
       if($passwortAlt == $passwortDb)
       {
           if($passwortNeu != $passwortDb)
           {
               $passwort = DatenbankManager::$benutzer->findAndModify(
                           array("benutzerName" => $benutzerName),
                           array('$set' => array("passwort" => $passwortNeu)),
                           array(),
                           array("new" => true)
                       );
               
               $status = "Dein Passwort wurde erfolgreich geaendert";
               
           }
           else
           {
               $status = "Das neue Passwort darf nicht mit dem alten uebereinstimmen";
           }
       }
       else 
       {
           $status = "Leider ist das eingegebene Passwort falsch";
       }
       
       
       return $status;
   }
   function gibAlleBilderVon($benutzerName, $albumName)
   {
       
   }
}

//http://www.fh-wedel.de/~si/seminare/ss01/Ausarbeitung/5.xslt/xslt6.htm
